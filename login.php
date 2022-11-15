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

                  <img class="bi pe-none me-2" width="240" height="32" src="img/creditwatch_long.png">
                  <p class="mb-5"><br>Please enter your login and password!</p>

                  <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div><br>';
                    }        
                  ?>
                
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                      <div class="form-outline mb-4">
                        <label class="form-label" for="typeEmailX">Username</label>
                        <input type="text" name="username" class="form-control form-control-lg <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" />
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="typePasswordX">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" />
                      </div>

                     <input type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm" value="Login" style="width:65px; padding:5px;">

                    </form>

                </div>

                <div>
                  <p class="mb-0">Don't have an account? <a href="register.php" class="text-danger fw-bold">Sign Up</a></p>
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
