<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
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

        $transaction = Transaction::where('customer_id', $customer->id)
            ->join('transaction_details as td', 'td.transaction_id', '=', 'transactions.id')
            ->join('products as p', 'p.id', '=', 'td.product_id')
            ->join('photo_sessions as ps', 'ps.id', '=', 'td.photo_session_id')
            ->join('photographers as pg', 'pg.id', '=', 'td.photographer_id')
            ->join('users as u', 'u.id', '=', 'pg.user_id')
            ->select(
                'transactions.*',
                'td.*',
                'p.name as product_name',
                'p.photo',
                'p.price as product_price',
                'ps.name as session_name',
                'ps.start_time',
                'ps.end_time',
                'u.name as photographer_name'
            )
            ->get();
        return view('master.transaction-history.index', compact('title', 'transaction'));
    }
}
