<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'descriptions',
    ];

    static function getCategory($cat_id){
        return Category::where('id', $cat_id)->first();
    }
}
