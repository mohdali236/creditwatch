<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Murray">

    <meta charset="UTF-8">
    <title>Welcome to CreditWatch</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
</head>
<body>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
      </symbol>
      <symbol id="speedometer2" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
      </symbol>
      <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </symbol>
      <symbol id="exclamation-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
      </symbol>
    </svg>

    <main class="d-flex flex-nowrap">
        
      <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
          <img class="bi pe-none me-2" width="240" height="32" src="img/creditwatch_long.png">
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
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
            <a href="#" class="nav-link link-dark">
              <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#exclamation-circle"/></svg>
              Notifications
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
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
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
  
        <div class="container">
                <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["id"]); ?></b>. Welcome to CreditWatch.</h1>
                <p>
                    <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
                    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
                </p>
        </div>

    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

</body>
</html>
