<?php

    // Preparing to collect dashboard bar chart data
    $usersid = $_SESSION["id"];

    // epoch variables for queries
	$currentmonthend = mktime(23, 59, 59, date("n"), date("t"));
	$currentmonthstart = mktime(0, 0, 0, date("n"), 1);
	$prev1monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-1 month")), 1);
	$prev2monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-2 month")), 1);
	$prev3monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-3 month")), 1);
	$prev4monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-4 month")), 1);
	$prev5monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-5 month")), 1);
	$prev6monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-6 month")), 1);
	$prev7monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-7 month")), 1);
	$prev8monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-8 month")), 1);
	$prev9monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-9 month")), 1);
	$prev10monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-10 month")), 1);
	$prev11monthstart = 	mktime(0, 0, 0, date("n",  strtotime("-11 month")), 1);

	// Month name variables for dynamic table
    $currentmonth = date('F');
    $prev1month = date('F', strtotime("-1 month"));
    $prev2month = date('F', strtotime("-2 month"));
    $prev3month = date('F', strtotime("-3 month"));
    $prev4month = date('F', strtotime("-4 month"));
    $prev5month = date('F', strtotime("-5 month"));
    $prev6month = date('F', strtotime("-6 month"));
    $prev7month = date('F', strtotime("-7 month"));
    $prev8month = date('F', strtotime("-8 month"));
    $prev9month = date('F', strtotime("-9 month"));
    $prev10month = date('F', strtotime("-10 month"));
    $prev11month = date('F', strtotime("-11 month"));

    // Current month fraud total for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $currentmonthstart and tx_timedate <= $currentmonthend");
    $currmonthfraud = mysqli_fetch_assoc($result);
    $currmonthlyfraud = $currmonthfraud['total'];

    // Previous month fraud total for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev1monthstart and tx_timedate <= $currentmonthstart");
    $prev1monthfraud = mysqli_fetch_assoc($result);
    $prev1monthlyfraud = $prev1monthfraud['total'];

    // Previous fraud total from 2 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev2monthstart and tx_timedate <= $prev1monthstart");
    $prev2monthfraud = mysqli_fetch_assoc($result);
    $prev2monthlyfraud = $prev2monthfraud['total'];

    // Previous fraud total from 3 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev3monthstart and tx_timedate <= $prev2monthstart");
    $prev3monthfraud = mysqli_fetch_assoc($result);
    $prev3monthlyfraud = $prev3monthfraud['total'];

    // Previous fraud total from 4 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev4monthstart and tx_timedate <= $prev3monthstart");
    $prev4monthfraud = mysqli_fetch_assoc($result);
    $prev4monthlyfraud = $prev4monthfraud['total'];

    // Previous fraud total from 5 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev5monthstart and tx_timedate <= $prev4monthstart");
    $prev5monthfraud = mysqli_fetch_assoc($result);
    $prev5monthlyfraud = $prev5monthfraud['total'];

    // Previous fraud total from 6 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev6monthstart and tx_timedate <= $prev5monthstart");
    $prev6monthfraud = mysqli_fetch_assoc($result);
    $prev6monthlyfraud = $prev6monthfraud['total'];

    // Previous fraud total from 7 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev7monthstart and tx_timedate <= $prev6monthstart");
    $prev7monthfraud = mysqli_fetch_assoc($result);
    $prev7monthlyfraud = $prev7monthfraud['total'];

    // Previous fraud total from 8 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev8monthstart and tx_timedate <= $prev7monthstart");
    $prev8monthfraud = mysqli_fetch_assoc($result);
    $prev8monthlyfraud = $prev8monthfraud['total'];

    // Previous fraud total from 9 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev9monthstart and tx_timedate <= $prev8monthstart");
    $prev9monthfraud = mysqli_fetch_assoc($result);
    $prev9monthlyfraud = $prev9monthfraud['total'];

    // Previous fraud total from 10 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev10monthstart and tx_timedate <= $prev9monthstart");
    $prev10monthfraud = mysqli_fetch_assoc($result);
    $prev10monthlyfraud = $prev10monthfraud['total'];

    // Previous fraud total from 11 months ago for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where 
    	users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prev11monthstart and tx_timedate <= $prev10monthstart");
    $prev11monthfraud = mysqli_fetch_assoc($result);
    $prev11monthlyfraud = $prev11monthfraud['total'];

    $yaxismax = max($currmonthlyfraud, $prev1monthlyfraud, $prev2monthlyfraud, $prev3monthlyfraud, $prev4monthlyfraud, $prev5monthlyfraud, 
    				$prev6monthlyfraud, $prev7monthlyfraud, $prev8monthlyfraud, $prev9monthlyfraud, $prev10monthlyfraud, $prev11monthlyfraud)

?>

<script>
	// Populate JavaScript bar chart fraud values for the year from PHP SQL queries
    var currmonthval = <?php echo json_encode($currmonthlyfraud, JSON_HEX_TAG); ?>;
    var prev1monthval = <?php echo json_encode($prev1monthlyfraud, JSON_HEX_TAG); ?>;
    var prev2monthval = <?php echo json_encode($prev2monthlyfraud, JSON_HEX_TAG); ?>;
    var prev3monthval = <?php echo json_encode($prev3monthlyfraud, JSON_HEX_TAG); ?>;
    var prev4monthval = <?php echo json_encode($prev4monthlyfraud, JSON_HEX_TAG); ?>;
    var prev5monthval = <?php echo json_encode($prev5monthlyfraud, JSON_HEX_TAG); ?>;
    var prev6monthval = <?php echo json_encode($prev6monthlyfraud, JSON_HEX_TAG); ?>;
    var prev7monthval = <?php echo json_encode($prev7monthlyfraud, JSON_HEX_TAG); ?>;
    var prev8monthval = <?php echo json_encode($prev8monthlyfraud, JSON_HEX_TAG); ?>;
    var prev9monthval = <?php echo json_encode($prev9monthlyfraud, JSON_HEX_TAG); ?>;
    var prev10monthval = <?php echo json_encode($prev10monthlyfraud, JSON_HEX_TAG); ?>;
    var prev11monthval = <?php echo json_encode($prev11monthlyfraud, JSON_HEX_TAG); ?>;

	// Populate JavaScript bar month names for the year from PHP SQL queries
    var currmonthname = <?php echo json_encode($currentmonth, JSON_HEX_TAG); ?>;
    var prev1monthname = <?php echo json_encode($prev1month, JSON_HEX_TAG); ?>;
    var prev2monthname = <?php echo json_encode($prev2month, JSON_HEX_TAG); ?>;
    var prev3monthname = <?php echo json_encode($prev3month, JSON_HEX_TAG); ?>;
    var prev4monthname = <?php echo json_encode($prev4month, JSON_HEX_TAG); ?>;
    var prev5monthname = <?php echo json_encode($prev5month, JSON_HEX_TAG); ?>;
    var prev6monthname = <?php echo json_encode($prev6month, JSON_HEX_TAG); ?>;
    var prev7monthname = <?php echo json_encode($prev7month, JSON_HEX_TAG); ?>;
    var prev8monthname = <?php echo json_encode($prev8month, JSON_HEX_TAG); ?>;
    var prev9monthname = <?php echo json_encode($prev9month, JSON_HEX_TAG); ?>;
    var prev10monthname = <?php echo json_encode($prev10month, JSON_HEX_TAG); ?>;
    var prev11monthname = <?php echo json_encode($prev11month, JSON_HEX_TAG); ?>;

    // Variable to set the y-axis max on bar chart
    var baryaxismax = <?php echo json_encode($yaxismax, JSON_HEX_TAG); ?>;

    //document.write(currmonthval, ", ", currmonthname, ", ", baryaxismax);
</script>
