<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        if (Auth::check()) {
            $user = Auth::user();
            $review = new Review();
            $review->user_id = $user->id;
            $review->product_id = $request->input('product_id');
            $review->content = $request->input('content');
            $review->rating = $request->input('rating');
            $review->save();
    
            return redirect()->back()->with('success', 'Review added successfully.');
        } else {
            return redirect()->route('login')->with('error', 'Please login to submit a review.');
        }
    }
    

    public function index($productId)
    {
        $product = Product::findOrFail($productId); // Assuming you have a `Product` model
        
        return view('site.product', compact('product'));
    }
    
}

