<?php
session_start();
if (isset($_SESSION['loggedin'])  || $_SESSION['loggedin'] == true) {
    
    $loggedin=true;
}
else{
    $loggedin=false;
}
echo '
<style>
    .navbar {
        background-color: grey;
        border: 4px solid yellow;
        border-radius: 10px;
        justify-content: center;
        align-items: center;
    }

    .navbar ul {
        overflow: hidden;
    }

    .navbar li {
        float: left;
        list-style: none;
    }

    .navbar li a {
        text-decoration: none;
        padding: 20px;
        font-size: 20px;
        color: yellow;

    }

    .navbar li a:hover {
        background-color: darkgray;
    }
    .navbar li label{
        font-size: 20px;
        color: whitesmoke;
    }

    
</style>
</head>

<body>
    <nav class="navbar">
        
        <ul>
            <li><label for="title"><b>iSecure</b></label></li>
            <li class="items"> <a href="/Login_page/index.php">Home</a> </li>';
            if(!$loggedin){
                echo '
                <li class="items"> <a href="/Login_page/login.php">Login</a> </li>
                <li class="items"> <a href="/Login_page/signup.php">Signup</a> </li>';
            }
            if($loggedin){
                echo '<li class="items"> <a href="/Login_page/logout.php">Logout</a> </li>';
            }
            
        echo 
        '</ul>
    </nav>';
    ?>