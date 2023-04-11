<?php
class Admin {
    // variables for the vehicle class
    private $AdminID;
    private $Name;
    // default constructor
    public function __construct($ID, $N) {
        $this->AdminID = $ID;
        $this->Name = $N; 
    }
    // a getter for the AdminID parameter
    function getAdminID(){
        return($this->AdminID);
    }
    // a getter for the Name parameter
    function getName(){
        return($this->Name);
    }
}
?>