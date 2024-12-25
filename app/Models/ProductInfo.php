<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductInfo extends Model
{
    protected $table = 'product_info';
    protected $fillable = [
        'pro_id',
        'weigth',
        'specification',
        'size',
        'description'
    ];
    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'id'); // Specify the foreign key and local key
    }
}
