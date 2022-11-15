<?php 

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
require_once "logincheck.php";

// Start the database manger
require_once "dbmanager.php";

// Users ID param
$param_uid = $_SESSION['id'];
 
// Fetch records from database 
//$query = $link->query("SELECT * FROM frauddata where users_id = $param_uid ORDER BY tx_timedate ASC"); 

$sql = "SELECT * FROM frauddata where users_id = $param_uid ORDER BY tx_timedate ASC";
$query = mysqli_query($link, $sql);

 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "creditwatch-fraud-data_" . date('Y-m-d-H-i-s') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('CUSTOMER_ID', 'TRANSACTION_ID', 'TX_DATETIME', 'IS_FRAUD', 'FRAUD_TYPE'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $fraud_detected = ($row['tx_fraud'] == 1)?'true':'false';
        $lineData = array($row['customer_id'], $row['transaction_id'], $row['tx_timedate'], $fraud_detected, $row['fraud_type']);
        fputcsv($f, $lineData, $delimiter);
    } 
     
    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

    //output all remaining data on a file pointer
    fpassthru($f);
} 
exit;
 
?>