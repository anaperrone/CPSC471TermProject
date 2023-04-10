<!DOCTYPE html>
<html>
<head>
    <h1>My Test Page</h1>
</head>
<body>
    <?php
    // the creds for the database; change as needed
    $servername = "localhost";
    $username = "Hamza";
    $password = "hello";
    $dbname = "ParkingData";
    // initialize the database connection using the DB driver code
    include_once 'DB.php';
    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    
    $stallArray = $db->DBGetStalls(); // this array is only needed to build the parking lot objects, but becomes irrelivant after
    $lotArray = $db->DBGetParkingLots($stallArray);
    $lotArray[0]->printLotData();
    $lotArray[1]->printLotData();

    // check if the database is connected
    $status = $db->isConnected();
    echo "The status is: " . $status;

    // close the database connection
    $db->closeDBConnection();
    echo "<br>Done<br>";
    ?>
</div>
</body>
</html>