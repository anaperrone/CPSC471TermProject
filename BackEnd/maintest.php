<!DOCTYPE html>
<html>
<head>
    <h1>My Test Page</h1>
</head>
<body>
    <?php
    // the creds for the database; change as needed
    $servername = "localhost:4306";
    $username = "EWinters";
    $password = "";
    $dbname = "ParkingData";
    // initialize the database connection using the DB driver code
    include_once 'DB.php';
    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    
    $stallArray = $db->DBGetStalls(); // this array is only needed to build the parking lot objects, but becomes irrelivant after
    $lotArray = $db->DBGetParkingLots($stallArray);
    $lotArray[0]->printLotData();
    $lotArray[1]->printLotData();

    // create new user here and use $theUser->getAccountID() for the vehicle creation
    include_once 'User.php';
    
    $theUser = new User('Ethan', 'Winters', '1212', '123456789', '2345', '123', 0);
    echo $theUser->getAccountID();
    $db->DBInsertIntoUsers($theUser);
    

    $ID = $theUser->getAccountID();

    include_once 'Vehicle.php';
    $theCar = new Vehicle('123ABC', 'Corrola', 'XT', 'Silver', '1999', '12', '340', $ID);
    $db->DBInsertIntoVehicles($theCar);

    $carArray = $db->DBGetVehicles();
    echo $carArray[0]->getModel();

    $UserArray = $db->DBGetUsers($carArray);
    
    echo $UserArray[0]->getFirstName();

    echo $UserArray[0]->getVehicles()[0]->getPlatNum();


    $theUser->addVehicle($carArray[0]);
  
    echo $theUser->getVehicles()[0]->getPlatNum();

    include_once 'Parking_Lot.php';
    $theLot = new Parking_Lot('472', '200', '380 Core-Lot', $stallArray);
    $db->DBInsertIntoParkingLots($theLot);

    include_once 'Transaction.php';
    $theTransaction = new Transaction('ABC-123', '9', '1126', '12', '04', '2023');
    $db->DBInsertIntoTransactions($theTransaction);

    $TransactionArray = $db->DBGetTransactions();
    echo $TransactionArray[0]->getNumber();

    include_once 'Ticket.php';
    include_once 'Timestamp.php';

    $theTicket = new Ticket('1234', '02', '04', '2021', '11', '23', 'Payment', '9');
    $db->DBInsertIntoTickets($theTicket);
    
    $TicketArray = $db->DBGetTickets();
    echo $TicketArray[0]->getNumber();
    echo $TicketArray[0]->getTimestamp()->getHour();

    include_once 'Admin.php';
    $theAdmin = new Admin('12345', 'TheKing');
    $db->DBInsertIntoAdmins($theAdmin);

    $AdminArray = $db->DBGetAdmins();
    echo $AdminArray[0]->getAdminID();

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