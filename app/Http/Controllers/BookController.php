<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Carbon\Carbon;
use Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view("book.books", ['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'admin')
        {
            return view("book.create");
        } else
        {
            return view('/noAuth');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|max:255',
        ]);

        $book = Book::create([
            "name" => "$request->name",
        ]);
        
        return redirect('book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        return view('book.show', ["book"=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role == 'admin')
        {
            $book = Book::find($id);

            return view('book.edit', ["book"=>$book]);    
        } else
        {
            return view('/noAuth');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
      
        $book->name = $request->name;

        $book->save();

        return redirect('/book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::destroy($id);

        return redirect('book');
    }

    public function borrow($id)
    {
        if (Auth::user()->role == 'student')
        {
            $book = Book::find($id);
            $user = Auth::user();
            $book->user_id = $user->id;
            $book->save();
    
            return redirect('book');    
        } else
        {
            return view('/noAuth');
        }
        
    }

    public function return($id)
    {
        if (Auth::user()->role == 'student')
        {
            $book = Book::find($id);
            $book->user_id = null;
            $book->save();
    
            return redirect()->intended(session()->previousUrl());
        } else
        {
            return view('/noAuth');
        }
        
    }

    public function setReturnDate(Request $request, $id)
    {
        if (Auth::user()->role == 'student')
        {
            $book = Book::find($id);
            $book->return_date = $request->return_date;
            $book->save();
    
            return redirect('book/studentBooks');
        } else
        {
            return view('/noAuth');
        }
        
    }

    public function studentBooks()
    {
        if (Auth::user()->role == 'student')
        {
            $books = Book::where('user_id', Auth::user()->id)->get();

            return view('book/studentBooks', ['books'=>$books]);
        } else
        {
            return view('/noAuth');
        }
    }
}