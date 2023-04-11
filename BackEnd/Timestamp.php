<?php
class Timestamp {
    // variables for the timestamp class
    private $Hour;
    private $Minute;
    // default constructor
    public function __construct($H, $M) {
        $this->Hour = $H;
        $this->Minute = $M;
        return($this);
    }
    // a getter for the Hour parameter
    function getHour(){
        return($this->Hour);
    }
    // a getter for the Minute parameter
    function getMinute(){
        return($this->Minute);
    }
}
?>