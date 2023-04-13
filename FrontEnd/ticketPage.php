<?php    
    session_start();
    $post_data = $_SESSION['post_data']; // get the username from here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ParkingData";
    // initialize the database connection using the DB driver code
    include_once '../BackEnd/DB.php';
    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    $ticketArray = $db->DBGetTickets(); // this array is only needed to build the parking lot objects, but becomes irrelivant after
    $vehicleArray = $db->DBGetVehicles();
    $userArray = $db->DBGetUsers($vehicleArray);
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
      <link href="./ticketPage.css" rel="stylesheet" />

      <div class="ticketPage-container">
        <div class="ticketPage-page">
            <img
                src="public/playground_assets/Waves.png"
                class="ticketPage-waves-background"
            />
            <span class="parkshark-logo-text"><span>ParkShark</span></span>
            <img src="public/playground_assets/Logo.png" class = "parkshark-logo"/>
            <a href = 'homePage.php' class = 'homePage-button button'>
              <img
                src="public/playground_assets/homePageIcon.png"
                alt="Vector125"
                class="homePage-icon "
              />
              <span class="homePage-button-text">go to home page</span>
              </span>
            </a>

            <?php
              for($i = 0; $i < sizeof($userArray); $i++)
              {
                if($userArray[$i]->getUserName() == $post_data)
                {
                  $arrayIndex = $i;
                }
              }
              $userTicketArray = [];
              for($i = 0; $i < sizeof($ticketArray); $i++)
              {
                if($ticketArray[$i]->getUserID() == $userArray[$arrayIndex]->getAccountID())
                {
                  $userTicketArray[] = $ticketArray[$i]; 
                }
              }
            ?>
            <div class="box-container">
              <?php 
              for($i = 0; $i < sizeof($userTicketArray); $i++)
              {
                $selectedLotID = $userTicketArray[$i]->getLotID();
                $selectedLotAddr = $userTicketArray[$i]->getLotAddress();
                $selectedVehicle = $userTicketArray[$i]->getPlateNum();
                $sessionStartTime = $userTicketArray[$i]->getTimestampStart();
                $sessionEndTime = $userTicketArray[$i]->getTimestampEnd();
                $calculatedPrice = $userTicketArray[$i]->getAmount();

                echo "<div class='ticket-box'>
                <span class='ticket-title'><span>parkshark receipt</span></span>
                <span class='ticket-lotID'><span><b>Parking Lot ID:</b> $selectedLotID </span></span>
                <span class='ticket-lotAddr'><span><b>Parking Lot Address:</b> $selectedLotAddr</span></span>
                <span class='ticket-vehicle'><span><b>Vehicle Registered:</b> $selectedVehicle</span></span>
                <span class='ticket-sessionTime'><span><b>Session Start Time:</b> $sessionStartTime</span></span>
                <span class='ticket-sessionExpirationTime'><span><b>Session End Time:</b> $sessionEndTime</span></span>
                <span class='ticket-sessionPrice'><span><b>Session Price:</b> $calculatedPrice</span></span>
                </div>";
              }
              ?>
            </div>

        </div>
      </div>
    </div>
  </body>
</html>
