<?php

// Set database credentials

$db_host = "localhost";

$db_user = "proactive_user";

$db_pass = "password";

$db_name = "proactive";

// Establish database connection

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}

?>

