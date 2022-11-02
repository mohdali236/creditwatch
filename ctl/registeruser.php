<?php
        
        // REGISTERS A NEW USER FOR CREDITWATCH

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, email, sec_question, sec_answer) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_email, $sec_question, $sec_answer);
          
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_sec_question = $sec_question;
            $param_sec_answer = $sec_answer;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                // Prepare an insert statement to create user's row in the contact table
                $sql_contact = "INSERT INTO contact (username) VALUES (?)";
                if($stmt2 = mysqli_prepare($link, $sql_contact)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt2, "s", $param_username);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt2)){

                        // Redirect after successful registration
                        header("location: login.php");
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);
        }

?>