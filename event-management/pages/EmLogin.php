<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Eventopia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<?php
session_start();
include '../includes/config.php'; // Include the database configuration file

$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $inputEmail = $_POST['txtemail']; // Match the name attribute
    $inputPassword = $_POST['txtpassword']; // Match the name attribute

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM eventmanager WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $inputEmail, $inputPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
		 $eventmanager = $result->fetch_assoc();
		// Set session variable
        $_SESSION['emloggedin'] = true;
        $_SESSION['email'] = $inputEmail;
		$_SESSION['event_manager_id'] = $eventmanager['event_manager_id']; // ✅ Important
		//echo"<script>alert('you are loing');</script>";
        header("Location: eventmanager.php"); // Redirect to dashboard page
		exit;
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }

	    // Close the statement
    $stmt->close();

}

?>

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
	
	
	<main class="container mx-auto my-10 px-6">
        <div class="bg-white shadow-md rounded-md p-6 max-w-md mx-auto">
            <h2 class="text-xl font-bold mb-4">Login</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label class="block text-gray-700" for="role"><i class="fas fa-user mr-2"></i> Role</label>
                     <input aria-readonly="true" class="w-full border border-gray-300 rounded px-3 py-2 text-sm text-gray-900 bg-white cursor-default" readonly type="text" value="Event Manager"/>
    <label class="block mt-4 mb-1 text-gray-700 text-xs" for="email">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="username"><i class="fas fa-user mr-2"></i> Email</label>
                    <input class="w-full border border-gray-300 rounded-md p-2" id="email" placeholder="Email" type="text" name="txtemail"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="password"><i class="fas fa-lock mr-2"></i> Password</label>
                    <input class="w-full border border-gray-300 rounded-md p-2" id="password" placeholder="Password" type="password" name="txtpassword"/>
                </div>
                <button class="w-full bg-blue-500 text-white rounded-md p-2" type="submit" name="btnlogin">Login</button>
                

    
			<div> Don't have account  <a href="emregister.php" style="color: blue; text-decoration: underline;"> Register</a></div>



            </form>
			<?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
        </div>
    </main>
	
	
	<br>
	&nbsp;
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<br>
	</br>
	</br>
	
    <footer class="bg-gray-800 text-white py-2">
        <div class="container mx-auto px-2">
            <div class="flex justify-between">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
        </div>
    </footer>

</body>
</html>





