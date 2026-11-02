<?php
include '../includes/config.php';
header('Content-Type: application/json');

if (isset($_GET['city_id'])) {
    $cityId = intval($_GET['city_id']);
    $result = $conn->query("SELECT * FROM eventmanager WHERE city_id = $cityId");
    $managers = [];
    while ($row = $result->fetch_assoc()) {
        $managers[] = $row;
    }
    echo json_encode($managers);
}
?>