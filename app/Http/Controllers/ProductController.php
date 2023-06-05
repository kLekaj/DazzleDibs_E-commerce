<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Gallery;


class ProductController extends Controller
{
    public function index(Category $category)
    {
        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })->with('gallery')->get();
    
        return view('site.app', ['products' => $products, 'category' => $category]);
    }
    

    public function search(Request $request, Category $category)
    {
        $searchTerm = $request->input('q');
    
        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('categories.id', $category->id);
        })->where('title', 'LIKE', '%' . $searchTerm . '%')->get();
    
        return view('site.search', ['products' => $products]);
    }


    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = Session::get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => $request->input('quantity', 1),
            ];
        }

        Session::put('cart', $cart);
        Session::flash('success', 'Product added to cart.');
        Session::put('cartCount', count($cart)); // Add this line to update the cart count

        return redirect()->back();
    }

    public function removeFromCart(Request $request, $productId)
    {
        $cart = Session::get('cart', []);
    
        // Check if the product is in the cart
        if (isset($cart[$productId])) {
            // Decrease the quantity by 1
            $cart[$productId]['quantity'] -= 1;
    
            // Remove the item from the cart if the quantity reaches 0
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
    
            Session::put('cart', $cart);
            Session::flash('success', 'Quantity removed from cart.');
            Session::put('cartCount', count($cart)); // Update the cart count
    
            return redirect()->back();
        }
    
        return redirect()->back()->with('error', 'Product not found in cart.');
    }    

}
