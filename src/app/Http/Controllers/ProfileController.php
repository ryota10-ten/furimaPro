<?php

namespace App\Http\Controllers;

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

        return view ('mypage',compact('listings','orders','ratingStars'));
    }
}
