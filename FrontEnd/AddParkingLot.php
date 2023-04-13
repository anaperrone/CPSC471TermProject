<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ParkingData";
    include_once '../BackEnd/DB.php';

    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    $stallArray = $db->DBGetStalls(); // this array is only needed to build the parking lot objects, but becomes irrelivant after
    $lotArray = $db->DBGetParkingLots($stallArray);


    if (count($_POST) && !empty($_POST["LotID"]) && !empty($_POST["Size"]) && !empty($_POST["Address"])){
        $LotID = $_POST['LotID'];
        $Size = $_POST['Size'];
        $Address = $_POST['Address'];
        foreach($lotarray as $Lot){
            if($LotID === ($Lot->getLotID())){
                $_SESSION["errorMessage"] .= "this plate number already exists, please try again";
                header ("Location: adminAddParkingLot.php?erro=Plate Already Exists");
                exit();
            }
        }
        foreach($lotArray as $Lot){
            $theLot = new Parking_Lot($LotID, $Size, $Address, $stallArray);
            $db->DBInsertIntoParkingLots($theLot);
            // close the database connection
            $db->closeDBConnection();
            header ("Location: homePage.php");
            exit();
        }
    }
    else{
        header ("Location: adminAddParkingLot.php?erro=All Fields Must be Filled");
        exit();
    }
?>