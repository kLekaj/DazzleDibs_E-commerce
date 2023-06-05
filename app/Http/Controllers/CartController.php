<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
    
        // Calculate the total amount
        $totalAmount = 0;
        foreach ($cart as $productId => $item) {
            $totalAmount += $item['product']->price * $item['quantity'];
        }
    
        // Store the cart and total amount in the session
        Session::put('cart', $cart);
        Session::put('totalAmount', $totalAmount);
    
        // Pass the total amount to the view
        return view('cart.index', [
            'cart' => $cart,
            'totalAmount' => $totalAmount,
        ]);
    }
    

    public function removeItem($productId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }

        Session::put('cartCount', count($cart)); // Add this line to update the cart count

        return back()->with('success', 'Item removed from cart.');
    }

}
