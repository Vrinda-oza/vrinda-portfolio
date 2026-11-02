<?php
include '../includes/config.php';
header('Content-Type: application/json');

if (isset($_GET['city_id'])) {
    $cityId = intval($_GET['city_id']);
    $query = "
        SELECT vs.vs_id, v.name AS vendor_name, s.service_name, s.amount 
        FROM vendorservicedetails vs
        JOIN vendor v ON vs.vendor_id = v.vendor_id
        JOIN service s ON vs.service_id = s.service_id
        WHERE v.city_id = $cityId
    ";
    $result = $conn->query($query);
    $services = [];
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
    echo json_encode($services);
}
?>