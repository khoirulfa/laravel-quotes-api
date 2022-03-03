<?php

namespace App\Http\Controllers;

use App\Models\{Quote, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\QuotesExport;
use Maatwebsite\Excel\Facades\Excel;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quote.index', [
            'quotes' => Quote::latest()->get(),
            'categories' => Category::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.quote.create', [
            'categories' => Category::latest()->get()
        ]);
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
            Alert::error('Error', $validator->errors()->all());
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        try {
            Quote::create([
                'quote' => $request->quote,
                'length' => strlen($request->quote),
                'slug' => Str::slug(Str::limit($request->quote, 15)),
                'author' => $request->author,
                'category_uuid' => $request->category_uuid
            ]);

            Alert::success('Success', 'Quote Created Successfully');

            return redirect()->route('quotes.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', $th->getMessage());
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
    }

    // make function to show quote details in modal
    public function show(Quote $quote)
    {
        return view('admin.quote.show', [
            'quote' => $quote
        ])->render()['content'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        return view('admin.quote.edit', [
            'quote' => $quote,
            'categories' => Category::latest()->get()
        ]);
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
            Alert::error('Error', $validator->errors()->all());
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        try {
            $quote->update([
                'quote' => $request->quote,
                'slug' => Str::slug(Str::limit($request->quote, 15)),
                'author' => $request->author,
                'category_uuid' => $request->category_uuid
            ]);

            Alert::success('Success', 'Quote Updated Successfully');

            return redirect()->route('quotes.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', $th->getMessage());
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
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
            Alert::success('Success', 'Quote has successfully deleted!');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
        }

        return redirect()->back();
    }
}
