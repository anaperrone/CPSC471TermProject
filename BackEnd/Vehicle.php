<?php
class Vehicle {
    // variables for the vehicle class
    private $PlateNum;
    private $Model;
    private $Make;
    private $Colour;
    private $Year;
    private $ParkedInLot; // this is a lot number
    private $ParkedInStall; // this is a stall number
    private $OwnerID; // this is the userID of who owns the vehicle
    // default constructor
    public function __construct($Num, $Mo, $Ma, $C, $Y, $ST, $L, $OID) {
        $this->PlateNum = $Num;
        $this->Model = $Mo;
        $this->Make = $Ma;
        $this->Colour = $C;
        $this->Year = $Y;
        $this->ParkedInLot = $L;
        $this->ParkedInStall = $ST;
        $this->OwnerID = $OID;
        return($this);
    }
    // a getter for the PlateNum parameter
    function getPlatNum(){
        return($this->PlateNum);
    }
    // a getter for the Model parameter
    function getModel(){
        return($this->Model);
    }
    // a getter for the Make parameter
    function getMake(){
        return($this->Make);
    }
    // a getter for the Colour parameter
    function getColour(){
        return($this->Colour);
    }
    // a getter for the Year parameter
    function getYear(){
        return($this->Year);
    }
    // a getter for the Lot the vehicle is parked in
    function getLot(){
        return($this->ParkedInLot);
    }
    // a getter for the stall the vehicle is parked in
    function getStall(){
        return($this->ParkedInStall);
    }
    // this allows you to set the space where a vehicle is parked
    function Park($LotNum, $StallNum){
        $this->ParkedInLot = $LotNum;
        $this->ParkedInStall = $StallNum;
    }
    // this sets the parking space to null
    function Unpark(){
        $this->ParkedInLot = NULL;
        $this->ParkedInStall = NULL;
    }
    // a getter for the OwnerID parameter
    function getOwnerID(){
        return($this->OwnerID);
    }

}
?>