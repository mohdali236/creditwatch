<?php

    // Preparing to collect dashboard pie chart data
    $usersid = $_SESSION["id"];

    // Total datetime fraud for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where users_id = $usersid and fraud_type in ('1','3','5','7')");
    $totdatetime = mysqli_fetch_assoc($result);
    $totaldatetime = $totdatetime['total'];


    // Total amount fraud for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where users_id = $usersid and fraud_type in ('2','3','6','7')");
    $totamount = mysqli_fetch_assoc($result);
    $totalamount = $totamount['total'];


    // Total geolocation fraud for user
    $result = mysqli_query($link, "SELECT count(*) as total from frauddata where users_id = $usersid and fraud_type in ('4','5','6','7')");
    $totgeoloc = mysqli_fetch_assoc($result);
    $totalgeoloc = $totgeoloc['total'];

?>

<script>
	// Populate datetime fraud total JS var from php SQL query
    var datetime = <?php echo json_encode($totaldatetime, JSON_HEX_TAG); ?>;
	// Populate amount fraud total JS var from php SQL query
    var amount = <?php echo json_encode($totalamount, JSON_HEX_TAG); ?>;
	// Populate geolocation fraud total JS var from php SQL query
    var geoloc = <?php echo json_encode($totalgeoloc, JSON_HEX_TAG); ?>;

    //document.write(datetime, ", ", amount, ", ", geoloc);
</script>
