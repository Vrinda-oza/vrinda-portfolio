<?php
// Start session to maintain state between page reloads
session_start();

// Initialize or toggle the state
if (!isset($_SESSION['button_state'])) {
    $_SESSION['button_state'] = 'off'; // Default state
}

if (isset($_POST['toggle'])) {
    // Toggle the state when button is clicked
    $_SESSION['button_state'] = ($_SESSION['button_state'] == 'on') ? 'off' : 'on';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toggle Button Example</title>
</head>
<body>
    <form method="post">
        <button type="submit" name="toggle">
            <?php echo ($_SESSION['button_state'] == 'on') ? 'ON' : 'OFF'; ?>
        </button>
    </form>
    
    <p>Current state: <?php echo strtoupper($_SESSION['button_state']); ?></p>
</body>
</html>