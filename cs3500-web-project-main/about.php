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
    
    <!-- CSS for this Individual Page -->
    <link rel="stylesheet" href="styles/about.css">

    <title>About Us</title>
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
            <li class="nav-item active">
              <a class="nav-link" href="#">About Us</a>
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


    <!-- Main Cotainer  -->
    <div class="container">
        <!-- Header  -->
        <div class="row">
            <div class="col-lg-5">
                <br>
                <br>
                <br>
                <h1>About Us</h1>
                <p>We are a thriving team of three. All of us are very passionate about Computer Science, and we give our best at what we do!</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit esse perspiciatis enim, nam recusandae perferendis quibusdam distinctio, voluptatibus provident veritatis aliquam, similique ipsam blanditiis obcaecati eaque. Molestiae suscipit voluptates voluptatibus.</p>
            </div>

            <div class="col-lg-7">
                <img src="resources/gifs/coding.gif" alt="Teamwork" class="img-fluid" id="teamwork-gif">
            </div>
        </div>

        <!-- Meet the team Text -->
        <div class="container-fluid mt-4 mb-4">
            <div class="row"></div>
                <div class="col-lg-12 text-center">
                    <div class="custom-border padding-bottom-0 d-inline-block p-3"><h1 class="">Meet the Team</h1></div></div>
                </div>
            </div>
        </div>

        <!-- The Team Cards-->
        <div class="row mb-4 mx-auto justify-content-center">
            <div class="col-lg-4 col-md-6 mb-5 mx-sm-5 mx-md-0">
                <div class="card background-transparent">
                    <img src="resources/images/paul.jpg" class="card-img-top" alt="Photo of Paul">
                    <div class="card-body border-bottom border-left border-right border-white">
                    <h5 class="card-title">Md Abiruzzaman Palok</h5>
                    <h6 class="card-subtitle mb-1">Software Developer</h6>
                    <p class="card-text">
                        A young software developer with a focus on new innovative technologies.
                        Paul is also an expert in C, C++, Python, JavaScript, React and Angular.
                    </p>
                    <br>
                    <a href="https://github.com/SteamingPilot" class="btn btn-primary">GitHub Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mx-sm-5 mx-md-0">
                <div class="card background-transparent">
                    <img src="resources/images/tarin.jpg" class="card-img-top" alt="Photo of Tarin">
                    <div class="card-body border-bottom border-left border-right border-white">
                    <h5 class="card-title">Tarin Nurany</h5>
                    <h6 class="card-subtitle mb-1">IT Technician</h6>
                    <p class="card-text">
                        A career focused IT Technician currenly interning at JM Wilson.
                        Her other fields of expertise includes Salesforce, Server Management, Python, C, Computer Hardware and so on.
                    </p>
                    <a href="https://github.com/tnurany" class="btn btn-primary">GitHub Profile</a>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 mb-5 mx-sm-5 mx-md-0">
                <div class="card background-transparent">
                    <img src="resources/images/taseen.jpg" class="card-img-top" alt="Photo of Taseen">
                    <div class="card-body border-bottom border-left border-right border-white">
                    <h5 class="card-title">Taseen Bin Hakim</h5>
                    <h6 class="card-subtitle mb-1">Web Developer</h6>
                    <p class="card-text">
                        A hard-working web developer who has good knowledge on HTML, CSS, JavaScript, WordPress, React and so on.
                    </p>
                    <br>
                    <br>
                    <a href="https://github.com/TaseenHakim" class="btn btn-primary">GitHub Profile</a>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Social Links Text-->
        <div class="container-fluid mt-4 mb-4">
            <div class="row"></div>
                <div class="col-lg-12 text-center">
                    <div class="custom-border padding-bottom-0 d-inline-block p-3"><h1 class="">Follow us on Social Media</h1></div></div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-4 text-center">
                    <i class="social-icon bi bi-facebook"></i>
                </div>
                <div class="col-4 text-center">
                    <i class="social-icon bi bi-twitter"></i>
                </div>
                <div class="col-4 text-center">
                    <i class="social-icon bi bi-youtube"></i>
                </div>
            </div>
        </div>

    </div>


    <br>
    <br>
    <br>
    <br>    
    
    <!-- BootStarp Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>

