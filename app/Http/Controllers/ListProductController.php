<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PhotoSession;
use App\Http\Requests\ShowListProductRequest;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Customer;
use App\Models\Keranjang;
use App\Models\Photographer;
use App\Models\ProductDiscount;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ListProductController extends Controller
{
    public function index(ShowListProductRequest $request)
    {
        $title = "List - Products";

        $query = Product::query();

        if ($request->has('category')) {
            $query->where('product_category_id', $request->category);
        }
        if ($request->has('order')) {
            switch ($request->order) {
                case 'termurah':
                    $query->orderBy('price', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('price', 'desc');
                    break;
                case 'kategori':
                    $query->orderBy('product_category_id', 'asc');
                    break;
            }
        }
        $products = $query->get();
        $kategories = ProductCategory::get();
        $sessionPhoto = PhotoSession::where('code', 'like', '%IS%')->get();
        $sessionOutdoor = PhotoSession::where('code', 'like', '%OS%')->get();
        return view('master.list-product.index', compact('title', 'products', 'kategories', 'sessionPhoto', 'sessionOutdoor'));
    }
    public function show_detail(string $id)
    {
        $title = "Detail - Products";
        $data = Product::with('category')->findOrFail($id);
        $sessionPhoto = PhotoSession::where('code', 'like', '%IS%')->get();
        $sessionOutdoor = PhotoSession::where('code', 'like', '%OS%')->get();
        return view('master.list-product.detail', compact('title', 'data', 'sessionPhoto', 'sessionOutdoor'));
    }

    public function store_detail(StoreTransactionRequest $request)
    {
        try {
            $isPayment = $request->payment_method ?? 'cash';
            $paidAt = $isPayment ? now() : Carbon::now();
            $totalPrice = 0;

            $id_user = Auth::user()->id;
            $customer = Customer::where('user_id', $id_user)->first();

            $transaction = Transaction::create([
                'customer_id'    => $customer->id,
                'total_price'    => 0,
                'payment_status' => $isPayment !== 'cash' ? 'paid' : 'pending',
                'payment_method' => $isPayment,
                'paid_at'        => $isPayment ? now() : null,
            ]);

            $productId = $request->product_id;
            $product = Product::findOrFail($productId);
            $price = $product->price;

            $discount = ProductDiscount::where('product_id', $productId)
                ->where('start_date', '<=', $paidAt)
                ->where('end_date', '>=', $paidAt)
                ->first();

            $discountAmount = $discount ? ($price * $discount->discount / 100) : 0;
            $quantity = $request->quantity ?? 1;
            $total = ($price * $quantity) - $discountAmount;
            $totalPrice += $total;

            $cekDetail = TransactionDetail::where('schedule', $request->photo_date)
                ->where('photo_session_id', $request->photo_session_id)
                ->get();
            $sessionData = PhotoSession::where('id', $request->photo_session_id)->first();

            if ($cekDetail->count() > 1) {
                $transaction->delete();
                Alert::error('Error', 'Schedule di tanggal ' . $request->photo_date . ' di jam ' . $sessionData->start_time . ' sudah penuh');
                return redirect()->back()->withInput();
            }
            $photographerId = Photographer::inRandomOrder()->value('id');

            TransactionDetail::create([
                'transaction_id'     => $transaction->id,
                'product_id'         => $productId,
                'photo_session_id'   => $request->photo_session_id ?? null,
                'discount_id'        => $discount->id ?? null,
                'photographer_id'    => $photographerId,
                'price'              => $price,
                'total'              => $total,
                'schedule'           => $request->photo_date ?? null,
                'status'             => false,
            ]);

            $transaction->update(['total_price' => $totalPrice]);

            Alert::success('Sukses', 'Transaksi berhasil dibuat.');
            return redirect()->route('list.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function store(StoreTransactionRequest $request)
    {
        try {
            $isPayment = $request->payment_method ? $request->payment_method : 'cash';
            $paidAt = $isPayment ? now() : Carbon::now();
            $isCash =  $request->payment_method === 'cash';
            $totalPrice = 0;

            $id_user = Auth::user()->id;
            $customer = Customer::where('user_id', $id_user)->first();
            $transaction = Transaction::create([
                'customer_id'    => $customer->id,
                'total_price'    => 0,
                'payment_status' => $isPayment !== 'cash' && $isPayment !== ''  ? 'paid' : 'pending',
                'payment_method' => $isPayment,
                'paid_at'        => $isPayment ? now() : null,
            ]);

            foreach ($request->product_id as $index => $productId) {
                $product = Product::findOrFail($productId);
                $price = $product->price;

                $discount = ProductDiscount::where('product_id', $productId)
                    ->where('start_date', '<=', $paidAt)
                    ->where('end_date', '>=', $paidAt)
                    ->first();
                $cekTransaction = TransactionDetail::whereDate('schedule', $request->photo_date[$index])
                    ->where('photo_session_id', $request->photo_session_id[$index])
                    ->get();

                $sessionData = PhotoSession::where('id', $request->photo_session_id[$index])->first();
                if ($cekTransaction->count() > 1) {
                    $transaction->delete();
                    Alert::error('Error', 'Schedule di tanggal ' . $request->photo_date[$index] . ' di jam ' . $sessionData->start_time . ' sudah penuh');
                    return redirect()->back()->withInput();
                }
                $discountAmount = $discount ? ($price * $discount->discount / 100) : 0;
                $total = ($price * $request->quantity[$index]) - $discountAmount;

                $totalPrice += $total;
                $photographerId = Photographer::inRandomOrder()->value('id');

                TransactionDetail::create([
                    'transaction_id'     => $transaction->id,
                    'product_id'         => $productId,
                    'photo_session_id'   => $request->photo_session_id[$index] ?? null,
                    'discount_id'        => $discount->id ?? null,
                    'photographer_id'    => $photographerId,
                    'price'              => $price,
                    'total'              => $total,
                    'schedule'           => $request->photo_date[$index] ?? null,
                    'status'             => false,
                ]);
                if ($request->id[$index]) {
                    $keranjang = Keranjang::where('id', $request->id[$index])->first();
                    if ($keranjang) {
                        $keranjang->delete();
                    }
                }
            }
            $transaction->update(['total_price' => $totalPrice]);
            if ($isCash) {
                Alert::success('Sukses', 'Transaksi berhasil dibuat.');
                return redirect()->route('list.index');
            } else {
                Alert::success('Sukses', 'Transaksi berhasil dibuat.');
                return redirect()->route('list.index');
            }
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function bucket()
    {
        $title = 'Keranjang -Products';

        $userId = Auth::user()->id;
        $customer = Customer::where('user_id', $userId)->first();

        $customerId = $customer->id;
        $keranjang = DB::table('keranjangs')
            ->join('products', 'keranjangs.products_id', '=', 'products.id')
            ->join('photo_sessions', 'keranjangs.photo_session_id', '=', 'photo_sessions.id')
            ->where('customers_id', $customerId)
            ->orderBy('keranjangs.created_at', 'desc')
            ->select(
                'keranjangs.id as id',
                'keranjangs.products_id as id_product',
                'keranjangs.photo_session_id as session_id',
                'keranjangs.jumlah as jumlah',
                'keranjangs.schedule as schedule',
                'products.name as name_product',
                'products.price as price',
                'products.photo as photo',
                'photo_sessions.name as name_session',
                'photo_sessions.start_time as start',
                'photo_sessions.end_time as end'
            )->get();
        $kategories = ProductCategory::get();
        return view('master.list-product.keranjang', compact('title', 'keranjang', 'kategories'));
    }
    public function store_bucket(StoreKeranjangRequest $request)
    {
        try {
            $userId = Auth::user()->id;
            $customer = Customer::where('user_id', $userId)->first();

            if ($request->product_id === "") {
                Alert::error('Error', 'Id produk cannot be empty!');
            }
            $product = Product::findOrFail($request->product_id);

            if ($request->quantity <= 0) {
                Alert::error('Error', 'Jumlah cannot be empty!');
            }

            Keranjang::create([
                'customers_id' => $customer->id,
                'products_id' => $request->product_id,
                'jumlah' => $request->quantity,
                'photo_session_id' => $request->photo_session_id,
                'schedule' => $request->photo_date
            ]);
            Alert::success('Sukses', 'Produk telah ditambahkan ke keranjang.');
            return redirect()->route('list.index');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function store_delete(string $id)
    {
        try {
            $cek = Keranjang::where('id', $id)->first();
            if ($cek) {
                $cek->delete();
                return response()->json(['success' => true]);
            }
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
