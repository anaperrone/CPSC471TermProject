<?php    
    session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ParkingData";
  // initialize the database connection using the DB driver code
  include_once '../BackEnd/DB.php';
  $db = new DBConnection();
  $db->connectToDB($servername, $username, $password, $dbname);
  $stallArray = $db->DBGetStalls(); // this array is only needed to build the parking lot objects, but becomes irrelivant after
  $lotArray = $db->DBGetParkingLots($stallArray);
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
      <link href="./adminParkingLotPage.css" rel="stylesheet" />

      <div class="adminParkingLotPage-container">
        <div class="adminParkingLotPage-page">
          <img
            src="public/playground_assets/Waves.png"
            class="adminParkingLotPage-waves-background"
          />
          <span class="parkshark-logo-text"><span>ParkShark</span></span>
          <img src="public/playground_assets/Logo.png" class = "parkshark-logo"/>

          <div class="button-container">
            <?php 
            for ($i = 0; $i < sizeof($lotArray); $i++) {
              $lotID = $lotArray[$i]->getLotID();
              $address = $lotArray[$i]->getAddress();
              echo "<button class='button' id='$lotID'>" .
                  "<strong>Lot ID:</strong><br>" . $lotID . "<br><br><strong>Address:</strong><br>" .
                  $address . "<br><br><strong>Size:</strong> " . $lotArray[$i]->getSize() . "</button>";
          }
            ?>
            <a href = "adminAddParkingLot.php">
              <button class='button'><span style="font-size: 60px;"><strong>+</strong></span></button>
            </a>
          </div>
          
          <span class="removeParkingLot-drop-down-title">Remove Parking Lot</span>
          <select class="removeParkingLot-drop-down" id="chosenLotID">
            <?php
              for($i = 0; $i < sizeof($lotArray); $i++)
              {
                echo "<option value='" . $lotArray[$i]->getLotID() . "'>" . $lotArray[$i]->getLotID() . "</option>";
              }
            ?>
          </select>

          <form id="removeParkingLotForm" method="post" action="adminParkingLotPage.php">
            <input type="hidden" id="chosenLotIDFormInfo" name="chosenLotID" value="">
          </form>
          
          <button id="removeParkingLot-button">Submit</button>

            <script>
              document.getElementById("removeParkingLot-button").addEventListener("click", function() 
              {
                //The below two statements are the response to the clicks
                document.getElementById("chosenLotIDFormInfo").value = document.getElementById("chosenPlatnum").value;
                document.getElementById("removeParkingLotForm").submit();
                <?php
                  if(isset($_POST['chosenPlatnum'])) 
                  {
    
                    $chosenLotID = $_POST['chosenLotID'];
                    $lotArrayIndex;
                    for($i = 0; $i < sizeof($lotArray); $i++)
                    {
                      if($lotArray[$i]->getLotID() == $chosenLotID)
                      {
                        $lotArrayIndex = $i;
                      }
                    }

                    $db->DBDeleteFromParkingLots($lotArray[$lotArrayIndex]);
                  }
                  //Close connection  
                  $db->closeDBConnection();
                ?>
              setTimeout(function()
              {
                window.location.href = "homePage.php";
              }, 1);
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>