<?php

// Check if dbmanager is open
if ($link === false) {
        die("ERROR: Could not connect. ".mysqli_connect_error());
}

// Configuring parameters and SQL query
$param_username = $_SESSION['username'];
$sql = "SELECT * FROM notifications WHERE username = '$param_username' AND is_deleted = 0";

// Run fetch query and display results
if ($res = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_array($res)) {
                        echo '<div class="col-xl-10 col-lg-10">';
                        echo '<div class="card shadow mb-4">';
                        echo '<div class="card-body">';
                        echo '<a href="?notif_id='.$row['notif_id'].'"><i class="fas fa-trash-can fa-sm icon-red"></i></a>';
                        echo '&nbsp;&nbsp;'.$row['message'];
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                }
                mysqli_free_result($res);
        }
        else {
                echo "No matching records are found.";
        }
}
else {
        echo "ERROR: Could not able to execute $sql. ".mysqli_error($link);
}

mysqli_close($link);
?>

