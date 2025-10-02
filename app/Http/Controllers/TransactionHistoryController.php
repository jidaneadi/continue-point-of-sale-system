<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $title = "Transaction History";

        $user_id = Auth::id();
        $customer = Customer::where('user_id', $user_id)->first();
        if (!$customer) {
            Alert::error('Error', 'Customer not found!');
        }
        $transaction = Transaction::with([
            'details.product',
            'details.photoSession',
            'details.photographer.user'
        ])
        ->where('payment_status', 'paid')
        ->where('customer_id', $customer->id)
        ->get();
        // dd($transaction->toArray());
        return view('master.transaction-history.index', compact('title', 'transaction'));
    }
    public function pending()
    {
        $title = "Transaction History";

        $user_id = Auth::id();
        $customer = Customer::where('user_id', $user_id)->first();
        if (!$customer) {
            Alert::error('Error', 'Customer not found!');
        }
        $transaction = Transaction::with([
            'details.product',
            'details.photoSession',
            'details.photographer.user'
        ])
        ->where('customer_id', $customer->id)
        ->where('payment_status', 'pending')
        ->get();
        // dd($transaction->toArray());
        return view('master.transaction-history.pending', compact('title', 'transaction'));
    }
    public function unpaid()
    {
        $title = "Transaction History";

        $user_id = Auth::id();
        $customer = Customer::where('user_id', $user_id)->first();
        if (!$customer) {
            Alert::error('Error', 'Customer not found!');
        }
        $transaction = Transaction::with([
            'details.product',
            'details.photoSession',
            'details.photographer.user'
        ])
        ->where('customer_id', $customer->id)
        ->where('payment_status', 'unpaid')
        ->get();
        // dd($transaction->toArray());
        return view('master.transaction-history.unpaid', compact('title', 'transaction'));
    }
    public function repayment()
    {
        $title = "Transaction History";

        $user_id = Auth::id();
        $customer = Customer::where('user_id', $user_id)->first();
        if (!$customer) {
            Alert::error('Error', 'Customer not found!');
        }
        $transaction = Transaction::with([
            'details.product',
            'details.photoSession',
            'details.photographer.user'
        ])
        ->where('customer_id', $customer->id)
        ->where('payment_status', 'repayment')
        ->get();
        // dd($transaction->toArray());
        return view('master.transaction-history.repayment', compact('title', 'transaction'));
    }
}
