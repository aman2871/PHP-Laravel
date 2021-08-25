@extends('layouts.apps')
@section('content')



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div class="container px-4">
        <div class="row gx-5">
            <div class="col">
                <div class="p-3 border bg-light">
                    <form action="/image" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6 mt-2">
                            <input type="file" name="image">
                        </div>
                        <div class="col-md-6 mt-2">
                            <button type="submit" class="btn btn-primary">
                                upload
                            </button>
                        </div>


                    </form>
                </div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">
                    <div class="card" style="width: fit-content; height:fit-content">
                        @foreach($image as $image)
                        <img src="{{asset('/storage/'.$image->image)}}" class="card-img-top" alt="..." style="height: 300px; width: 300px">
                        @endforeach
                        <div class="card-body">
                            <h5 class="card-title">{{Auth::user()->name}}</h5>
                            <h5 class="card-title">{{Auth::user()->email}}</h5>
                            <!-- Button trigger modal -->
                            <form action="{{ url('edit/')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <a href="#"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Edit
                                    </button></a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="file" class="form-control" value="{{$image->image}}" name="image">
                                                </div>

                                               
                                                <div class="form-group">
                                                    <label for="email">Name:</label>
                                                    <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" placeholder="Enter name" id="email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="text" class="form-control" value="{{Auth::user()->email}}" name="email" placeholder="Enter email" id="email" readonly>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
@endsection