@extends('layout')

@section('content')

<form action="/editsubmit" method="POST">
    @csrf
    <div class="form-group">
        <input type="hidden" class="form-control" value="{{$student->id}}" name="id" placeholder="Enter name" id="id">
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" value="{{$student->name}}" name="name" placeholder="Enter name" id="name">
    </div>
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="text" class="form-control" value="{{$student->email}}" name="email" placeholder="Enter email" id="email">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" value="{{$student->password}}" name="password" placeholder="Enter password" id="pwd">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endSection