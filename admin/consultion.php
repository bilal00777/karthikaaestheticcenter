<?php
session_start();
include '../includes/header.php';

// Ensure that admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // If no session for admin_id, redirect to admin login page
    header('Location: admin_login.php');
    exit();
}

// Include the database configuration file
include '../config/config.php'; // Adjust this path based on your setup

// Fetch consultation data from the database, ordered by latest submission first
$sql = "SELECT * FROM consultations ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<h1>Consultion Requests</h1>

    <!-- Display the consultation requests in a table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Second Name</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Message</th>
                <th>Consent</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($consultations)): ?>
                <?php foreach ($consultations as $consultation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($consultation['id']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['second_name']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['email']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['message']); ?></td>
                        <td><?php echo $consultation['consent'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars($consultation['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No consultation requests found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

   
</body>
</html>
