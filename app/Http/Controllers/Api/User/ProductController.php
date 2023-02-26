<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Category $category) {
        try {

            $products  = Product::where('category_id',$category->id)->where('status',1)->get();
            
            return response()->json([
                'products' => ProductResource::collection($products)
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
