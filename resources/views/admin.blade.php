@extends('layouts.design')
@section('content')
    <div>
        <form action="/user/searchres" method="get">
            search student: <input type="text" name="student_id">
            <input type="submit" value="search">
        </form>
    </div>
    <div>
        <h1><a href="book">list books</a></h1>
        <h1><a href="/user">list users</a></h1>
    </div>
@endsection