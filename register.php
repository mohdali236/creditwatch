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

    <!-- CSS style for login/reg page background -->
    <style type="text/css">
        
        .gradient-custom {
        /* fallback for old browsers */
        background: #eb0d15;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(235, 13, 21, 1), rgba(248, 249, 250, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(235, 13, 21, 1), rgba(248, 249, 250, 1))
        }
    </style>

</head>
<body>

    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <img class="bi pe-none me-2" width="240" height="109" src="img/creditwatch_large.png">
                  <p class="mb-5"><br>Please enter your new user details!</p>
                
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                        <div class="form-outline mb-4">
                            <label>Username</label>
                            <input type="text" name="username" maxlength="50" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-outline mb-4">
                            <label>Password</label>
                            <input type="password" name="password" maxlength="255" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-outline mb-4">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-outline mb-4">
                            <label>E-mail</label>
                            <input type="email" name="email" maxlength="255" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-outline mb-4">
                            <label>Security Question</label>
                            <input type="text" name="sec_question" maxlength="100" class="form-control <?php echo (!empty($sec_question_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sec_question; ?>">
                            <span class="invalid-feedback"><?php echo $sec_question_err; ?></span>
                        </div>
                        <div class="form-outline mb-4">
                            <label>Security Question Answer</label>
                            <input type="text" name="sec_answer" maxlength="100" class="form-control <?php echo (!empty($sec_answer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sec_answer; ?>">
                            <span class="invalid-feedback"><?php echo $sec_answer_err; ?></span>
                        </div>

                            <input type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm" value="Submit">
                            <input type="reset" class="d-none d-sm-inline-block btn btn-secondary ml-2 shadow-sm" value="Reset">

                        
                    </form>


                </div>

                <div>
                  <p class="mb-0">Already have an account? <a href="login.php" class="text-danger fw-bold">Login here</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
