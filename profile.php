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
$name = $surname = $phone = $address1 = $address2 = $zipcode = $city = $state = $country = $email = $username = $id = $result = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $phone = trim($_POST["phone"]);
    $address1 = trim($_POST["address1"]);
    $address2 = trim($_POST["address2"]);
    $zipcode = trim($_POST["zipcode"]);
    $city = trim($_POST["city"]);
    $state = trim($_POST["state"]);
    $country = trim($_POST["country"]);
    $email = trim($_POST["email"]);
    $username = $_SESSION["username"];
    $id = $_SESSION["id"];
    $failed = 0;

    if(!empty($name)){
        $sql = "UPDATE contact SET name = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $name, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Name, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($surname)){
        $sql = "UPDATE contact SET surname = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $surname, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Surname, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($phone)){
        $sql = "UPDATE contact SET phone = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $phone, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Phone, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($address1)){
        $sql = "UPDATE contact SET address1 = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $address1, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Address1, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($address2)){
        $sql = "UPDATE contact SET address2 = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $address2, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Address2, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($zipcode)){
        $sql = "UPDATE contact SET zipcode = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "is", $zipcode, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "ZipCode, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($city)){
        $sql = "UPDATE contact SET city = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $city, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "City, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($state)){
        $sql = "UPDATE contact SET state = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $state, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "State, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($country)){
        $sql = "UPDATE contact SET country = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $country, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Country, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($email)){
        $sql = "UPDATE users SET email = ? WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $email, $id);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Email, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

$result .= "updated successfully.";

if($failed == 1){
    $result = "Oops! Something went wrong. Please try again later.";
}

mysqli_close($link);

}

        
/*    // Check input errors before updating the database
    if(!empty($name) || !empty($surname) || !empty($phone) || !empty($address1) || !empty($address2) || !empty($zipcode) || !empty($city) || !empty($state) || !empty($country)){
        // Prepare an update statement
        $sql = "UPDATE contact SET name = ?, surname = ?, phone = ?, address1 = ?, address2 = ?, zipcode = ?, city = ?, state = ?, country = ? WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssissss", $param_name, $param_surname, $param_phone, $param_address1, $param_address2, $param_zipcode, $param_city, $param_state, $param_country, $param_username);
            
            // Set parameters
            $param_name = $name;
            $param_surname = $surname;
            $param_phone = $phone;
            $param_address1 = $address1;
            $param_address2 = $address2;
            $param_zipcode = $zipcode;
            $param_city = $city; 
            $param_state = $state;
            $param_country = $country;
            $param_username = $_SESSION["username"];
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                if(!empty($email)){
                    // Prepare an update statement
                    $sql2 = "UPDATE users SET email = ? WHERE id = ?";
                    
                    if($stmt2 = mysqli_prepare($link, $sql2)){
                        
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt2, "si", $email, $id);

                        if(mysqli_stmt_execute($stmt2)){
                            echo "Profile details updated successfully!";
                        }
                    }
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}*/

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
            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
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
  
        <div class="container">
                <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. This is your profile.</h1>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <?php echo $result; ?>    
                    </div>
                </div>

                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Profile Settings</h4>
                                </div>
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
                                        <div class="mt-5 text-center form-group">
                                            <input type="submit" class="btn btn-primary" value="Save Profile">
                                            <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
                                            <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>

        </div>

    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

</body>
</html>
