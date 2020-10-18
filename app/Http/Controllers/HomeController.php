<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public static function index()
    {
        if (Auth::check() && Auth::user()->role == 'admin') 
        {
            return view('/admin');
        } else if (Auth::check() && Auth::user()->role == 'student') 
        {
            return view('/student');
        }
    }
}
