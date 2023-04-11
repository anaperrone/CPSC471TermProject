<?php
class Ticket {
    // variables for the ticket class
    private $Number;
    private $DateDay;
    private $DateMonth;
    private $DateYear;
    private $Timestamp; 
    private $Type;
    private $Amount;
    // default constructor
    public function __construct($Num, $D, $M, $Y, $H, $Min, $Ty, $A) {
        include_once 'Timestamp.php';
        $this->Number = $Num;
        $this->DateDay = $D;
        $this->DateMonth = $M;
        $this->DateYear = $Y;
        $this->Timestamp = new Timestamp($H, $Min);
        $this->Type = $Ty;
        $this->Amount = $A;
        return($this);
    }
    // a getter for the Number parameter
    function getNumber(){
        return($this->Number);
    }
    // a getter for the Day parameter
    function getDay(){
        return($this->DateDay);
    }
    // a getter for the Month parameter
    function getMonth(){
        return($this->DateMonth);
    }
    // a getter for the Year parameter
    function getYear(){
        return($this->DateYear);
    }
    // a getter for the Timestamp object
    function getTimestamp(){
        return($this->Timestamp);
    }
    // a getter for the Type parameter
    function getType(){
        return($this->Type);
    }
    // a getter for the Amount parameter
    function getAmount(){
        return($this->Amount);
    }
    
}
?>