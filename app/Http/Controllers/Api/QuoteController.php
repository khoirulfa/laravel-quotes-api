<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class QuoteController extends Controller
{
    public function index()
    {
        $quote = Quote::with('category')->get();
        $response = [
            'message' => 'Quote retrieved successfully',
            'quotes' => QuoteResource::collection($quote)
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function show($uuid)
    {
        $quote = Quote::findOrFail($uuid)->with('category')->first();

        try {
            if ($quote) {
                $response = [
                    'message' => 'Quote retrieved successfully',
                    'quote' => new QuoteResource($quote)
                ];

                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'message' => 'Quote not found'
                ];

                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $e) {
            $response = [
                'message' => 'Quote not found'
            ];

            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }

    public function random()
    {
        $quote = Quote::inRandomOrder()->with('category')->first();

        try {
            if ($quote) {
                $response = [
                    'message' => 'success',
                    'quote' => new QuoteResource($quote)
                ];

                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'message' => 'No quote found'
                ];

                return response()->json($response, Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            $response = [
                'message' => 'Something went wrong'
            ];

            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function qod()
    {
        $quote = Quote::whereDate('created_at', Carbon::today())->with('category')->first();

        try {
            if ($quote) {
                $response = [
                    'message' => 'success',
                    'quote' => new QuoteResource($quote)
                ];

                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'message' => 'No quote of the day found',
                ];

                return response()->json($response, Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            $response = [
                'message' => 'No quote of the day found',
            ];

            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }
}
