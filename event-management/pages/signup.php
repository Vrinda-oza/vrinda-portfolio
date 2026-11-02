<?php
session_start();
include '../includes/config.php';
include '../includes/header.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Stored as plain text
    $contact = $_POST['contact_number'];

    // Check if email exists
    $check = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    
    if ($check->get_result()->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO user (name, email, password, contact_number) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $contact);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['user_name'] = $name;
            header("Location: home.php");
        } else {
            $error = "Registration failed: " . $conn->error;
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-burgundy text-beige">
                    <h3 class="text-center">Sign Up</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_number" name="contact_number" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-login">Register</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Already have an account? <a href="UserLogin.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>