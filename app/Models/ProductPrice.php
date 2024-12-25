<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPrice extends Model
{
    use HasFactory;
    protected $table = 'product_price';
    protected $fillable = [
        'name',
        'pro_id',
        'price',
    ];
        // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }
    
    static function getProductPrice(){
         // Fetch all products
         $products = Product::all();

    
         // Initialize an array to hold product prices
         $productPrices = [];
     
         // Loop through each product to get the latest price
         foreach ($products as $product) {
             $latestPrice = ProductPrice::where('pro_id', $product->id)
                 ->orderBy('created_at', 'desc') // Order by created_at in descending order
                 ->first(); // Get the first result
     
             // Store the latest price in the array with the product ID as the key
             $productPrices[$product->id] = $latestPrice;
         }
               // Fetch all product info and brands
            $productsInfo = ProductInfo::all();
            $brands = ProductBrand::all();
        
            // Prepare data for the view
            $data = [
                'products' => $products,
                'product_prices' => $productPrices,
                'products_info' => $productsInfo,
                'brands' => $brands,
            ];
    
    }
}
