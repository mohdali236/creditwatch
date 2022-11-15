<?php

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, if not then redirect him to login page
    require_once "ctl/logincheck.php";

    // Start the database manger
    require_once "ctl/dbmanager.php";

    // Users ID param
    $param_uid = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="David Murray">

    <meta charset="UTF-8">
    <title>CreditWatch - Fraud Event Drilldown</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>


<div class="col-md-9">
    <div class="ms-5">
        <br><a href="javascript:history.go(-1)" title="Return to the previous page">« Go back</a>
    </div>
</div>

<div class="container rounded bg-white">
    <div class="col-md-9">

        <!-- Export link -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0 text-black">Fraud Event Drilldown</h2>
            <a href="eventdrilldown.php" class="d-none d-sm-inline-block btn btn-success"><i class="dwn"></i> Export</a>                    
        </div>

        <!-- Query and display fraud event data -->
        <?php

        if ($link === false) {
                die("ERROR: Could not connect. "
                                        .mysqli_connect_error());
        }

        $sql = "SELECT * FROM frauddata where users_id = $param_uid";
        if ($res = mysqli_query($link, $sql)) {
                if (mysqli_num_rows($res) > 0) {
                        echo "<table class=\"table\">";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th scope=\"col\">Customer ID</th>";
                        echo "<th scope=\"col\">TransID</th>";
                        echo "<th scope=\"col\">TransDateTime</th>";
                        echo "<th scope=\"col\">IsFraud?</th>";
                        echo "<th scope=\"col\">FraudType</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($res)) {
                                echo "<tr>";
                                echo "<td>".$row['customer_id']."</td>";
                                echo "<td>".$row['transaction_id']."</td>";
                                echo "<td>".$row['tx_timedate']."</td>";
                                $fraud_detected = ($row['tx_fraud'] == 1)?'true':'false';
                                echo "<td>".$fraud_detected."</td>";
                                echo "<td>".$row['fraud_type']."</td>";
                                echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        mysqli_free_result($res);
                }
                else {
                        echo "No matching records are found.";
                }
        }
        else {
                echo "ERROR: Could not able to execute $sql. "
                                                                        .mysqli_error($mysqli);
        }
        mysqli_close($mysqli);

        ?>

    </div>
</div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>