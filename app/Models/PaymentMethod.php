<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = "payment_methods";

    protected $fillable = [
        'name',
        'description'
    ];

}
