<?php

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, if not then redirect him to login page
    require_once "ctl/logincheck.php";

    // Start the database manger
    require_once "ctl/dbmanager.php";

    $result = ""; // Result message variable for display if user deletes a notification

    // If notif_id is set in URL, then update is_deleted field for notification record
    if(!empty($_GET['notif_id'])){
      $notif_id = $_GET['notif_id'];
      require_once "ctl/delnotifications.php";
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Murray">

    <meta charset="UTF-8">
    <title>CreditWatch - Notifications</title>
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
    <style type="text/css">.fas.icon-red {color: red;}</style>
</head>
<body>

  <!-- load icons for menu from svg paths -->
  <iframe src="img/svg-loggedin.html" onload="this.insertAdjacentHTML('afterend', (this.contentDocument.body||this.contentDocument).innerHTML);this.remove()"></iframe>

    <div class="wrapper d-flex align-items-stretch">

      <nav class="sidebar">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;height: 100vh;">
          <a href="/creditwatch" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
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
              <a href="#" class="nav-link active">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#exclamation-circle"/></svg>
                Notifications
              </a>
            </li>
            <li>
              <a href="upload-data.php" class="nav-link link-dark">
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
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="reset-password.php">Change Password</a></li>
              <li><a class="dropdown-item" href="contact.php">Customer Support</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container">
              <h2 class="my-5">Notifications Dashboard</h2>

                <?php 
                    if(!empty($result)){
                        echo '<div class="alert alert-primary">' . $result . '</div><br>';
                    }        
                ?>

                <div class="row">

                  <?php require_once "ctl/fetchnotifications.php"; ?>

                </div>

      </div>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

</body>
</html>
