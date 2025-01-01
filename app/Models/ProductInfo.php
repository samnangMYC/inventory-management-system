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
        'discount',
        'tax',
        'specification',
        'size',
        'description'
    ];
    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id', 'id'); // 'pro_id' is the foreign key in ProductInfo
    }
}
