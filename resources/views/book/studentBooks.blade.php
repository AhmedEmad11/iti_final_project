@extends('layouts.design')
@section('content')
@if ($books->isEmpty())
    <h3>no books</h3>

@else
<table border="2px solid">
    <tr>
        <td>name</td>
    </tr>
    @foreach ($books as $book)
        <tr>
            <td>{{$book->name}}</td>
            <td>
                <form action="/book/{{$book->id}}/returnDate" method="POST">
                    @csrf
                    return date: <input type="date" name="return_date">
                    <input type="submit">
                </form>
            </td>
            <td>
                <form action="/book/{{$book->id}}/return" method="POST">
                    @csrf
                    <input type="submit" name="return" value="return">
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endif
<br>
<a href="{{ url()->previous() }}"> return the previous page</a>
@endsection