<?php
class Transaction {
    // variables for the transaction class
    private $Number;
    private $Amount;
    private $Time;
    private $DateDay;
    private $DateMonth;
    private $DateYear;
    // default constructor 
    public function __construct($N, $A, $T, $D, $M, $Y) {
        $this->Number = $N;
        $this->Amount = $A;
        $this->Time = $T; // 24 hour clock
        $this->DateDay = $D;
        $this->DateMonth = $M;
        $this->DateYear = $Y;
        return($this);
    }
    // a getter for the Number parameter
    function getNumber(){
        return($this->Number);
    }
    // a getter for the Amount parameter
    function getAmount(){
        return($this->Amount);
    }
    // a getter for the Time parameter
    function getTime(){
        return($this->Time);
    }
    // a getter for the DateDay parameter
    function getDay(){
        return($this->DateDay);
    }
    // a getter for the DateMonth parameter
    function getMonth(){
        return($this->DateMonth);
    }
    // a getter for the DateYear parameter
    function getYear(){
        return($this->DateYear);
    }
}
?>