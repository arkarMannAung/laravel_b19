<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Categories;
use app\Subcategories;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home(){
        return view('frontend.home.home');
    }

    public function ordersucess(){
        return view('frontend.order.ordersuccess');
    }
}
