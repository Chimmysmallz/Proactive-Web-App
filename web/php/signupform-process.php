<?php
include 'db_connect.php';
$errorMSG = "";

if (empty($_POST["email"])) {
    $errorMSG = "Email is required ";
} else {
    $email = $_POST["email"];
}

if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

if (empty($_POST["password"])) {
    $errorMSG = "Password is required ";
} else {
    $password = $_POST["password"];
}

if (empty($_POST["terms"])) {
    $errorMSG = "Terms is required ";
} else {
    $terms = $_POST["terms"];
}

if(empty($errorMSG)) {
    $query = "INSERT INTO Users (name, email, password) VALUES ('$name', '$email', '$password')";
    $result = mysqli_query($connection, $query);

    if($result) {
        header('Location: login.php');
    } else {
        $errorMSG = "Error inserting user details.";
    }
}

// redirect to signup page with error message
if(!empty($errorMSG)) {
    header('Location: signup.php?error=' . urlencode($errorMSG));
}
?>
