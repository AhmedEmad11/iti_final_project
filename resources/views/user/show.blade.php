@extends('layouts.design')
@section('content')
<table border="2px solid">
    <tr>
        <td>id</td>
        <td>name</td>
        <td>email</td>
        <td>student id</td>
        <td>borrowed books</td>
    </tr>
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->student_id}}</td>
        @if ($books)
            <td>
                @foreach ($books as $book)
                    <p>{{$book->name}}</p>
                @endforeach
            </td>
        @else
        <td>no books</td>
        @endif
    </tr>
</table>
<br>
<a href="{{ url()->previous() }}"> return the previous page</a>
@endsection