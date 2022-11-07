<?php

    // Initialize the session
    session_start();

    // Check if the user is logged in, if not then redirect him to login page
    require_once "ctl/logincheck.php";

    // Controller for upload and fraudDetect on CSV file
    require_once "ctl/uploadandprocess.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Murray">

    <meta charset="UTF-8">
    <title>Welcome to CreditWatch</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
</head>
   <body>

  <!-- load icons for menu from svg paths -->
  <iframe src="img/svg-loggedin.html" onload="this.insertAdjacentHTML('afterend', (this.contentDocument.body||this.contentDocument).innerHTML);this.remove()"></iframe>


   </svg>

    <div class="wrapper d-flex align-items-stretch">

      <nav class="sidebar">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;height: 100vh;">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img class="bi pe-none me-2" width="240" height="32" src="img/creditwatch_long.png">
          </a>
          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
              <a href="welcome.php" class="nav-link link-dark" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Home
              </a>
            </li>
            <li>
              <a href="dashboard.php" class="nav-link link-dark">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                Fraud Dashboard
              </a>
            </li>
            <li>
              <a href="notifications.php" class="nav-link link-dark">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#exclamation-circle"/></svg>
                Notifications
              </a>
            </li>
            <li>
              <a href="#" class="nav-link active">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#file-earmark-arrow-up"/></svg>
                Upload Data
              </a>
            </li>
            <li>
              <a href="payments.php" class="nav-link link-dark">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#bi-credit-card"/></svg>
                Payments
              </a>
            </li>
            <li>
              <a href="profile.php" class="nav-link link-dark">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Profile
              </a>
            </li>
          </ul>
          <hr>
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <svg class="rounded-circle me-2" width="32" height="32"><use xlink:href="#gear-fill"/></svg>
              <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>
            </a>
            <ul class="dropdown-menu text-small shadow">
              <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="reset-password.php">Change Password</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container rounded bg-white mt-5 mb-5">

        <h2> Upload Transaction Data</h2>

        <br>
        Here is a sample data file for upload testing: <a href="https://www.ohmydar.win/creditwatch/data/sampledata.csv"> Sample CSV File </a><br>
        Upload accepts only CSV files that are less than 20MB.<br>
        CSV File Columns: [customer_account_number, transaction_number, epoch_timedate, geo_longitude, geo_latitude]<br><br><hr><br>

        <form action="" method="POST" enctype="multipart/form-data">
          <input type="file" name="csv" />
          <input type="submit"/>
          <br><br>
          <ul>
             <li>Sent file: <?php echo $_FILES['csv']['name'];  ?>
             <li>File size: <?php echo $_FILES['csv']['size'], " bytes";  ?>
             <li>File type: <?php echo $_FILES['csv']['type'] ?>
          </ul>
          <br>
          <?php echo $error; echo $result; ?>
        </form>
      </div>
    
    </div>
      
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>


   </body>
</html>