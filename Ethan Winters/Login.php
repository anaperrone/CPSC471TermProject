<?php
session_start();



if (count($_POST) && isset($_POST["username"]) && isset($_POST["password"])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    if($uname === "pass" && $pass === "password"){
        header ("Location: homePage.php");
        exit();
    }
    else{
        header ("Location: loginPage.php?erro=Wrong");
        exit();
    }
}



else{
    header ("Location: loginPage.php?erro=Failed");
    exit();
}

?>