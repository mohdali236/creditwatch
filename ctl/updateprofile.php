<?php


/*    // Check input errors before updating the database
    if(!empty($name) || !empty($surname) || !empty($phone) || !empty($address1) || !empty($address2) || !empty($zipcode) || !empty($city) || !empty($state) || !empty($country)){
        // Prepare an update statement
        $sql = "UPDATE contact SET name = ?, surname = ?, phone = ?, address1 = ?, address2 = ?, zipcode = ?, city = ?, state = ?, country = ? WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssissss", $param_name, $param_surname, $param_phone, $param_address1, $param_address2, $param_zipcode, $param_city, $param_state, $param_country, $param_username);
            
            // Set parameters
            $param_name = $name;
            $param_surname = $surname;
            $param_phone = $phone;
            $param_address1 = $address1;
            $param_address2 = $address2;
            $param_zipcode = $zipcode;
            $param_city = $city; 
            $param_state = $state;
            $param_country = $country;
            $param_username = $_SESSION["username"];
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                if(!empty($email)){
                    // Prepare an update statement
                    $sql2 = "UPDATE users SET email = ? WHERE id = ?";
                    
                    if($stmt2 = mysqli_prepare($link, $sql2)){
                        
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt2, "si", $email, $id);

                        if(mysqli_stmt_execute($stmt2)){
                            echo "Profile details updated successfully!";
                        }
                    }
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
 */

    // UPDATES USER PROFILE DETAIL FIELDS THAT ARE POPULATED
 
    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $phone = trim($_POST["phone"]);
    $address1 = trim($_POST["address1"]);
    $address2 = trim($_POST["address2"]);
    $zipcode = trim($_POST["zipcode"]);
    $city = trim($_POST["city"]);
    $state = trim($_POST["state"]);
    $country = trim($_POST["country"]);
    $email = trim($_POST["email"]);
    $username = $_SESSION["username"];
    $id = $_SESSION["id"];
    $failed = 0;

    if(!empty($name)){
        $sql = "UPDATE contact SET name = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $name, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Name, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($surname)){
        $sql = "UPDATE contact SET surname = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $surname, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Surname, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($phone)){
        $sql = "UPDATE contact SET phone = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $phone, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Phone, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($address1)){
        $sql = "UPDATE contact SET address1 = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $address1, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Address1, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($address2)){
        $sql = "UPDATE contact SET address2 = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $address2, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Address2, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($zipcode)){
        $sql = "UPDATE contact SET zipcode = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "is", $zipcode, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "ZipCode, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($city)){
        $sql = "UPDATE contact SET city = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $city, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "City, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($state)){
        $sql = "UPDATE contact SET state = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $state, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "State, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($country)){
        $sql = "UPDATE contact SET country = ? WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $country, $username);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Country, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

    if(!empty($email)){
        $sql = "UPDATE users SET email = ? WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $email, $id);
            if(mysqli_stmt_execute($stmt)){
                $result .= "Email, ";
                mysqli_stmt_close($stmt);
            } else { $failed = 1; }
        }
    }

$result .= "updated successfully.";

if($failed == 1){
    $result = "Oops! Something went wrong. Please try again later.";
}
    
?>