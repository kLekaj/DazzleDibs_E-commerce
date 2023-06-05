<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create($request->all());

        return redirect()->back()->with('success', 'Review added successfully.');
    }

    public function index($productId)
    {
        $product = Product::findOrFail($productId); // Assuming you have a `Product` model
        
        return view('reviews.create', compact('product'));
    }
    
}

