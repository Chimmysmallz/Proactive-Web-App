<?php

// define constants for SQL queries
define('QUERY_GET_USER_BY_EMAIL', 'SELECT * FROM users WHERE email = ?');
define('QUERY_INSERT_USER', 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)');

// define functions for SQL queries
function get_project_by_id($project_id) {
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT * FROM projects WHERE id = ?');
    $stmt->bind_param('i', $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function insert_project($name, $user_id) {
    global $mysqli;
    $stmt = $mysqli->prepare('INSERT INTO projects (name, user_id) VALUES (?, ?)');
    $stmt->bind_param('si', $name, $user_id);
    $stmt->execute();
    return $mysqli->insert_id;
}

?>
