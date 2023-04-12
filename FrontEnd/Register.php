<?php
session_start();
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];

// the creds for the database; change as needed
$servername = "localhost:4306";
$username = "EWinters";
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

if (count($_POST) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["confirmed"])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $check = $_POST['confirmed'];
    foreach($UserArray as $User){
        if($uname === ($User->getUserName()) && $pass === ($User->getPassword())){
            header ("Location: registerPage.php?erro=Account Already Exists");
            exit();
        }
    }
    if($pass == $check){ // check if passwords match
        header ("Location: paymentPage.php");
        exit();
    }
    header ("Location: registerPage.php?erro=Passwords Don't Match");
    exit();
    
}

else{
    header ("Location: registerPage.php?erro=Failed");
    exit();
}

?>