<?php

    if(!isset($_SESSION["UserId"])){
        session_start();
    }

    if(isset($_SESSION['UserId'])){
        $uid = $_SESSION['UserId'];
        $ufname = $_SESSION['UserFirstName'];
        $ulname = $_SESSION['UserLastName'];
        $uIsPlaying = $_SESSION["isPlaying"];
        $uOpponent = $_SESSION["OpponentId"];
        $uGameId = $_SESSION["GameId"];
        $uLocalBoard = $_SESSION["LocalBoard"];

    } else{
        $uid = NULL;
    }

?>