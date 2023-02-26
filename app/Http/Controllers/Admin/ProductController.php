<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\SaveRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Addon;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('entity','product_options')->latest()->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.add', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRequest $request)
    {
        try {
            $product = new Product();
            $product->title   = $request->title;
            $product->category_id = $request->category_id;
            $product->status = $request->filled('status') ? true : false;
            $product->save();

            //Store Product variations
                    foreach ($request->product_option_size as $key => $product_option_size) {
                        $product->product_options()->create([
                            'size' => $request->product_option_size[$key],
                            'color' => $request->product_option_color[$key],
                            'quantity' => $request->product_option_quantity[$key],
                            'price' =>  $request->product_option_price[$key]
                        ]);
                    }
                
            

            if ($product) {
                toastr()->success('', ' Product added successfully');
                return redirect()->route('dashboard.products.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('product_options');
        // return $product;
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        try {
            $product->title   = $request->title;
            $product->title   = $request->title;
            $product->category_id = $request->category_id;
            $product->status = $request->filled('status') ? true : false;
            $product->save();

            // remove product variations
            $product->product_options()->delete();

            //Store Product variations
            foreach ($request->product_option_size as $key => $product_option_size) {
                $product->product_options()->create([
                    'size' => $request->product_option_size[$key],
                    'color' => $request->product_option_color[$key],
                    'quantity' => $request->product_option_quantity[$key],
                    'price' =>  $request->product_option_price[$key]
                ]);
            }
    

            if ($product) {
                toastr()->success('', '  The product has been updated successfully');
                return redirect()->route('dashboard.products.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            if ($product) {
                toastr()->success('', "Product removed successfully");
                return redirect()->route('dashboard.products.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
