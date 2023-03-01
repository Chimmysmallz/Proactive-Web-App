<?php

// Set database credentials

$db_host = "localhost";

$db_user = "username";

$db_pass = "password";

$db_name = "database_name";

// Establish database connection

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}

?>

