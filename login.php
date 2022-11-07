<?php

    // Initialize the session
    session_start();

    // Check if the user is already logged in, if yes then redirect him to welcome page
    require_once "ctl/logincheckwelcome.php";
     
    // Start the database manger
    require_once "ctl/dbmanager.php";
     
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = $login_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Check if username is empty
        require_once "ctl/usernameempty.php";
        
        // Check if password is empty
        require_once "ctl/passwordempty.php";
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){

            // Verifies password against DB and creates login session
            require_once "ctl/logincontroller.php";

        }
        
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
    <title>CreditWatch Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
</head>
<body>

  <!-- load icons for menu from svg paths -->
  <iframe src="img/svg-loggedout.html" onload="this.insertAdjacentHTML('afterend', (this.contentDocument.body||this.contentDocument).innerHTML);this.remove()"></iframe>

    <div class="wrapper d-flex align-items-stretch">

      <nav class="sidebar">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;height: 100vh;">
            <a href="/creditwatch" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
              <img class="bi pe-none me-2" width="240" height="32" src="img/creditwatch_long.png">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="index.html" class="nav-link link-dark" aria-current="page">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                  Home
                </a>
              </li>
              <li>
                <a href="#" class="nav-link active">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Login
                </a>
              </li>
              <li>
                <a href="register.php" class="nav-link link-dark">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#person-plus-fill"/></svg>
                  Register
                </a>
              </li>
              <li>
                <a href="contact.php" class="nav-link link-dark">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#telephone-fill"/></svg>
                  Contact Us
                </a>
              </li>
            </ul>
          </div>
      </nav>

      <div class="container">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="col-md-4">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
          </div>
        </form>
      </div>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>
</body>
</html>
