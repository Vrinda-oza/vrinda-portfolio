<?php
include '../includes/header.php';
?>

<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4">
            <h1 class="display-4 mb-4 text-burgundy">Our Story</h1>
            <p class="lead">Eventopia transforms ordinary moments into unforgettable experiences.</p>
            <p>Founded in 2023, we've curated over 500 events with a 98% satisfaction rate. Our team of certified event managers and vendor network ensures flawless execution.</p>
            
            <div class="mt-4">
                <div class="d-flex mb-3">
                    <div class="me-3 text-burgundy">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="h6 mb-1">Premium Vendors</h5>
                        <small>Verified professionals only</small>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="me-3 text-burgundy">
                        <i class="fas fa-rupee-sign fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="h6 mb-1">Transparent Pricing</h5>
                        <small>No hidden costs</small>
                    </div>
                </div>
                <div>
                        <h4 class="text-xl font-semibold text-indigo-700 mb-4">Contact Information</h4>
                        <ul class="text-gray-700 space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-indigo-700"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;22/Akash Tower, Bodakdev, Ahmedabad
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone mr-3 text-indigo-700"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91 7874765836
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-indigo-700"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;eventopia@gmail.com
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-globe mr-3 text-indigo-700"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;www.eventopia.com
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="about-image rounded overflow-hidden shadow-lg">
                <img src="../assets/images/team.jfif" alt="Eventopia Team" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="bg-burgundy text-beige rounded-circle p-3 mx-auto mb-3" style="width: 80px;">
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                    <h3 class="h5">500+ Events</h3>
                    <p class="small">Successfully organized</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="bg-burgundy text-beige rounded-circle p-3 mx-auto mb-3" style="width: 80px;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="h5">50+ Managers</h3>
                    <p class="small">Certified professionals</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="bg-burgundy text-beige rounded-circle p-3 mx-auto mb-3" style="width: 80px;">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                    <h3 class="h5">15 Cities</h3>
                    <p class="small">Across India</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.about-image {
    border: 5px solid white;
    box-shadow: 0 10px 30px rgba(128, 0, 32, 0.1);
}
.about-image img {
    transition: transform 0.5s;
}
.about-image:hover img {
    transform: scale(1.05);
}
</style>

<?php include '../includes/footer.php'; ?>