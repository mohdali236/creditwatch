 <?php
        
        // Validate name
        if(empty(trim($_POST["name"]))){ $name_err = "Please enter an first name."; } else { $name = trim($_POST["name"]); }

        // Validate surname
        if(empty(trim($_POST["surname"]))){ $surname_err = "Please enter an last name."; } else { $surname = trim($_POST["surname"]); }

        // Validate email
        if(empty(trim($_POST["email"]))){ $email_err = "Please enter an email."; } 
            elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){ $email_err = "Invalid email format."; } 
            else{ $email = trim($_POST["email"]); }

        // Validate address
        if(empty(trim($_POST["address1"]))){ $address1_err = "Please enter an address."; } else { $address1 = trim($_POST["address1"]); }

        // Validate city
        if(empty(trim($_POST["city"]))){ $city_err = "Please enter a city."; } else { $city = trim($_POST["city"]); }

        // Validate state
        if(empty(trim($_POST["state"]))){ $state_err = "Please enter a state."; } else { $state = trim($_POST["state"]); }

        // Validate zip
        if(empty(trim($_POST["zip"]))){ $zip_err = "Please enter a zip code."; } else { $zip = trim($_POST["zip"]); }

        // Validate country
        if(empty(trim($_POST["country"]))){ $country_err = "Please enter a country."; } else { $country = trim($_POST["country"]); }

        // Validate credit card number
        if(empty(trim($_POST["cc_num"]))){ $cc_num_err = "Please enter a credit card number."; } else { $cc_num = trim($_POST["cc_num"]); }

        // Validate credit card expiration month
        if(empty(trim($_POST["cc_month"]))){ $cc_month_err = "Please enter a credit card expiration month."; } else { $cc_month = trim($_POST["cc_month"]); }

        // Validate credit card expiration year
        if(empty(trim($_POST["cc_year"]))){ $cc_year_err = "Please enter a credit card expiration year."; } else { $cc_year = trim($_POST["cc_year"]); }

        // Validate credit card ccv
        if(empty(trim($_POST["cc_cvv"]))){ $cc_cvv_err = "Please enter an first name."; } else { $cc_cvv = trim($_POST["cc_cvv"]); }

        // Check input errors before inserting in database
        if(empty($name_err) && empty($surname_err) && empty($email_err) && empty($address1_err) && empty($city_err) && empty($state_err) && 
            empty($zip_err) && empty($country_err) && empty($cc_num_err) && empty($cc_month_err) && empty($cc_year_err) && empty($cc_cvv_err)){
            
            // Prepare an update statement
            $sql = "UPDATE payments SET name = ?, surname = ?, email = ?, address1 = ?, address2 = ?, city = ?, state = ?, zip = ?, country = ?, card_num = ?, card_cvc = ?, card_exp_month = ?, card_exp_year = ?, payment_status = ? WHERE users_id = ? and payment_status = ?";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssssisiiiisis", $param_name, $param_surname, $param_email, $param_address1, $param_address2, $param_city, $param_state, $param_zip, $param_country, $param_cc_num, $param_cc_cvv, $param_cc_month, $param_cc_year, $param_status, $param_uid, $param_curr_status);
              
                // Set parameters
                $param_name = $name;
                $param_surname = $surname;
                $param_email = $email;
                $param_address1 = $address1;
                $param_address2 = trim($_POST["address2"]);
                $param_city = $city;
                $param_state = $state;
                $param_zip = $zip;
                $param_country = $country;
                $param_cc_num = $cc_num;
                $param_cc_cvv = $cc_cvv;
                $param_cc_month = $cc_month;
                $param_cc_year = $cc_year;
                $param_status = "Paid";
                $param_curr_status = "Pending";
                $param_uid = $_SESSION['id'];

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Update payment amount due and due date for display
                    $totaldue = 0;
                    $finaldatedue = 'None';
                    
                    // response if payment is successful
                    $result = "Payment was successful!";
                } else{
                    $result = "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
            
        } else {
            $result = "Oops! Something went wrong here. Please try again later.";
        }
        
        // Close database manager connection
        mysqli_close($link);

?>