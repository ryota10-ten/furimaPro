<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();

        Review::create([
            'transaction_id' => $request->transaction_id,
            'reviewer_id' => $userId,
            'reviewee_id' => $request->reviewee_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('index');
    }
}
