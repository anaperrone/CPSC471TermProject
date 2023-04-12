<?php
session_start();

// the creds for the database; change as needed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ParkingData";
// initialize the database connection using the DB driver code
include_once '../BackEnd/DB.php';
include_once '../BackEnd/Admin.php';

$db = new DBConnection();
$db->connectToDB($servername, $username, $password, $dbname);
$AdminArray = $db->DBGetAdmins();
// close the database connection
$db->closeDBConnection();

if (count($_POST) && isset($_POST["username"]) && isset($_POST["password"])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    foreach($AdminArray as $Admin){
        if($uname === ($Admin->getName()) && $pass === ($Admin->getPassword())){
            header ("Location: adminHomePage.php");
            exit();
        }
    }
    $_SESSION["errorMessage"] .= "incorrect username or password, please try again";
    header ("Location: adminLoginPage.php?erro=Wrong");
    exit();
}

else{
    header ("Location: adminLoginPage.php?erro=Failed");
    exit();
}

?>