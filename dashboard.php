<?php

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, if not then redirect him to login page
    require_once "ctl/logincheck.php";

    // Start the database manger
    require_once "ctl/dbmanager.php";

    // Queries dashboard card data for display on page
    require_once "ctl/dashboardcards.php";

    // Queries dashboard pie chart data for display on page
    require_once "ctl/dashboardpie.php";

    // Queries dashboard pie chart data for display on page
    require_once "ctl/dashboardbar.php";
   
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Murray">

    <meta charset="UTF-8">
    <title>CreditWatch - Fraud Dashboard</title>
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">

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
              <a href="#" class="nav-link active">
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
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="reset-password.php">Change Password</a></li>
              <li><a class="dropdown-item" href="contact.php">Customer Support</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
            </ul>
          </div>
        </div>
      </nav>

        <div class="container rounded bg-white mt-5 mb-5">
          <div class="col-md">
            <div class="pt-5">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h2 class="mb-0 text-black">Fraud Dashboard</h2>
                    <a href="eventdrilldown.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-circle-info fa-sm text-white-50"></i> Fraud Event Drilldown</a>                    
                </div>

                <div class="row">

                    <!-- total fraud found for account -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Fraud</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalfraud; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- total fraud within the last month -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Monthly Fraud</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $monthlyfraud; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- percentage of fraud against number of records checked -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Percent Fraud
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $percentfraudint; ?>%</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                        style="width: <?php echo $percentfraudint; ?>%" aria-valuenow="<?php echo $percentfraudint; ?>" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- total number of transactions checked for fraud -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Transactions Checked</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totaltransactions; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">

                        <!-- Bar Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Fraud Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="myBarChart" width="667" height="320" style="display: block; width: 667px; height: 320px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Fraud Sources</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="myPieChart" width="301" height="245" style="display: block; width: 301px; height: 245px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Amount
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Date or Time
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Geolocation
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

              </div>
            </div>
          </div>

      </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>

    <script src="js/chart.js"></script>
    <script src="js/chart-bar.js"></script>
    <script src="js/chart-pie.js"></script>

    <script src="js/sbadmin2.js"></script>
    
    <script src="js/jquery-easing.js"></script>
    <script src="js/jquery-min.js"></script>

</body>
</html>
