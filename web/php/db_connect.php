<?php

// include queries.php
require_once 'queries.php';

// Set database credentials

$db_host = "localhost";

$db_user = "proactive_user";

$db_pass = "password";

$db_name = "proactive";

// Establish database connection

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors

if (!$conn) {

    if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// example usage of SQL queries
$email = 'example@example.com';
$stmt = $mysqli->prepare(QUERY_GET_USER_BY_EMAIL);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$name = 'Example Project';
$user_id = $user['id'];
$project_id = insert_project($name, $user_id);

?>
