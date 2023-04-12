<?php
session_start();
$uname = $_SESSION['username'];
$pass = $_SESSION['password'];
$F = $_SESSION['fname'];
$L = $_SESSION['lname'];

// the creds for the database; change as needed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ParkingData";
// initialize the database connection using the DB driver code
echo("done");
include_once '../BackEnd/DB.php';
include_once '../BackEnd/User.php';

$db = new DBConnection();
$db->connectToDB($servername, $username, $password, $dbname);
$carArray = $db->DBGetVehicles();
$UserArray = $db->DBGetUsers($carArray);


if (count($_POST) && isset($_POST["number"]) && isset($_POST["date"]) && isset($_POST["cvv"])){
    $Num = $_POST['number'];
    $Date = $_POST['date'];
    $CVV = $_POST['cvv'];
    // check if card is 16 digits
    if(strlen($Num) != 16){
        header ("Location: paymentPage.php?erro=Card Number Must be 16 Digits ");
        exit();
    }
    // check that expiry data is 4 digits (2/2)
    if (!(preg_match('/^\d{2}\/\d{2}$/', $Date))){
        header ("Location: paymentPage.php?erro=Expiry Date Must be in xx/xx format ");
        exit();
    }
    // check if cvv is 3 characters
    if(strlen($CVV) != 3){
        header ("Location: paymentPage.php?erro=CVV Must be 3 Digits ");
        exit();
    }
    // generate userID
    $userID = rand(10000, 99999);
    // create a new user
    $newUser = new User($F, $L, $uname, $pass, $userID, $Num, $Date, $CVV, 0);
    // save new user into the database
    $db->DBInsertIntoUsers($newUser);

    $_SESSION['post_data'] = $post_data['username']; // use this to carry the username into the homepage
    // close the database connection
    $db->closeDBConnection();

    header ("Location: homePage.php");
    exit();
}

else{
    header ("Location: paymentPage.php?erro=Failed");
    exit();
}

?>