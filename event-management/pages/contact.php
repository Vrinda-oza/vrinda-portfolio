<?php
session_start();
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        date('Y-m-d H:i:s'),
        $_POST['name'],
        $_POST['email'],
        $_POST['message']
    ];
    file_put_contents('contacts.txt', implode('|', $data) . PHP_EOL, FILE_APPEND);
    $success = true;
}
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Contact Us</h1>
    
    <?php if (isset($success)): ?>
        <div class="alert alert-success">Thank you! We'll contact you soon.</div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-burgundy">Send Message</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>