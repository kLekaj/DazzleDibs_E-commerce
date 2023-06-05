<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Session;
use Stripe;
    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        // Retrieve the cart and total amount from the session
        $cart = Session::get('cart', []);
        $totalAmount = Session::get('totalAmount', 0);
    
        // Calculate the updated total amount based on item prices and quantities
        $afterTransport = 0;
        $updatedTotalAmount = 0;
        $description = "Payment for items: ";
    
        foreach ($cart as $productId => $item) {
            $updatedTotalAmount += $item['product']->price * $item['quantity'];
            $description .= $item['quantity'] . "x " . $item['product']->id . ", ";
        }
    
        $afterTransport = $updatedTotalAmount + 50;
    
        Stripe\Charge::create([
            "amount" => $afterTransport * 100, // Multiply by 100 to convert dollars to cents
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => rtrim($description, ", ") // Remove the trailing comma
        ]);
    
        Session::flash('success', 'Payment successful!');
    
        return back();
    }
    
}