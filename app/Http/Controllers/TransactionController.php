<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Customer;
use App\Models\Photographer;
use App\Models\PhotoSession;
use App\Models\Product;
use App\Models\ProductDiscount;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        $title = "Transactions - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.transaction.index', compact('title'));
    }

    public function create()
    {
        $title = "Transactions - Create";

        $products = Product::get();
        $customers = Customer::with('user')->get();
        $photoSessions = PhotoSession::get();
        $photographers = Photographer::get();

        return view('master.transaction.create', compact('title', 'products', 'customers', 'photoSessions', 'photographers'));
    }

    public function store(StoreTransactionRequest $request)
    {
        try {
            $isCash = $request->payment_method === 'cash';
            $paidAt = $isCash ? now() : Carbon::now();

            $totalPrice = 0;

            $transaction = Transaction::create([
                'customer_id'    => $request->customer,
                'total_price'    => 0,
                'payment_status' => $isCash ? 'paid' : 'pending',
                'payment_method' => $request->payment_method,
                'paid_at'        => $isCash ? now() : null,
            ]);

            foreach ($request->product_id as $index => $productId) {
                $product = Product::findOrFail($productId);
                $price = $product->price;

                $discount = ProductDiscount::where('product_id', $productId)
                    ->where('start_date', '<=', $paidAt)
                    ->where('end_date', '>=', $paidAt)
                    ->first();

                $discountAmount = $discount ? ($price * $discount->discount / 100) : 0;
                $total = $price - $discountAmount;

                $totalPrice += $total;

                TransactionDetail::create([
                    'transaction_id'     => $transaction->id,
                    'product_id'         => $productId,
                    'photo_session_id'   => $request->photo_session_id[$index] ?? null,
                    'discount_id'        => $discount->id ?? null,
                    'photographer_id'    => $request->photographer_id[$index] ?? null,
                    'price'              => $price,
                    'total'              => $total,
                    'status'             => false,
                ]);
            }

            $transaction->update(['total_price' => $totalPrice]);

            if ($isCash) {
                Alert::success('Sukses', 'Transaksi cash berhasil dibuat.');
                return redirect()->route('transaction.index');
            } else {
                Alert::success('Sukses', 'Transaksi cash berhasil dibuat.');
                return redirect()->route('transaction.index');
            }
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        try {
            $transactionId = Crypt::decrypt($id);
            $data = Transaction::findOrFail($transactionId);

            $data->delete();

            Alert::success('Congrats', 'You\'ve successfully deleted');
            return redirect()->route('transaction.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid decryption key or ciphertext.');
            return redirect()->route('transaction.index');
        }
    }

    public function data()
    {
        $data = Transaction::with('customer.user')
                            ->get()
                            ->map(function ($transaction) {
                                $transaction->id = Crypt::encrypt($transaction->id);
                                return $transaction;
                            });

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('customer', function ($item) {
                return $item->customer->user->name ?? '-';
            })
            ->editColumn('total_price', function ($item) {
                return 'Rp. ' . number_format($item->total_price, 2, ',', '.');
            })
            ->editColumn('payment_status', function ($item) {
                return ucfirst($item->payment_status);
            })
            ->editColumn('payment_method', function ($item) {
                return ucfirst($item->payment_method);
            })
            ->editColumn('paid_at', function ($item) {
                return $item->paid_at ? $item->paid_at->format('d-m-Y H:i') : '-';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
