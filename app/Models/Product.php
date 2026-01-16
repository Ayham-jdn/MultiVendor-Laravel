<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Brand; 
use App\Models\category;
use App\Models\User;
use App\Models\Store;   
use App\Models\productImage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'sku',
        'seller_id',
        'category_id',
        'brand_id',
        'store_id',
        'regular_price',
        'sale_price',
        'discounted_price',
        'tax_rate',
        'stock_quantity',
        'stock_status',
        'slug',
        'visibility',
        'meta_title',
        'meta_description',
        'status',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function seller() {
        return $this->belongsTo(User::class);
    }
    
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function images()
    {
        return $this->hasMany(productImage::class);
    }
}

