<?php
class Ticket {
    // variables for the ticket class
    private $Number;
    private $LotID;
    private $LotAddress;
    private $PlateNum;
    private $TimestampStart; 
    private $TimestampEnd;
    private $Type;
    private $Amount;
    private $UserID;
    // default constructor
    public function __construct($Num, $ID, $AD, $PN, $ST, $EN, $Ty, $A, $UID) {
        $this->Number = $Num;
        $this->LotID = $ID;
        $this->LotAddress = $AD;
        $this->PlateNum = $PN;
        $this->TimestampStart = $ST;
        $this->TimestampEnd = $EN;
        $this->Type = $Ty;
        $this->Amount = $A;
        $this->UserID = $UID;
        return($this);
    }
    // a getter for the Number parameter
    function getNumber(){
        return($this->Number);
    }
    // a getter for the LotID parameter
    function getLotID(){
        return($this->LotID);
    }
    // a getter for the Lot Address parameter
    function getLotAddress(){
        return($this->LotAddress);
    }
    // a getter for the PlateNum parameter
    function getPlateNum(){
        return($this->PlateNum);
    }
    // a getter for the TimestampStart object
    function getTimestampStart(){
        return($this->TimestampStart);
    }
    // a getter for the TimestampEnd object
    function getTimestampEnd(){
        return($this->TimestampEnd);
    }
    // a getter for the Type parameter
    function getType(){
        return($this->Type);
    }
    // a getter for the Amount parameter
    function getAmount(){
        return($this->Amount);
    }
    // a getter for the userId parameter
    function getUserID(){
        return($this->UserID);
    }
}
?>