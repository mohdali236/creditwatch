<?php

      // PROCESSES CONTACT US REQUEST -- EMAIL NOT IMPLEMENTED

      // Prepare an insert statement
      $sql = "INSERT INTO contactus (name, email, message) VALUES (?, ?, ?)";
       
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_message);
        
          // Set parameters
          $param_name = $name;
          $param_email = $email;
          $param_message = $message;
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
            $result = "Your message was sent, thank you!";

          } else{
            $result = "Oops! Something went wrong. Please try again later.";
          }

          // Close statement
          mysqli_stmt_close($stmt);
      }

?>