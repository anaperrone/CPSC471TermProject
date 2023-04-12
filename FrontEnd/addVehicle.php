<?php
    session_start();
    $post_data = $_SESSION['post_data']; // get the username from here
    echo $post_data;

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
    

    if (count($_POST) && isset($_POST["PlatNum"]) && isset($_POST["Model"]) && isset($_POST["Make"]) && isset($_POST["Colour"]) && isset($_POST["Year"])){
        $Num = $_POST['PlatNum'];
        $Model = $_POST['Model'];
        $Make = $_POST['Make'];
        $Colour = $_POST["Colour"];
        $Year = $_POST["Year"];
        foreach($UserArray as $User){
            if(($User->getUserName()) === $post_data){
                $OID = $User->getAccountID();
                $theCar = new Vehicle($Num, $Model, $Make, $Colour, $Year, NULL, NULL, $OID);
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