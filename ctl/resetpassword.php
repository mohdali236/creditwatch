<?php

    // UPDATES USER PASSWORD FOR THE RESET PASSWORD PAGE

    // Prepare a select statement
    $sql = "SELECT sec_answer FROM users WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_id);
        
        // Set parameters
        $param_id = $_SESSION["id"];
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $sec_answer_chk);
            mysqli_stmt_fetch($stmt);

            // Check if security answer matches
            if($sec_answer == $sec_answer_chk){

                // Close previous statement
                mysqli_stmt_close($stmt);

                // Prepare an update statement
                $sql = "UPDATE users SET password = ? WHERE id = ?";
                
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
                    
                    // Set parameters
                    $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $param_id = $_SESSION["id"];
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        
                        // Password updated successfully. Destroy the session, and redirect to login page
                        session_destroy();
                        header("location: login.php");
                        exit();
                    } else{
                        echo "Oops! Something went wrong updating the password. Please try again later.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

?>