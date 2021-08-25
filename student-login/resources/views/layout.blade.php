<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
    <title></title>
</head>

<body>
    <div class="header">
        @section('header')
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="list">User List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="login">Login</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link active" href="create" tabindex="-1" aria-disabled="true">Create Account</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
        @show
    </div>
    <div class="content" style="width: 70%; margin:auto">
        @section('content')
        <h1>content part</h1>
        @show
    </div>
    <div class="footer" style=" color: #fff;
    position: absolute;
    bottom: 0;
    width: 100%;
    background-color: #000;">
        @section('footer')
        <h1>footer part</h1>
        @show
    </div>
</body>

</html>