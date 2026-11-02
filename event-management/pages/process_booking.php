<?php
session_start();
include '../includes/config.php';
date_default_timezone_set('Asia/Kolkata');

// Authentication check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Method check
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: booking.php");
    exit;
}

// Required fields validation
$required = ['event_manager_id', 'vs_id', 'event_id', 'event_address', 
             'city_id', 'event_date', 'event_time'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        die(json_encode(['status' => 'error', 'message' => "Missing required field: $field"]));
    }
}

// Date validation (YYYY-MM-DD)
$event_date = $_POST['event_date'];
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $event_date) || !strtotime($event_date)) {
    die(json_encode(['status' => 'error', 'message' => "Invalid date format. Use YYYY-MM-DD"]));
}

// Time validation (HH:MM in 24-hour format)
$event_time = $_POST['event_time'];
if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $event_time)) {
    die(json_encode(['status' => 'error', 'message' => "Invalid time format. Use 24-hour HH:MM"]));
}

// Calculate totals with manager fee
$total = 5000; // Base manager fee
$vs_ids = is_array($_POST['vs_id']) ? $_POST['vs_id'] : [$_POST['vs_id']];

foreach ($vs_ids as $vs_id) {
    $stmt = $conn->prepare("SELECT s.amount FROM vendorservicedetails vs
                           JOIN service s ON vs.service_id = s.service_id
                           WHERE vs.vs_id = ?");
    $stmt->bind_param("i", $vs_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        die(json_encode(['status' => 'error', 'message' => "Invalid service selected"]));
    }
    $total += $result->fetch_assoc()['amount'];
}

// Prepare all variables separately (not in array) for binding
$user_id = (int)$_SESSION['user_id'];
$event_manager_id = (int)$_POST['event_manager_id'];
$vs_id_primary = (int)$vs_ids[0];
$event_id = (int)$_POST['event_id'];
$event_address = substr(trim($_POST['event_address']), 0, 30);
$city_id = (int)$_POST['city_id'];
$advance_payment = $total * 0.25;
$actual_payment = $total;

// Add seconds to time for TIME field
$event_time_db = $event_time . ':00';

// Insert booking with transaction
$conn->begin_transaction();

try {
    // Main booking record
    $stmt = $conn->prepare("INSERT INTO booking (
        user_id, event_manager_id, vs_id, event_id, event_address,
        city_id, event_date, advance_payment, event_time,
        payment_date, actual_payment, status, payment_time
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), ?, 'Pending', CURTIME())");
    
    // Bind each variable directly (not from array)
    $stmt->bind_param(
        "iiiisssdsd",
        $user_id,
        $event_manager_id,
        $vs_id_primary,
        $event_id,
        $event_address,
        $city_id,
        $event_date,
        $advance_payment,
        $event_time_db,
        $actual_payment
    );
    
    if (!$stmt->execute()) {
        throw new Exception("Booking failed: " . $conn->error);
    }
    
    $booking_id = $conn->insert_id;
    
    // Booking details for each service
    foreach ($vs_ids as $vs_id) {
        $vs_id_int = (int)$vs_id;
        $stmt = $conn->prepare("INSERT INTO bookingdetails (booking_id, vs_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $booking_id, $vs_id_int);
        if (!$stmt->execute()) {
            throw new Exception("Failed to save service details: " . $conn->error);
        }
    }
    
    $conn->commit();
    
    // Redirect to confirmation
    header("Location: booking_confirmation.php?booking_id=$booking_id");
    exit;
    
} catch (Exception $e) {
    $conn->rollback();
    die(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
}
?>