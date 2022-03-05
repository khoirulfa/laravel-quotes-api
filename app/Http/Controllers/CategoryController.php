<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator};
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->get();
        $response = [
            'message' => 'Category retrieved successfully',
            'categories' => CategoryResource::collection($category)
        ];

        return response()->json($response, Response::HTTP_OK);
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
            $response = [
                'message' => 'Error',
                'errors' => $validator->errors()->all()
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        try {
            $category = Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);

            $response = [
                'message' => 'Category created successfully',
                'category' => new CategoryResource($category)
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'message' => 'Error',
                'errors' => $th->getMessage()
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
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
        $response = [
            'message' => 'Category retrieved successfully',
            'category' => new CategoryResource($category)
        ];

        return response()->json($response, Response::HTTP_OK);
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
            $response = [
                'message' => 'Error',
                'errors' => $validator->errors()->all()
            ];

            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $category->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);

            $response = [
                'message' => 'Category updated successfully',
                'category' => new CategoryResource($category)
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'message' => 'Error ' . $th->errorInfo,
                'errors' => $th->getMessage()
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
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
            $respose = [
                'message' => 'Category deleted successfully'
            ];

            return response()->json($respose, Response::HTTP_OK);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'message' => 'Error',
                'errors' => $th->getMessage()
            ];

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }
}
