<?php

namespace App\Http\Controllers;
use App\Models\Invoice;


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
        $invoices = Invoice::all();
        return view('home')->with([
            'invoices' => $invoices, 
        ]);
    }
}
