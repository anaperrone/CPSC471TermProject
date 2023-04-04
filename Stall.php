<?php
class Stall {
    // variables for the parking stall class
    private $LotID;
    private $Number;
    private $Type;
    private $IsReserved;
    // default constructor
    public function __construct($ID, $Num, $type, $Reserved) {
        $this->LotID = $ID;
        $this->Number = $Num;
        $this->Type = $type;
        $this->IsReserved = $Reserved;
        return($this);
    }
    // a getter for the Lot ID
    function getLotID(){
        return($this->LotID);
    }
    // a getter for the stall number
    function getNumber(){
        return($this->Number);
    }
    // a getter for the stall type
    function getType(){
        return($this->Type);
    }
    // a getter for teh reservation status of the stall
    function getReservationStats(){
        return($this->IsReserved); 
    }

}
?>