<?php
// Database connection
$host = "sql305.infinityfree.com";
$user = "if0_40542951"; // default XAMPP username
$pass = "vriza2004"; // default XAMPP password (empty)
$db = "if0_40542951_event_management_db"; // replace with your DB name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>