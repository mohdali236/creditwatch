<?php

    // Preparing to collect dashboard card data
    $usersid = $_SESSION["id"];
    $currentDate =  time();
    $prevmonth = strtotime(date("Y-m-d H:i:s", $currentDate) . " -1 month"); // subtract 1 month

    // Total fraud for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where users_id = $usersid and tx_fraud = '1'");
    $totfraud = mysqli_fetch_assoc($result);
    $totalfraud = $totfraud['total'];

    // Previous monthy fraud total for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where users_id = $usersid and tx_fraud = '1' and tx_timedate >= $prevmonth");
    $monthfraud = mysqli_fetch_assoc($result);
    $monthlyfraud = $monthfraud['total'];

    // Total transactions for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where users_id = $usersid");
    $totaltx = mysqli_fetch_assoc($result);
    $totaltransactions = $totaltx['total'];

    // Check to ensure no dividing by 0 errors occur
    if($totalfraud != 0 && $totaltransactions != 0 ){
	    // Total percent fraud for user
	    $percentfraud = ($totalfraud / $totaltransactions) * 100;
	    $percentfraudint = number_format($percentfraud);
	} else { $percentfraudint = 0; }

?>