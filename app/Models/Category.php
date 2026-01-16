<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Brand; 

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
