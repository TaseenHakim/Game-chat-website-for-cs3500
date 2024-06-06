<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/rockpaperscissors.css">


     <!-- Theme -->
    <link rel="stylesheet" href="../styles/theme.css">
    <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
    <title>Rock Paper Scissor</title>
</head>
<body>

<!-- Navigation bar  -->
    <nav id="navigation-bar" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php">Play&Chat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                  Games
                </a>
                <div class="dropdown-menu active">
                  <a class="dropdown-item" href="tictac.php">Tic Tac Toe</a>
                  <a class="dropdown-item active" href="#">Rock, Paper, Scissor</a>
                  <a class="dropdown-item" href="connect4.php">Connect 4</a>
                </div>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="../about.php">About Us</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="../contact.php">Contact</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <a class="btn btn-primary ml-3" href="../singin.php">Sign In</a>
          </form>
        </div>
      </nav>
    

    <div class="container-fluid">
        <header>
          <h1>Rock Paper Scissors</h1>
        </header>
        
        <div class="row">

          <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="container">

              <h1><span id="board">Game Status: </span><span id="status" style="color:#FFF;">Choose an option !</span></status></h1>
              <h3><span id="score">Your Score is: </span><span id="playerScore" style="color:#FFF;">0</span></h3>
              <h3><span id="score">Opponent Score is: </span><span id="computerScore" style="color:#FFF;">0</span></h3>
              <p><span id="choice">You chose: </span><span id="playerSelection" style="color:#FFF;">Pick</span></p>
              <p><span id="choice">Friend chose: </span><span id="computerSelection" style="color:#FFF;">Pick</span></p>
              
              <img class="img-responsive" id="rock" src="../resources/images/rock-transparent.png" alt="rock image">
              <img class="img-responsive" id="paper" src="../resources/images/paper-trans.png" alt="paper image">
              <img class="img-responsive" id="scissors" src="../resources/images/scissor-t.png" alt="scissors image">



              <div class="center">
                  <button class="btn-lg btn-outline-dark" id="reset" class="button">RESET</button>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-12">
            <div id="sidebar" class="row">
              <!-- ScoreBoard  -->
              <div class="col-lg-12 col-md-6">
                  <div class="container">
                      <div class="row">
                          <div id="scoreboard">
                              <h3 id="scoreboard-title">Scoreboad</h3>
                              <table class="table table-sm table-dark table-hover background-transparent">
                                  <thead>
                                      <tr>
                                          <th>Player</th>
                                          <th>Wins</th>
                                          <th>Loses</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <th scope="row">(You) Player Name</th>
                                          <td>5</td>
                                          <td>3</td>
                                      </tr>
                                      <tr>
                                          <th scope="row">Opponent Player Name</th>
                                          <td>3</td>
                                          <td>5</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              

              <!-- Chat  -->
              <div class="col-lg-12 col-md-6">
                  <div class="container border">
                      <!-- Chat Title  -->
                      <div id="chat-bar">
                          <h4 id="chatbar-title" class="pb-2">Chat</h4>
                      </div>

                      <!-- The Conversation  -->
                      <div id="chat-coversation" class="container">
                          <!-- Each row will a message from one Person  -->
                          <div class="chat row">
                              <!-- Person Image  -->
                              <div class="identity">
                                  <img class="person-img" src="../resources/images/paul.jpg" alt="">
                              </div>
                              <!-- Message  -->
                              <div class="message align-self-center ml-5">
                                  <p class="text-secondary">Nice move</p>
                              </div>
                          </div>

                          <div class="chat row mt-2">
                              <div class="identity">
                                  <img class="person-img" src="../resources/images/tarin.jpg" alt="">
                              </div>
                              <div class="message align-self-center ml-5">
                                  <p class="text-secondary">Thank you.</p>
                              </div>
                          </div>

                          <div class="chat row mt-2">
                              <div class="identity">
                                  <img class="person-img" src="../resources/images/paul.jpg" alt="">
                              </div>
                              <div class="message align-self-center ml-5">
                                  <p class="text-secondary">Welcome. Gotta go. Bye</p>
                              </div>
                          </div>
                          <div class="chat row mt-2">
                              <div class="identity">
                                  <img class="person-img" src="../resources/images/tarin.jpg" alt="">
                              </div>
                              <div class="message align-self-center ml-5">
                                  <p class="text-secondary">Bye Bye.</p>
                              </div>
                          </div>
                      </div>
                      
                      <!-- New Message Chat  -->
                      <form action="#" class="mt-2">
                          <div class="row">
                              <div class="col-9">
                                  <input type="text" class="form-control" id="newMessage" placeholder="Type your message here">
                              </div>
                              <div class="col-3">
                                  <button type="submit" class="btn btn-primary">Send</button>
                              </div>
                          </div>
                      </form>

                  </div>
              </div>
              
          </div>


          </div>
          

        </div>
        

    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- BootStarp Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    

</body>
</html>