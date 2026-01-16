<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Livewire\Component;

class CategoryBrand extends Component
{
    public $categories = [];
    public $selectedCategory;
    public $brands = [];

    public function mount(){
        $this->categories = Category::all();
    }
    public function updatedSelectedCategory($categoryId){
        $this->brands = Brand::where('category_id', $categoryId)->get();
    }

    public function render()
    {
        return view('livewire.category-brand');
    }
}
