<?php 

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, if not then redirect them to the login page
    require_once "logincheck.php";

    // Start the database manger
    require_once "dbmanager.php";

    // Prepare an insert statement
    $sql = "INSERT INTO payments (users_id, customer_amt, item_price, payment_status) VALUES (?, ?, ?, ?)";


    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iids", $param_uid, $param_cust_num, $param_price, $param_status);
      
        // Set parameters
        $param_uid = $_SESSION['id'];
        $param_cust_num = $_GET['cust_num'];
        $param_price = 2.99;
        $param_status = "Pending";
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){

            // Generate successfull activation notification
            $notfication_username = $_SESSION['username'];
            $notfication_message = "Successfully activated " . $param_cust_num . " accounts at " . date("F j, Y, g:i a") . ".";
            require_once "generatenotification.php";

            // Successful activation response
            echo '<br><p>Successfully activated services for ' . $param_cust_num . ' customers.</p>';
            echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">« Go back</a></p>';

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

?>