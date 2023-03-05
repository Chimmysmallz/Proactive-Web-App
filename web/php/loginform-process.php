<?php
session_start();
include 'db_connect.php';
$errorMSG = "";

if (empty($_POST["email"])) {
    $errorMSG = "Email is required ";
} else {
    $email = $_POST["email"];
}

if (empty($_POST["password"])) {
    $errorMSG = "Password is required ";
} else {
    $password = $_POST["password"];
}

if(empty($errorMSG)) {
    $query = "SELECT * FROM Users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['email'] = $email;
        header('Location: dashboard.php');
    } else {
        $errorMSG = "Invalid login credentials.";
    }
}

// redirect to login page with error message
if(!empty($errorMSG)) {
    header('Location: login.php?error=' . urlencode($errorMSG));
}
?>
