<?php
    session_start();

    if(isset($_SESSION['UserId'])){
        $uid = $_SESSION['UserId'];
        $ufname = $_SESSION['UserFirstName'];
        $ulname = $_SESSION['UserLastName'];
    } else{
        $uid = NULL;
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

     <!-- Theme -->
    <link rel="stylesheet" href="styles/theme.css">

      <!-- CSS for this Individual Page -->
    <link rel="stylesheet" href="styles/contactus.css">


    <title>Contact Us</title>
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
          
          <li class="nav-item active">
            <a class="nav-link" href="#">Contact</a>
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


<!-- contact us -->
<div class="padding">
 
      <div  style="text-align: center">
        <i class="mdi mdi-forum"></i>
        <br>

        <h1 style="color: #C3073F;">Contact Us</h1 >
        <br>
        <p class="text-center" style="color:#FFF;">Other ways to connect<br>

            <h4 class="text-center" style="color:#FFF;">Email </h4>
            <p class="text-center" style="color:#FFF;">
            taseenbin.hakim@wmich.edu <br>
            mdabiruzzaman.palok@wmich.edu <br>
            taharinakter.nurany@wmich.edu <br>
            </p>

            
            <h4 class="text-center" style="color:#FFF;">Address </h4>
                <p class="text-center" style="color:#FFF;">Western Michigan University <br>
                    1903 W Michigan Ave, Kalamazoo, MI 49008 <br>
                </p>



        </p>
        <br>
        <button  style="color:#C3073F;" type="submit" class="btn btn-outline-light ml-sm-2 mb-2" style="border-radius: 50px" data-toggle="modal" data-target="#contact">&emsp;&emsp;Contact Support&emsp;&emsp;</button>
      </div>
     
  <!--Contact Modal-->
  <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark" >
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalLabel">Use the form below to share your questions, ideas, comments and feedback</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form  my-3 mr-2 ml-2">
          <div class="form-row"> 
            <div class="form-group col-sm">
              <label for="exampleInputEmail1" style="color: #fff;">Enter Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First">
            </div>
            <div class="form-group col-sm">
              <label class="sm-lbl" for="exampleInputEmail1" style="color:rgba(0, 0, 0, 0); visibility: hidden;">Enter Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="color: #fff;">Enter Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1" style="color: #fff;">Your Query or Question</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-outline-light ml-sm-2" style="border-radius: 50px; width:100%;" data-dismiss="modal" aria-label="Close">Submit</button>
      </div>
    </div>
    </div>
    </div>
  </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>