<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
class Invoice extends Model
{
    use HasFactory;

    
    protected $table = "invoices";
    protected $fillable = [
       'name',
       'url',

    ];    
    public function sale(){
        return $this->belongsTo(Sales::class);
    }

}
