@extends('layouts.app')

@section('content')
<html lang="en">

<head>
    <title>MultiUpload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="jumbotron text-center" style="margin-bottom:0">
        <h2>MultiUpload</h2>
    </div>
    <div class="container px-4">
        <div class="row gx-5">
            <div class="col">
                <div class="p-3 border bg-light">
                    <div class="container">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Sorry!</strong> Here have some issue please check<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif



                        <form method="post" action="{{url('image')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group realprocode control-group lst increment">
                                <input type="file" name="image[]" class="myfrm form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" style="background-color: blue;" type="button"> <i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                            </div>
                            <div class="clone hide">
                                <div class="realprocode control-group lst input-group" style="margin-top:10px">
                                    <input type="file" name="image[]" class="myfrm form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success" style="margin-top:10px; background-color: blue;">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-3 border bg-light">
                    <td>                        
                        @foreach($image as $img)                        
                        <img src="{{ asset('/storage/'.$img->images) }}" style="height:120px; width:200px" />
                        @endforeach
                    </td>
                </div>
            </div>
        </div>
    </div>

    <br>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".realprocode").remove();
            });
        });
    </script>
</body>

</html>
@endsection