<?php
session_start();
$newPrice = $_POST['price'];
// the creds for the database; change as needed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ParkingData";
// initialize the database connection using the DB driver code
echo("done");
include_once '../BackEnd/DB.php';

$db = new DBConnection();
$db->connectToDB($servername, $username, $password, $dbname);

if (count($_POST) && !empty($_POST['price'])){
    $db->DBSetPrice($newPrice);
    $db->closeDBConnection();
    header ("Location: adminHomePage.php");
    exit();
}
else{
    header ("Location: AdminTicketPrice.php?erro=Enter an Integer Price");
    exit();
}
