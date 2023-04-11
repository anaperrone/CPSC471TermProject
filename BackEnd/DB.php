<?php
class DBConnection extends mysqli {
    // variables for the database
    private $isConnected;
    private $connection;
    // default constructor
    public function __construct(){
        $this->isConnected = false;
        echo("Built<br>");
    }
    // a function to connect to a database
    function connectToDB($serverName, $username, $password, $db) {
        $this->connection = mysqli_connect($serverName, $username, $password, $db);
        
        if($connection->connect_error){
            echo("Connection Failed<br>");
            $this->isConnected = false;
        }
        else {
            echo("Connection Successful<br>");
            $this->isConnected = true;
        }
    }
    // reciever function for parking lots
    function DBGetParkingLots($stallArray) {
        $array = [];
        $results = mysqli_query($this->connection, "SELECT * FROM Parking_Lots");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        while($row = mysqli_fetch_array($results)) {
            include_once 'Parking_Lot.php';
            $ID = $row['LotID'];
            $Size = $row['Size'];
            $Address = $row["Address"];
            $array[] = new Parking_Lot($ID, $Size, $Address, $stallArray);
        }
        return($array);
    }
    // output function for parking lots
    function DBInsertIntoParkingLots($theLot) {
        $ID = $theLot->getLotID();
        $Size = $theLot->getSize();
        $Address = $theLot->getAddress();
        $results = mysqli_query($this->connection, "INSERT INTO Parking_Lots (LotID, Size, Address) VALUES ('$ID', '$Size', '$Address')");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        else{
            echo "Success";
        }
    }
    // reciever function for stalls
    function DBGetStalls() {
        $array = [];
        $results = mysqli_query($this->connection, "SELECT * FROM Stalls");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        while($row = mysqli_fetch_array($results)) {
            include_once 'Stall.php';
            $ID = $row['LotID'];
            $Num = $row['Number'];
            $type = $row['Type'];
            $Reserved = $row['Reserved'];
            $array[] = new Stall($ID, $Num, $type, $Reserved);
        }
        return($array);
    }
    // output function for stalls
    function DBInsertIntoStalls($theStall) { // this function only takes one stall at a time, so to add many, just use a for loop
        $LotID = $theStall->getLotID();
        $Number = $theStall->getNumber();
        $Type = $theStall->getType();
        $IsReserved = $theStall->getReservationStats(); 
        $results = mysqli_query($this->connection, "INSERT INTO Stalls (LotID, Number, Type, Reserved) VALUES ('$LotID', '$Number', '$Type', '$IsReserved')");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        else{
            echo "Success";
        }
    }
    // reciever function for vehicles
    function DBGetVehicles(){
        $array = [];
        $results = mysqli_query($this->connection, "SELECT * FROM Vehicles");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        while($row = mysqli_fetch_array($results)) {
            include_once 'Vehicle.php';
            $PlateNum = $row['PlateNumber'];
            $Model = $row['Model'];
            $Make = $row['Make'];
            $Colour = $row['Colour'];
            $Year = $row['Year'];
            $Stall = $row['ParkedInStall'];
            $Lot = $row['ParkedInLot'];
            $OID = $row['OwnerID'];
            $array[] = new Vehicle($PlateNum, $Model, $Make, $Colour, $Year, $Stall, $Lot, $OID);
        }
        return($array);
    }
    // output function for vehicles
    function DBInsertIntoVehicles($theCar) {
        $PlateNum = $theCar->getPlatNum();
        $Model = $theCar->getModel();
        $Make = $theCar->getMake();
        $Colour = $theCar->getColour();
        $Year = $theCar->getYear();
        $Stall = $theCar->getStall();
        $Lot = $theCar->getLot();
        $OID = $theCar->getOwnerID();
        $results = mysqli_query($this->connection, "INSERT INTO Vehicles (PlateNumber, Model, Make, Colour, Year, ParkedInLot, ParkedInStall, OwnerID) VALUES ('$PlateNum', '$Model', '$Make', '$Colour', '$Year', '$Lot', '$Stall', '$OID')");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        else{
            echo "Success";
        }
    }
    // reciever function for transactions
    function DBGetTransactions() {
        $array = [];
        $results = mysqli_query($this->connection, "SELECT * FROM Transactions");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        while($row = mysqli_fetch_array($results)) {
            include_once 'Transaction.php';
            $Number = $row['Number'];
            $Amount = $row['Amount'];
            $Time = $row['Time'];
            $DateDay = $row['DateDay'];
            $DateMonth = $row['DateMonth'];
            $DateYear = $row['DateYear'];
            $array[] = new Transaction($Number, $Amount, $Time, $DateDay, $DateMonth, $DateYear);
        }
        return($array);
    }
    // output function for transactions
    function DBInsertIntoTransactions($theTransaction) {
        $TheNumber = $theTransaction->getNumber(); 
        $Amount = $theTransaction->getAmount();
        $Time = $theTransaction->getTime();
        $Day = $theTransaction->getDay();
        $Month = $theTransaction->getMonth();
        $TheYear = $theTransaction->getYear();
        $results = mysqli_query($this->connection, "INSERT INTO Transactions (Amount, Number, Time, DateDay, DateMonth, DateYear) VALUES ('$Amount', '$TheNumber', '$Time', '$Day', '$Month', '$TheYear')");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        else{
            echo "Success";
        }
    }
    // reciever function for tickets
    function DBGetTickets(){
        $array = [];
        $results = mysqli_query($this->connection, "SELECT * FROM Tickets");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        while($row = mysqli_fetch_array($results)) {
            include_once 'Ticket.php';
            $Number = $row['Number'];
            $Day = $row['DateDay'];
            $Month = $row['DateMonth'];
            $Year = $row['DateYear'];
            $StampHour = $row['StampHour'];
            $StampMinute = $row['StampMinute'];
            $Type = $row['Type'];
            $Amount = $row['Amount'];
            $array[] = new Ticket($Number, $Day, $Month, $Year, $StampHour, $StampMinute, $Type, $Amount);
        }
        return($array);
    }
    // output function for tickets
    function DBInsertIntoTickets($theTicket){
        $N = $theTicket->getNumber();
        $TheDay = $theTicket->getDay();
        $TheMonth = $theTicket->getMonth();
        $Theyear = $theTicket->getYear();
        $Hour = $theTicket->getTimestamp()->getHour();
        $Minute = $theTicket->getTimestamp()->getMinute();
        $Type = $theTicket->getType();
        $amount = $theTicket->getAmount();
        
        $results = mysqli_query($this->connection, "INSERT INTO Tickets (DateDay, Number, DateMonth, DateYear, StampHour, StampMinute, Type, Amount) VALUES ('$TheDay', '$N', '$TheMonth', '$Theyear', '$Hour', '$Minute', '$Type', '$amount')");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        else{
            echo "Success";
        }
    }
    // reciever function for users, which requires the vehicle array from the database
    function DBGetUsers($VArray){
        $array = [];
        $results = mysqli_query($this->connection, "SELECT * FROM Users");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        while($row = mysqli_fetch_array($results)) {
            include_once 'User.php';
            $F = $row['FName'];
            $L = $row['LName'];
            $AID = $row['AccountID'];
            $C = $row['CardNum'];
            $P = $row['Passcode'];
            $CVV = $row['CVV'];
            $array[] = new User($F, $L, $AID, $C, $P, $CVV, $VArray);
        }
        return($array);
    }
    // output function for users
    function DBInsertIntoUsers($theUser){
        $F = $theUser->getFirstName();
        $L = $theUser->getLastName();
        $ID = $theUser->getAccountID();
        $C = $theUser->getCardNum();
        $P = $theUser->getPasscode();
        $CVV = $theUser->getCVV();

        $results = mysqli_query($this->connection, "INSERT INTO Users (FName, LName, AccountID, CardNum, Passcode, CVV) VALUES ('$F', '$L', '$ID', '$C', '$P', '$CVV')");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        else{
            echo "Success";
        }
    }
    // reciever function for admins
    function DBGetAdmins(){
        $array = [];
        $results = mysqli_query($this->connection, "SELECT * FROM Admins");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        while($row = mysqli_fetch_array($results)) {
            include_once 'User.php';
            $ID = $row['AdminID'];
            $N = $row['Name'];
            $array[] = new Admin($ID, $N);
        }
        return($array);
    }
    // output function for admins
    function DBInsertIntoAdmins($theAdmin){
        $ID = $theAdmin->getAdminID();
        $N = $theAdmin->getName();

        $results = mysqli_query($this->connection, "INSERT INTO Admins (AdminID, Name) VALUES ('$ID', '$N')");
        if(!$results){
            echo "Query Failed: ";
            exit();
        }
        else{
            echo "Success";
        }
    }

    // a function to disconnect the database
    function closeDBConnection() {
        mysqli_close($this->connection);
        $this->isConnected = false; 
    }
    // a getter for the status of the database connection
    function isConnected() {
        return($this->isConnected);
    }
}
?>
