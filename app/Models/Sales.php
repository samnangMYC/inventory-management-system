<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SaleInfo;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\PaymentMethod;
use App\Models\SaleItems;
use App\Models\Customers;

class Sales extends Model
{
    use HasFactory;

    protected $table = "sales";
    protected $fillabel = [
        'invoice_id',
        'customer_id',
        'qty',
        'recieved_amount',
        'total_price',
        'payment_method_id',
    ];
    public function saleInfo(){
        return $this->hasOne(SaleInfo::class,'sale_id');
    }
 

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function saleItems()
    {
        return $this->hasMany(SaleItems::class,'sale_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

   

}
