@extends('layouts.design')
@section('content')
@if ($users->isEmpty())
    <h3>no users</h3>

@else
<table border="2px solid">
    <tr>
        <td>name</td>
        <td>email</td>
        <td>role</td>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role}}</td>
        @if ($user->role == 'student')
        <td><a href="user/{{$user->id}}/show">show</a></td>
        @endif
    </tr>
    @endforeach
</table>
@endif
<br>
<a href="{{ url()->previous() }}"> return the previous page</a>
@endsection