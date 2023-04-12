<?php
session_start();
$_SESSION['post_data'] = $_POST['username'];
$_SESSION["errorMessage"] = "";

// the creds for the database; change as needed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ParkingData";
// initialize the database connection using the DB driver code
include_once '../BackEnd/DB.php';
include_once '../BackEnd/User.php';

$db = new DBConnection();
$db->connectToDB($servername, $username, $password, $dbname);
$carArray = $db->DBGetVehicles();
$UserArray = $db->DBGetUsers($carArray);
// close the database connection
$db->closeDBConnection();

if (count($_POST) && isset($_POST["username"]) && isset($_POST["password"])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    
    foreach($UserArray as $User){
        if($uname === ($User->getUserName()) && $pass === ($User->getPassword())){
            header ("Location: homePage.php");
            exit();
        }
    }
    $_SESSION["errorMessage"] .= "incorrect username or password, please try again";
    header ("Location: loginPage.php?erro=Wrong");
    exit();
    
}

else{
    header ("Location: loginPage.php?erro=Failed");
    exit();
}

?>