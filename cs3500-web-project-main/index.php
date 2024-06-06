<?php

    $x = 10;
    echo $x;
    
    session_start();

    if(isset($_SESSION['UserId'])){
        $uid = $_SESSION['UserId'];
        $ufname = $_SESSION['UserFirstName'];
        $ulname = $_SESSION['UserLastName'];
    } else{
        $uid = NULL;
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

    <link rel="stylesheet" href="styles/index.css">




    <title>Play & Chat</title>
</head>
<body>

    
    <!-- Navigation bar -->
    <nav id="navigation-bar" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Play&Chat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
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

            <!-- If Signed in don't show the sign in button  -->
            <?php 
            if($uid == NULL){
                echo '<a class="btn btn-primary ml-3" href="singin.php">Sign In</a>';
                
            }
            ?>



          </form>
        </div>
    </nav>
    <div class="container">

        <div class="row mt-md-5">
            <div class="col-12">
                <?php
                    if($uid != NULL){
                        echo "<h4 class='color-secondary'>Hello $ufname, choose a game to play from the top menu</h4>";
                    }
                ?>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 text-center ">
                <img src="resources/gifs/image001.gif" alt="Teamwork" class="img-fluid" id="teamwork-gif">
            </div>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus tempora id repellendus blanditiis, iusto voluptatum illum aliquid consequuntur iste reiciendis quae est aliquam nihil, qui autem molestias. Distinctio, ipsa illum.</p>

        <p id="game-choose">Please choose a game to play</p>

        

    </div>

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-3 col-md-5 col-sm-7 mb-3">

          <div class="card background-transparent">
            <img src="resources/images/connect4.png" class="card-img-top game-img" alt="Connect 4 game">
            <div class="card-body border-bottom border-left border-right border-white">
              <h5 class="card-title">Connect 4</h5>
              <p class="card-text">It is the classic game you love to play with your friends and family. Can you connect four of your coloured disks by dropping them into the holder before your opponent does?</p> <br>
              <a href="games/connect4.php" class="btn btn-primary">Play Connect 4</a>
            </div>
          </div>

        </div>

        <div class="col-lg-3 col-md-5 col-sm-7 mb-3">

            <div class="card background-transparent">
              <img src="resources/images/rock-paper-scissor.png" class="card-img-top game-img" alt="Rock Paper Scissor game">
              <div class="card-body border-bottom border-left border-right border-white">
                <h5 class="card-title">Rock Paper Scissor</h5>
                <p class="card-text">Rock wins against scissors; paper wins against rock; and scissors wins against paper. If both players throw the same hand signal, it is considered a tie, and play resumes until there is a clear winner.</p>
                <a href="games/connect4.php" class="btn btn-primary">Play Rock Paper Scissor</a>
              </div>
            </div>
  
        </div>
        <div class="col-lg-3 col-md-5 col-sm-7 mb-3">

          <div class="card background-transparent">
            <img src="resources/images/tictac.png" class="card-img-top game-img" alt="Tic Tac Toe game">
            <div class="card-body border-bottom border-left border-right border-white">
              <h5 class="card-title">Tic Tac Toe</h5>
              <p class="card-text">Tic-tac-toe, noughts and crosses, or Xs and Os is a paper-and-pencil game for two players who take turns marking the spaces in a three-by-three grid with X or O. The player who succeeds placing three of their marks is the winner</p>
              <a href="games/connect4.php" class="btn btn-primary">Play Tic Tac Toe</a>
            </div>
          </div>

        </div>

       
    </div>
      
  </div>


    <br>
    <br><br><br>

    <?php
        for ($i=0; $i < 10; $i++) { 
            echo "<p>Hello World</p>";
        }
    ?>

    <!-- BootStarp Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>