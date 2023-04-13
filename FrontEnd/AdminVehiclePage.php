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
    $vehicleArray = $db->DBGetVehicles();
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
      <link href="./vehiclePage.css" rel="stylesheet" />

      <div class="vehiclePage-container">
        <div class="vehiclePage-page">
          <img
            src="public/playground_assets/Waves.png"
            class="vehiclePage-waves-background"
            />
          <span class="parkshark-logo-text"><span>ParkShark</span></span>
          <img src="public/playground_assets/Logo.png" class = "parkshark-logo"/>

          <!-- Button container to make everything look nice -->
          <div class="button-container">
            <?php
              //Gets vehicles for the user logged in and stores in vehiclesInUserArray
              //Prints all the buttons and info inside. Assigns the plate number as the button id for each vehicle button
              //if (!is_null($vehiclesInUserArray))
             // {
                for($i = 0; $i < sizeof($vehicleArray); $i++)
                {
                  echo "<button class='button' id='" . $vehicleArray[$i]->getPlatnum() . "'> <strong>Plate number:</strong><br>" . 
                  $vehicleArray[$i]->getPlatnum(). "<br><br> <strong>Car:</strong> " . $vehicleArray[$i]->getYear() . " " . 
                  $vehicleArray[$i]->getMake(). " " . $vehicleArray[$i]->getModel() . "<br><br><strong>Colour:</strong> " . 
                  $vehicleArray[$i]->getColour() . "</button>";
                }
              //}
            ?>
          </div> <!-- End of button container -->
          <!-- Remove vehicle text -->
          <span class="removeVehicle-drop-down-title">Remove vehicle</span>
          <!-- Drop down menu -->
          <select class="removeVehicle-drop-down" id="chosenPlatnum">
            <?php
              for($i = 0; $i < sizeof($vehicleArray); $i++)
              {
                echo "<option value='" . $vehicleArray[$i]->getPlatnum() . "'>" . $vehicleArray[$i]->getPlatnum() . "</option>";
              }
            ?>
          </select>
          <!-- Form needed to convert javascript input to php variable -->
          <form id="removeVehicleForm" method="post" action="AdminVehiclePage.php">
            <input type="hidden" id="chosenPlatnumFormInfo" name="chosenPlatnum" value="">
          </form>
          <!-- Submit button -->
          <button id="removeVehicle-button">Submit</button>
          <!-- Start javascript code  -->
          <script>
            // Makes the button respond to clicks
            document.getElementById("removeVehicle-button").addEventListener("click", function() {
              //The below two statements are the response to the clicks
              document.getElementById("chosenPlatnumFormInfo").value = document.getElementById("chosenPlatnum").value;
              document.getElementById("removeVehicleForm").submit();
              <?php
                //if statement to make sure the form is submitted before doing logic
                if(isset($_POST['chosenPlatnum'])) 
                {
                  //Access post variable from obtained from .submit() just above
                  $chosenPlatnum = $_POST['chosenPlatnum'];
                  
                  $vehiclesInUserArrayIndex;
                  //We find the location in the logged in user's vehicle array, where the chosen plate number matches and store it in vehiclesInUserArrayIndex
                  for($i = 0; $i < sizeof($vehicleArray); $i++)
                  {
                    if($vehicleArray[$i]->getPlatnum() == $chosenPlatnum)
                    {
                      $vehiclesInUserArrayIndex = $i;
                    }
                  }
                  //Delete Vehicle from DB.php which takes in a vehicle object
                  $db->DBDeleteFromVehicles($vehicleArray[$vehiclesInUserArrayIndex]);
                }
                //Close connection  
                $db->closeDBConnection();
              ?>
            //Timeout of 0 ensures that the above code is executed first and then we are brought back to homePage.php
            setTimeout(function()
            {
              window.location.href = "adminHomePage.php";
            }, 1);
            });     
          </script> 
        </div>
      </div>
    </div>
  </body>
</html>