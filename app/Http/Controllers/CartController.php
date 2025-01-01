<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);
        $productId = $request->product_id;
        $productPrice = $request->price;
        $product = Product::find($productId);
      
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        }
        // Add product to cart
        $cart = session()->get('cart', []);
          // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            // If it is, increase the quantity
            $cart[$productId]['quantity'] += 1; // Increment quantity
        } else {
            // If not, add it to the cart with a quantity of 1
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $productPrice,
                'quantity' => 1, // Set quantity to 1
            ];
        }
        session()->put('cart', $cart);

        // dd(session()->all());
        return redirect()->route(route: 'sale.index');
    }
    public function update(Request $request, $id)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$id])) {
            // Determine the action (increase or decrease)
            if ($request->input('action') === 'increase') {
                $cart[$id]['quantity'] += 1; // Increase quantity
            } elseif ($request->input('action') === 'decrease') {
                // Decrease quantity but ensure it doesn't go below 1
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity'] -= 1; // Decrease quantity
                }
            }

            // Update the session with the modified cart
            session()->put('cart', $cart);

            return redirect()->route('sale.index');
        }

        return redirect()->route('sale.index')->with('error', 'Product not found in cart!');
    }
    public function destroy($id){
           // Retrieve the cart from the session
    $cart = session()->get('cart', []);

    // Check if the product exists in the cart
    if (isset($cart[$id])) {
        // Remove the product from the cart
        unset($cart[$id]);
        // Update the session with the new cart
        session()->put('cart', $cart);
        return redirect()->route('sale.index');
    }

    return redirect()->route('sale.index')->with('error', 'Product not found in cart!');
    }
}
