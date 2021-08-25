@extends('layout')

@section('content')

<div>
    <ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SrNo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        @foreach($student as $s)

                        <tbody>
                            <tr>
                                <th scope="row">{{$s->id}}</th>
                                <td>{{$s->name}}</td>
                                <td>{{$s->email}}</td>

                                <td>
                                    <a href='/edit/{{ $s->id }}'>Edit</a>
                                    <a href='/delete/{{ $s->id }}'>Delete</a>
                                </td>
                            </tr>
                            
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </ul>
</div>
@endSection