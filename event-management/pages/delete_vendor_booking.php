<?php
                        include('../includes/config.php');

if (isset($_GET['booking_id']) && isset($_GET['vs_id'])) {
    $booking_id = intval($_GET['booking_id']);
    $vs_id = intval($_GET['vs_id']);

    // Step 1: Delete the entry from bookingdetails
    $stmt1 = $conn->prepare("DELETE FROM bookingdetails WHERE booking_id = ? AND vs_id = ?");
    $stmt1->bind_param("ii", $booking_id, $vs_id);
    $stmt1->execute();

    // Step 2: Check if any vs_id remain for this booking
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM bookingdetails WHERE booking_id = ?");
    $stmt_check->bind_param("i", $booking_id);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    // Step 3: If no vs_id remain, delete from booking
    if ($count == 0) {
        $stmt2 = $conn->prepare("DELETE FROM booking WHERE booking_id = ?");
        $stmt2->bind_param("i", $booking_id);
        $stmt2->execute();
        $stmt2->close();
    }

    if ($stmt1->affected_rows > 0) {
        echo "<script>alert('Booking deleted successfully'); window.location.href='vendor.php';</script>";
    } else {
        echo "<script>alert('No matching booking found'); window.location.href='vendor.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='vendor.php';</script>";
}
?>
	