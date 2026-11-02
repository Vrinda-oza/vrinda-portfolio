<?php
// Start session and include dependencies FIRST
session_start();
require '../includes/config.php';  // Ensures $conn is available
include '../includes/header.php';

// Now safely query the database
$images = $conn->query("SELECT * FROM gallery ORDER BY image_id DESC");
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Our Gallery</h1>
    <div class="row g-3">
        <?php while($img = $images->fetch_assoc()): ?>
            <div class="col-md-4 col-lg-3">
                <div class="gallery-card">
                    <img src="../<?= htmlspecialchars($img['image_path']) ?>" 
                         alt="<?= htmlspecialchars($img['caption']) ?>" 
                         class="img-fluid rounded hover-zoom">
                    <?php if(!empty($img['caption'])): ?>
                        <div class="caption p-2">
                            <?= htmlspecialchars($img['caption']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<style>
.gallery-card {
    border: 1px solid rgba(128, 0, 32, 0.1);
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s;
}
.gallery-card:hover {
    transform: translateY(-5px);
}
.hover-zoom {
    transition: transform 0.5s;
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.hover-zoom:hover {
    transform: scale(1.03);
}
.caption {
    background-color: #f8f3e8;
    border-top: 1px solid rgba(128, 0, 32, 0.1);
}
</style>

<?php include '../includes/footer.php'; ?>