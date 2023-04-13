<?php
    session_start();
    $post_data = $_SESSION['post_data']; // get the username from here

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ParkingData";
    include_once '../BackEnd/DB.php';
    include_once '../BackEnd/User.php';
    include_once '../BackEnd/Vehicle.php';

    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    $carArray = $db->DBGetVehicles();
    $UserArray = $db->DBGetUsers($carArray);
    

    if (count($_POST) && !empty($_POST["PlatNum"]) && !empty($_POST["Model"]) && !empty($_POST["Make"]) && !empty($_POST["Colour"]) && !empty($_POST["Year"])){
        $Num = $_POST['PlatNum'];
        $Model = $_POST['Model'];
        $Make = $_POST['Make'];
        $Colour = $_POST["Colour"];
        $Year = $_POST["Year"];
        foreach($carArray as $Car){
            if($Num === ($Car->getPlatNum())){
                $_SESSION["errorMessage"] .= "this plate number already exists, please try again";
                header ("Location: userAddVehicle.php?erro=Plate Already Exists");
                exit();
            }
        }
        foreach($UserArray as $User){
            if(($User->getUserName()) === $post_data){
                $OID = $User->getAccountID();
                $theCar = new Vehicle($Num, $Model, $Make, $Colour, $Year, 0, 0, $OID);
                $db->DBInsertIntoVehicles($theCar);
                // close the database connection
                $db->closeDBConnection();
                header ("Location: homePage.php");
                exit();
            }
        }
        header ("Location: userAddVehicle.php?erro=Username not found in system");
        exit();
    }
    else{
        header ("Location: userAddVehicle.php?erro=All Fields Must be Filled");
        exit();
    }
    

?>