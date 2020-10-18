@extends('layouts.design')
@section('content')
@if ($student->isEmpty())
    <h3>no student with this id</h3>

@else
<table border="2px solid">
    <tr>
        <td>name</td>
    </tr>
    <tr>
        <td>{{$student[0]->name}}</td>
        <td><a href="/user/{{$student[0]->id}}/show">show</a></td>
    </tr>
</table>
@endif
@endsection