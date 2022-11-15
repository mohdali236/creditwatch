<?php

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, if not then redirect him to login page
    require_once "ctl/logincheck.php";

    // Start the database manger
    require_once "ctl/dbmanager.php";

    // Define variables and initialize with empty values
    $name = $email = $message = $result = "";
    $email_err = $message_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $name = trim($_POST["name"]);

      require_once "ctl/validateemail.php";

      // Validate message length
      require_once "ctl/validatemessage.php";

      // Check input errors before inserting in database
      if(empty($email_err) && empty($message_err)){

        // Submits contact request if no errors found in field input
        require_once "ctl/contactuscontroller.php";      

      } else { (!empty($result)) ? $email_err = $result : ''; }
      
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
    <title>CreditWatch Contact Customer Support</title>
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
              <a href="#" class="nav-link link-dark">
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
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="reset-password.php">Change Password</a></li>
              <li><a class="dropdown-item active" href="contact.php">Customer Support</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container">
        <div class="row py-5">
          <div class="col-md-5 mr-auto">
            <h2>Contact Customer Support</h2>
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quaerat autem corrupti asperiores accusantium et fuga! Facere excepturi, quo eos, nobis doloremque dolor labore expedita illum iusto, aut repellat fuga!</p>
            <ul class="list-unstyled pl-md-5 mb-5">
              <li class="d-flex text-black mb-2">
                <span class="mr-3"><span class="icon-map"></span></span> 1234 Street Name, City Name Here, <br> United States
              </li>
              <li class="d-flex text-black mb-2"><span class="mr-3"><span class="icon-phone"></span></span> +1 (214) 555 5555</li>
              <li class="d-flex text-black"><span class="mr-3"><span class="icon-envelope-o"></span></span> support@creditwatch.io </li>
            </ul>
          </div>

          <div class="col-md-6">
            
            <form class="mb-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="name" class="col-form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email" class="col-form-label">Email</label>
                  <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="message" class="col-form-label">Message</label>
                  <textarea maxlength="500" name="message" id="message"  cols="30" rows="7" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $message; ?>"></textarea>
                  <div id="counter"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="Send Message">
                      </div>
                </div>
              </div>
            </form>

              <div id="form-message-success">
                <?php echo $result; ?>
              </div>
          </div>
        </div>
      </div>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

    <!-- used for textarea counter for contact message -->
    <script>
      const messageEle = document.getElementById('message');
      const counterEle = document.getElementById('counter');

      messageEle.addEventListener('input', function (e) {
          const target = e.target;

          // Get the `maxlength` attribute
          const maxLength = target.getAttribute('maxlength');

          // Count the current number of characters
          const currentLength = target.value.length;

          counterEle.innerHTML = `${currentLength}/${maxLength}`;
      });
    </script>

</body>
</html>
