<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('cart.cart');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cartItems = Session()->get('cartItems');

        if (isset($cartItems[$id])) {
            $cartItems[$id]['quantity']++;
        } else {
            $cartItems[$id] = [
                "name" => $product->name,
                "details" => $product->details,
                "image_path" => $product->image_path,
                "quantity" => 1,
                "price" => $product->price
            ];
        }
        Session()->put('cartItems', $cartItems);
        return redirect()->back()->withSuccess('Product Added To Cart!.');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cartItems = session()->get('cartItems');
            $cartItems[$request->id]["quantity"] = $request->quantity;
            session()->put('cartItems', $cartItems);
        }

        return redirect()->back()->withSuccess('Product Updated From cart!');
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $cartItems = session()->get('cartItems');
            if (isset($cartItems[$request->id])) {
                unset($cartItems[$request->id]);
                Session()->put('cartItems', $cartItems);
            }
            return redirect()->back()->withSuccess('Product Remove From Cart!.');
        }
    }
}
