<?php
    // session management
    session_start();
    if(isset($_SESSION['sessionId'])){
        header("Location: ./receptionist/receptionist.php");
    }else{
        header("Location: ./home.php");
    }
?>