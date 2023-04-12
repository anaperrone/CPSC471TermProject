<?php    
    session_start();
    $post_data = $_SESSION['post_data']; // get the username from here
    echo $post_data;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ParkingData";
    // initialize the database connection using the DB driver code
    include_once '../BackEnd/DB.php';
    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    $vehicleArray = $db->DBGetVehicles();
    $userArray = $db->DBGetUsers($vehicleArray);
    //echo $vehicleArray[0]->getModel();
    // close the database connection
    $db->closeDBConnection();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div>
      <link href="./selectVehiclePage.css" rel="stylesheet" />

      <div class="selectVehiclePage-container">
        <div class="selectVehiclePage-page">
          <img
            src="public/playground_assets/Waves.png"
            class="selectVehiclePage-waves-background"
          />
          <span class="parkshark-logo-text"><span>ParkShark</span></span>
          <img src="public/playground_assets/Logo.png" class = "parkshark-logo"/>
          <?php
            $AccountId = '54321'; //Need to get account ID from session variable instead
            for($i = 0; $i < sizeof($userArray); $i++)
            {
              if($userArray[$i]->getUserName() == $post_data)
              {
                $arrayIndex = $i;
              }
            }
          ?>
          <div class="button-container">
            <a href = "selectParkingTimePage.php">
              <?php
                $vehiclesInUserArray = $userArray[$arrayIndex]->getVehicles();
                for($i = 0; $i < sizeof($vehiclesInUserArray); $i++)
                {
                  echo "<button class='button' id='" . $vehiclesInUserArray[$i]->getPlatnum() . "'> <strong>Plate number:</strong><br>" . 
                  $vehiclesInUserArray[$i]->getPlatnum(). "<br><br> <strong>Car:</strong> " . $vehiclesInUserArray[$i]->getYear() . " " . 
                  $vehiclesInUserArray[$i]->getMake(). " " . $vehiclesInUserArray[$i]->getModel() . "<br><br><strong>Colour:</strong> " . 
                  $vehiclesInUserArray[$i]->getColour() . "</button>";
                }
              ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
