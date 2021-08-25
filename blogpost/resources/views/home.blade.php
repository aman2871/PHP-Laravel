@extends('layouts.app')

@section('content')
<div class="container px-4">
    <div class="row gx-4">
        <div class="col">
            <div class="p-3 border bg-light" style="width: 330px;">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#tagModal">
                            Add Tag
                        </button>
                        <form action="/tag" method="POST">
                            @csrf
                            <!-- Modal -->
                            <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Tags</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <select class="form-select" name="tags" aria-label="Default select example">
                                                <option selected>none</option>
                                                <option value="Technology"><a href="">Technology</a></option>
                                                <option value="IT"><a href="">IT</a></option>
                                                <option value="AI"><a href="">AI</a></option>
                                                <option value="News"><a href="">News</a></option>
                                                <option value="Data Science"><a href="">Data Science</a></option>
                                                <option value="Machine Learning"><a href="">Machine Learning</a></option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="savetag" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                    <table class="table">
                        <td><a href="{{'/home'}}" style="text-decoration: none;">All Posts</a>
                        @foreach($tag as $inf)
                        <tbody>
                            <tr>
                                <td><a href="{{url('/home',$inf->id)}}" style="text-decoration: none;">{{$inf->tag_name}}</a>
                                    <a href="/delete/{{$inf->id}}"><button type="delete" class="btn-close" aria-label="Close" name="delete" style="float: right;"></button></a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 border bg-light" style="width: 500px;">
                <div class="card" style="width: 28rem;">
                    <div class="card-header">
                        <form action="/post" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" style="float: right;" data-bs-target="#postModal">
                                Add Post
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" style="font-weight: bold;" class=" form-label">Title</label>
                                                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Post Title">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label" style="font-weight: bold;">Description:</label>
                                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Write Post Description"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFileSm" style="font-weight: bold;" class="form-label">Image:</label>
                                                <input class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                                            </div>
                                            <!-- <select name="tag_id" class="form-control js-example-basic-multiple" style="width: 20.75em;" id="" multiple="multiple"> -->
                                            <label style="font-weight: bold;" for="tags">Post Tags:</label>
                                            @foreach($tag as $inf)
                                            <!-- <option value="{{$inf->id}}">{{$inf->tag_name}}</option> -->
                                            <div class="form-check">
                                                <input class="form-check-input" name="id[]" type="checkbox" value="{{$inf->id}}" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{$inf->tag_name}}
                                                </label>
                                            </div>

                                            @endforeach
                                            <!-- </select> -->

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="savepost" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @foreach($posts as $pos)
                        <div class="card mt-4" name="posts" style="width: 25rem;">
                            <div class="card" style="width: 25rem;">
                                <a href="/postdetails/{{$pos->id}}"> <img src="{{asset('/storage/'.$pos->image)}}" style="width:398px; height:200px;"></a>
                                <div class="card-body">

                                    <h5 class="card-title"><a style="text-decoration: none;" href="/postdetails/{{$pos->id}}">{{$pos->user->name}}</a></h5>
                                    <h5 class="card-title"><a style="text-decoration: none;" href="/postdetails/{{$pos->id}}">{{$pos->created_at}}</a></h5>


                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{$posts->links()}}


                    </div>
                </div>

            </div>
        </div>
    </div>


    @endsection