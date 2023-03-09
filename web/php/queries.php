<?php

// Include the database connection file
include_once 'db_connect.php';

// Sample queries

// 1. Retrieve all projects
$projects_query = "SELECT * FROM projects";
$projects_result = mysqli_query($conn, $projects_query);

if ($projects_result) {
  while ($project = mysqli_fetch_assoc($projects_result)) {
    echo "Project Name: " . $project['name'] . "<br>";
    echo "Project Owner: " . $project['owner'] . "<br>";
    echo "Project Start Date: " . $project['start_date'] . "<br>";
    echo "Project End Date: " . $project['end_date'] . "<br>";
    echo "<br>";
  }
} else {
  echo "Error retrieving projects: " . mysqli_error($conn);
}

// 2. Insert a new project
$new_project_query = "INSERT INTO projects (name, owner, start_date, end_date) VALUES ('New Project', 'John', '2023-02-01', '2023-02-28')";
$new_project_result = mysqli_query($conn, $new_project_query);

if ($new_project_result) {
  echo "New project created successfully!";
} else {
  echo "Error creating new project: " . mysqli_error($conn);
}

// 3. Update an existing project
$update_project_query = "UPDATE projects SET end_date = '2023-03-15' WHERE id = 1";
$update_project_result = mysqli_query($conn, $update_project_query);

if ($update_project_result) {
  echo "Project updated successfully!";
} else {
  echo "Error updating project: " . mysqli_error($conn);
}

// 4. Delete an existing project
$delete_project_query = "DELETE FROM projects WHERE id = 2";
$delete_project_result = mysqli_query($conn, $delete_project_query);

if ($delete_project_result) {
  echo "Project deleted successfully!";
} else {
  echo "Error deleting project: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

?>
