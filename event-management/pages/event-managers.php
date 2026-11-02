<?php
session_start();
require '../includes/config.php';
include '../includes/header.php';

// Fetch all event managers with their cities
$managers = $conn->query("
    SELECT em.*, c.city_name, s.state_name 
    FROM eventmanager em
    JOIN citymaster c ON em.city_id = c.city_id
    JOIN statemaster s ON c.state_id = s.state_id
    ORDER BY em.name
");
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Our Event Managers</h1>
    
    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name...">
                <button class="btn btn-burgundy" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <select class="form-select" id="cityFilter">
                <option value="">All Cities</option>
                <?php
                $cities = $conn->query("SELECT DISTINCT c.city_id, c.city_name 
                                      FROM citymaster c
                                      JOIN eventmanager em ON em.city_id = c.city_id
                                      ORDER BY c.city_name");
                while($city = $cities->fetch_assoc()): ?>
                    <option value="<?= $city['city_id'] ?>"><?= htmlspecialchars($city['city_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>

    <!-- Managers Grid -->
    <div class="row g-4" id="managersContainer">
        <?php while($manager = $managers->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-4 manager-card" 
                 data-city="<?= $manager['city_id'] ?>" 
                 data-name="<?= strtolower($manager['name']) ?>">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-burgundy text-beige">
                        <h5 class="mb-0"><?= htmlspecialchars($manager['name']) ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light-burgundy text-burgundy rounded-circle p-3 me-3">
                                <i class="fas fa-user-tie fa-lg"></i>
                            </div>
                            <div>
                                <p class="mb-1">
                                    <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                    <?= htmlspecialchars($manager['city_name']) ?>, <?= htmlspecialchars($manager['state_name']) ?>
                                </p>
                                <p class="mb-1">
                                    <i class="fas fa-phone-alt text-muted me-2"></i>
                                    <?= htmlspecialchars($manager['contact_number']) ?>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-envelope text-muted me-2"></i>
                                    <?= htmlspecialchars($manager['email']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="booking.php?manager=<?= $manager['event_manager_id'] ?>" 
                           class="btn btn-sm btn-burgundy w-100">
                           Book This Manager
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Empty State -->
    <div class="text-center py-5 d-none" id="noResults">
        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
        <h4>No managers found</h4>
        <p>Try adjusting your search or filters</p>
    </div>
</div>

<!-- JavaScript for Filtering -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const cityFilter = document.getElementById('cityFilter');
    const managerCards = document.querySelectorAll('.manager-card');
    const noResults = document.getElementById('noResults');

    function filterManagers() {
        const searchTerm = searchInput.value.toLowerCase();
        const cityId = cityFilter.value;
        let visibleCount = 0;

        managerCards.forEach(card => {
            const matchesSearch = card.dataset.name.includes(searchTerm);
            const matchesCity = cityId === '' || card.dataset.city === cityId;
            
            if (matchesSearch && matchesCity) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        noResults.classList.toggle('d-none', visibleCount > 0);
    }

    searchInput.addEventListener('input', filterManagers);
    cityFilter.addEventListener('change', filterManagers);
    document.getElementById('searchButton').addEventListener('click', filterManagers);
});
</script>

<style>
.bg-light-burgundy {
    background-color: rgba(128, 0, 32, 0.1);
}
.manager-card {
    transition: transform 0.3s;
}
.manager-card:hover {
    transform: translateY(-5px);
}
</style>

<?php include '../includes/footer.php'; ?>