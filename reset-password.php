<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$sec_question = $sec_answer = $sec_answer_chk = $new_password = $confirm_password = "";
$sec_answer_err = $new_password_err = $confirm_password_err = "";


// Get customer's security question to ask for answer
// Prepare a select statement
$sql = "SELECT sec_question FROM users WHERE id = ?";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    
    // Set parameters
    $param_id = $_SESSION["id"];
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Store results
        mysqli_stmt_store_result($stmt);
        // Bind result variables
        mysqli_stmt_bind_result($stmt, $sec_question);
        mysqli_stmt_fetch($stmt);

    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Confirm security question answer is not empty
    if(empty(trim($_POST["sec_answer"]))){
        $sec_answer_err = "Please enter an answer for your security question.";
    } else{
        $sec_answer = strtolower(trim($_POST["sec_answer"]));
    }
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($sec_answer_err) && empty($new_password_err) && empty($confirm_password_err)){

        // Prepare a select statement
        $sql = "SELECT sec_answer FROM users WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_id);
            
            // Set parameters
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $sec_answer_chk);
                mysqli_stmt_fetch($stmt);

                // Check if security answer matches
                if($sec_answer == $sec_answer_chk){

                    // Close previous statement
                    mysqli_stmt_close($stmt);

                    // Prepare an update statement
                    $sql = "UPDATE users SET password = ? WHERE id = ?";
                    
                    if($stmt = mysqli_prepare($link, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
                        
                        // Set parameters
                        $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $param_id = $_SESSION["id"];
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            
                            // Password updated successfully. Destroy the session, and redirect to login page
                            session_destroy();
                            header("location: login.php");
                            exit();
                        } else{
                            echo "Oops! Something went wrong updating the password. Please try again later.";
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    
    // Close connection
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
      <symbol id="gear-fill" viewBox="0 0 16 16">
        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
      </symbol>
      <symbol id="file-earmark-arrow-up" viewBox="0 0 16 16">
         <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z"/>
         <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
      </symbol>
      <symbol id="bi-credit-card" viewBox="0 0 16 16">
         <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
         <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
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
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>    
</body>
</html>
