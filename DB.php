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
