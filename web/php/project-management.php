<?php
    require_once(db_connect.php);
?>

// Check for connection errors
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submissions
if (isset($_POST['create_project'])) {
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $project_start_date = $_POST['project_start_date'];
    $project_end_date = $_POST['project_end_date'];
    $project_owner_id = $_SESSION['user_id'];

    // Insert project into database
    $stmt = $mysqli->prepare("INSERT INTO projects (name, description, start_date, end_date, owner_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $project_name, $project_description, $project_start_date, $project_end_date, $project_owner_id);
    $stmt->execute();
    $stmt->close();

    // Redirect user to newly created project page
    $project_id = $mysqli->insert_id;
    header("Location: project.php?id=$project_id");
    exit();
}

// Get all projects for current user from database
$user_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT * FROM projects WHERE owner_id = $user_id");
$projects = [];
while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

// Close database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Project Management</title>
</head>
<body>
    <h1>Welcome to the Project Management System</h1>
    <a href="logout.php">Logout</a>

    <h2>Create a New Project</h2>
    <form method="POST">
        <label>Project Name:</label>
        <input type="text" name="project_name" required>

        <label>Project Description:</label>
        <textarea name="project_description"></textarea>

        <label>Start Date:</label>
        <input type="date" name="project_start_date" required>

        <label>End Date:</label>
        <input type="date" name="project_end_date" required>

        <button type="submit" name="create_project">Create Project</
   </form>
