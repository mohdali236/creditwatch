<?php

    // COLLECTS USER SECURITY QUESTION

    // Prepare a select statement
    $sql = "SELECT sec_question FROM users WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $_SESSION["id"];
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store results
            mysqli_stmt_store_result($stmt);
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $sec_question);
            mysqli_stmt_fetch($stmt);

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

?>