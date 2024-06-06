<?php

    require_once "includes/dbconnect.inc.php";

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
    <!-- <link rel="stylesheet" href="styles/signin.css" -->
    <link rel="stylesheet" href="styles/signup-submit.css">

    <?php
        if(isset($_POST['signup_submit'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $pwd = $_POST['pwd'];
            $email = $_POST['email'];   

            $stmt = $conn->prepare("SELECT * FROM user WHERE Email=:email");
            $stmt->execute(['email' => $email]);

            if($stmt->rowCount() > 0){
                header("Location: ./signup.php?success=False&fname=$fname&lname=$lname");
            } else {
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                $sql = "INSERT INTO user (FirstName, LastName, Email, Password) 
                VALUES(:fname, :lname, :email, :pwd)";
                $stmt = $conn->prepare($sql);

                $stmt->execute(['fname'=>$fname, 'lname' => $lname, 'email'=> $email, 'pwd'=>$hashedPwd]);
            }
        }
    ?>
    <title>Thank You</title>
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

  <div class = "container">
    <div class = "row justify-content-center">
        <h5>Account created successfully</h5>
    </div>
    <div class = "row justify-content-center">
        <h2>Thank you for creating an account</h1>
    </div>
    <div class = "row justify-content-center">
        <p>Sign in <a href="singin.php">here</a></p>
    </div>
  </div>

</body>
</html>