<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPrice;
use App\Models\SubCategory;
use App\Models\ProductInfo;
use App\Models\SaleItems;
class Product extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'stock',
        'description',
        'sub_cat_id',
        'brand_id',
        'image',
    ];
     // Define the relationship with ProductPrice
     public function prices()
     {
         return $this->hasMany(ProductPrice::class, 'pro_id');
     }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id');	
    }

      // Define the relationship with ProductInfo
      public function productInfo()
      {
          return $this->hasOne(ProductInfo::class, 'pro_id', 'id'); // 'pro_id' is the foreign key in ProductInfo
      }
      public function saleItems(){
        return $this->hasMany(SaleItems::class);
     }

      static public function getProductPrice($id)
      {
                // Retrieve the latest product price
            $productPrice = ProductPrice::where('pro_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

            // Return the product price or a default value
            return $productPrice ?? null;	
      }
      static public function getProductInfo($id){
        // Retrieve the product info
        $productInfo = ProductInfo::where('pro_id', $id)->first();
        // Return the product info or a default value
        return $productInfo ?? null;
      }

}
