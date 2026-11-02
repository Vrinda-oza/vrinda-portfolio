<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Eventopia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img alt="University Logo" class="mr-4" height="50" src="../assets/images/Eventopia_logo_50x50.png" width="50"/>
                <div>
                    <h1 class="text-xl font-bold">Eventopia <span class="text-blue-500"></span></h1>
                   
                </div>
            </div>
            
        </div>
        <nav class="bg-gray-800">
            <div class="container mx-auto flex justify-between items-center py-2 px-6">
                            </div>
        </nav>
    </header>
<?
<?php
// Include the configuration file
Include '../includes/config.php';


// Initialize variables
$email = "";
$new_password = "";
$confirm_password = "";
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 if (isset($_POST['txtemail'], $_POST['txtnewpassword'], $_POST['txtconpassword'])) {
   
   $email = $_POST['txtemail'];
    $new_password = $_POST['txtnewpassword'];
    $confirm_password = $_POST['txtconpassword'];

    // Check if passwords match
    if ($new_password === $confirm_password) {
        // Update the password in the database
        $sql = "UPDATE admin SET password='$new_password' WHERE email='$email'";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Password reset successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Passwords do not match!";
    }
	
}
}

$conn->close();
?>

?>
   <main class="flex justify-center py-16 px-4">
   <form action="register1.php" class="bg-white rounded-md shadow-md p-6 w-full max-w-md" method="POST">  
   <h2 class="font-bold text-black mb-5 text-lg">Forgot Password</h2>
	<?php if ($message): ?>
	<div class="mb-4 text-red-500"><?php echo $message; ?></div>
            <?php endif; ?>
<div class="mb-4">
                    <label class="block text-gray-700" for="username"><i class="fas fa-user mr-2"></i> Email</label>
                    <input class="w-full border border-gray-300 rounded-md p-2" id="email" placeholder="Email" type="text" name="txtemail"/>
                </div>

      <div class="mb-4">
                    <label class="block text-gray-700" for="new password"><i class="fas fa-lock mr-2"></i>New Password</label>
                    <input class="w-full border border-gray-300 rounded-md p-2" id="password" placeholder="New Password" type="password" name="txtnewpassword"/>
                </div>

            <div class="mb-4">
                    <label class="block text-gray-700" for="confirm password"><i class="fas fa-lock mr-2"></i>Confirm Password</label>
                    <input class="w-full border border-gray-300 rounded-md p-2" id="password" placeholder="Confirm Password" type="password" name="txtconpassword"/>
                </div>


      <button class="w-full bg-blue-500 text-white rounded-md p-2" type="submit" name="btnlogin">Reset Password</button>
                
      			<div> Remembered Your Password?<a href="AdminLogin.php" style="color: blue; text-decoration: underline;">Login Here</a></div>

    </form>
  </main>
	<br>
	</br>
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-3">
            <div class="flex justify-between">
                
			</div>
        </div>
    </footer>
</body>
</html>





