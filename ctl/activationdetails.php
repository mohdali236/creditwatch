<?php

    // Preparing to collect dashboard card data
    $usersid = $_SESSION["id"];

    // Total number of accounts activated
    $result = mysqli_query($link, "SELECT SUM(customer_amt) as total from payments where users_id = $usersid and payment_status = 'Paid'");
    $totact = mysqli_fetch_assoc($result);
    $totalactivated = $totact['total'];

    // Total number of accounts monitored
    $result = mysqli_query($link, "SELECT COUNT(DISTINCT(customer_id)) as total from frauddata where users_id = $usersid");
    $totmon = mysqli_fetch_assoc($result);
    $totalmonitored = $totmon['total'];

?>