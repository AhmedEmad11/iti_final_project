@extends('layouts.design')
@section('content')
<table border="2px solid">
    <tr>
        <td>name</td>
    </tr>
    <tr>
        <form action="/book" method="POST">
            @csrf
            <td><input type="text" name="name" required></td>
            <td><input type="submit" name="submit" required></td>
        </form>
    </tr>
</table>
@endsection