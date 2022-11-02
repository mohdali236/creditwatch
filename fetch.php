<?php
// Include the database connection file
include_once("ctl/dbmanager.php");

if ($link === false) {
        die("ERROR: Could not connect. "
                                .mysqli_connect_error());
}

$sql = "SELECT * FROM users";
if ($res = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($res) > 0) {
                echo "<table>";
                echo "<tr>";
		echo "<th>id</th>";
                echo "<th>username</th>";
                echo "<th>password</th>";
                echo "<th>email</th>";
		echo "<th>created_at</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['password']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['created_at']."</td>";
                        echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($res);
        }
        else {
                echo "No matching records are found.";
        }
}
else {
        echo "ERROR: Could not able to execute $sql. "
                                                                .mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>

