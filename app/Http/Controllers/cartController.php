<?php
// app/Http/Controllers/CartController.php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    // Add product to cart
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    // Display the cart
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $customer = Auth::user(); // Add this to pass the current user to the view
        return view('viewCart', compact('carts', 'customer'));
    }

    // Update cart item quantity
    public function update(Request $request, $id)
{
    $cart = Cart::find($id);
    if ($cart && $cart->user_id == Auth::id()) {
        $cart->quantity = $request->quantity;
        $cart->save(); // This save method should work fine here
        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }
    return redirect()->route('cart.index')->with('error', 'Cart item not found');
}


    // Remove cart item
    public function destroy($id)
    {
        $cart = Cart::find($id);
        if ($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
            return redirect()->route('cart.index')->with('success', 'Cart item removed');
        }
        return redirect()->route('cart.index')->with('error', 'Cart item not found');
    }

    // Update address
    public function updateAddress(Request $request)
{
    $request->validate([
        'new_address' => 'required|string|max:255',
    ]);

    $user = Auth::user();
    $user->address = $request->input('new_address');
    $user->save(); // Use the save() method inherited from Eloquent Model

    return redirect()->route('cart.index')->with('success', 'Address updated successfully.');
}
}

