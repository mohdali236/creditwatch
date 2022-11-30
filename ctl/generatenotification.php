<?php

    // Controller for generating new notifications

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