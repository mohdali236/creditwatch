<?php

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, otherwise redirect to login page
    require_once "ctl/logincheck.php";
     
    // Start the database manger
    require_once "ctl/dbmanager.php";

    // Define variables and initialize with empty values
    $sec_question = $sec_answer = $sec_answer_chk = $new_password = $confirm_password = "";
    $sec_answer_err = $new_password_err = $confirm_password_err = "";

    // Get customer's security question to ask for answer
    require_once "ctl/secquestion.php";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Confirm security question answer is not empty
        require_once "ctl/validatesecanswer.php";
     
        // Validate new password and confirm password
        require_once "ctl/validatenewpass.php";
            
        // Check input errors before updating the database
        if(empty($sec_answer_err) && empty($new_password_err) && empty($confirm_password_err)){

            // Resets password if there are no errors from input
            require_once "ctl/resetpassword.php";

        }
        
        // Close database manager connection
        mysqli_close($link);
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CreditWatch - Reset Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
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
                <li><a class="dropdown-item active" href="#">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
              </ul>
            </div>
          </div>
      </nav>

      <div class="container">
        <div class="col-md-4">
            <div class="pt-5">
                <h2>Reset Password</h2>
                <p>Please fill out this form to reset your password.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                        <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label><?php echo $sec_question; echo (strpos($sec_question, '?') !== false) ? '' : '?'; ?></label>
                        <input type="text" name="sec_answer" maxlength="100" class="form-control <?php echo (!empty($sec_answer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sec_answer; ?>">
                        <span class="invalid-feedback"><?php echo $sec_answer_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
      </div>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>    
</body>
</html>
