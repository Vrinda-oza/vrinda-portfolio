<?php
session_start();
include '../includes/config.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: UserLogin.php");
    exit;
}

// Get all states for the dropdown
$states = $conn->query("SELECT * FROM statemaster");
$events = $conn->query("SELECT * FROM event");
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Book Your Event</h1>
    
    <form id="bookingForm" action="process_booking.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

        <!-- State Selection -->
        <div class="card mb-4">
            <div class="card-header bg-burgundy text-beige">
                <h2 class="h5 mb-0">1. Select State</h2>
            </div>
            <div class="card-body">
                <select class="form-select" id="stateSelect" name="state_id" required>
                    <option value="" disabled selected>Select state</option>
                    <?php while($row = $states->fetch_assoc()): ?>
                        <option value="<?= $row['state_id'] ?>">
                            <?= htmlspecialchars($row['state_name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <!-- City Selection -->
        <div class="card mb-4">
            <div class="card-header bg-burgundy text-beige">
                <h2 class="h5 mb-0">2. Select City</h2>
            </div>
            <div class="card-body">
                <select class="form-select" id="citySelect" name="city_id" required disabled>
                    <option value="" disabled selected>First select a state</option>
                </select>
            </div>
        </div>

        <!-- Event Manager Section -->
        <div class="card mb-4">
            <div class="card-header bg-burgundy text-beige">
                <h2 class="h5 mb-0">3. Choose Event Manager</h2>
            </div>
            <div class="card-body">
                <select class="form-select" id="managerSelect" name="event_manager_id" required disabled>
                    <option value="" disabled selected>First select a city</option>
                </select>
            </div>
        </div>

        <!-- Vendor Services Section -->
        <div class="card mb-4">
            <div class="card-header bg-burgundy text-beige">
                <h2 class="h5 mb-0">4. Select Services</h2>
            </div>
            <div class="card-body">
                <div class="row g-3" id="servicesContainer">
                    <div class="col-12">
                        <p class="text-muted">Please select a city first to see available services</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Details Section -->
        <div class="card mb-4">
            <div class="card-header bg-burgundy text-beige">
                <h2 class="h5 mb-0">4. Event Details</h2>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Event Type</label>
                        <select class="form-select" name="event_id" required>
                            <?php while($row = $events->fetch_assoc()): ?>
                                <option value="<?= $row['event_id'] ?>">
                                    <?= htmlspecialchars($row['event_name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date</label>
                        <input type="date" 
                               class="form-control" 
                               name="event_date" 
                               min="<?= date('Y-m-d') ?>"
                               required
                               oninvalid="this.setCustomValidity('Please select a valid date')"
                               onchange="this.setCustomValidity('')">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Time</label>
                        <input type="time" class="form-control" name="event_time" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="event_address" maxlength="30" required>
                    </div>
                   
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="card mb-4">
            <div class="card-header bg-burgundy text-beige">
                <h2 class="h5 mb-0">5. Payment</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="fw-bold">Total: ₹<span id="totalAmount">0</span></p>
                        <p class="text-muted">25% advance: ₹<span id="advanceAmount">0</span></p>
                    </div>
                    <div class="col-md-6">
                        <div class="qr-payment-box text-center p-3 border rounded bg-light">
                            <img src="../assets/images/qr.jpeg" alt="Payment QR" class="img-fluid mb-2" style="max-width: 180px;">
                            <p class="small mb-1">Scan to pay advance via UPI</p>
                            <p class="mb-0 fw-bold">eventopia@oksbi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-burgundy w-100 py-3">Confirm Booking</button>
        </form>
</div>

<script>
// When state changes, update cities
document.getElementById('stateSelect').addEventListener('change', function() {
    const stateId = this.value;
    
    if (!stateId) {
        // Reset all dependent fields if no state is selected
        document.getElementById('citySelect').innerHTML = '<option value="" disabled selected>First select a state</option>';
        document.getElementById('citySelect').disabled = true;
        document.getElementById('managerSelect').innerHTML = '<option value="" disabled selected>First select a city</option>';
        document.getElementById('managerSelect').disabled = true;
        document.getElementById('servicesContainer').innerHTML = '<div class="col-12"><p class="text-muted">Please select a city first to see available services</p></div>';
        return;
    }
    
    // Load cities
    fetchCities(stateId);
});

// When city changes, update managers and services
document.getElementById('citySelect').addEventListener('change', function() {
    const cityId = this.value;
    
    if (!cityId) {
        document.getElementById('managerSelect').innerHTML = '<option value="" disabled selected>First select a city</option>';
        document.getElementById('managerSelect').disabled = true;
        document.getElementById('servicesContainer').innerHTML = '<div class="col-12"><p class="text-muted">Please select a city first to see available services</p></div>';
        return;
    }
    
    // Load managers
    fetchManagers(cityId);
    
    // Load services
    fetchServices(cityId);
});

function fetchCities(stateId) {
    const citySelect = document.getElementById('citySelect');
    citySelect.disabled = true;
    citySelect.innerHTML = '<option value="">Loading cities...</option>';
    
    fetch('../includes/get_cities.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'state_id=' + stateId
    })
    .then(response => response.text())
    .then(data => {
        citySelect.innerHTML = data;
        citySelect.disabled = false;
    })
    .catch(error => {
        citySelect.innerHTML = '<option value="">Error loading cities</option>';
        console.error('Error:', error);
    });
}

function fetchManagers(cityId) {
    const managerSelect = document.getElementById('managerSelect');
    managerSelect.disabled = true;
    managerSelect.innerHTML = '<option value="">Loading managers...</option>';
    
    fetch('../includes/get_managers.php?city_id=' + cityId)
    .then(response => response.json())
    .then(data => {
        let options = '<option value="" disabled selected>Select manager</option>';
        data.forEach(manager => {
            options += `<option value="${manager.event_manager_id}">
                          ${manager.name}
                       </option>`;
        });
        managerSelect.innerHTML = options;
        managerSelect.disabled = false;
    })
    .catch(error => {
        managerSelect.innerHTML = '<option value="">Error loading managers</option>';
        console.error('Error:', error);
    });
}

function fetchServices(cityId) {
    const servicesContainer = document.getElementById('servicesContainer');
    servicesContainer.innerHTML = '<div class="col-12"><p class="text-muted">Loading services...</p></div>';
    
    fetch('../includes/get_vendor_services.php?city_id=' + cityId)
    .then(response => response.json())
    .then(data => {
        if (data.length === 0) {
            servicesContainer.innerHTML = '<div class="col-12"><p class="text-muted">No services available in this city</p></div>';
            return;
        }
        
        let html = '';
        data.forEach(service => {
            html += `
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input service-checkbox" 
                               type="checkbox" 
                               name="vs_id[]" 
                               value="${service.vs_id}"
                               data-price="${service.amount}"
                               id="service_${service.vs_id}">
                        <label class="form-check-label" for="service_${service.vs_id}">
                            ${service.vendor_name} - 
                            ${service.service_name} 
                            (₹${service.amount})
                        </label>
                    </div>
                </div>
            `;
        });
        servicesContainer.innerHTML = html;
        
        // Reattach event listeners to the new checkboxes
        document.querySelectorAll('.service-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updatePricing);
        });
    })
    .catch(error => {
        servicesContainer.innerHTML = '<div class="col-12"><p class="text-muted">Error loading services</p></div>';
        console.error('Error:', error);
    });
}

function updatePricing() {
    let total = 0;
    document.querySelectorAll('.service-checkbox:checked').forEach(checkbox => {
        total += parseFloat(checkbox.dataset.price);
    });
    
    // Add manager fee (5000) to the total
    total += 5000;
    
    const advance = total * 0.25;
    const balance = total * 0.75;
    
    document.getElementById('totalAmount').textContent = total.toFixed(2);
    document.getElementById('advanceAmount').textContent = advance.toFixed(2);
    document.getElementById('balanceAmount').textContent = balance.toFixed(2);
}
</script>

<?php include '../includes/footer.php'; ?>