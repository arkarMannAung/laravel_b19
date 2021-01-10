<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class MyController extends Controller
{
    public function dashboard(){
    	return view('backend.dashboard.dashboard');
    }
}
