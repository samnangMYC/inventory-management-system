<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\PaymentMethod;
use App\Models\SaleItems;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Sales;
use Illuminate\Support\Facades\Auth;
use App\Models\SaleInfo;
use App\Models\Role;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        // Retrieve the subcategory_id from the request
        $subCategory = $request->input('subcategory_id');
        $PermissionRole = PermissionRole::getPermission('Sale', Auth::user()->role_id);
        $PermissionAdd = PermissionRole::getPermission('Add Sale', Auth::user()->role_id);
        $PermissionRole = PermissionRole::all();
        if(!$PermissionRole){
            abort(404);
        }

        
        
        $products = Product::all();
        $subCategories = SubCategory::all();
        $productPrices = Product::with('prices')->get();
        $productCategories = Product::with('subCategory')->get();
        $productInfo = Product::with('productInfo')->get();
        $payment = PaymentMethod::all(); 
        $customers = Customers::all();
        
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);
        // dd($cart);

        $totalQty = 0;
        $totalPrice = 0;
        // Initialize total discount
        $totalDiscount = 0;
        $totalTax = 0;
        $finalPrice = 0;
        $totalShipping = 0;

        // Iterate through the cart to calculate the total price
        foreach ($cart as $item) {
            
             // Check if the discount key exists, if not set it to 0
            $discountPrice = ($item['discount']) / 100; // Default to
            $tax = ($item['tax']) / 100; 
            $totalQty += $item['quantity'];
            $totalPrice += $item['price'] * $item['quantity'] ;
            $totalDiscount += $item['price'] * $discountPrice;
            $totalTax += $item['price'] * $tax;
            $totalShipping += isset($item['shipping']) ? $item['shipping'] : 0; // Default to 0 if not set
           
        }
        $finalPrice =  $totalPrice - $totalDiscount - $totalTax - $totalShipping;

       
        session()->put('totalQuantity', $totalQty);
        session()->put('finalPrice', $finalPrice);
        session()->put('totalDiscount', $totalDiscount);
        session()->put('totalTax', $totalTax);
        session()->put('totalShipping', $totalShipping);

        $data = [
            'products' => $products,
            'productPrices' => $productPrices,
            'productCategories' => $productCategories,
            'subCategories' => $subCategories,
            'productInfo' => $productInfo,
            'totalQty' => $totalQty,
            'totalPrice' => $totalPrice,
            'payments' => $payment,
            'customers' => $customers,
            'totalDiscount' => $totalDiscount,
            'totalTax' => $totalTax,
            'totalShipping' => $totalShipping,
            'finalPrice' => $finalPrice,
            'PermissionAdd' => $PermissionAdd,
            'PermissionRole' => $PermissionRole,
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
        // dd($request);
        $totalQty = session()->get('totalQuantity');
        $finalPrice = session()->get('finalPrice');
        $totalDiscount = session()->get('totalDiscount');
        $totalTax = session()->get('totalTax');
        $totalShipping = session()->get('totalShipping');
         // Retrieve the cart from the session
         $cart = session()->get('cart', []);
        // dd($request->customer_name);
        $sale = new Sales();
        $sale->customer_id = $request->customer_name;
        $sale->qty =  $totalQty ;
        $sale->recieved_amount = $request->recieved_amount;
        $sale->total_price = $finalPrice;
        $sale->payment_method_id = $request->payment;
        $sale->save();
       
        $saleInfo = new SaleInfo();
        $saleInfo->sale_id = $sale->id;
        $saleInfo->discount = $totalDiscount;
        $saleInfo->tax = $totalTax;
        $saleInfo->shipping = $totalShipping;
        $saleInfo->description = $request->description;
        $saleInfo->save();
       
        // dd($cart);
        foreach($cart as $item){
            $saleItem = new SaleItems();
            $saleItem->sale_id = $sale->id; // Set the sale_id to the newly created sale's ID
            $saleItem->pro_id = $item['id']; // Use the key as the product ID
            $saleItem->quantity = $item['quantity'];
            $saleItem->price = $item['price'];
            $saleItem->discount = $item['discount'];
            $saleItem->tax = $item['tax'];
            $saleItem->shipping = $item['shipping'];
            $saleItem->save();
        }
               // Start a database transaction
        DB::transaction(function () use ($cart) {
            foreach ($cart as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];

                // Find the product
                $product = Product::findOrFail($productId);

                // Check if there is enough stock
                if ($product->stock < $quantity) {
                    return response()->json(['error' => 'Not enough stock for product ID ' . $productId], 400);
                }

                // Reduce the stock
                $product->stock -= $quantity;
                $product->save();
            }
        });
        //need to create database follow above one

        // $data = [
        //     'totalQty'=> $totalQty,
        //     'finalPrice' => $finalPrice,
        //     'totalDiscount' => $totalDiscount,
        //     'totalTax' => $totalTax,
        //     'totalShipping' => $totalShipping
        // ];
        // dd($data);
        
        // Optionally, clear the cart from the session
        session()->forget('cart');
        session()->forget('totalQuantity');
        session()->forget('finalPrice');
        session()->forget('totalDiscount');
        session()->forget('totalTax');
        session()->forget('totalShipping');


        return redirect()->route('sale.index')->with('success','Sale have created succesfully');
        
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
