<?php    
    session_start();
    $post_data = $_SESSION['post_data']; // get the username from here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ParkingData";
    // initialize the database connection using the DB driver code
    include_once '../BackEnd/DB.php';
    include_once '../BackEnd/User.php';
    $db = new DBConnection();
    $db->connectToDB($servername, $username, $password, $dbname);
    $stallArray = $db->DBGetStalls(); // this array is only needed to build the parking lot objects, but becomes irrelivant after
    $lotArray = $db->DBGetParkingLots($stallArray);
    $carArray = $db->DBGetVehicles();
    $userArray = $db->DBGetUsers($carArray);
    for($i = 0; $i < sizeof($userArray); $i++) {
      if($userArray[$i]->getUserName() == $post_data)
      {
        $arrayIndex = $i;
      }
    }
    $UserID = $userArray[$arrayIndex]->getAccountID();
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
      <link href="./sessionTicketPage.css" rel="stylesheet" />

      <div class="sessionTicketPage-container">
        <div class="sessionTicketPage-page">
            <img
            src="public/playground_assets/Waves.png"
            class="sessionTicketPage-waves-background"
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

            <span class='sessionTicketPage-message'><span>payment successful!</span></span>
            <?php
            $selectedLotID = $_SESSION['lotID'];
            $selectedLotAddr = $_SESSION['lotAddress'];
            $selectedVehicle = $_SESSION['vehicle'];
            $selectedSessionTime = $_POST['hours'];
            $calculatedPrice = $_POST['total'];  
            ?>

            <div class="ticket-box">
              <span class='ticket-title'><span>parkshark receipt</span></span>
              <span class='ticket-date'><span id='datetime'></span></span>
              <span class='ticket-lotID'><span><b>Parking Lot ID:</b> <?php echo $selectedLotID; ?> </span></span>
              <span class='ticket-lotAddr'><span><b>Parking Lot Address:</b> <?php echo $selectedLotAddr; ?></span></span>
              <span class='ticket-vehicle'><span><b>Vehicle Registered:</b> <?php echo $selectedVehicle; ?></span></span>
              <span class='ticket-sessionTime'><span><b>Session Time:</b> <?php echo $selectedSessionTime; ?> hours</span></span>
              <span class='ticket-sessionExpirationTime'><span></span></span>
              <span class='ticket-sessionPrice'><span><b>Session Price:</b> <?php echo $calculatedPrice; ?></span></span>
            </div>

            <script>
              function displayDateTime() {
                  var today = new Date();
                  var date = today.toLocaleDateString();
                  var time = today.toLocaleTimeString();
                  var dateTime = date + ' ' + time;
                  document.querySelector('#datetime').textContent = dateTime;
              }
              displayDateTime();

              function calculateSessionExpirationTime() {
                var selectedSessionTime = <?php echo $selectedSessionTime; ?>; // get selected session time from PHP variable
                var currentTime = new Date(); // get current local time
                var expirationTime = new Date(currentTime.getTime() + selectedSessionTime * 60 * 60 * 1000); // add selected session time to current time

                var date = expirationTime.toLocaleDateString();
                var time = expirationTime.toLocaleTimeString();
                var dateTime = date + ' ' + time;
                document.querySelector('.ticket-sessionExpirationTime').innerHTML = '<span><b>Session Expiration Time:</b> ' + dateTime + '</span>';
              }
              calculateSessionExpirationTime();
              <?php
                include_once '../BackEnd/Ticket.php';
                $currentTime = date('Y-m-d H:i:s');
                $endTime = date('Y-m-d H:i:s', strtotime('+' .$selectedSessionTime. 'hours', strtotime($currentTime)));
                $num = rand(100000, 999999);
                $theTicket = new Ticket($num, $selectedLotID, $selectedLotAddr, $selectedVehicle, $currentTime, $endTime, 'Fare', $calculatedPrice, $UserID);
                $db->DBInsertIntoTickets($theTicket);
                // close the database connection
                $db->closeDBConnection();
              ?>
            </script>
        </div>
      </div>
    </div>
  </body>
</html>
