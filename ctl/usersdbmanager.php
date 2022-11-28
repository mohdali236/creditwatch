<?php
/* Database credentials. Assuming you are running MySQL
server with default setting. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ohmydarw_endusertest');
define('DB_PASSWORD', '3ndU5er.4u!');
define('DB_NAME', 'ohmydarw_creditwatch_userdb');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Fix for redirect error with output buffering
ob_start();

?>

