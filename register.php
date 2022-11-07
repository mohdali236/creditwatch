<?php

    // Start the database manger
    require_once "ctl/dbmanager.php";

    // Define variables and initialize with empty values
    $username = $password = $confirm_password = $email = $sec_question = $sec_answer = "";
    $username_err = $password_err = $confirm_password_err = $email_err = $sec_question_err = $sec_answer_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Validate username
        require_once "ctl/checkusername.php";
        
        // Validate password and confirm password
        require_once "ctl/validatepwd.php";
    	
    	// Validate email
        require_once "ctl/validateemail.php";

        // Validate security question and answer input
        require_once "ctl/validatesec.php";

        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) 
            && empty($email_err) && empty($sec_question_err) && empty($sec_answer_err)){
            
            // Registers the user account if no errors found in field input
            require_once "ctl/registeruser.php";
        
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
    <title>Sign Up for CreditWatch</title>
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
                <a href="login.php" class="nav-link link-dark">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Login
                </a>
              </li>
              <li>
                <a href="#" class="nav-link active">
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="col-md-4">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" maxlength="50" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" maxlength="255" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
			<div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" maxlength="255" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Security Question</label>
                <input type="text" name="sec_question" maxlength="100" class="form-control <?php echo (!empty($sec_question_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sec_question; ?>">
                <span class="invalid-feedback"><?php echo $sec_question_err; ?></span>
            </div>
            <div class="form-group">
                <label>Security Question Answer</label>
                <input type="text" name="sec_answer" maxlength="100" class="form-control <?php echo (!empty($sec_answer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sec_answer; ?>">
                <span class="invalid-feedback"><?php echo $sec_answer_err; ?></span>
            </div>        
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
          </div>
        </form>
      </div>
        
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>
</body>
</html>
