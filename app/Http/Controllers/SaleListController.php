<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\PaymentMethod;
class SaleListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Sales::with('customer')->orderBy('created_at', 'desc')->get();
        $saleInfo = Sales::with('saleInfo')->orderBy('created_at', 'desc')->get();
        $sales = Sales::orderBy('created_at', 'desc')->get();
        $paymentMethod = PaymentMethod::orderBy('created_at', 'desc')->get();
        $customer = Customers::orderBy('created_at', 'desc')->get();
            // Loop through each sale and its sale items
            // foreach ($sales as $sale) {
            //     echo "Sale ID: " . $sale->id . "<br>";
    
            //     // Loop through sale items
            //     foreach ($sale->saleItems as $item) {
            //         echo "Product ID (pro_id): " . $item->pro_id . "<br>";
            //     }
            //     echo "<hr>";
            // }

        $data = [
            'customer' => $customer,
            'sales' => $sales,
            'paymentMethod' => $paymentMethod,
            'saleInfo' => $saleInfo,
        ];

        return view('saleList.sale-list',$data);
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
}
