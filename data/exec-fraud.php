<?php

    // Initialize the session
    //session_start();
     
    // Check if the user is logged in, otherwise redirect to login page
    //require_once "../ctl/logincheck.php";

	// Start the database manger
    require_once "ctl/dbmanager.php";

	// Run fraudDetect script on remote server
	$fraudDetect = shell_exec("data/fraudDetect.sh");
	
	//echo $fraudDetect;

	//echo "<br>";
	//echo "<br>";

	$data = str_getcsv($fraudDetect);

	//var_dump($data);

	//echo "<br>";
	//echo "<br>";

	$usersid = $_SESSION["id"];

	$sql = 'INSERT INTO frauddata (users_id, customer_id , transaction_id, tx_timedate, tx_fraud, fraud_type) VALUES (?, ?, ?, ?, ?, ?)';

	// Prepare statement and link with DBManager connection
	if($stmt = mysqli_prepare($link, $sql)){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iiiiii", $param_uid, $param_cid, $param_tid, $param_time, $param_isfraud, $param_fraudtype);
    }


	// Break up data into csv rows
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

        /*if(mysqli_stmt_execute($stmt)){

        	echo "execute completed";
        	echo "<br>";

        } else { 
			printf("Query error #%d: %s.\n", mysqli_stmt_errno($stmt), mysqli_stmt_error($stmt));
        	echo "<br>";
        }*/

	}

    // Close statement
    mysqli_stmt_close($stmt);

?>