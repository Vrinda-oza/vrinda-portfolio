<?php
session_start();
require '../includes/config.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: UserLogin.php");
    exit;
}

// Initialize variables
$error_message = '';
$success_message = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);

// Get user data
$user = $conn->query("SELECT * FROM user WHERE user_id = {$_SESSION['user_id']}")->fetch_assoc();

// Handle form submission for profile updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    
    $update_sql = "UPDATE user SET 
                  name = '$name',
                  email = '$email',
                  contact_number = '$contact_number'
                  WHERE user_id = {$_SESSION['user_id']}";
    
    if ($conn->query($update_sql)) {
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: user_profile.php");
        exit;
    } else {
        $error_message = "Error updating profile: " . $conn->error;
    }
}

// Handle event cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking'])) {
    $booking_id = intval($_POST['booking_id']);
    $event_date = $_POST['event_date'];
    
    $current_date = new DateTime();
    $event_date_obj = new DateTime($event_date);
    $days_remaining = $current_date->diff($event_date_obj)->days;
    
    $check_booking = $conn->query("SELECT status, advance_payment FROM booking WHERE booking_id = $booking_id AND user_id = {$_SESSION['user_id']}")->fetch_assoc();
    
    if ($check_booking && $check_booking['status'] == 'APPROVED') {
        $refund_message = $days_remaining >= 15 ? 
            "Refund of ₹" . number_format($check_booking['advance_payment'], 2) . " will be credited to your bank account within 5-7 working days." : 
            "No refund will be issued as the event is within 15 days.";
        
        if ($conn->query("UPDATE booking SET status = 'CANCELLED' WHERE booking_id = $booking_id")) {
            $_SESSION['success_message'] = "Booking cancelled successfully. $refund_message";
            header("Location: user_profile.php");
            exit;
        } else {
            $error_message = "Error cancelling booking: " . $conn->error;
        }
    } else {
        $error_message = "You can only cancel approved bookings.";
    }
}

// Get bookings data
$bookings = $conn->query("
    SELECT b.*, e.event_name 
    FROM booking b
    JOIN event e ON b.event_id = e.event_id
    WHERE b.user_id = {$_SESSION['user_id']}
    ORDER BY b.event_date DESC
") or die("Database error: " . $conn->error);
?>

<div class="container py-5">
    <?php if ($success_message): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $success_message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if ($error_message): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $error_message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="profile-card shadow-lg">
        <!-- Profile Header -->
        <div class="profile-header bg-burgundy text-beige p-4 position-relative">
            <div class="d-flex justify-content-end gap-2 position-absolute top-0 end-0 m-3">
                <!-- New Logout Button -->
                <a href="logout.php" class="btn btn-sm btn-beige" title="Logout">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
                
                <!-- Existing Edit Button -->
                <button class="btn btn-sm btn-beige" 
                        data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-edit me-1"></i> Edit
                </button>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="profile-icon rounded-circle bg-beige text-burgundy d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div>
                    <h2 class="h4 mb-0"><?= htmlspecialchars($user['name']) ?></h2>
                    <small><?= htmlspecialchars($user['email']) ?></small>
                    <?php if (!empty($user['contact_number'])): ?>
                        <div class="mt-1">
                            <i class="fas fa-phone"></i> <?= htmlspecialchars($user['contact_number']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Bookings Section -->
        <div class="profile-body p-4">
            <h3 class="h5 mb-4 border-bottom pb-2">Your Bookings</h3>
            
            <?php if ($bookings->num_rows > 0): ?>
                <div class="booking-list">
                    <?php while($booking = $bookings->fetch_assoc()): ?>
                        <div class="booking-item mb-4 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="h6 mb-1"><?= htmlspecialchars($booking['event_name']) ?></h4>
                                    <small class="text-muted">
                                        <?= date('F j, Y', strtotime($booking['event_date'])) ?> 
                                        at <?= date('g:i A', strtotime($booking['event_time'])) ?>
                                    </small>
                                    <div class="mt-2">
                                        <span class="badge bg-<?= $booking['status'] == 'APPROVED' ? 'success' : ($booking['status'] == 'CANCELLED' ? 'secondary' : 'warning') ?>">
                                            <?= $booking['status'] ?>
                                        </span>
                                        <span class="ms-2">Amount Paid: ₹<?= number_format($booking['advance_payment'], 2) ?></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <a href="booking_confirmation.php?booking_id=<?= $booking['booking_id'] ?>" class="btn btn-sm btn-outline-burgundy">
                                        <i class="fas fa-info-circle me-1"></i> Details
                                    </a>
                                    
                                    <?php if ($booking['status'] == 'APPROVED'): ?>
                                        <button class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cancelModal<?= $booking['booking_id'] ?>">
                                            <i class="fas fa-calendar-times me-1"></i> Cancel
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php if ($booking['status'] == 'APPROVED'): ?>
                                <!-- Cancel Modal -->
                                <div class="modal fade" id="cancelModal<?= $booking['booking_id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Confirm Cancellation</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form method="POST">
                                                <div class="modal-body">
                                                    <?php
                                                    $event_date = new DateTime($booking['event_date']);
                                                    $current_date = new DateTime();
                                                    $days_remaining = $current_date->diff($event_date)->days;
                                                    ?>
                                                    <p>You are about to cancel your booking for:</p>
                                                    <h5 class="mb-3"><?= htmlspecialchars($booking['event_name']) ?></h5>
                                                    
                                                    <div class="alert <?= $days_remaining >= 15 ? 'alert-success' : 'alert-warning' ?>">
                                                        <?php if ($days_remaining >= 15): ?>
                                                            <h6><i class="fas fa-check-circle me-2"></i> Refund Eligible</h6>
                                                            <p class="mb-0">Your advance payment of ₹<?= number_format($booking['advance_payment'], 2) ?> will be credited back to your account within 5-7 working days.</p>
                                                        <?php else: ?>
                                                            <h6><i class="fas fa-exclamation-triangle me-2"></i> No Refund</h6>
                                                            <p class="mb-0">Since the event is within 15 days, your advance payment of ₹<?= number_format($booking['advance_payment'], 2) ?> will not be refunded.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" type="checkbox" id="confirmCancel<?= $booking['booking_id'] ?>" required>
                                                        <label class="form-check-label" for="confirmCancel<?= $booking['booking_id'] ?>">
                                                            I understand and wish to proceed
                                                        </label>
                                                    </div>
                                                    
                                                    <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                                    <input type="hidden" name="event_date" value="<?= $booking['event_date'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Go Back</button>
                                                    <button type="submit" name="cancel_booking" class="btn btn-danger">
                                                        Confirm Cancellation
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-light">
                    You haven't made any bookings yet. <a href="booking.php" class="text-burgundy">Plan your event now!</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-burgundy text-beige">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= htmlspecialchars($user['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" id="contact_number" name="contact_number" 
                               value="<?= htmlspecialchars($user['contact_number'] ?? '') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-burgundy" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_profile" class="btn btn-burgundy">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.profile-card {
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid rgba(128, 0, 32, 0.1);
}
.profile-icon {
    font-size: 1.5rem;
    font-weight: bold;
}
.booking-item {
    transition: all 0.3s;
    background-color: rgba(245, 245, 220, 0.3);
}
.booking-item:hover {
    transform: translateX(5px);
    border-color: #800020 !important;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
.btn-beige {
    background-color: #EAE6DA;
    color: #4A3F3A;
    border: 1px solid #B38B8D;
}
.btn-beige:hover {
    background-color: #e0dcd1;
    color: #4A3F3A;
}
.btn-outline-burgundy {
    border-color: #B38B8D;
    color: #B38B8D;
}
.btn-outline-burgundy:hover {
    background-color: #B38B8D;
    color: #EAE6DA;
}
.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
}
.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
}
.d-flex.gap-2 {
    gap: 0.5rem;
}
</style>

<?php include '../includes/footer.php'; ?>