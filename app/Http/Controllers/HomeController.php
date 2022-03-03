<?php

namespace App\Http\Controllers;

use App\Models\{Category, Quote};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'all_categories' => Category::count(),
            'all_quotes' => Quote::count()
        ]);
    }
}
