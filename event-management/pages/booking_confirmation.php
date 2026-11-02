<?php
session_start();
include '../includes/config.php';
include '../includes/header.php';

// Redirect if no booking ID
if (!isset($_GET['booking_id']) || !is_numeric($_GET['booking_id'])) {
    header("Location: booking.php");
    exit;
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking details
$booking_query = $conn->query("
    SELECT 
        b.*, 
        u.name AS user_name, 
        e.event_name, 
        em.name AS manager_name,
        c.city_name,
        s.state_name
    FROM booking b
    JOIN user u ON b.user_id = u.user_id
    JOIN event e ON b.event_id = e.event_id
    JOIN eventmanager em ON b.event_manager_id = em.event_manager_id
    JOIN citymaster c ON b.city_id = c.city_id
    JOIN statemaster s ON c.state_id = s.state_id
    WHERE b.booking_id = $booking_id
");

if (!$booking_query) {
    die("Database error: " . $conn->error);
}

$booking = $booking_query->fetch_assoc();

// Validate and format date
if (!empty($booking['event_date']) && $booking['event_date'] != '0000-00-00') {
    $event_timestamp = strtotime($booking['event_date']);
    if ($event_timestamp === false || $booking['event_date'] == '0000-00-00') {
        $formatted_date = "Invalid Date";
        $formatted_time = "Invalid Time";
    } else {
        $formatted_date = date('l, j F Y', $event_timestamp);
        $formatted_time = !empty($booking['event_time']) ? date('h:i A', strtotime($booking['event_time'])) : "Time not specified";
    }
} else {
    $formatted_date = "Date not specified";
    $formatted_time = "Time not specified";
}


// Fetch booked services
$services_query = $conn->query("
    SELECT 
        v.name AS vendor_name,
        sv.service_name,
        sv.amount
    FROM bookingdetails bd
    JOIN vendorservicedetails vs ON bd.vs_id = vs.vs_id
    JOIN vendor v ON vs.vendor_id = v.vendor_id
    JOIN service sv ON vs.service_id = sv.service_id
    WHERE bd.booking_id = $booking_id
");

if (!$services_query) {
    die("Database error: " . $conn->error);
}
?>

<div class="container py-5">
    <div class="confirmation-card shadow-lg">
        <div class="confirmation-header bg-burgundy text-beige">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Booking Confirmed</h1>
                <span class="badge bg-light text-burgundy fs-6">#<?= $booking_id ?></span>
            </div>
            <p class="mb-0">Thank you for choosing Eventopia!</p>
        </div>

        <div class="confirmation-body">
            <!-- Event Details Section -->
            <div class="confirmation-section">
                <h2 class="h5 section-title text-burgundy">
                    <i class="fas fa-calendar-alt me-2"></i>Event Details
                </h2>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Event Type:</strong> <?= htmlspecialchars($booking['event_name']) ?></p>
                        <p><strong>Date:</strong> <?= $formatted_date ?></p>
                        <p><strong>Time:</strong> <?= $formatted_time ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Location:</strong> 
                            <?= htmlspecialchars($booking['event_address']) ?>, 
                            <?= htmlspecialchars($booking['city_name']) ?>, 
                            <?= htmlspecialchars($booking['state_name']) ?>
                        </p>
                        <p><strong>Manager:</strong> <?= htmlspecialchars($booking['manager_name']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="confirmation-section">
                <h2 class="h5 section-title text-burgundy">
                    <i class="fas fa-list-alt me-2"></i>Selected Services
                </h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="bg-light">
                                <th>Service Provider</th>
                                <th>Service</th>
                                <th class="text-end">Price (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0;
                            $manager_fee = 5000;
                            $total += $manager_fee;
                            ?>
                            <tr>
                                <td>Eventopia</td>
                                <td>Event Management Fee</td>
                                <td class="text-end">₹5,000.00</td>
                            </tr>
                            
                            <?php while($service = $services_query->fetch_assoc()): 
                                $total += $service['amount'];
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($service['vendor_name']) ?></td>
                                <td><?= htmlspecialchars($service['service_name']) ?></td>
                                <td class="text-end">₹<?= number_format($service['amount'], 2) ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <tr class="table-light">
                                <td colspan="2" class="fw-bold">Subtotal</td>
                                <td class="text-end fw-bold">₹<?= number_format($total, 2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="confirmation-section">
                <h2 class="h5 section-title text-burgundy">
                    <i class="fas fa-receipt me-2"></i>Payment Information
                </h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="qr-payment-box p-3 border rounded bg-light">
                            <h6 class="text-burgundy mb-3">
                                <i class="fas fa-qrcode me-2"></i>Complete Payment via UPI
                            </h6>
                            <div class="text-center mb-3">
                                <img src="../assets/images/qr.jpeg" alt="Eventopia UPI QR Code" class="img-fluid" style="max-width: 200px;">
                            </div>
                            <p class="small text-center mb-1">
                                Scan this QR code with any UPI app
                            </p>
                            <p class="text-center mb-0">
                                <strong>UPI ID:</strong> eventopia@oksbi
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-summary bg-light p-3 rounded">
                            <p class="d-flex justify-content-between">
                                <span>Total Amount:</span>
                                <span>₹<?= number_format($total, 2) ?></span>
                            </p>
                            <p class="d-flex justify-content-between">
                                <span>Advance Paid (25%):</span>
                                <span class="text-burgundy fw-bold">₹<?= number_format($total * 0.25, 2) ?></span>
                            </p>
                            <hr>
                            <p class="d-flex justify-content-between">
                                <span>Balance Due:</span>
                                <span>₹<?= number_format($total * 0.75, 2) ?></span>
                            </p>
                            <div class="alert alert-info mt-3 p-2 small">
                                <i class="fas fa-info-circle me-2"></i>
                                Please complete payment within 24 hours to confirm your booking
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirmation-footer bg-light">
            <div class="d-flex justify-content-between">
                <a href="home.php" class="btn btn-outline-burgundy">
                    <i class="fas fa-home me-2"></i>Return Home
                </a>
                <button onclick="window.print()" class="btn btn-burgundy">
                    <i class="fas fa-print me-2"></i>Print Confirmation
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.confirmation-card {
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid rgba(128, 0, 32, 0.1);
}
.confirmation-header {
    padding: 1.5rem;
    border-bottom: 3px solid var(--beige);
}
.confirmation-body {
    padding: 2rem;
}
.confirmation-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px dashed #eee;
}
.confirmation-section:last-child {
    border-bottom: none;
}
.section-title {
    border-left: 4px solid var(--burgundy);
    padding-left: 10px;
    margin-bottom: 1rem;
}
.qr-payment-box {
    height: 100%;
}
</style>

<?php include '../includes/footer.php'; ?>