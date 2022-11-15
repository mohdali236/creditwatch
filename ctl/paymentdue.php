 <?php

    // Users ID param
    $param_uid = $_SESSION['id'];
        
    // Get payment amount due for display
    $query_tot = mysqli_query($link, "SELECT SUM(customer_amt) as total FROM payments WHERE users_id = $param_uid and payment_status = 'Pending'");
    $totcust = mysqli_fetch_assoc($query_tot);
    $totalcust = $totcust['total'];
    $totaldue = $totalcust * 2.99; // calculate total due from number of customers activated

?>