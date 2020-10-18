@extends('layouts.design')
@section('content')
@if (Auth::user()->role == 'admin')
    <a href="/book/create">add a book</a>
@endif
@if (Auth::user()->role == 'student')
    <a href="/book/studentBooks">my books</a>
@endif
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
            @if (Auth::user()->role == 'admin')
                <td><a href="book/{{$book->id}}">show</a></td>
                @if (Auth::user()->role == 'admin')
                    <td><a href="book/{{$book->id}}/edit">Edit</a></td>
                    <td>
                        <form action="book/{{$book->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="delete">
                        </form>
                    </td>
                @endif
            @endif

            @if ($book->user_id == NULL)
                <td><a href="book/{{$book->id}}/borrow">borrow</a></td> 
            @elseif ($book->user_id == Auth::user()->id)
                <td><a href="/book/studentBooks">you already borrowed this book</a></td>
                <td>
                    <form action="/book/{{$book->id}}/return" method="POST">
                        @csrf
                        <input type="submit" name="return" value="return">
                    </form>
                </td>
            @else
                <td>borrowed</td>
            @endif
            </tr>
    @endforeach
</table>
@endif
<br>
<a href="{{ url()->previous() }}"> return the previous page</a>
@endsection