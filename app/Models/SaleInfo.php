<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
class SaleInfo extends Model
{
    use HasFactory;

    
    protected $table = "sale_info";
    protected $fillable = [
       'sale_id',
       'discount',
       'tax',
       'shipping',
       'description',

    ];
    public function sale(){
        return $this->belongsTo(Sales::class,'sale_id');
    }

}
