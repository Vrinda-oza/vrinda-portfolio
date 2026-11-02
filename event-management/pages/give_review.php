<?php
session_start();
require '../includes/config.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: UserLogin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $review_text = $conn->real_escape_string($_POST['review_text']);
    $rating = (int)$_POST['rating'];
    
    $conn->query("INSERT INTO reviews (user_id, review_text, rating, review_date) 
                VALUES ($user_id, '$review_text', $rating, CURDATE())");
    header("Location: reviews.php?success=1");
}
?>

<!-- Custom Styles Embedded -->
<style>
.review-container {
    max-width: 700px;
    margin: 2rem auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(128, 0, 32, 0.1);
    overflow: hidden;
}
.review-header {
    background-color: #800020;
    color: #F5F5DC;
    padding: 1.5rem;
}
.review-body {
    padding: 2rem;
}
.rating-options {
    display: flex;
    gap: 10px;
    margin: 1rem 0;
}
.rating-options input[type="radio"] {
    display: none;
}
.rating-options label {
    cursor: pointer;
    font-size: 1.5rem;
    color: #ccc;
    transition: all 0.2s;
}
.rating-options input[type="radio"]:checked ~ label {
    color: #ffc107;
}
.rating-options label:hover {
    transform: scale(1.2);
}
.btn-submit {
    background-color: #800020;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 5px;
    transition: all 0.3s;
}
.btn-submit:hover {
    background-color: #600018;
    transform: translateY(-2px);
}
</style>

<div class="review-container">
    <div class="review-header">
        <h2 class="h4 mb-0">Share Your Experience</h2>
    </div>
    <div class="review-body">
        <form method="POST">
            <!-- Rating Selection -->
            <div class="mb-4">
                <label class="form-label d-block">Your Rating</label>
                <div class="rating-options">
                    <?php for ($i=5; $i>=1; $i--): ?>
                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required>
                        <label for="star<?= $i ?>">★</label>
                    <?php endfor; ?>
                </div>
            </div>
            
            <!-- Review Text -->
            <div class="mb-4">
                <label class="form-label">Your Review</label>
                <textarea name="review_text" class="form-control" rows="5" required 
                          placeholder="How was your experience with Eventopia?"></textarea>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn-submit">Submit Review</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>