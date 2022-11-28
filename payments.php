<?php

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, otherwise redirect to login page
    require_once "ctl/logincheck.php";

    // Start the database manger
    require_once "ctl/dbmanager.php";

    // Get payment amount due for display
    require_once "ctl/paymentdue.php";

    // Get payment due date for display
    require_once "ctl/paymentdate.php";

    // Define variables and initialize with empty values
    $name = $surname = $email = $address1 = $address2 = $city = $state = $zip = $country = $cc_num = $cc_month = $cc_year = $cc_cvv = $result = "";
    $name_err = $surname_err = $email_err = $address1_err = $city_err = $state_err = $zip_err = $country_err = $cc_num_err = $cc_month_err = $cc_year_err = $cc_cvv_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Payment processing controller
        require_once "ctl/paymentprocess.php";

    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Murray">

    <meta charset="UTF-8">
    <title>CreditWatch Payments Portal</title>
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
                <a href="payments.php" class="nav-link active">
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

      <div class="container rounded bg-white">

        <div class="col-md-8 py-5">
            <h2>Payment Details Portal</h2>
        </div>

        <div class="row">
            <div class="col-md-8 order-md-1">

                <?php 
                    if(!empty($result)){
                        echo '<div class="alert alert-primary">' . $result . '</div><br>';
                    }        
                ?>
            
                <h4 class="mb-3">Payment amount due</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <span>Total (USD):</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong class="text-success">$<?php echo number_format((float)$totaldue, 2, '.', ''); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <span>Due date:</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong><?php echo $finaldatedue; ?></strong>
                    </div>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Billing address</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">First name</label>
                            <input type="text" name="name" class="form-control" placeholder="" value="<?php echo $name; ?>" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback"> Valid first name is required. </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="surname">Last name</label>
                            <input type="text" name="surname" class="form-control" placeholder="" value="<?php echo $surname; ?>" required>
                            <div class="invalid-feedback"> Valid last name is required. </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" value="<?php echo $email; ?>">
                        <div class="invalid-feedback"> Please enter a valid email address. </div>
                    </div>
                    <div class="mb-3">
                        <label for="address1">Address Line 1</label>
                        <input type="text" name="address1" class="form-control" placeholder="1234 Main St" value="<?php echo $address1; ?>" required>
                        <div class="invalid-feedback"> Please enter your shipping address. </div>
                    </div>
                    <div class="mb-3">
                        <label for="address2">Address Line 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" name="address2" class="form-control" placeholder="Apartment or suite" value="<?php echo $address2; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="country">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Richardson" value="<?php echo $city; ?>" required>
                            <div class="invalid-feedback"> Please enter a valid city. </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="state">State</label>
                            <input type="text" name="state" class="form-control" placeholder="Texas" value="<?php echo $state; ?>" required>
                            <div class="invalid-feedback"> Please provide a valid state. </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" name="zip" class="form-control" placeholder="" value="<?php echo $zip; ?>" required>
                            <div class="invalid-feedback"> Zip code required. </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="country">Country</label>
                            <input type="text" name="country" class="form-control" placeholder="USA" value="<?php echo $country; ?>" required>
                            <div class="invalid-feedback"> Please enter a valid country. </div>
                        </div>                        
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Credit card details</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" name="cc_num" class="form-control" maxlength="16" required>
                            <div class="invalid-feedback"> Credit card number is required </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="ccm-exp">Exp. Month</label>
                            <input type="text" name="cc_month" class="form-control" maxlength="2" required>
                            <div class="invalid-feedback"> Expiration month required </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="ccy-exp">Exp. Year</label>
                            <input type="text" name="cc_year" class="form-control" maxlength="2" required>
                            <div class="invalid-feedback"> Expiration year required </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" name="cc_cvv" class="form-control" maxlength="3" placeholder="" required>
                            <div class="invalid-feedback"> Security code required </div>
                        </div>
                    </div>
                    
                    <hr class="mb-4">
                    <button class="btn btn-danger" type="Submit">Save Payment Details</button>
                </form>
            </div>
        </div>
      </div>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

</body>
</html>
