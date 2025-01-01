<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Session;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();
        $subCategories = SubCategory::all();
        $productPrices = Product::with('prices')->get();
        $productCategories = Product::with('subCategory')->get();
        $productInfo = Product::with('productInfo')->get();
        
          // Retrieve the cart from the session
        $cart = session()->get('cart', []);
        // dd($cartItem);
           // Initialize total price
        $totalQty = 0;
        $totalPrice = 0;

        // Iterate through the cart to calculate the total price
        foreach ($cart as $item) {
            $totalQty += $item['quantity'];
            $totalPrice += $item['price'] * $item['quantity'];
        }


        $data = [
            'products' => $products,
            'productPrices' => $productPrices,
            'productCategories' => $productCategories,
            'subCategories' => $subCategories,
            'productInfo' => $productInfo,
            'totalQty' => $totalQty,
            'totalPrice' => $totalPrice,
        ];
        return view('sales',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getFilterProductAjax(){
      $getProduct = Product::all();
    }
}
