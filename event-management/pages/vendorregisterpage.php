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

<?php
include '../includes/config.php';

// Fetch data for dropdowns
$cityQuery = $conn->query("SELECT city_id, city_name FROM citymaster");
$stateQuery = $conn->query("SELECT state_id, state_name FROM statemaster");
$serviceQuery = $conn->query("SELECT service_id, service_name FROM service");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $shopName = $_POST['shop_name'];
    $shopAddress = $_POST['shop_address'];
    $shopContactNumber = $_POST['shop_contact_number'];
    $cityId = $_POST['city_id'];
    $stateId = $_POST['state_id'];
    $serviceId = $_POST['service_name'];

    // Insert vendor details into the vendor table
    $sql = "INSERT INTO vendor (name, password, email, shop_name, shop_address, shop_contact_number, city_id,  service_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiii", $name, $password, $email, $shopName, $shopAddress, $shopContactNumber, $cityId, $serviceId);

    if ($stmt->execute()) {
        echo "<div class='text-green-600 text-center mt-4'>New vendor registered successfully.</div>";
    } else {
        echo "<div class='text-red-600 text-center mt-4'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
?>
   <main class="flex-grow flex justify-center items-start px-4 py-8">
   <form action="#" class="bg-white p-6 rounded shadow-md w-full max-w-3xl" method="POST" id="registerForm">
    <!-- Highlighted top section -->
    <div class="bg-blue-100 border border-blue-300 rounded-md p-4 mb-6">
     <h2 class="font-bold text-lg text-blue-800 select-none">
      Register Your Shop
     </h2>
     <p class="text-blue-700 text-xs mt-1 select-none">
      Please fill in the details below to create your account and register your shop with Eventopia.
     </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
     <label class="block text-xs text-gray-700" for="name">
      <div class="flex items-center mb-1">
       <i class="fas fa-user mr-2 text-gray-700">
       </i>
       Name
      </div>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500" id="name" name="name" placeholder="Name" required="" type="text"/>
     </label>
     <label class="block text-xs text-gray-700" for="email">
      <div class="flex items-center mb-1">
       <i class="fas fa-envelope mr-2 text-gray-700">
       </i>
       Email
      </div>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500" id="email" name="email" placeholder="Email" required="" type="email"/>
     </label>
     <label class="block text-xs text-gray-700" for="password">
      <div class="flex items-center mb-1">
       <i class="fas fa-lock mr-2 text-gray-700">
       </i>
       Password
      </div>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500" id="password" name="password" placeholder="Password" required="" type="password"/>
     </label>
     <label class="block text-xs text-gray-700" for="confirm-password">
      <div class="flex items-center mb-1">
       <i class="fas fa-lock mr-2 text-gray-700">
       </i>
       Confirm Password
      </div>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required="" type="password"/>
     </label>
     <label class="block text-xs text-gray-700" for="shop-name">
      <div class="flex items-center mb-1">
       <i class="fas fa-store mr-2 text-gray-700">
       </i>
       Shop Name
      </div>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500" id="shop-name" name="shop_name" placeholder="Shop Name" required="" type="text"/>
     </label>
     <label class="block text-xs text-gray-700" for="shop-address">
      <div class="flex items-center mb-1">
       <i class="fas fa-map-marker-alt mr-2 text-gray-700">
       </i>
       Shop Address
      </div>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500" id="shop-address" name="shop_address" placeholder="Shop Address" required="" type="text"/>
     </label>
     <label class="block text-xs text-gray-700" for="shop-contact">
      <div class="flex items-center mb-1">
       <i class="fas fa-phone mr-2 text-gray-700">
       </i>
       Shop Contact Number
      </div>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-xs placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500" id="shop-contact" name="shop_contact_number" placeholder="Shop Contact Number" required="" type="tel" pattern="[0-9]{10}" title="Enter 10 digit phone number"/>
     </label>
	 
	 <label class="block text-xs text-gray-700" for="state-name">
      <div class="flex items-center mb-1">
       <i class="fas fa-flag-usa mr-2 text-gray-700">
       </i>
       State Name
      </div>
      <select class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500" id="state_id" name="state_id" required>
       <option value="">Select State</option>
    <?php while ($state = $stateQuery->fetch_assoc()): ?>
        <option value="<?= $state['state_id'] ?>"><?= htmlspecialchars($state['state_name']) ?></option>
    <?php endwhile; ?>
      </select>
     </label>
	 
	 
     <label class="block text-xs text-gray-700" for="city-name">
      <div class="flex items-center mb-1">
       <i class="fas fa-city mr-2 text-gray-700">
       </i>
       City Name
      </div>
      <select class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500" id="city_id" name="city_id" required>
       <option value="">Select City</option>
               
      </select>
     </label>
     
     <label class="block mb-4 text-xs text-gray-700" for="service-name">
      <div class="flex items-center mb-1">
       <i class="fas fa-concierge-bell mr-2 text-gray-700">
       </i>
       Service Name
      </div>
      <select class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500" id="service_name" name="service_name" required>
        <option value="">Select Service</option>
                <?php while ($service = $serviceQuery->fetch_assoc()): ?>
                    <option value="<?= $service['service_id'] ?>"><?= htmlspecialchars($service['service_name']) ?></option>
                <?php endwhile; ?>
      </select>
     </label>
    </div>
    <button class="mt-6 w-full bg-blue-600 text-white text-xs py-2 rounded hover:bg-blue-700 transition-colors" type="submit">
     Register
    </button>
    <p class="mt-2 text-[10px] text-gray-900 select-none">
     Already have an account?
     <a style="color: blue; text-decoration: underline;" href="vendorlogin.php">
      Login Here
     </a>
    </p>
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#state_id').change(function() {
    var stateId = $(this).val();
    if (stateId !== '') {
        $.ajax({
            url: '../includes/get_cities.php',
            method: 'POST',
            data: { state_id: stateId },
            success: function(response) {
                $('#city_id').html(response);
            }
        });
    } else {
        $('#city_id').html('<option value="">Select City</option>');
    }
});
</script>

</body>
</html>





