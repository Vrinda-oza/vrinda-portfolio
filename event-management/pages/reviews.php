<?php
// Start session and include config file for database connection
session_start();
require '../includes/config.php';
include '../includes/header.php';

try {
    // Fetch reviews from database
    $reviews = $conn->query("
        SELECT r.*, u.name AS user_name 
        FROM reviews r
        JOIN user u ON r.user_id = u.user_id
        ORDER BY r.review_date DESC
    ") or throw new Exception("Database error: " . $conn->error);

} catch (Exception $e) {
    $error_message = $e->getMessage();
}
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Client Testimonials</h1>
    
    <!-- Error Message Display -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>
    
    <!-- Review Cards -->
    <div class="row g-4">
        <?php if (isset($reviews) && $reviews->num_rows > 0): ?>
            <?php while($review = $reviews->fetch_assoc()): ?>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <div class="bg-burgundy text-beige rounded-circle p-3 me-3">
                                    <?= strtoupper(substr($review['user_name'], 0, 1)) ?>
                                </div>
                                <div>
                                    <h5 class="mb-1"><?= htmlspecialchars($review['user_name']) ?></h5>
                                    <small class="text-muted">
                                        <?= date('F j, Y', strtotime($review['review_date'])) ?>
                                    </small>
                                </div>
                            </div>
                            <p class="card-text"><?= htmlspecialchars($review['review_text']) ?></p>
                            <div class="text-warning">
                                <?= str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No reviews found. Be the first to share your experience!
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center mt-5">
        <a href="give_review.php" class="btn btn-burgundy">Share Your Experience</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>