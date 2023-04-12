<?php
class Admin {
    // variables for the vehicle class
    private $AdminID;
    private $Name;
    private $Password;
    // default constructor
    public function __construct($ID, $N, $P) {
        $this->AdminID = $ID;
        $this->Name = $N; 
        $this->Password = $P;
    }
    // a getter for the AdminID parameter
    function getAdminID(){
        return($this->AdminID);
    }
    // a getter for the Name parameter
    function getName(){
        return($this->Name);
    }
    function getPassword(){
        return($this->Password);
    }
}
?>