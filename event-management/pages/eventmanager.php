<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EventManager Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />

    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<!--p>You are logged in as: <!?php echo htmlspecialchars($_SESSION['email']); ?></p-->

 <?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['emloggedin']) || $_SESSION['emloggedin'] !== true)
	{
    header('Location: emlogin.php'); // Redirect to login page
    exit;
}
?>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white fixed top-0 left-0 h-full overflow-auto">
            <div class="p-4 text-lg font-bold">EventManager Panel</div>

            <ul class="space-y-2 mt-4">
                
                
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('booking')">
                        <i class="fas fa-book mr-2"></i>
                        MY Booking
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('profile')">
                        <i class="fas fa-calendar-day mr-2"></i>
                        Profile
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('companyProfile')">
                        <i class="fas fa-building mr-2"></i>
                        Company Profile
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="EmLogin.php" class="flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10 ml-64 overflow-auto min-h-screen">
            <div id="booking" class="section ">
                <h1 class="text-2xl font-bold">MY Booking</h1>
                <br />
                &nbsp;
                <?php
                include '../includes/config.php';
				$eventmanagerId = $_SESSION['event_manager_id'];
                $sql = "SELECT 
    b.event_manager_id,
    u.name AS user_name,
    u.contact_number AS user_contact_number,
    u.email AS user_email,
    s.service_name,
    e.event_name,
    b.event_address,
    b.event_time,
    b.event_date,
    v.name AS vendor_name,
    v.email AS vendor_email,
    v.shop_contact_number AS vendor_contact_number,
    c.city_name,
    st.state_name
FROM booking b
JOIN user u ON b.user_id = u.user_id
JOIN event e ON b.event_id = e.event_id
JOIN vendorservicedetails vsd ON b.vs_id = vsd.vs_id
JOIN vendor v ON vsd.vendor_id = v.vendor_id
JOIN service s ON vsd.service_id = s.service_id
JOIN citymaster c ON b.city_id = c.city_id
JOIN statemaster st ON c.state_id = st.state_id
WHERE b.event_manager_id = $eventmanagerId;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="min-w-full bg-white border" align="center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="py-3 px-4 border-b">EventManager ID</th>';
                    echo '<th class="py-3 px-4 border-b">User Name</th>';
                    echo '<th class="py-3 px-4 border-b">UserContactNumber</th>';
                    echo '<th class="py-3 px-4 border-b">UserEmail</th>';
                    echo '<th class="py-3 px-4 border-b">ServiceName</th>';
                    echo '<th class="py-3 px-4 border-b">Event Name</th>';
                    echo '<th class="py-3 px-4 border-b">Event Address</th>';
                    echo '<th class="py-3 px-4 border-b">Event Time</th>';
					echo '<th class="py-3 px-4 border-b">Event Date</th>';
					
                    echo '<th class="py-3 px-4 border-b">Vendor Name</th>';
					
					echo '<th class="py-3 px-4 border-b">Vendor Email</th>';
                    echo '<th class="py-3 px-4 border-b">VendorContactnumber</th>';
                    echo '<th class="py-3 px-4 border-b">City Name</th>';
                    echo '<th class="py-3 px-4 border-b">State Name</th>';
                    
					
					
					
                    echo '<th class="py-3 px-4 border-b">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr align="center">';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_manager_id"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["user_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["user_contact_number"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["user_email"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["service_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_address"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_time"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_date"] . '</td>';
                       

						 echo '<td class="py-3 px-2 border-b">' . $row["vendor_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["vendor_email"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["vendor_contact_number"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["city_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["state_name"] . '</td>';
                       
						

					   echo '<td class="py-3 px-2 border-b">';?>
					   <br>
                       <button class="px-4 py-2 bg-red-500 text-white rounded" onclick="removeRow(this)">Cancel</button>
                        <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
				
				<script>
function removeRow(button) {
    // Find the row that contains the button
    var row = button.closest('tr');
    // Remove the row from the table
    row.remove();
}
</script>
				
            </div>

            

            <div id="profile" class="section hidden">
                <h1 class="text-2xl font-bold">Profile</h1>
				<?php
                include '../includes/config.php';


$eventmanagerId = $_SESSION['event_manager_id']; // Adjust based on your session setup

// Fetch current vendor data
$query = $conn->prepare("SELECT * FROM eventmanager WHERE event_manager_id = ?");
$query->bind_param("i", $eventmanagerId);
$query->execute();
$result = $query->get_result();
$eventmanager = $result->fetch_assoc();

// Dropdown data
$cityQuery = $conn->query("SELECT city_id, city_name FROM citymaster");
$stateQuery = $conn->query("SELECT state_id, state_name FROM statemaster");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ContactNumber = $_POST['contact_number'];
   $cityId = isset($_POST['city_id']) ? $_POST['city_id'] : null;
//$stateId = isset($_POST['state_id']) ? $_POST['state_id'] : null;


    $updateQuery = $conn->prepare("UPDATE eventmanager SET name = ?, email = ?, contact_number = ?, city_id = ? WHERE event_manager_id = ?");
$updateQuery->bind_param("ssiii", $name, $email, $ContactNumber, $cityId,  $eventmanagerId);

    
       if ($updateQuery->execute()) {
    echo "<script>alert('Profile updated successfully');</script>";
} else {
    echo "<script>alert('Error updating profile: " . addslashes($updateQuery->error) . "');</script>";
}
}
?>

		<section class="flex-1 p-6 flex justify-center items-start bg-gray-100">
      <form id="vendorForm" class="max-w-lg bg-white shadow-lg rounded-lg p-8 space-y-6 w-full" method="POST" action="">
        <h3 class="font-bold text-lg text-black mb-6 text-center border-b border-gray-300 pb-2">Profile</h3>
		
        <div>
          <label for="vendorName" class="block text-xs font-semibold mb-1 text-gray-700">EventManager Name</label>
          <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required />
        </div>
        <div>
          <label for="email" class="block text-xs font-semibold mb-1 text-gray-700">Email</label>
          <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required />
        </div>
        <div>
          <label for="shopContact" class="block text-xs font-semibold mb-1 text-gray-700">Contact Number</label>
          <input type="tel" id="contact" name="contact_number" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required />
        </div>
        
        
        <div>
          <label for="stateName" class="block text-xs font-semibold mb-1 text-gray-700">State Name</label>
           <select class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500" id="state_id" name="state_id" required>
       <option value="">Select State</option>
                <?php while ($state = $stateQuery->fetch_assoc()): ?>
                    <option value="<?= $state['state_id'] ?>"><?= htmlspecialchars($state['state_name']) ?></option>
                <?php endwhile; ?>
      </select>
      </div>
    <div>
          <label for="CityName" class="block text-xs font-semibold mb-1 text-gray-700">City Name </label>
           <select class="w-full border border-gray-300 rounded px-3 py-2 text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500" id="city_id" name="city_id" required>
       <option value="">Select City</option>
                
      </select>
         
            
        </div>
        
       
        <button type="submit" class="bg-[#1e2a35] text-white px-5 py-2 rounded text-sm font-semibold hover:bg-[#16222b] transition w-full">Update</button>
      </form>
    </section>
            
            </div>
            <div id="companyProfile" class="section hidden">
                <h1 class="text-2xl font-bold">Company Profile</h1>
                <div class="bg-white rounded-lg shadow-md p-8 max-w-4xl mx-auto">
                    <div class="mb-8">
                        <h3 class="text-3xl font-bold text-indigo-700 mb-4">Eventopia</h3>
                        <p class="text-gray-700 mb-4">
                            Eventopia is a dynamic event management company committed to delivering exceptional and personalized event experiences. We specialize in corporate events, weddings, product launches, and social gatherings.
                        </p>
                        <p class="text-gray-700 mb-4">
                            Our expert team combines creativity, technology, and meticulous planning to ensure every event is flawlessly executed. We collaborate with trusted vendors and venues to bring your vision to life.
                        </p>
                        <p class="text-gray-700 mb-4">
                            At Eventopia, we believe every event should be unique and memorable. From concept to completion, we handle all logistics so you can enjoy your special day stress-free.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-indigo-700 mb-4">Contact Information</h4>
                        <ul class="text-gray-700 space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-indigo-700"></i>
                                22/Akash Tower, Bodakdev, Ahmedabad
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone mr-3 text-indigo-700"></i>
                                +91 7874765836
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-indigo-700"></i>
                                eventopia@gmail.com.com
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-globe mr-3 text-indigo-700"></i>
                                www.eventopia.com
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10">
                        <h4 class="text-xl font-semibold text-indigo-700 mb-4">Our Mission</h4>
                        <p class="text-gray-700">
                            To create unforgettable events by combining innovation, passion, and flawless execution, ensuring every client’s vision becomes reality.
                        </p>
                    </div>
                </div>
            </div>

            <div id="logout" class="section hidden">
                <h1 class="text-2xl font-bold">Logout</h1>
                <p>You have been logged out.</p>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }
    </script>
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