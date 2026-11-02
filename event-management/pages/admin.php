<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Panel Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    body {
      background-color: #f3f4f6;
      min-height: 100vh;
      display: flex;
    }
    aside {
      background-color: #1e293b;
      width: 16rem;
      padding: 1.5rem;
      color: #e0e7ff;
      flex-shrink: 0;
    }
    aside h2 {
      font-weight: 700;
      font-size: 1.125rem;
      margin-bottom: 2rem;
      color: white;
    }
    aside nav a {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      color: #cbd5e1;
      font-size: 0.875rem;
      margin-bottom: 1.25rem;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    aside nav a:hover,
    aside nav a.active {
      color: white;
    }
    main {
      flex-grow: 1;
      padding: 2rem;
    }
    .card-custom {
      border-radius: 0.5rem;
      color: white;
      padding: 1.5rem;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.15);
    }
    .card-title {
      font-weight: 600;
      font-size: 1.125rem;
      margin-bottom: 0.5rem;
    }
    .card-number {
      font-weight: 800;
      font-size: 2rem;
    }
  </style>
</head>
<body>
  <aside>
    <h2>Admin Panel</h2>
    <nav id="sidebarNav">
      <a href="dashboard.php" class="nav-link" data-page="dashboard.php"><i class="fas fa-palette"></i> Dashboard</a>
      <a href="user.php" class="nav-link" data-page="user.php"><i class="fas fa-user"></i> User</a>
      <a href="event_manager.php" class="nav-link" data-page="event_manager.php"><i class="fas fa-calendar-alt"></i> Event Manager</a>
      <a href="vendor.php" class="nav-link" data-page="vendor.php"><i class="fas fa-store"></i> Vendor</a>
      <a href="service.php" class="nav-link" data-page="service.php"><i class="fas fa-concierge-bell"></i> Service</a>
      <a href="booking.php" class="nav-link" data-page="booking.php"><i class="fas fa-book"></i> Booking</a>
      <a href="event.php" class="nav-link" data-page="event.php"><i class="fas fa-calendar-check"></i> Event</a>
      <a href="company_profile.php" class="nav-link" data-page="company_profile.php"><i class="fas fa-building"></i> Company Profile</a>
      <a href="logout.php" class="nav-link" data-page="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
  </aside>
  <main>
    <?php
      $page = basename($_SERVER['PHP_SELF']);
    ?>
    <h1 class="fw-bold mb-4 text-dark">Dashboard</h1>
    <div class="row g-4">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card-custom bg-indigo-700" style="background-color:#4c51bf;">
          <div class="card-title">Total Booking</div>
          <div class="card-number">8</div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card-custom" style="background-color:#0d9488;">
          <div class="card-title">Total Event Manager</div>
          <div class="card-number">3</div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card-custom" style="background-color:#059669;">
          <div class="card-title">Total Vendor</div>
          <div class="card-number">5</div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card-custom" style="background-color:#dc2f54;">
          <div class="card-title">Total Service</div>
          <div class="card-number">8</div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card-custom" style="background-color:#0c8599;">
          <div class="card-title">Total Event</div>
          <div class="card-number">23</div>
        </div>
      </div>
    </div>
  </main>

  <script>
    // Highlight active link based on current page
    document.addEventListener("DOMContentLoaded", function () {
      const currentPage = "<?php echo $page; ?>";
      const links = document.querySelectorAll("#sidebarNav a.nav-link");
      links.forEach(link => {
        if (link.getAttribute("data-page") === currentPage) {
          link.classList.add("active");
        }
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>