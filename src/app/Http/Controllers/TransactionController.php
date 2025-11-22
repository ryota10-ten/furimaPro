<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index($id)
    {
        $userId = Auth::id();
        $transaction = Transaction::with(['product','messages.sender'])->findOrFail($id);
        $partner = $transaction->seller_id == $userId
            ? $transaction->buyer
            : $transaction->seller;
        $messages = $transaction->messages()->orderBy('created_at')->get();
        $otherTransactions = Transaction::with('product')
            ->where('status', Transaction::STATUS_PENDING)
            ->where(function ($q) use ($userId) {
                $q->where('seller_id', $userId)
                  ->orWhere('buyer_id', $userId);
            })
            ->where('id', '!=', $id)
            ->orderByDesc('last_message_at')
            ->get();

        return view('transaction',compact('transaction','partner','messages','otherTransactions'));
    }

    public function complete($id)
    {
        $userId = Auth::id();
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => Transaction::STATUS_COMPLETED]);
        \Mail::to($transaction->seller->email)->send(new \App\Mail\TransactionCompleted($transaction));

        return redirect()->back();
    }
}
