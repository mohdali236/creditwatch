<?php

    // Validate email controller

    // exploding email for later MX check
    $emailArray = explode("@", trim($_POST["email"]));

    if(empty(trim($_POST["email"]))){ // is email empty?
        $email_err = "Please enter an email.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){ // simple PHP email format validation
        $email_err = "Invalid email format.";
    } elseif (!checkdnsrr(array_pop($emailArray), "MX")) { // checks that domain actually exists per TA suggestion
        $email_err = "Invalid email domain.";
    } else{
        $email = trim($_POST["email"]);
    }

?>