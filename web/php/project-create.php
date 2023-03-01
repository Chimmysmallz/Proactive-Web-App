<?php

// start session

session_start();

// check if user is logged in

if (!isset($_SESSION['user_id'])) {

    // redirect user to login page

    header("Location: login.php");

    exit();

}

// include database connection file

require_once "includes/db_connect.php";

// initialize variables

$name = "";

$description = "";

$start_date = "";

$end_date = "";

$errors = [];

// handle form submission

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // sanitize form data

    $name = htmlspecialchars(trim($_POST['name']));

    $description = htmlspecialchars(trim($_POST['description']));

    $start_date = htmlspecialchars(trim($_POST['start_date']));

    $end_date = htmlspecialchars(trim($_POST['end_date']));

    // validate form data

    if (empty($name)) {

        $errors[] = "Project name is required.";

    }

    if (empty($description)) {

        $errors[] = "Project description is required.";

    }

    if (empty($start_date)) {

        $errors[] = "Start date is required.";

    }

    if (empty($end_date)) {

        $errors[] = "End date is required.";

    }

    // if there are no errors, insert project into database

    if (empty($errors)) {

        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO projects (user_id, name, description, start_date, end_date)

                VALUES ('$user_id', '$name', '$description', '$start_date', '$end_date')";

        $result = mysqli_query($conn, $sql);

        if ($result) {

            // redirect user to project list page

            header("Location: project-list.php");

            exit();

        } else {

            $errors[] = "Unable to create project.";

        }

    }

}

// close database connection

mysqli_close($conn);

?>

<!-- HTML form for creating a new project -->

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Create Project - Proactive Web App</title>

</head>

<body>

    <h1>Create New Project</h1>

    <?php if (!empty($errors)): ?>

        <ul>

            <?php foreach ($errors as $error): ?>

                <li><?php echo $error; ?></li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <label for="name">Project Name:</label>

        <input type="text" name="name" id="name" value="<?php echo $name; ?>"><br>

        <label for="description">Project Description:</label>

        <textarea name="description" id="description"><?php echo $description; ?></textarea><br>

        <label for="start_date">Start Date:</label>

        <input type="date" name="start_date" id="start_date" value="<?php echo $start_date; ?>"><br>

        <label for="end_date">End Date:</label>

        <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>"><br>

        <input type="submit" value="Create Project">

    </form>

</body>

</html>

