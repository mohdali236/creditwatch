<?php
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: https://www.ohmydar.win/creditwatch/welcome.php");
    exit;
}

?>