<?php 
    include "../includes/session.inc.php";
    include "../includes/dbconnect.inc.php";
    include "../helper/tictac-utility-functions.php";
    include "../actions/check-incoming-invite.php";

    if(isset($_GET["rejected"])){
        if($_GET["rejected"] == "true"){
            echo '<script>alert("Your friend rejected your invite.");</script>';
        }
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
    <link rel="stylesheet" href="../styles/theme.css">

    <!-- css for individual page -->
    <link rel="stylesheet" href="../styles/games/tictac.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


    <script>
        $(function(){
            <?php 
                echo '$("#newGame").hide();';
                echo '$("#gameAndScoreBoard").hide();';
                echo '$("#waitingForFriend").hide();';
                if($uid == NULL){
                    // User's not logged in
                    echo '$("#notLoggedInContaier").show();';

                } else{
                    echo '$("#notLoggedInContaier").hide();';

                    if($_SESSION["isPlaying"] == FALSE){
                        // User Logged in
                        // user not playing with anyone
                        echo '$("#newGame").show();';
                        
                    } else{
                        // User is playing with someone.
                        echo '$("#newGame").hide();';
                        echo '$("#gameAndScoreBoard").show();';
                        
                        // echo '$(#game button).html(" ");';
                        echo "$('#game button').html(' ');";
                        
                    }
                }

                
            ?>

            // Inviting a Friend
            $("#invite_submit").click(function (e) {                 
                e.preventDefault();

                $.post("../actions/invitePlayer.php", 
                    {
                        "invite_submit":"True",
                        "email": $("#email").val(),
                        "board": "---------",
                        "gameType": 1    
                    },
                    function (data, textStatus, jqXHR) {
                        if(data=="Success"){
                            // Successfully sent the invite
                            $('#waitingForFriend').show();
                            $("#newGame").hide();

                        } else if(data == "InvalidEmail"){
                            alert("No User Found with the emial. Try again");
                        } else if(data=="Failed"){
                            alert("Something went wrong. Try again Later.");
                        }
                    }
                );    
                
            });

            // Checking if friend has accepted invitation from current user (if sent any)
            setInterval(() => {
                formData = {
                    "function": "check_invite_accept"
                };

                $.ajax({
                    type: "POST",
                    url: "../actions/check-incoming-invite.php",
                    data: formData,
                    success: function (response) {
                        if(response != ""){
                            var data = JSON.parse(response);
                            console.log(data);
                            if(data.status == "waiting"){
                                // Do Nothing
                            } else if(data.status == "accepted"){
                                location.replace("./tictac.php");
                            } else if(data.status == "rejected"){
                                location.replace("./tictac.php?rejected=true");
                            }
                        }

                    }
                });
            }, 1500);


            // checkin if any invitation was received.
            setInterval(() => {
                formData = {
                    "function": "check_incoming_invite"
                }

                $.ajax({
                        type:  "POST",
                        url: "../actions/check-incoming-invite.php",
                        data: formData,
                        success: function(response) {
                            if(response != ""){
                                var data = JSON.parse(response);
                                if(data.isInvited == "true"){
                                    if(confirm("You have been invited to a game. Accept?") == true){
                                        // invitee chose to play. 
                                        // We will update the game record, with p2 = current user.
                                        formData2 = {
                                        "function": "accept_invite",
                                        "inviteId": data.inviteId,
                                        "gameId": data.gameId
                                        }
                                        $.ajax({
                                                type:  "POST",
                                                url: "../actions/check-incoming-invite.php",
                                                data: formData2,
                                                success: function(response2) {
                                                    if(response2 != ""){
                                                        var data2 = JSON.parse(response2);
                                                        if(data2.status == true){
                                                            location.replace("./tictac.php");
                                                        } else {
                                                            alert(data2.msg);
                                                        }
                                                    }
                                                    
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    alert("Error, status = " + textStatus +", " + "Error Thrown: " + errorThrown);
                                                }
                                        });
                                    } else {
                                        // rejected invite.
                                        formData3 = {
                                        "function": "reject_invite",
                                        "inviteId": data.inviteId,
                                        "gameId": data.gameId
                                        }
                                        $.ajax({
                                                type:  "POST",
                                                url: "../actions/check-incoming-invite.php",
                                                data: formData3,
                                                success: function(response3) {
                                                    if(response3 != ""){
                                                        var data3 = JSON.parse(response3);
                                                        if(data3.status == true){
                                                            alert("Successfully Rejected!");
                                                        } else {
                                                            alert(data.msg);
                                                        }
                                                    }
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    alert("Error, status = " + textStatus +", " + "Error Thrown: " + errorThrown);
                                                }
                                        });
                                    }

                                    
                                } else {
                                    // No invitation. So, Do nothing
                                }
                            }
                            
                        },
                });

            }, 1500);



            $("#game button").click(function (e) { 
                e.preventDefault();
               
                if((this.innerHTML == "X") || (this.innerHTML == "O")){
                    // Do nothing.
                } else {
                    formData = {
                        "buttonClicked": TRUE,
                        "id": parseInt(this.id[1])
                    }

                    $.ajax({
                        type:  "POST",
                        url: "../helper/tictac-play.php",
                        data: formData,
                        success: function(returnData) {
                            if(returnData["status"] == FALSE){
                                if(returnData["msg"] == "Database Update Failed!"){
                                    alert("Database Update Failed! Try again.");
                                } else if (returnData['msg'] == "Not My Turn!"){
                                    //Do nothing.
                                }
                            } else {
                                if(returnData['msg'] == "Successfully Played the Turn"){
                                    this.innerHTML = <?php 
                                        if(isset($_SESSION["MySymbol"])){
                                            echo $_SESSION["MySymbol"];
                                        } else {
                                            echo "X";
                                        }
                                        ?>;
                                }
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
    

    <title>Tic Tac Toe</title>
</head>
<body>

    <!-- Navigation Bar  -->
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
                <a class="nav-link dropdown-toggle active" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                  Games
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item active" href="#">Tic Tac Toe</a>
                  <a class="dropdown-item" href="rockpaperscissors.php">Rock, Paper, Scissor</a>
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

    <main>
        <div class="container" id="top-container">
            <!-- Title Container  -->
            <div class="row justify-content-center mt-5" id="title-container">
                <h1 id="game-title" class="display-4">Tic Tac Toe</h1>
            </div>



            <!-- Not Logged in container -->
            <div class="row justify-content-center mt-5" id="notLoggedInContaier">
                <div>
                    <h4 class="color-primary">It seems like you're not logged in. In order to play you must <a href="../singin.php">Login</a> or <a href="../signup.php">Create an Account<a></h4>
                </div>
            </div>
        </div>

        <!-- Main Container  -->
        <div class="container-fluid" id="main-container">

            <!-- Invite a Friend  -->
            <div class="row" id="newGame">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="color-secondary">
                                Hi 
                                <?php echo $ufname;?>
                                , <br>Invite a friend to play</h4>
                        </div>
                    </div>
                    <div class="row" id="inviteAFriend">
                        <div class="col-lg-8 col-md-12 col-sm-12 mb-3">
                            <form action="" method="" class="form-inline">
                                <input type="text" class="form-control" id="email"  name="email"  placeholder="Enter an email to invite">
                                <button type="submit" class="btn btn-danger ml-2" id="invite_submit" name="invite_submit">Invite</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading GIF  -->
            <div class="row justify-content-center" id="waitingForFriend">
                <div class="col-12">
                    <h3 class="color-secondary text-center">
                        Your Game Id:. Your Friend can join this game by entering this ID.
                    </h3>


                </div>
                <div class="col-12 text-center ">
                    <div>
                        <img src="../resources/gifs/spinner.svg" alt="Teamwork" class="img-fluid" id="teamwork-gif">
                        <h1 class="d-inline">Waiting for your Friend to Join!</h1>
                    </div>

                </div>
            </div>

            <!-- Game and Scoreboad  -->
            <div class="row" id="gameAndScoreBoard">
                <div class="col-lg-8 col-md-12 col-sm-12 mb-3">
                    <!-- Game  -->
                    <div id="game" class="center">

                        <table class="center">
                            <tr>
                                <td>
                                    <button type="button" id="v0" class="btn btn-outline-danger cell">X</button>
                                </td>
                                <td>
                                    <button type="button" id="v1" class="btn btn-outline-danger cell">O</button>
                                </td>
                                <td>
                                    <button type="button" id="v2" class="btn btn-outline-danger cell">X</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" id="v3" class="btn btn-outline-danger cell">X</button>
                                </td>
                                <td>
                                    <button type="button" id="v4" class="btn btn-outline-danger cell">O</button>
                                </td>
                                <td>
                                    <button type="button" id="v5" class="btn btn-outline-danger cell">X</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" id="v6" class="btn btn-outline-danger cell">O</button>
                                </td>
                                <td>
                                    <button type="button" id="v7" class="btn btn-outline-danger cell">X</button>
                                </td>
                                <td>
                                    <button type="button" id="v8" class="btn btn-outline-danger cell">O</button>
                                </td>
                            </tr>
                        </table>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary btn-lg" id="reset">Restart</button>
                        </div>
                
                    </div>
                </div>

                <!-- Chat and Scorboard -->
                <div class="col-lg-4 col-md-12">

                    <div class="row">
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
                                            <p class="text-secondary">Thank you. You also played very well</p>
                                        </div>
                                    </div>
        
                                    <div class="chat row mt-2">
                                        <div class="identity">
                                            <img class="person-img" src="../resources/images/paul.jpg" alt="">
                                        </div>
                                        <div class="message align-self-center ml-5">
                                            <p class="text-secondary">Thanks. Gotta go. Bye</p>
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

    </main>

    


    <!-- BootStarp Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    


</body>
</html>