<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class SubCategory extends Model
{
    
    use HasFactory;
    protected $table = 'sub_category';
    
    protected $fillable = [
        'name',
        'descriptions',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_cat_id', 'id');
    } 
}
