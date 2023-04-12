<?php
class User {
    // variables for the user class
    private $FName;
    private $LName;
    private $Username;
    private $Password;
    private $AccountID;
    private $CardNum;
    private $Passcode;
    private $CVV;
    private $Vehicles; // this is an array containing all the vehicles registered to a user
    // default constructor
    public function __construct($F, $L, $UN, $PA, $ID, $C, $P, $CVV, $VArray) { // VArray is an array of all the vehicles in the database
        $this->FName = $F;
        $this->LName = $L;
        $this->Username = $UN;
        $this->Password = $PA;
        $this->AccountID = $ID;
        $this->CardNum = $C;
        $this->Passcode = $P;
        $this->CVV = $CVV;
        if(is_array($VArray)) { // if you don't want to add vehicles to a new user (hasn't registered any) just send a 0 in place of the $VArray parameter to make this statement equate to false
            foreach($VArray as $V){
                $code = $V->getOwnerID();
                if($code == $this->AccountID){
                    $this->Vehicles[] = $V;
                }
            }
        }
        return($this);
    }
    // a getter for the FName parameter
    function getFirstName(){
        return($this->FName);
    }
    // a getter for the LName parameter
    function getLastName(){
        return($this->LName);
    }
    // a getter for the username parameter
    function getUserName(){
        return($this->Username);
    }
    // a getter for the password parameter
    function getPassword(){
        return($this->Password);
    }
    // a getter for the AccountID parameter
    function getAccountID(){
        return($this->AccountID);
    }
    // a getter for the CardNum parameter
    function getCardNum(){
        return($this->CardNum);
    }
    // a getter for the Passcode parameter
    function getPasscode(){
        return($this->Passcode);
    }
    // a getter for the CVV parameter
    function getCVV(){
        return($this->CVV);
    }
    // a getter for a list of user's vehicles
    function getVehicles(){
        return($this->Vehicles);
    }
    // a function to add a vehicle to a user's account
    function addVehicle($theCar){
        $this->Vehicles[] = $theCar;
    }

}
?>