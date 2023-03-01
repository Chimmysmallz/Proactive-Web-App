<?php

// start the session

session_start();

// check if user is logged in

if (!isset($_SESSION['username'])) {

    // redirect to login page

    header("Location: login.php");

    exit();

}

// check if project ID is set

if (!isset($_GET['id'])) {

    // redirect to projects page

    header("Location: projects.php");

    exit();

}

// get the project ID from the URL

$id = $_GET['id'];

// connect to the database

$servername = "localhost";

$username = "username";

$password = "password";

$dbname = "database_name";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}

// prepare and execute SQL statement to delete the project with the specified ID

$sql = "DELETE FROM projects WHERE id = $id";

if (mysqli_query($conn, $sql)) {

    // redirect to projects page

    header("Location: projects.php");

} else {

    echo "Error deleting project: " . mysqli_error($conn);

}

// close the database connection

mysqli_close($conn);

?>

