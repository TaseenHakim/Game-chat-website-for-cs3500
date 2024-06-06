<?php
    include "../includes/session.inc.php";
    include "../includes/dbconnect.inc.php";


    $opponentId = NULL;


    if(isset($_POST["invite_submit"])){
        // Verifying if user exists with the email
        $sql = "SELECT * FROM user WHERE Email=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['email']]);
        if($stmt->rowCount()){
            while($res = $stmt->fetch()){
                $opponentId = $res["Id"];
            }
        } else{
            // Invalid Email
            echo "InvalidEmail";
            exit();
        }

        // Creating a game room
        $gid = strtotime("now");

        $conn->beginTransaction();
        $sql = "INSERT INTO game(gameId, gameType, p1, board) VALUES(:gameId, :gameType, :p1, :board)";
        $stmt = $conn->prepare($sql);
        $success = $stmt->execute(["gameId"=>$gid, "gameType"=>$_POST['gameType'], "p1"=>$uid, "board"=>$_POST["board"]]);

        if($success){
            $sql = "INSERT INTO invite(invitee, inviter, gameid) VALUES(:invitee, :inviter, :gameId)";
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute(["invitee"=>$opponentId, "inviter"=>$uid, "gameId"=>$gid]);

            if($success){
                $conn->commit();
                $_SESSION["gameId"] = $gid;
                $_SESSION["hasInvited"] = TRUE;
                echo "Success";
            } else {
                $conn->rollback();
                echo "Failed!";
            }
            
        } else{
            $conn->rollback();
            echo "Failed!";
        }
    }
    






?>