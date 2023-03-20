<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;

class SellerController extends Controller
{
    public function showRegistrationForm()
    {
        return view('seller.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:sellers,email',
            'password' => 'required|confirmed',
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
        ]);

        $seller = new Seller();
        $seller->email = $request->email;
        $seller->password = bcrypt($request->password);
        $seller->company_name = $request->company_name;
        $seller->phone = $request->phone;
        $seller->address = $request->address;
        $seller->city = $request->city;
        $seller->country = $request->country;
        $seller->postal_code = $request->postal_code;
        $seller->save();

        Auth::guard('seller')->login($seller);

        return redirect()->intended('/seller/dashboard');
    }

    public function showLoginForm()
    {
        return view('seller.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/seller/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('seller')->logout();

        return redirect('/seller/login');
    }
}
