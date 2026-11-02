<?php
session_start();
include '../includes/config.php';

// Check if admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die(json_encode(['success' => false, 'message' => 'Unauthorized']));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'message' => 'Invalid request']));
}

// Validate inputs
$booking_id = filter_input(INPUT_POST, 'booking_id', FILTER_VALIDATE_INT);
$status = in_array($_POST['status'], ['pending', 'approved', 'cancelled']) ? $_POST['status'] : null;

if (!$booking_id || !$status) {
    die(json_encode(['success' => false, 'message' => 'Invalid parameters']));
}

// Update the status in database
$stmt = $conn->prepare("UPDATE booking SET status = ? WHERE booking_id = ?");
$stmt->bind_param("si", $status, $booking_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

$stmt->close();
$conn->close();
?>