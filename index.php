<?php

    //DEFAULT PAGE IN CASE .htaccess DEFAULT DOES NOT WORK AS EXPECTED

    // Initialize the session
    session_start();
     
    // Check if the user is logged in, if not then redirect him to login page
    require_once "ctl/logincheck.php";

?>