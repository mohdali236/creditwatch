 <?php

    // Users ID param
    $param_uid = $_SESSION['id'];
        
    // Get payment due date for display
    $query_date = mysqli_query($link, "SELECT created FROM payments WHERE users_id = $param_uid and payment_status = 'Pending' ORDER BY created DESC LIMIT 1");
    $date = mysqli_fetch_assoc($query_date);
    //$datedue = $date['created'];
    //$finaldatedue = strtotime("+1 month", strtotime($datedue)); // adds 1 month for payment due date onto most recent activation date

   if (strtotime($date['created']) > 0) {

      // Adds 1 month onto most recent activation date if date is not epoch of 0
      $datedue = $date['created'];
      $finaldatedue = date('F j, Y, g:i a', strtotime("+1 month", strtotime($datedue))); // adds 1 month for payment due date onto most recent activation date

    } else {

      // No due date found because epoch result is 0
      $finaldatedue = 'None';

    }

?>