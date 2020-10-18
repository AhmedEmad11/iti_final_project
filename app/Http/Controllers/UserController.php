<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin')
        {
        $users = user::all();
        return view("user/users", ['users'=>$users]);
       } else
        {
            return view('/noAuth');
        }
    }
    

    public function search()
    {
        if (Auth::user()->role == 'admin')
        {
        $student_id = $_GET['student_id'];

        $student = User::where('student_id', $student_id)->get();

        return view('user/searchres', ["student"=>$student]);
        } else
        {
            return view('/noAuth');
        }

    }

    public function show($id)
    {
        if (Auth::user()->role == 'admin')
        {
        $user = User::find($id);

        $books = $user->books()->get();

        return view('user/show', ["user"=>$user, 'books'=>$books]);
        } else
        {
            return view('/noAuth');
        }
    }
}
