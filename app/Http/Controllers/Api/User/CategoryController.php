<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index() {
        try {
            // $categories = Category::with('products')->where('status',1)->get();
            $categories = Category::where('status',1)->get();
            
            return response()->json([
                'categories' => CategoryResource::collection($categories)
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
