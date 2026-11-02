<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventopia | Luxury Event Management</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Neuton:wght@300;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../pages/home.php">Eventopia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../pages/home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/event-managers.php">Managers</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/vendor-service.php">Vendors</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/booking.php">Book Now</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/reviews.php">Reviews</a></li>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="../pages/user_profile.php"><i class="fas fa-user-circle"></i>My Account</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="../pages/UserLogin.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>