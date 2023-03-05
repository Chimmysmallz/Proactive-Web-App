<?php

// connect to the database

$servername = "localhost";

$username = "username";

$password = "password";

$dbname = "proactive_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection

if ($conn->connect_error) {

  die("Connection failed: " . $conn->connect_error);

}

// query the database for all projects

$sql = "SELECT * FROM projects";

$result = $conn->query($sql);

// display the projects in a table

if ($result->num_rows > 0) {

  echo "<table>";

  echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Status</th><th>Start Date</th><th>End Date</th></tr>";

  while($row = $result->fetch_assoc()) {

    echo "<tr>";

    echo "<td>" . $row["id"] . "</td>";

    echo "<td>" . $row["name"] . "</td>";

    echo "<td>" . $row["description"] . "</td>";

    echo "<td>" . $row["status"] . "</td>";

    echo "<td>" . $row["start_date"] . "</td>";

    echo "<td>" . $row["end_date"] . "</td>";

    echo "</tr>";

  }

  echo "</table>";

} else {

  echo "No projects found.";

}

// close the database connection

$conn->close();

?>

