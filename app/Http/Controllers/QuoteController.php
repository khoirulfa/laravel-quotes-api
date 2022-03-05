<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator};
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quote = Quote::with('category')->get();
        $response = [
            'message' => 'Quote retrieved successfully',
            'quotes' => QuoteResource::collection($quote)
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
                'quote' => 'required|min:3',
                'author' => 'required|min:3',
                'category_uuid' => 'required|exists:categories,uuid'
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
            $quote = Quote::create([
                'quote' => $request->quote,
                'length' => strlen($request->quote),
                'slug' => Str::slug(Str::words($request->quote, 15)),
                'author' => $request->author,
                'category_uuid' => $request->category_uuid
            ]);

            $response = [
                'message' => 'Quote created successfully',
                'quote' => new QuoteResource($quote)
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

    // make function to show quote details in modal
    public function show(Quote $quote)
    {
        $response = [
            'message' => 'Quote retrieved successfully',
            'quote' => new QuoteResource($quote)
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'quote' => 'required|min:3',
                'author' => 'required|min:3',
                'category_uuid' => 'required|exists:categories,uuid'
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
            $quote->update([
                'quote' => $request->quote,
                'length' => strlen($request->quote),
                'slug' => Str::slug(Str::words($request->quote, 15)),
                'author' => $request->author,
                'category_uuid' => $request->category_uuid
            ]);

            $response = [
                'message' => 'Quote updated successfully',
                'quote' => new QuoteResource($quote)
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
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        try {
            $quote->delete();
            $response = [
                'message' => 'Quote deleted successfully'
            ];

            return response()->json($response, Response::HTTP_OK);
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
