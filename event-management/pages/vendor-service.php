<?php
session_start();
require '../includes/config.php';
include '../includes/header.php';

// Fetch all vendor-service pairs with error handling
try {
    $vendor_services = $conn->query("
        SELECT 
            vs.vs_id,
            v.vendor_id,
            v.name AS vendor_name,
            v.shop_name,
            v.shop_contact_number,
            s.service_id,
            s.service_name,
            s.amount,
            c.city_name
        FROM vendorservicedetails vs
        JOIN vendor v ON vs.vendor_id = v.vendor_id
        JOIN service s ON vs.service_id = s.service_id
        JOIN citymaster c ON v.city_id = c.city_id
        ORDER BY s.service_name, v.name
    ");

    // Get unique services for filter
    $services = $conn->query("SELECT DISTINCT service_id, service_name FROM service ORDER BY service_name");
} catch (Exception $e) {
    die("Database error: " . $e->getMessage());
}
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Vendors & Services</h1>
    
    <!-- Filter Section -->
    <div class="row mb-4 g-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search vendors...">
                <button class="btn btn-burgundy" type="button" id="searchBtn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="serviceFilter">
                <option value="">All Services</option>
                <?php while($service = $services->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($service['service_id']) ?>">
                        <?= htmlspecialchars($service['service_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="priceSort">
                <option value="">Sort by</option>
                <option value="low">Price: Low to High</option>
                <option value="high">Price: High to Low</option>
            </select>
        </div>
    </div>

    <!-- Vendor Services Grid -->
    <div class="row g-4" id="vendorContainer">
        <?php while($vs = $vendor_services->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-4 vendor-card" 
                 data-service="<?= htmlspecialchars($vs['service_id']) ?>"
                 data-price="<?= htmlspecialchars($vs['amount']) ?>"
                 data-name="<?= htmlspecialchars(strtolower($vs['vendor_name'])) ?>">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-burgundy text-beige d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-truncate" style="max-width: 70%"><?= htmlspecialchars($vs['service_name']) ?></h5>
                        <span class="badge bg-beige text-dark fw-bold">₹<?= number_format($vs['amount']) ?></span>                    </div>
                    <div class="card-body">
                        <h6 class="text-burgundy mb-3">
                            <i class="fas fa-store-alt me-2"></i>
                            <?= htmlspecialchars($vs['vendor_name']) ?>
                            <?php if(!empty($vs['shop_name'])): ?>
                                <small class="text-muted d-block"><?= htmlspecialchars($vs['shop_name']) ?></small>
                            <?php endif; ?>
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                <?= htmlspecialchars($vs['city_name']) ?>
                            </li>
                            <li>
                                <i class="fas fa-phone-alt text-muted me-2"></i>
                                <?= htmlspecialchars($vs['shop_contact_number']) ?>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="booking.php?vs_id=<?= $vs['vs_id'] ?>" 
                           class="btn btn-sm btn-burgundy w-100">
                           Select for Booking
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Empty State -->
    <div class="text-center py-5 d-none" id="noResults">
        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
        <h4>No vendors found</h4>
        <p>Try adjusting your filters</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const serviceFilter = document.getElementById('serviceFilter');
    const priceSort = document.getElementById('priceSort');
    const vendorContainer = document.getElementById('vendorContainer');
    const noResults = document.getElementById('noResults');
    let vendorCards = Array.from(document.querySelectorAll('.vendor-card'));

    function updateResults() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const serviceId = serviceFilter.value;
        const sortOrder = priceSort.value;
        
        // Filter cards
        let results = vendorCards.filter(card => {
            const matchesSearch = card.dataset.name.includes(searchTerm);
            const matchesService = !serviceId || card.dataset.service === serviceId;
            return matchesSearch && matchesService;
        });

        // Sort results
        if (sortOrder === 'low') {
            results.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
        } else if (sortOrder === 'high') {
            results.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
        }

        // Update UI
        vendorContainer.innerHTML = '';
        results.forEach(card => vendorContainer.appendChild(card.cloneNode(true)));
        
        // Toggle empty state
        noResults.classList.toggle('d-none', results.length > 0);
    }

    // Event listeners
    searchInput.addEventListener('input', updateResults);
    searchBtn.addEventListener('click', updateResults);
    serviceFilter.addEventListener('change', updateResults);
    priceSort.addEventListener('change', updateResults);
});
</script>

<style>
.vendor-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.vendor-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(128, 0, 32, 0.1) !important;
}
.card-header h5 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.badge.bg-beige.text-dark {
    color: #212529 !important; /* Dark gray color */
    font-weight: bold;
    text-shadow: 0 1px 1px rgba(255,255,255,0.5); /* Improves readability */
}
</style>

<?php include '../includes/footer.php'; ?>