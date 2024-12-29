<?php
session_start();

// Ensure that admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // If no session for admin_id, redirect to admin login page
    header('Location: admin_login.php');
    exit();
}

// Include the database configuration file
include '../config/config.php'; // Adjust this path based on your setup
include '../includes/header.php'; // Adjust this path based on your setup


?>


    <h1>Welcome, Admin!</h1>

</div>

</body>
</html>
