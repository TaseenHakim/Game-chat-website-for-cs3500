<?php

    session_start();

    if(isset($_SESSION['UserId'])){
        header("Location: index.php");
    }
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Files -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Bootstarp Icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Theme -->
    <link rel="stylesheet" href="styles/theme.css">

    <!-- css for individula page -->
    <link rel="stylesheet" href="styles/signin.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>



      
    <title>Login</title>

</head>
<body>
 <!-- Navigation Bar  -->
 <nav id="navigation-bar" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Play&Chat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Games
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="games/tictac.php">Tic Tac Toe</a>
              <a class="dropdown-item" href="games/rockpaperscissors.php">Rock, Paper, Scissor</a>
              <a class="dropdown-item" href="games/connect4.php">Connect 4</a>
            </div>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About Us</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <a class="btn btn-primary ml-3" href="#">Sign In</a>
      </form>
    </div>
  </nav>

    <!-- main container -->
    <div class = "container">
        <!-- getting the form into the center -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7 col-sm-8"  id="main-form">

                <!-- main form for sign in -->
                <form>

                    <!-- top sign in text -->
                    <div>
                        <h1 id="title-text"> Sign In</h1>
                    </div>

                    <!-- pursing credentals from users -->
                    <div class="container" id="log-form">

                        <!-- username configuraton -->
                        <div class="form-group">
                            <p class="req-field" id="req-text"></p>
                            <label for="email" class="all-text">Email</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Enter Email" name="email" id="email" required>
                        </div>
        
                        <!-- password configuration -->
                        <div class="form-group">
                            <label for="pwd" class="all-text">Password</label>
                            <input type="password" class="form-control form-control-lg" placeholder="Enter Password" name="pwd" id="pwd" required>
                        </div>
                        
                        <!-- remember me and forgot password into a same div -->
                        <div class="form-group margin-bottom-10">
                          <div class=""><a href="#"><u>Forgot/Change Password</u></a></div>
                        </div>
                        
                        <!-- Sign in Button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="signin-submit" name="signin-submit"><b>Sign in</b></button>
                    </div>
                </form>

                <!-- create new account section outside the form. -->
                <div class="container" id="new-account">
                    <!-- messege -->
                    <div class="col-md-12 text-center">
                        <small id="all-text">New to this website?</small>
                    </div>
                    
                    <!-- create new account button -->
                    <div class="col-md-12 text-center">
                        <a href="signup.php" class="btn btn-success">Create New Account</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div> 


<!-- Boot Strap JS,not needed for the time being but may use it in the future -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->



    <!-- Using Ajax to check for login  -->
    <script>
      $(document).ready(function(){
        $("#req-text").html("");

        $("#signin-submit").click(function (e) { 
            e.preventDefault();
            if($("#email").val() == "" || $("#pwd").val() == ""){
                $("#req-text").html("* All fields are required");
            } else {
                var email = $("#email").val();
                var pwd = $("#pwd").val();

                var formData = {
                    "email": email,
                    "pwd": pwd,
                    "signin-submit": 1
                };

                $.ajax({
                    type:  "POST",
                    url: "signin-submit.php",
                    data: formData,
                    success: function(data) {
                        if(data == "UserInvalid"){
                            $("#req-text").html("Invalid email");
                        }
                        else if(data == "PasswordInvalid"){
                            $("#req-text").html("Invalid Password");
                        }
                        else{
                            window.location.replace("index.php");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error, status = " + textStatus +", " + "Error Thrown: " + errorThrown);
                    }
                });
            }
          
        });
      });


    </script>
</body>
</html>