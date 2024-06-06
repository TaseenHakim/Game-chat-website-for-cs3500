<?php
include "../includes/dbconnect.inc.php";

if(!isset($_SESSION['UserId'])){
    session_start();
}

if(isset($_SESSION["UserId"])){
    if (isset($_POST["function"])){
        if($_POST["function"] == "check_incoming_invite"){
            if(isset($_SESSION['UserId']) && $_SESSION["isInvited"] == false && $_SESSION["isPlaying"] != true){
                $uid = $_SESSION['UserId'];
                $sql = "SELECT * FROM invite WHERE invitee=$uid LIMIT 1";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
        
                if($stmt->rowCount() > 0){
                    // We got an invite.
                    $_SESSION['isInvited'] = true;
        
                    $resInvite = $stmt->fetch();
                    $inviteId = $resInvite['inviteId'];
                    $gameId = $resInvite['gameId'];
    
                    $data['isInvited'] = 'true';
                    $data['inviteId'] = $inviteId;
                    $data['gameId'] = $gameId;
        
                    echo json_encode($data);
                } else {
                    // No invite, so do nothing.
                    $data["isInvited"] = "false";
                    echo json_encode($data);
                }
            }
    
        } else if($_POST["function"] == "accept_invite"){
            
            $inviteId = $_POST["inviteId"];
            $gameId = $_POST["gameId"];
    
            $conn->beginTransaction();
            $sql2 = "DELETE FROM invite WHERE inviteId = :inviteId";
            $stmt2 = $conn->prepare($sql2);
            $success2 = $stmt2->execute(["inviteId"=>$inviteId]);
    
            if ($success2){
                //Delete successfull
                //Now update game record
                
                $sql3 = "UPDATE game SET p2=:UserId WHERE gameId=:gameId";
                $stmt3 = $conn->prepare($sql3);
                $success3 = $stmt3->execute(["gameId"=>$gameId, "UserId"=>$_SESSION['UserId']]);
                if($success3){
    
                    $sql5 = "SELECT * FROM game WHERE gameId=$gameId";
                    $stmt5 = $conn->prepare($sql5);
                    $stmt5->execute();
                    $resGame = $stmt5->fetch();
                    
                    $gameType = $resGame["gameType"];
                    $_SESSION['OpponentId'] = $resGame['p1'];
                    $_SESSION['GameId'] = $resGame['gameId'];
                    $_SESSION['LocalBoard'] = $resGame['board'];
                    $_SESSION["MySymbol"] = "O";
                    $_SESSION["isInvited"] = FALSE;
                    $_SESSION['isPlaying'] = TRUE;
    
                    $conn->commit();
    
                    $status = TRUE;
                    $msg = "Invite Accepted!";
    
                    $data["status"] = $status;
                    $data["msg"] = $msg;
        
                    echo json_encode($data);
                    
    
                
                } else{
                    // Failed to upate game record.
                    $conn->rollback();
                    $status = FALSE;
                    $errorMsg = "Database Update Failed!";
    
                    $data["status"] = $status;
                    $data["msg"] = $errorMsg;
        
        
                    echo json_encode($data);
                }
    
            } else {
                // Deletion of invite record failed.
                $conn->rollback();
                $status = FALSE;
                $errorMsg = "Database Update Failed!";
    
                $data["status"] = $status;
                $data["msg"] = $errorMsg;
    
    
                echo json_encode($data);
            }
    
        } else if($_POST["function"] == "reject_invite"){
            // To Reject an invite
            // Remove the invite record from invite table
            // Then remove the game record from game table. 
            // The inviter will keep looking if the game record exists, when it doesn't they will conclude that the friend rejected their invite.
            $inviteId = $_POST["inviteId"];
            $gameId = $_POST["gameId"];
    
            $conn->beginTransaction();
            $sql2 = "DELETE FROM invite WHERE inviteId = :inviteId";
            $stmt2 = $conn->prepare($sql2);
            $success2 = $stmt2->execute(["inviteId"=>$inviteId]);
    
            if($success2){
                // Successfully deleted invite record.
                // Deleting the Game Record Now
                $sql3 = "DELETE FROM game WHERE gameId = :gameId;";
                $stmt3 = $conn->prepare($sql3);
                $success3 = $stmt3->execute(["gameId"=>$gameId]);
    
                if($success3){
                    // Game record deleted successfully
                    $_SESSION["isInvited"] = FALSE;
                    $_SESSION["isPlaying"] = FALSE;
                    $_SESSION["gameId"] = NULL;
                    $_SESSION["OpponentId"] = NULL;
                    $_SESSION["LocalBoard"] = NULL;
    
                    $conn->commit();
                    $status = TRUE;
                    $msg = "Invite Rejected!";
                        
                    $data["status"] = $status;
                    $data["msg"] = $msg;
    
                    echo json_encode($data);
    
                } else {
                    // Game record deletiion failed.
                    $conn->rollback();
                    $status = FALSE;
                    $errorMsg = "Database Update Failed!";
                    
                    $data["status"] = $status;
                    $data["msg"] = $errorMsg;
        
                    echo json_encode($data);
                }
    
            } else {
                // Invite Record Deletion Failed.
                $conn->rollback();
                $status = FALSE;
                $errorMsg = "Database Update Failed!";
    
                $data["status"] = $status;
                $data["msg"] = $errorMsg;
    
                echo json_encode($data);
            }
    
        } else if($_POST["function"] == "check_invite_accept"){
            if(isset($_SESSION["hasInvited"])){
                if($_SESSION["hasInvited"] == TRUE){
                    // Has invited someone.
                    $gameId = $_SESSION["gameId"];
                    if($gameId != NULL){
                        $sql = "SELECT * FROM game WHERE gameId=$gameId";
                        $stmt = $conn->prepare($sql);
                        
                        $stmt->execute();
    
                        if($stmt->rowCount() > 0){
                            // Friend didn't reject yet.
                            $res = $stmt->fetch();
    
                            $p2 = $res['p2'];
    
                            if($p2 != NULL){
                                // Friend accpeted the invite
                                $_SESSION['isPlaying'] = TRUE;
                                $_SESSION["hasInvited"] = FALSE;
                                $_SESSION["MySymbol"] = "X";

                                $data = [
                                    "status"=> "accepted"
                                ];

                                echo json_encode($data);
                                exit();
                            }
                            // Else the invite has not been accepted yet.


                            $data = [
                                "status"=> "waiting"
                            ];

                            echo json_encode($data);

                        } else {
                            // Friend rejected the invite
                            $_SESSION['isPlaying'] = FALSE;
                            $_SESSION['OpponentId'] = NULL;
                            $_SESSION['GameId'] = NULL;
                            $_SESSION['LocalBoard'] = NULL;
                            $_SESSION["hasInvited"] = FALSE;

                            $data = [
                                "status"=> "rejected"
                            ];

                            echo json_encode($data);
    
                        }
                    }
                }
            }
        }
    }
    
}






