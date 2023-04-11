<?php
class Parking_Lot {
    // variables for the parking lot class
    private $LotID;
    private $Size;
    private $Address;
    private $Stalls; // this will be an array, build the array in the constructor and then assign it to this
    // default constructor
    public function __construct($ID, $size, $addr, $stallArray) {
        $this->Address = $addr;
        $this->LotID = $ID;
        $this->Size = $size;
        if(is_array($stallArray)) {
            foreach($stallArray as $stall){
                $code = $stall->getLotID();
                if($code == $this->LotID){
                    $this->Stalls[] = $stall;
                }
            }
        }
        return($this);
    }
    // a getter for the LotID parameter
    function getLotID() {
        return($this->LotID);
    }
    // a getter for the Size parameter
    function getSize() {
        return($this->Size);
    }
    // a getter for the Address parameter
    function getAddress() {
        return($this->Address);
    }
    // a getter for the Stalls Array
    function getStalls(){
        return($this->Stalls);
    }
    // a function to print the object's info, for only demonstrative perposes
    function printLotData() {
        echo "<br>Lot info: <br>";
        echo "Lot ID: " . $this->LotID . "<br>";
        echo "Lot Size: " . $this->Size . "<br>";
        echo "Lot Address: " . $this->Address . "<br>";
        echo "Stalls: <br>";
        foreach($this->Stalls as $stall){
            echo ($stall->getNumber()) . ") " . ($stall->getType()) . "<br>";
        }
    }
}
?>