@extends('layouts.design')
@section('content')
<table border="2px solid">
    <tr>
        <td>name</td>
    </tr>
    <tr>
        <td>{{$book->name}}</td>
        @if (Auth::user()->role == 'admin')
            <td><a href="/book/{{$book->id}}/edit">Edit</a></td>
            <td>
                <form action="/book/{{$book->id}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="delete">
                </form>
            </td>
        @endif
        @if (Auth::user()->role == 'student')
            <td><a href="/book/{{$book->id}}/borrow">borrow</a></td>
        @endif
    </tr>
</table>
<br>
<a href="{{ url()->previous() }}"> return the previous page</a>
@endsection