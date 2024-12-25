<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductBrand extends Model
{
    use HasFactory;
    protected $table = 'product_brand';
    protected $fillable = [
        'name',
        'contact',
        'url',
    ];
    static function getProductBrand($id){
        return ProductBrand::where('id', $id)
             ->value('name');
    }
}
