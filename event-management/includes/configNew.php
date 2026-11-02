<?php
// Database connection for Eventopia
$host = "localhost";
$user = "root";     // Default XAMPP username
$pass = "";         // Default XAMPP password (empty)
$db = "eventopia";  // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>