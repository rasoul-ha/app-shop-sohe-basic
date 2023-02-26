<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\SaveRequest;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::with('product','category','entity')->latest()->paginate();
        $categories = Category::all();

        return view('dashboard.banners.index', compact('banners', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.banners.add', compact('categories'));
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
            $banner = new Banner();
            $banner->category_id = $request->category_id;
            $banner->product_id = $request->product_id;
            $banner->status = $request->filled('status') ? true : false;
            $banner->save();
            if ($banner) {
                toastr()->success('', ' Banner added successfully');
                return redirect()->route('dashboard.banners.index');
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
    public function edit(Banner $banner)
    {
        $categories = Category::all();
        return view('dashboard.banners.edit', compact('categories','banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRequest $request, Banner $banner)
    {
        try {
            $banner->category_id = $request->category_id;
            $banner->product_id = $request->product_id;
            $banner->status = $request->filled('status') ? true : false;
            $banner->save();
            if ($banner) {
                toastr()->success('', '  The banner has been updated successfully');
                return redirect()->route('dashboard.banners.index');
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
    public function destroy(Banner $banner)
    {
        try {
            $banner->delete();
            if ($banner) {
                toastr()->success('', "Banner removed successfully");
                return redirect()->route('dashboard.banners.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
