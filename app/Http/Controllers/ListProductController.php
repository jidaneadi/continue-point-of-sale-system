<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PhotoSession;
use App\Http\Requests\ShowListProductRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Customer;
use App\Models\Photographer;
use App\Models\ProductDiscount;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        return view('master.list-product.index', compact('title', 'products', 'kategories', 'sessionPhoto'));
    }
    public function show_detail(string $id)
    {
        $title = "Detail - Products";
        $data = Product::with('category')->findOrFail($id);
        $sessionPhoto = PhotoSession::where('code', 'like', '%IS%')->get();
        return view('master.list-product.detail', compact('title', 'data', 'sessionPhoto'));
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

                $discountAmount = $discount ? ($price * $discount->discount / 100) : 0;
                $total = ($price * $request->quantity) - $discountAmount;

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
}
