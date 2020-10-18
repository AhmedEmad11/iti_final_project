@extends('layouts.design')
@section('content')
<table border="2px solid">
    <tr>
        <td>name</td>
    </tr>
    <tr>
        <form action="/book/{{$book->id}}" method="POST">
            @method('PUT')
            @csrf
            <td><input type="text" name="name" required value="{{$book->name}}"></td>
            <td><input type="submit" name="submit" required></td>
        </form>
    </tr>
</table>
@endsection