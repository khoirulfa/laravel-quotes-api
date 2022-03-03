<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quote = Quote::with('category')->get();
        return [
            'message' => 'success',
            'status' => 200,
            'quotes' => QuoteResource::collection($quote)
        ];
    }

    public function show($uuid)
    {
        $quote = Quote::where('uuid', $uuid)->with('category')->first();
        return [
            'message' => 'success',
            'status' => 200,
            'quote' => new QuoteResource($quote)
        ];
    }

    public function random()
    {
        $quote = Quote::inRandomOrder()->with('category')->first();
        return [
            'message' => 'success',
            'status' => 200,
            'quote' => new QuoteResource($quote)
        ];
    }

    // make method to get random quote of the day
    public function qod()
    {
        $quote = Quote::whereDate('created_at', Carbon::today())->with('category')->first();
        return [
            'message' => 'success',
            'status' => 200,
            'quote' => new QuoteResource($quote)
        ];
    }
}
