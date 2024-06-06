<?php
    include "../../includes/dbconnect.inc.php";
    include "./tictac-utility-functions.php"
    session_start();

    if(isset($_POST["buttonClicked"])){
        $sql = "SELECT * FROM game WHERE gameId = $_SESSION['GameId'] LIMIT 1;";
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        if($stmt->rowCount() >0){
            $resGameInfo = $stmt->fetch();

            if($resGameInfo['turn'] != $_SESSION["UserId"]){
                // Not current users turn. So, we will do nothing.
                $status = FALSE;
                $errorMsg = "Not My Turn!";
                $data = [
                    "status" => $status,
                    "errorMsg" => $errorMsg
                ];
                echo $data;

            } else {
                // current player's turn.
                $id = $_POST["id"];

                if($_SESSION['MySymbol'] == "X"){
                    $boardStringSymbol = "1";
                } else {
                    $boardStringSymbol = "2";
                }
                 
                $_SESSION['LocalBoard'][$id] = $boardStringSymbol;

                $conn->beginTransaction();
                $sql1 = "UPDATE game SET board = $_SESSION['LocalBoard'] WHERE gameId = $_SESSION['GameId']";

                $stmt1 = $conn->prepare($sql1);
                $success1 = $stmt1->execute();

                if($success1){
                    $win = check_winner($_SESSION['LocalBoard']);
                    if($win){
                        $status = TRUE;
                        $msg = "Won";

                        $data = [
                            "status" => $status,
                            "msg" => $msg
                        ];

                        $conn->commit();
                        echo $data;

                    } else {
                        // Played the turn but didn't win. So we have to change the turn to the next player.
                        $sql2 = "UPDATE game SET turn = :opponentId WHERE gameId = :gameId";
                        $stmt2 = $conn->prepare($sql2);
                        $success2 = $stmt2->execute([
                            "opponentId"=>$_SESSION["OpponentId"],
                            "gameId"=>$_SESSION["GameId"]
                        ]);

                        if($success2){
                            // Successfully turned
                            $conn->commit();
                            $status=TRUE;
                            $msg="Successfully Played the Turn"
    
                            $data = [
                                "status" => $status,
                                "msg" => $msg
                            ];
                            echo $data;

                            
                        } else {
                            // Change Turn update failed
                            $conn->rollback();
                            $status = FALSE;
                            $msg = "Database Update Failed!";
        
                            $data = [
                                "status" => $status,
                                "msg" => $msg
                            ];
                            echo $data;
                        }
                    }
                } else{
                    // Board update failed
                    $conn->rollback();
                    $status = FALSE;
                    $msg = "Database Update Failed!";

                    $data = [
                        "status" => $status,
                        "msg" => $msg
                    ];
                    echo $data;

                }

            }
        } else {
            // Game doens't exists anymore.

            // Reset Session variables and redirect to the game page:
            $_SESSION['GameId'] = NULL;
            $_SESSION['OpponentId'] = NULL;
            $_SESSION['isPlaying'] = FALSE;
            $_SESSION['LocalBoard'] = NULL;
            $_SESSION['MySymbol'] = NULL;

            header("Location: ../tictac.php");
            


        }
    } else{
        
    }
    

?>