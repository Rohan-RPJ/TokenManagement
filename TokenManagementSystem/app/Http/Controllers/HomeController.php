<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   //dd(Auth::user());
        $this->middleware('auth');
       // $this->middleware('checkUserType:'.strval(Auth::user()->type));
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
}
