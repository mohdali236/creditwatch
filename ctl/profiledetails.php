<?php

    // Pull current profile details
    $param_username = $_SESSION['username'];

    $stmt = $link->prepare('SELECT name, surname, phone, address1, address2, zipcode, city, state, country FROM contact WHERE username = ?');
    $stmt->bind_param('s', $param_username);
    $stmt->execute();
    $stmt->bind_result($name, $surname, $phone, $address1, $address2, $zipcode, $city, $state, $country);
    $stmt->fetch();
    $stmt->close();    

    $stmt = $link->prepare('SELECT email FROM users WHERE username = ?');
    $stmt->bind_param('s', $param_username);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

?>