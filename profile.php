<?php

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, otherwise redirect to login page
    require_once "ctl/logincheck.php";

    // Start the database manger
    require_once "ctl/dbmanager.php";
     
    // Define variables and initialize with empty values
    $name = $surname = $phone = $address1 = $address2 = $zipcode = $city = $state = $country = $email = $username = $id = $result = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Updates the profile fields if any are populated with details
        require_once "ctl/updateprofile.php";

        // Close database manager connection
        mysqli_close($link);

    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Murray">

    <meta charset="UTF-8">
    <title>CreditWatch User Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
</head>
<body>

  <!-- load icons for menu from svg paths -->
  <iframe src="img/svg-loggedin.html" onload="this.insertAdjacentHTML('afterend', (this.contentDocument.body||this.contentDocument).innerHTML);this.remove()"></iframe>

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
                <a href="#" class="nav-link active">
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
                <li><a class="dropdown-item active" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="reset-password.php">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
              </ul>
            </div>
          </div>
      </nav>

        <div class="container rounded bg-white">

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <?php echo $result; ?>    
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <hr>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="row mt-2">
                                <div class="col-md-6 form-group">
                                    <label class="labels">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="labels">Surname</label>
                                    <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 form-group">
                                    <label class="labels">Mobile Number</label>
                                    <input type="tel" name="phone" class="form-control" value="<?php echo $phone; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="labels">Address Line 1</label>
                                    <input type="text" name="address1" class="form-control" value="<?php echo $address1; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="labels">Address Line 2</label>
                                    <input type="text" name="address2" class="form-control" value="<?php echo $address2; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="labels">Postcode</label>
                                    <input type="number" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="labels">City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="labels">State</label>
                                    <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="labels">Country</label>
                                    <input type="text" name="country" class="form-control" value="<?php echo $country; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="labels">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Save Profile">
                                <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
                                <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

</body>
</html>
