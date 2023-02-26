<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function selectedProductsByCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        
        return response()->json([
            'products' => $products
        ]);
    }
}
