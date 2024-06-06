<?php

    session_start();

    if(isset($_SESSION['UserId'])){
        header("Location: index.php");
    }




    if(isset($_GET['success'])){
        echo'<script>alert("Email already exists. Try again with a different email")</script>';
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

    <!-- css for indivudal page -->
    <link rel="stylesheet" href="styles/signin.css">


    <!-- Custom JS  -->
    <script src="js/signup.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


    <title>Sign Up</title>
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
        <a class="btn btn-primary ml-3" href="singin.php">Sign In</a>
      </form>
    </div>
  </nav>

    <!-- main container -->
    <div class = "container">

        <!-- keeping the form in the center -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7 col-sm-8"  id="main-form">

                <!-- main form for signup -->
                <form action="signup-submit.php" method="POST" oninput="pwd.setCustomValidity(pwd.value != repwd.value ? 'Passwords do not match.' : '')">

                    <!-- Heading text form sign up -->
                    <div>
                        <h1 id="title-text"> Sign Up</h1>
                    </div>

                    <div class="container" id="log-form">
                        <!-- having firstname and lastname into the same line -->
                        <div class="row">
                            <!-- Firstname -->
                            <div class="col">
                                <label for="fname" class="all-text">First name</label>
                                <input 
                                value="<?php 
                                  if(isset($_GET['fname'])) {
                                    echo $_GET['fname'];
                                  }
                                ?>"
                                name="fname" type="text" id="fname" class="form-control form-control-lg" placeholder="Firstname" required>
                            </div>
                            <!-- Lastname -->
                            <div class="col">
                                <label for="lname" class="all-text">Last name</label>
                                <input 
                                value="<?php 
                                  if(isset($_GET['lname'])) {
                                    echo $_GET['lname'];
                                  }
                                ?>"
                                name="lname" type="text" id="lname" class="form-control form-control-lg" placeholder="Lastname" required>
                            </div>
                        </div><br>

                        <!-- email address -->
                        <div class="form-group">
                            <label for="email" id="" class="all-text">Email Address</label>
                            <input name="email" type="email" id="email" class="form-control form-control-lg" placeholder="example@company.com" name="'uname" required>
                        </div>
        
                        <!-- password and repeat password in the same line -->
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="pwd" class="all-text">Password</label>
                                <input name="pwd" type="password" id="pwd" class="form-control form-control-lg" placeholder="Enter Password" name="pass" required>
                            </div>
    
                            <div class="col-lg-6 col-md-12 form-group">
                                <label for="repwd" class="all-text">Repeat Password</label>
                                <input type="password" id="repwd" class="form-control form-control-lg" placeholder="Re Enter Password" name="repass" required>
                            </div>
                        </div>

                        <!-- policy agreement texts -->
                        <div class="col-md-12">
                            <small class="all-text" class=>People who use our service, their profile will be shared with others. <a href="#"><u>Learn more. </u></a>
                                <br>
                                By clicking Sign Up, you agree to our <a href="#"><u>Terms, Privacy Policy</u></a> and <a href="#"><u>Cookies Policy</u></a>. 
                                You may receive SMS Notifications from us and can opt out any time.</small>
                        </div>
                        
                        <!-- Sign up button -->
                        <button name="signup_submit" type="submit" class="btn btn-primary btn-lg btn-block" id="signup_submit"><b>Sign Up</b></button>

                    </div>
                </form>
            </div>
        </div>
        
    <div>
    
    <!-- BootStarp Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>



</body>
</html>