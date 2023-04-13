<?php
session_start();
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];

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

if (count($_POST) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["confirmed"])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $check = $_POST['confirmed'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    foreach($UserArray as $User){
        if($uname === ($User->getUserName())){
            $_SESSION["errorMessage"] .= "this account already exists, please try again";
            header ("Location: registerPage.php?erro=Account Already Exists");
            exit();
        }
    }
    if((strlen($uname) == 0) || (strlen($pass) == 0) || (strlen($fname) == 0) || (strlen($lname) == 0)){
        $_SESSION["errorMessage"] .= "You must enter information for all fields";
        header ("Location: registerPage.php?erro=Enter all Fields");
        exit();
    }
    if($pass == $check){ // check if passwords match
        header ("Location: paymentPage.php");
        exit();
    }
    $_SESSION["errorMessage"] .= "your passwords do not match, please try again";
    header ("Location: registerPage.php?erro=Passwords Don't Match");
    exit();
    
}

else{
    header ("Location: registerPage.php?erro=Failed");
    exit();
}

?>