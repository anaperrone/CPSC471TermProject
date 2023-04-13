<?php
    session_start();
    $post_data = $_SESSION['post_data']; // get the username from here

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ParkingData";
    include_once '../BackEnd/DB.php';
    include_once '../BackEnd/Stall.php';

    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    $StallArray = $db->DBGetStalls();

    if (count($_POST) && !empty($_POST["LotID"]) && !empty($_POST["Number"]) && !empty($_POST["Type"])){
        $LotID = $_POST['LotID'];
        $Number = $_POST['Number'];
        $Type = $_POST['Type'];

        $theStall = new Stall($LotID, $Number, $Type, 0);
        $db->DBInsertIntoStalls($theStall);
        $db->closeDBConnection();
        header ("Location: adminHomePage.php");
        exit();
    }
    else{
        header ("Location: userAddVehicle.php?erro=All Fields Must be Filled");
        exit();
    }