<?php
session_start();
include '../includes/config.php';
include '../includes/header.php';



// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain text (as per your request)

    $stmt = $conn->prepare("SELECT user_id, name FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: home.php");
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-burgundy text-beige">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-login">Login</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>