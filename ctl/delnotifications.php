<?php

// Check if dbmanager is open
if ($link === false) {
        die("ERROR: Could not connect. ".mysqli_connect_error());
}

// Configuring parameters and SQL query
$param_username = $_SESSION['username'];
$param_notif_id = $notif_id;
$sql = "UPDATE notifications SET is_deleted = 1 WHERE username = '$param_username' AND notif_id = $notif_id";

// Update notification deleted status but does not actually delete anything
if (mysqli_query($link, $sql)) {
        $result = "Deleted notification with ID of ".$param_notif_id." for user ".$param_username.".";
}
else {
        $result = "ERROR: Could not able to execute $sql. ".mysqli_error($link);
}

?>

