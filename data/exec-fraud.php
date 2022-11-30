<?php

    // Fraud counter for notification
    $counter = 0;

	// Run fraudDetect script on remote server
	$fraudDetect = shell_exec("data/fraudDetect.sh");

	// Split up fraudDetect output into array
	$data = str_getcsv($fraudDetect);

	// Variables needed for database inserts
	$usersid = $_SESSION["id"];
	$sql = 'INSERT INTO frauddata (users_id, customer_id , transaction_id, tx_timedate, tx_fraud, fraud_type) VALUES (?, ?, ?, ?, ?, ?)';

	// Prepare statement and link with DBManager connection
	if($stmt = mysqli_prepare($link, $sql)){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iiiiii", $param_uid, $param_cid, $param_tid, $param_time, $param_isfraud, $param_fraudtype);
    }

	// Break up data into array into csv rows with 5 columns
	foreach (array_chunk($data, 5) as $row) {

        // Set parameters
        $param_uid = $usersid;
        $param_cid = $row[0];
        $param_tid = $row[1];  // this is the primary key for frauddata DB table, thus no duplicates will be inserted
        $param_time = $row[2];
        $param_isfraud = $row[3];
        $param_fraudtype = $row[4];

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        if($param_isfraud){
        	$counter++;
        }

	}

    // Close statement
    mysqli_stmt_close($stmt);

    // Generate notification for successful processing of transaction data
    $notfication_username = $_SESSION['username'];
    $notfication_message = "Fraud detection processing completed at " . date("F j, Y, g:i a") . ", and it found " . $counter . " fraudulent transactions.";
    
    // Prepare an insert statement
    $notifsql = "INSERT INTO notifications (username, message) VALUES (?, ?)";

    if($notifstmt = mysqli_prepare($link, $notifsql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($notifstmt, "ss", $param_username, $param_message);
      
        // Set parameters
        $param_username = $notfication_username;
        $param_message = $notfication_message;
        
        // Execute the prepared statement
        mysqli_stmt_execute($notifstmt);

        // Close statement
        mysqli_stmt_close($notifstmt);
    }

?>