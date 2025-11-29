<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $averageRating = $user->reviewsReceived()->avg('rating');
        $ratingStars = round($averageRating ?? 0);
        $listings = $user->listingProducts;
        $orders = $user->orderProducts;
        $transactions = Transaction::with(['product','seller','buyer','messages'])
            ->where('status',Transaction::STATUS_PENDING)
            ->relatedToUser($user->id)
            ->orderByDesc('last_message_at')
            ->get();
        $transactions = Transaction::with(['product','seller','buyer','messages'])
            ->where(function($query) use ($user) {
                $query->where('status', Transaction::STATUS_PENDING)
                    ->relatedToUser($user->id);
            })
            ->orWhere(function($query) use ($user) {
                $query->where('status', Transaction::STATUS_COMPLETED)
                    ->relatedToUser($user->id)
                    ->whereDoesntHave('reviews', function($q) use ($user) {
                        $q->where('reviewer_id', $user->id);
                    });
            })
            ->orderByDesc('last_message_at')
            ->get();
        $totalUnread = $transactions->sum(function ($transaction) use ($user) {
            return $transaction->unreadMessageCount($user->id);
        });

        return view ('mypage',compact('listings','orders','ratingStars','transactions', 'totalUnread'));
    }
}
