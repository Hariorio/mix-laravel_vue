<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index() 
     {
        return view('main');
     }

     public function home(Request $request) 
     {
        return view('home');
     }

     public function dt(Request $request) 
     {
        return view('dt');
     }
     
}
