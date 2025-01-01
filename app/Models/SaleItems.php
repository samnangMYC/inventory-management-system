<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class SaleItems extends Model
{
    use HasFactory;

    protected $table = 'sale_items';
    protected $fillable = [
        'sale_id',
        'pro_id',
        'quantity',
        'price',
        'discount',
        'tax',
        'shipping'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'sale_id');
    }
}
