<?php
session_start();
include '../includes/header.php';  // Include your header with the navigation

// Ensure that admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // If no session for admin_id, redirect to admin login page
    header('Location: admin_login.php');
    exit();
}

// Include the database configuration file
include '../config/config.php'; // Adjust this path based on your setup

// Fetch appointment data from the database, ordered by latest submission first
$sql = "SELECT * FROM appointments ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    h1 {
        color: #8A7A5C;
    }
</style>

<h1>Appointment Requests</h1>

<!-- Display the appointment requests in a table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Appointment Date</th>
            <th>Treatment</th>
            <th>Message</th>
            <th>Submitted At</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($appointments)): ?>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['email']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['phone']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['treatment']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['message']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No appointment requests found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
