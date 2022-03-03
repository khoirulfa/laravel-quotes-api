<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selected_category = false;
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.category.index', compact('categories', 'selected_category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:3|unique:categories,title'
            ]
        );

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        try {
            Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);

            Alert::success('Success', 'Category Created Successfully');

            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:3'
            ]
        );

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        try {
            $category->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);

            Alert::success('Success', 'Category Created Successfully');

            $selected_category = false;
            $categories = Category::latest()->get();

            return view('admin.category.index', compact('categories', 'selected_category'));
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success('Success', 'Category has successfully deleted!');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
        }

        return redirect()->back();
    }
}
