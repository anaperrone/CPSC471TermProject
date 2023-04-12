<?php
  session_start();

  $servername = "localhost";
  $serverusername = "root";
  $serverpassword = "";
  $dbname = "ParkingData";
  // initialize the database connection using the DB driver code
  include_once '../BackEnd/DB.php';
  $db = new DBConnection();
  $db->connectToDB($servername, $serverusername, $serverpassword, $dbname);
  
  // $username = $password = "";
  $username_err = $password_err = $login_err = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
  }
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
      <link href="./selectParkingTimePage.css" rel="stylesheet" />

      <div class="selectParkingTimePage-container">
        <div class="selectParkingTimePage-page">
            <img
                src="public/playground_assets/Waves.png"
                class="selectParkingTimePage-waves-background"
            />
            <span class="parkshark-logo-text"><span>ParkShark</span></span>
            <img src="public/playground_assets/Logo.png" class = "parkshark-logo"/>
            <span class='selectParkingTimePage-message'><span>please select how long you will park for:</span></span>

            <span class="hours-drop-down-title">hours:</span>
            <select class="hours-drop-down" id="hours" onselect="calculateTotal()">
              <option value="">-</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
            </select>

            <form id="paymentForm" method="post" action="sessionTicketPage.php">
              <input type="hidden" id="sessionTime" name="hours" value="">
              <input type="hidden" id="sessionPrice" name="total" value="">
            </form>

            <p id="total"></p>
            <button id="pay-button" style="display: none;">pay</button>

            <script>
              var price = 5; //set hourly rate here
              document.getElementById("hours").addEventListener("change", function() { 
                //wait for user to select a value from the drop down menu then calculate ticket price and show the pay button
                calculateTotal();
                showButton();
              });

              //function to calculate the parking price for selected number of hours
              function calculateTotal() {
                var quantity = document.getElementById("hours").value;
                var total = quantity * price;
                document.getElementById("total").textContent = "your total will be $" + total;
              }

              //function to show pay button once time has been chosen and price has been calculated
              function showButton() {
                var button = document.getElementById("pay-button");
                button.style.display = "block";
              }

              document.getElementById("pay-button").addEventListener("click", function() {
                //set the hidden form fields with the selected time and price data
                document.getElementById("sessionTime").value = document.getElementById("hours").value;
                document.getElementById("sessionPrice").value = document.getElementById("total").textContent.substr(18);

                //submit the form
                document.getElementById("paymentForm").submit();
              });
            </script>
            
        </div>
      </div>
    </div>
  </body>
</html>
