<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\SaveRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class CategoryController extends Controller
{
    public function __construct()
    {
        // return $this->middleware('demo', [
        //     'except' => [
        //         'index',
        //         'create',
        //         'edit'
        //     ]
        // ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest();
        return view('dashboard.categories.add', compact('categories'));
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
            $category = new Category();
            $category->title   = $request->title;
            $category->status = $request->filled('status') ? true : false;
            $category->save();

            
            if ($category) {
                toastr()->success('', 'Category successfully added');
                return redirect()->route('dashboard.categories.index');
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
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRequest $request, Category $category)
    {
        try {

            $category->title   = $request->title;
            $category->status = $request->filled('status') ? true : false;
            $category->save();
            if ($category) {
                toastr()->success('', 'The category has been successfully updated');
                return redirect()->route('dashboard.categories.index');
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
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            if ($category) {
                toastr()->success('', 'Category removed successfully');
                return redirect()->route('dashboard.categories.index');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
