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

// Define the email and password values for the new user
$email = 'chidexnwabulue@gmail.com';
$password = 'password';

// SQL query to insert the new user into the Users table
$sql = "INSERT INTO Users (email, password) VALUES ('$email', '$password')";

// Execute the query and check for errors
if (mysqli_query($conn, $sql)) {
    echo "New user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

?>
