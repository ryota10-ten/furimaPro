<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            $userId = Auth::id();
            $favorites = Auth::user()->favoriteProducts ?? collect();
            $listedProductIds = Listing::where('user_id', $userId)->pluck('product_id');
            $products = Product::with('orders')
                ->whereNotIn('id', $listedProductIds)
                ->get();
        }else{
            $favorites = collect();
            $products = Product::with('orders')->get();
        }

        return view('index',compact('products','favorites'));
    }

    public function search(Request $request)
    {
        $tab = $request->input('tab', 'tab1');
        $keyword = $request->keyword;

        if (Auth::check())
        {
            $user = Auth::user();
            $userId = Auth::id();

            if ($tab === 'tab2') {
                $favorites = $user->favoriteProducts()->where('name', 'like', "%{$keyword}%")->get();
                $products = Product::with('orders')->whereDoesntHave('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->get();
            } else {
                $favorites = $user->favoriteProducts;
                $products = Product::with('orders')->whereDoesntHave('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->KeywordSearch($keyword)->get();
            }
        } else {
            $favorites = null;
            $products = Product::with('orders')->KeywordSearch($keyword)->get();
        }

        return view('index', compact('products', 'favorites', 'tab'));
    }
}
