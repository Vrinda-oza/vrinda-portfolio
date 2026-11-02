<!--?php
include 'config.php';

if (isset($_POST['state_id'])) {
    $stateId = $_POST['state_id'];

    $stmt = $conn->prepare("SELECT city_id, city_name FROM citymaster WHERE state_id = ?");
    $stmt->bind_param("i", $stateId);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<option value="">Select City</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['city_id'] . '">' . htmlspecialchars($row['city_name']) . '</option>';
    }
}
?-->
<?php
include '../includes/config.php';

if(isset($_POST["state_id"])) {
    $state_id = $_POST["state_id"];
    $query = "SELECT city_id, city_name FROM citymaster WHERE state_id = $state_id";
    $result = $conn->query($query);

    echo '<option value="">Select City</option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
    }
}
?>

