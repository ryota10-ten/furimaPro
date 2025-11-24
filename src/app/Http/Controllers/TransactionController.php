<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index($id)
    {
        $userId = Auth::id();
        $transaction = Transaction::with(['product','messages.sender'])
            ->where('id', $id)
            ->where(function ($query) use ($userId) {
                $query->where('seller_id', $userId)
                    ->orWhere('buyer_id', $userId);
            })
            ->firstOrFail();

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
        TransactionMessage::where('transaction_id', $transaction->id)
            ->where('sender_id', '!=', $userId)
            ->where('read', false)
            ->update(['read' => true]);

        $alreadyReviewed = Review::where('transaction_id', $transaction->id)
            ->where('reviewer_id', $userId)
            ->exists();
        $showReviewModal = (
            $transaction->status === Transaction::STATUS_COMPLETED &&
            !$alreadyReviewed
        );

        return view('transaction',compact('transaction','partner','messages','otherTransactions','showReviewModal'));
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
