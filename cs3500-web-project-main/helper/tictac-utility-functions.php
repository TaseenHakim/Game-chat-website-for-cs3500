<?php

    function setBoard($boardString){
        // Set Board
        return string_to_board($boardString);
        

        
    }

    function board_to_string($board){
        $boardString = "";

        $signBinding = [
            0 => '-',
            1 => '1',
            2 => '2'
        ];

        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $boardString += $signBinding[$board[i][j]]; 
            }
        }

        return $boardString;

    }

    function string_to_board($boardString){
        $board = [];

        $signBinding = [
            '-'=> 0,
            '1'=> 1,
            '2'=> 2
        ];


        $count = 0;
        for ($i = 0; $i < 3; $i++) {
            $temp = [];
            for ($j = 0; $j < 3; $j++) {
                array_push($temp, $signBinding[$boardString[$count]]);
                $count += 1;
            }


            array_push($board, $temp);
            
        }

        return $board;

    }

    function check_winner($boardString){
        $board = string_to_board($boardString);

        // Horizontal Check
        for ($i = 0; $i < 3; $i++) {
            if($board[i][0] == $board[i][1] &&
                board[i][0] == $board[i][2]){
                    return TRUE;
            }
        }

        // Vertical check
        for ($i = 0; $i < 3; $i++) {
            if($board[0][i] == $board[1][i] &&
                $board[0][i] == $board[2][i]){
                    return TRUE;
                }
        }

        // Diagonal check
        if($board[0][0] == $board[1][1] && $board[0][0] == $board[2][2]){
            return TRUE;
        }
        if($board[0][2] == $board[1][1] && $board[0][2] == $board[2][0]){
            return TRUE;
        }
        
        return FALSE;
        
    }


    function check_friend_accepted_invite(){
        if(isset($_SESSION["hasInvited"])){
            if($_SESSION["hasInvited"] == TRUE){
                // Has invited someone.
                $gameId = $_SESSION["GameId"];
                if($gameId != NULL){
                    $sql = "SELECT * FROM game WHERE gameId=$gameId";
                    $stmt = $conn->prepare($sql);
                    
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        // Friend didn't reject yet.
                        $res = $stmt->fetch();

                        $p2 = $res['p2'];

                        if($p2 != NULL){
                            // Invite accepted
                            $_SESSION['isPlaying'] = TRUE;
                            $_SESSION["hasInvited"] = FALSE;
                            $_SESSION["MySymbol"] = "X";
                        }
                        // Else the invite has not been accepted yet.

                    } else {
                        // Friend rejected the invite
                        alert("Unfortunately your friend rejected your invite.");
                        $_SESSION['isPlaying'] = FALSE;
                        $_SESSION['OpponentId'] = NULL;
                        $_SESSION['GameId'] = NULL;
                        $_SESSION['LocalBoard'] = NULL;
                        $_SESSION["hasInvited"] = FALSE;

                        header("Location: games/tictac.php");

                    }
                }
            }
        }
        
    }


?>