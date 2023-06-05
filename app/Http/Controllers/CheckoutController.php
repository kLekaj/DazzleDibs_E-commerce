<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Set your Stripe API secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Create a Stripe Charge
        $charge = Charge::create([
            'amount' => $request->amount,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Purchase Description',
        ]);

        // Handle the successful payment (e.g., update order status, send email, etc.)

        // Redirect the user to a thank you page or any other appropriate page
        return redirect()->route('thankyou');
    }
}
