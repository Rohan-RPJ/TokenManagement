<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\StudentCalls;

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
        if (Auth::user()->type === "Teacher") {
            $unReadNotifCount = 0;
            return view('home', compact('unReadNotifCount'));
        }
        elseif (Auth::user()->type === "Student") {
            $unReadNotifCount = StudentCalls::getUnReadNotifCount();
            //dd($unReadNotifCount);
            return view('home', compact('unReadNotifCount'));
        }
    }
}
