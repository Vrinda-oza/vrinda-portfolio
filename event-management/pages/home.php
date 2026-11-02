<?php 
// Start session (for user greeting)
session_start();
include '../includes/header.php'; 
?>

<!-- Hero Section (Image placeholder) -->
<section class="hero-section py-5" style="background-color: #E5E5E5;">
  <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1 class="display-4 mb-4">
          <?php 
          if(isset($_SESSION['user_name'])) {
            echo "Welcome back, " . htmlspecialchars($_SESSION['user_name']) . "!";
          } else {
            echo "Curating Unforgettable Moments";
          }
          ?>
        </h1>
        <p class="lead mb-4">Eventopia transforms visions into timeless celebrations with effortless elegance.</p>
        <div class="d-flex gap-3">
          <a href="booking.php" class="btn btn-primary">Begin Planning</a>
          <a href="gallery.php" class="btn btn-outline-primary">View Gallery</a>
        </div>
      </div>
      <!-- Image placeholder column (add later) -->
      <div class="col-lg-6 d-none d-lg-block">
        <div class="placeholder-img" style="height: 400px; background: rgba(179, 139, 141, 0.1); display: flex; align-items: center; justify-content: center;">
          <img src="../assets/images/abc.jpg" alt="bleh bleh" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Services Preview -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5">Our Signature Services</h2>
    <div class="row g-4">
      <!-- Service 1 -->
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <h3 class="h5">Wedding Planning</h3>
            <p>Full-service coordination for your perfect day.</p>
          </div>
        </div>
      </div>
      <!-- Service 2 -->
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <h3 class="h5">Corporate Events</h3>
            <p>Seamless professional gatherings.</p>
          </div>
        </div>
      </div>
      <!-- Service 3 -->
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <h3 class="h5">Custom Decor</h3>
            <p>Tailored designs to match your vision.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonial Teaser -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <blockquote class="blockquote">
          <p>"Eventopia made our wedding feel like a royal affair!"</p>
          <footer class="blockquote-footer mt-3">Priya & Rohan</footer>
        </blockquote>
        <a href="reviews.php" class="btn btn-accent mt-3">Read More Stories</a>
      </div>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>