 <?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: AdminLogin.php');
    exit;
}
?>




<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <script>
function showSection(sectionId) {
    const sections = document.querySelectorAll(".section");

    sections.forEach(function(section) {
        section.style.display = "none";
    });

    const activeSection = document.getElementById(sectionId);

    if (activeSection) {
        activeSection.style.display = "block";
    }
}
</script>

</head>
<!--p>You are logged in as: <!?php echo htmlspecialchars($_SESSION['email']); --?></p-->



<body class="bg-gray-100">
     <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white fixed top-0 left-0 h-full overflow-auto">
            <div class="p-4 text-lg font-bold">Admin Panel</div>

            <ul class="space-y-2 mt-4">
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" onclick="showSection('dashboard'); return false;">

                        <i class="fas fa-tachometer-alt mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
    <a href="#" class="flex items-center" onclick="showSection('user'); return false;">
        <i class="fas fa-user mr-2"></i>
        User
    </a>
</li>

                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('eventManager');return false;">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Event Manager
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('vendor');return false;">
                        <i class="fas fa-store mr-2"></i>
                        Vendor
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('service');return false;">
                        <i class="fas fa-concierge-bell mr-2"></i>
                        Service
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('booking');return false;">
                        <i class="fas fa-book mr-2"></i>
                        Booking
                    </a>
                </li>

                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('event');return false;">
                        <i class="fas fa-calendar-day mr-2"></i>
                        Event
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="showSection('companyProfile');return false;">
                        <i class="fas fa-building mr-2"></i>
                        Company Profile
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700">
                    <a href="AdminLogin.php" class="flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10 ml-64 overflow-auto min-h-screen">
            <div id="dashboard" class="section">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <br />
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <section class="bg-indigo-700 text-white rounded-lg p-6 shadow-md">
                        <?php
                        
                        $sql = "SELECT COUNT(*) AS totalBookings FROM booking";
                        $result = $conn->query($sql);

                        $totalBookings = 0;
                        if ($result && $row = $result->fetch_assoc()) {
                            $totalBookings = $row['totalBookings'];
                        }

                        
                        ?>
                        <h3 class="font-bold text-lg mb-2">Total Booking</h3>
                        <div class="text-3xl font-extrabold"><?php echo $totalBookings; ?></div>
                    
					
					
					</section>



                    <section class="bg-teal-600 text-white rounded-lg p-6 shadow-md">
                        <?php
                        
                        $sql = "SELECT COUNT(*) AS totaleventmanager FROM eventmanager";
                        $result = $conn->query($sql);

                        $totaleventmanager = 0;
                        if ($result && $row = $result->fetch_assoc()) {
                            $totaleventmanager = $row['totaleventmanager'];
                        }

                       
                        ?>
                        <h3 class="font-bold text-lg mb-2">Total Event Manager</h3>
                        <div class="text-3xl font-extrabold"><?php echo $totaleventmanager; ?></div>
                    
					
					
					</section>
                    <section class="bg-emerald-600 text-white rounded-lg p-6 shadow-md">
                        <?php
                        
                        $sql = "SELECT COUNT(*) AS totalvendor FROM vendor";
                        $result = $conn->query($sql);

                        $totalvendor = 0;
                        if ($result && $row = $result->fetch_assoc()) {
                            $totalvendor = $row['totalvendor'];
                        }

                        
                        ?>
                        <h3 class="font-bold text-lg mb-2">Total Vendor</h3>
                        <div class="text-3xl font-extrabold"><?php echo $totalvendor; ?></div>
                    </section>
                    <section class="bg-rose-600 text-white rounded-lg p-6 shadow-md">
                        <?php
                        
                        $sql = "SELECT COUNT(*) AS totalservice FROM service";
                        $result = $conn->query($sql);

                        $totalservice = 0;
                        if ($result && $row = $result->fetch_assoc()) {
                            $totalservice = $row['totalservice'];
                        }

                        
                        ?>
                        <h3 class="font-bold text-lg mb-2">Total Service</h3>
                        <div class="text-3xl font-extrabold"><?php echo $totalservice; ?></div>
                    </section>
                    <section class="bg-cyan-600 text-white rounded-lg p-6 shadow-md">
                        <?php
                       
                        $sql = "SELECT COUNT(*) AS totalevent FROM event";
                        $result = $conn->query($sql);

                        $totalevent = 0;
                        if ($result && $row = $result->fetch_assoc()) {
                            $totalevent = $row['totalevent'];
                        }

                        
                        ?>
                        <h3 class="font-bold text-lg mb-2">Total Event</h3>
                        <div class="text-3xl font-extrabold"><?php echo $totalevent; ?></div>
                    </section>

                    <section class="bg-indigo-700 text-white rounded-lg p-6 shadow-md">
                        <?php
                        
                        $sql = "SELECT COUNT(*) AS totalUser FROM user";
                        $result = $conn->query($sql);

                        $totalUser = 0;
                        if ($result && $row = $result->fetch_assoc()) {
                            $totalUser = $row['totalUser'];
                        }

                        
                        ?>
                        <h3 class="font-bold text-lg mb-2">Total User</h3>
                        <div class="text-3xl font-extrabold"><?php echo $totalUser; ?></div>
                    
					
					
					</section>

                </div>
            </div>

           <div id="user" class="section" style="display:none;">

                <h1 class="text-2xl font-bold">Users</h1>
                &nbsp;
                <?php
                       
                        $sql = "SELECT user_id, name , email,contact_number FROM user";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="min-w-full bg-white border" align="center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="py-3 px-4 border-b">User ID</th>';
                    echo '<th class="py-3 px-4 border-b">Name</th>';
                    echo '<th class="py-3 px-4 border-b">Email</th>';
                    echo '<th class="py-3 px-4 border-b">contact</th>';
                    echo '<th class="py-3 px-4 border-b">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr align="center">';
                        echo '<td class="py-3 px-2 border-b">' . $row["user_id"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["email"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["contact_number"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">';
                        ?>
                        <a href="delete_user.php?deleteid=<?php echo $row['user_id'] ?>" class="px-4 py-2 bg-red-500 text-white rounded">Delete</a>
                        <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "0 results";
                }
               
                ?>
            </div>

            <div id="eventManager" class="section"style="display:none;">
                <h1 class="text-2xl font-bold">Event Managers</h1>
                &nbsp;
                <?php
                       
                        $sql = "SELECT 
                    EM.event_manager_id,
                    EM.name, 
                    EM.email, 
                    EM.contact_number, 
                    C.city_name, 
                    S.state_name
                FROM 
                    eventmanager EM
                JOIN 
                    citymaster C ON EM.city_id = C.city_id
                JOIN 
                    statemaster S ON S.state_id = C.state_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="min-w-full bg-white border" align="center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="py-3 px-4 border-b">Event Manager ID</th>';
                    echo '<th class="py-3 px-4 border-b">Name</th>';
                    echo '<th class="py-3 px-4 border-b">Email</th>';
                    echo '<th class="py-3 px-4 border-b">City</th>';
                    echo '<th class="py-3 px-4 border-b">State</th>';
                    echo '<th class="py-3 px-4 border-b">Contact</th>';
                    echo '<th class="py-3 px-4 border-b">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr align="center">';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_manager_id"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["email"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["city_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["state_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["contact_number"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">';
                        ?>
                        <a href="delete_eventmanager.php?deleteid=<?php echo $row['event_manager_id'] ?>" class="px-4 py-2 bg-red-500 text-white rounded">Delete</a>
                        <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "0 results";
                }
               
                ?>
            </div>

            <div id="vendor" class="section"style="display:none;">
                <h1 class="text-2xl font-bold">Vendors</h1>
                &nbsp;
               <?php
                        

$sql = "SELECT 
            v.vendor_id,
            v.name AS name,
            v.email,
            v.shop_name,
            v.shop_address,
            v.shop_contact_number,
            c.city_name,
            st.state_name,
            S.service_name
        FROM 
            vendor v
        JOIN 
            citymaster c ON v.city_id = c.city_id
        JOIN 
            statemaster st ON c.state_id = st.state_id
        JOIN 
            service S ON v.service_id = S.service_id"; 
        
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="min-w-full bg-white border" align="center">';
    echo '<thead>';
    echo '<tr>';
    echo '<th class="py-3 px-4 border-b">Vendor ID</th>';
    echo '<th class="py-3 px-4 border-b">Vendor Name</th>';
    echo '<th class="py-3 px-4 border-b">Vendor Email</th>';
    echo '<th class="py-3 px-4 border-b">Shop Name</th>';
    echo '<th class="py-3 px-4 border-b">Shop Address</th>';
    echo '<th class="py-3 px-4 border-b">Shop Contact Number</th>';
    echo '<th class="py-3 px-4 border-b">City Name</th>';
    echo '<th class="py-3 px-4 border-b">State Name</th>';
    echo '<th class="py-3 px-4 border-b">Service Name</th>'; 
    echo '<th class="py-3 px-4 border-b">Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr align="center">';
        echo '<td class="py-3 px-2 border-b">' . $row["vendor_id"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["name"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["email"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["shop_name"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["shop_address"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["shop_contact_number"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["city_name"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["state_name"] . '</td>';
        echo '<td class="py-3 px-2 border-b">' . $row["service_name"] . '</td>'; // New Column Data
        echo '<td class="py-3 px-2 border-b">';
        ?>
        <a href="delete_vendor.php?deleteid=<?php echo $row['vendor_id'] ?>" class="px-4 py-2 bg-red-500 text-white rounded">Delete</a>
        <?php
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo "0 results";
}

?>
            </div>

            <div id="service" class="section"style="display:none;">
                <h1 class="text-2xl font-bold">Service</h1>
                <button class="bg-blue-500 text-white px-4 py-2 rounded mb-4" onclick="document.getElementById('addServiceForm').classList.toggle('hidden')">Add Service</button>
                <div id="addServiceForm" class="hidden">
                    <form class="bg-white p-6 rounded shadow-md" method="POST" action="">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="serviceName">Service Name</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="serviceName" name="serviceName"type="text" placeholder="Enter Service Name" />
                        </div>
						<div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="serviceName">Service Amount</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="serviceAmount" name="serviceAmount"type="text" placeholder="Enter Service Amount" />
                        </div>
                        <div class="flex items-center justify-between">
                            <button name="btnaddservice" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
								ADD
							   
                            </button>
							
							<?php
                        

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnaddservice'])) {
    $serviceName = $_POST['serviceName'];
    $Amount = $_POST['serviceAmount'];

    // Ensure to use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO service (service_name, amount) VALUES (?, ?)");
    $stmt->bind_param("si", $serviceName, $Amount);

    if ($stmt->execute()) {
        echo "<script>alert('Service inserted successfully');</script>";
        echo "<script>document.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    
}
?>
                        </div>
                    </form>
                </div>

                <?php
                        
                        $sql = "SELECT service_id , service_name,amount from service ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="min-w-full bg-white border" align="center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="py-3 px-4 border-b">Service ID</th>';
                    echo '<th class="py-3 px-4 border-b">Service Name</th>';
                    echo '<th class="py-3 px-4 border-b">Amount</th>';
                    echo '<th class="py-3 px-4 border-b">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr align="center">';
                        echo '<td class="py-3 px-2 border-b">' . $row["service_id"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["service_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["amount"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">';
                        ?>
                        <a href="delete_service.php?deleteid=<?php echo $row['service_id'] ?>" class="px-4 py-2 bg-red-500 text-white rounded">Delete</a>
                        <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "0 results";
                }
                
                ?>
            </div>

           <div id="booking" class="section" style="display:none;">

                <h1 class="text-2xl font-bold">Bookings</h1>
                &nbsp;
                <?php
                    
                    $sql = "SELECT 
                    b.booking_id,
                    b.status,
                    u.name AS user_name,
                    --v.shop_name,
                    --s.service_name,
                     GROUP_CONCAT(DISTINCT v.shop_name SEPARATOR ', ') AS shop_name,
                     GROUP_CONCAT(DISTINCT s.service_name SEPARATOR ', ') AS service_name,
                    e.event_name,
                    b.event_address,
                    st.state_name,
                    c.city_name,
                    b.event_date,
                    b.advance_payment,
                    b.event_time,
                    b.payment_date,
                    b.payment_time,
					em.name AS event_manager_name,
					b.actual_payment
            
                FROM 
                    booking b
                    JOIN
                     bookingdetails bd ON b.booking_id = bd.booking_id
                      

				JOIN 
						eventmanager em ON b.event_manager_id = em.event_manager_id
                JOIN 
                    user u ON b.user_id = u.user_id
                JOIN 
                    vendorservicedetails vs ON bd.vs_id = vs.vs_id
                JOIN 
                    vendor v ON vs.vendor_id = v.vendor_id
                JOIN 
                    service s ON vs.service_id = s.service_id
                JOIN 
                    event e ON b.event_id = e.event_id
                JOIN 
                    citymaster c ON b.city_id = c.city_id
                JOIN 
                    statemaster st ON c.state_id = st.state_id
                    GROUP BY b.booking_id
                    ORDER BY b.booking_id ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="min-w-full bg-white border" align="center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="py-3 px-4 border-b">Booking ID</th>';
                    echo '<th class="py-3 px-4 border-b">User Name</th>';
                    echo '<th class="py-3 px-4 border-b">Vendor Shop Name</th>';
					echo '<th class="py-3 px-4 border-b">Event Manager  Name</th>';
                    echo '<th class="py-3 px-4 border-b">Service Name</th>';
                    echo '<th class="py-3 px-4 border-b">Event Name</th>';
                    echo '<th class="py-3 px-4 border-b">Event Address</th>';
                    echo '<th class="py-3 px-4 border-b">State Name</th>';
                    echo '<th class="py-3 px-4 border-b">City Name</th>';
                    echo '<th class="py-3 px-4 border-b">Event Date</th>';
                    echo '<th class="py-3 px-4 border-b">Advance Payment</th>';
                    echo '<th class="py-3 px-4 border-b">Event Time</th>';
                    echo '<th class="py-3 px-4 border-b">payment Date</th>';
                    echo '<th class="py-3 px-4 border-b">payment Time</th>';
                    echo '<th class="py-3 px-4 border-b">Actual Payment</th>';
                    echo '<th class="py-3 px-4 border-b">Status</th>';
                    echo '<th class="py-3 px-4 border-b">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr align="center">';
                        echo '<td class="py-3 px-2 border-b">' . $row["booking_id"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["user_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["shop_name"] . '</td>';
						echo '<td class="py-3 px-2 border-b">' . $row["event_manager_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["service_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_address"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["state_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["city_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_date"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["advance_payment"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_time"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["payment_date"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["payment_time"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["actual_payment"] . '</td>';
                       
                        echo '<td class="py-3 px-2 border-b">';
                        $status = $row["status"] ?? 'pending'; // Default to pending
                        $statusData = [
                            'pending' => [
                                'text' => 'Pending',
                                'color' => 'bg-yellow-500 hover:bg-yellow-600',
                                'next' => 'approved',
                                'confirm' => 'Are you sure you want to approve this booking?'
                            ],
                            'approved' => [
                                'text' => 'Approved',
                                'color' => 'bg-green-500 hover:bg-green-600',
                                'next' => 'cancelled',
                                'confirm' => 'Are you sure you want to cancel this booking?'
                            ],
                            'cancelled' => [
                                'text' => 'Cancelled',
                                'color' => 'bg-red-500',
                                'next' => null, // No next state
                                'confirm' => null // No confirmation needed
                            ]
                        ];
                        
                        $buttonClass = 'px-4 py-2 text-white rounded transition-colors duration-200 ' . $statusData[$status]['color'];
                        if ($status === 'cancelled') {
                            echo '<button class="'.$buttonClass.'" disabled>'.$statusData[$status]['text'].'</button>';
                        } else {
                            echo '<button onclick="updateBookingStatus(this, '.$row['booking_id'].', \''.$statusData[$status]['next'].'\', \''.$statusData[$status]['confirm'].'\')" 
                                  class="'.$buttonClass.'">
                                  '.$statusData[$status]['text'].'
                                  </button>';
                        }
                        echo '</td>';
                        ?>
		<?php echo '<td class="py-3 px-2 border-b">';
                        ?>
                        <a href="delete_booking.php?deleteid=<?php echo $row['booking_id'] ?>" class="px-4 py-2 bg-red-500 text-white rounded">Delete</a>
                        <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "0 results";
                }
                
                ?>
    


				<script>
        function showApprovedMessage(button) {
            // Change button text and class
            button.innerHTML = "Approved";
            button.classList.remove("bg-red-500");
            button.classList.add("bg-green-500");
            
            // Show the approval message
           // document.getElementById("approvalMessage").innerHTML = "Approved!";
        }
    </script>
            </div>

            <div id="event" class="section"style="display:none;">
                <h1 class="text-2xl font-bold">Events</h1>

                <button class="bg-blue-500 text-white px-4 py-2 rounded mb-4" onclick="document.getElementById('addEventForm').classList.toggle('hidden')">Add Event</button>
                <div id="addEventForm" class="hidden">
                    <form class="bg-white p-6 rounded shadow-md" method="POST" action="">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="eventName">Event Name</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="eventName" id="eventName" type="text" placeholder="Enter Event Name" />
                        </div>
                        <div class="flex items-center justify-between">
                            <button name="btnaddevent" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                ADD
                            </button>
							<?php
                        

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnaddevent'])) {
    $eventName = $_POST['eventName'];

    // Ensure to use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO event (event_name) VALUES (?)");
    $stmt->bind_param("s", $eventName);

    if ($stmt->execute()) {
        echo "<script>alert('Event inserted successfully');</script>";
        echo "<script>document.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    
}
?>
                        </div>
                    </form>
                </div>

                <?php
                       
                        $sql = "SELECT event_id, event_name FROM event";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<table class="min-w-full bg-white border" align="center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th class="py-3 px-4 border-b">Event ID</th>';
                    echo '<th class="py-3 px-4 border-b">Event Name</th>';
                    echo '<th class="py-3 px-4 border-b">Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr align="center">';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_id"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">' . $row["event_name"] . '</td>';
                        echo '<td class="py-3 px-2 border-b">';
                        ?>
                        <a href="delete_event.php?deleteid=<?php echo $row['event_id'] ?>" class="px-4 py-2 bg-red-500 text-white rounded">Delete</a>
                        <?php
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "0 results";
                }
               
                ?>
            </div>

            <div id="companyProfile" class="section"style="display:none;">
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
                                eventopia@gmail.com
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
	<div id="logout" class="section" style="display:none;">
    	<h1 class="text-2xl font-bold">Logout</h1>
    	<p>You have been logged out.</p>
	</div>

        </div>
    </div>

    <script>
function updateBookingStatus(button, bookingId, newStatus, confirmationMessage) {
    // Show confirmation dialog
    if (confirmationMessage && !confirm(confirmationMessage)) {
        return; // User cancelled the action
    }

    // Show loading state
    const originalText = button.textContent;
    button.textContent = 'Updating...';
    button.disabled = true;
    
    fetch('update_booking_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'booking_id=' + bookingId + '&status=' + newStatus
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Define status properties
            const statusProperties = {
                'pending': {
                    text: 'Pending',
                    color: 'bg-yellow-500 hover:bg-yellow-600',
                    next: 'approved',
                    confirm: 'Are you sure you want to approve this booking?'
                },
                'approved': {
                    text: 'Approved',
                    color: 'bg-green-500 hover:bg-green-600',
                    next: 'cancelled',
                    confirm: 'Are you sure you want to cancel this booking?'
                },
                'cancelled': {
                    text: 'Cancelled',
                    color: 'bg-red-500',
                    next: null,
                    confirm: null
                }
            };

            // Update button appearance and behavior
            button.textContent = statusProperties[newStatus].text;
            button.className = button.className.replace(
                /bg-(yellow|green|red)-500( hover:bg-(yellow|green|red)-600)?/, 
                statusProperties[newStatus].color
            );
            
            if (newStatus === 'cancelled') {
                button.disabled = true;
                button.onclick = null;
            } else {
                button.onclick = function() {
                    updateBookingStatus(
                        button, 
                        bookingId, 
                        statusProperties[newStatus].next,
                        statusProperties[newStatus].confirm
                    );
                };
            }
            
            // Show success message
            alert('Status updated successfully!');
        } else {
            throw new Error(data.message || 'Update failed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: ' + error.message);
        button.textContent = originalText;
    })
    .finally(() => {
        if (newStatus !== 'cancelled') {
            button.disabled = false;
        }
    });
}
</script>



<?php $conn->close(); ?>

</body>
</html>