@extends('layouts.app')

@section('content')


<div class="container-lg">
    <a href="/home"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg></a>

    <div class="card" style="width: 40rem;padding:20px; border:2px solid grey">
        <div class="container" style=" background-color:whitesmoke; display:block; padding:5px; width:570px">
            <label for="posted" style="padding: 10px;">
                <h6 class="card-title">Posted By: {{$post->user->name}}</h6>
                <h6 class="card-title">Posted on: {{$post->user->created_at}}</h6>
            </label>

        </div>
        <div class="container">

            <img src="{{asset('/storage/'.$post->image)}}" class="card-img-top" alt="Image" style="width: 570px; height:250px; margin-top: 5px;">
        </div>
        <div class="card-body">
            <label for="description" style="font-weight:bold; background-color:whitesmoke; display:block; padding:5px">Description:</label>
            <p>{{$post->description}}</p>
            <label for="tags" style="font-weight:bold; background-color:whitesmoke; display:block; padding:5px">Tags:</label>
          
            <p>{{$post->tag->tag_name}}</p>
            

            <label for="comments" style="font-weight:bold; background-color:whitesmoke; display:block; padding:5px">Comments:</label>
            <table class="table">
                <tbody>
                    <tr>
                        @foreach($commmentsdata as $comm)
                        <td>{{$comm->comment}}</a>
                        @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>

            <form action=" {{url('/comment',$post->id)}}" method="POST">
                @csrf
                <label for="addingcomments" style="font-weight:bold;">Add Comment:</label>
                <textarea style="font-weight:bold; background-color:whitesmoke; display:block; padding:5px" name="comment" id="" cols="50" rows="2"></textarea>
                <button style="margin-top: 5px;" type="submit" class="btn btn-primary">Comment</button>
            </form>
        </div>
    </div>

</div>


@endsection