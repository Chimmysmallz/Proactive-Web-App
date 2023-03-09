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

define('QUERY_GET_USER_BY_EMAIL', 'SELECT * FROM Users WHERE email = ?');

function checkUserLogin($email, $password) {
  global $conn;
  // prepare SQL statement
  $stmt = $conn->prepare("SELECT id FROM Users WHERE email = ? AND password = ?");

  // bind parameters
  $stmt->bind_param("ss", $email, $password);

  // execute statement
  $stmt->execute();

  // bind result variables
  $stmt->bind_result($id);

  // fetch value
  $stmt->fetch();

  // close statement and connection
  $stmt->close();

  // return user id or false if no user found
  if ($id) {
    return $id;
  } else {
    return false;
  }
}

// example usage of SQL queries
$email = 'example@example.com';
$stmt = $conn->prepare(QUERY_GET_USER_BY_EMAIL);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$name = 'Example Project';
$user_id = $user['id'];
$project_id = insert_project($name, $user_id);

?>
