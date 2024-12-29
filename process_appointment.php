<?php
// Start the session to store messages
session_start();

// Include the database connection file
include 'config/config.php'; // Adjust the path as per your file structure

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $appointment_date = $_POST['appointment_date'];
    $treatment = $_POST['treatment'];
    $message = $_POST['message'];

    // Validate required fields
    if (empty($full_name) || empty($email) || empty($phone) || empty($appointment_date) || empty($treatment)) {
        $_SESSION['error_message'] = "Please fill in all required fields.";
        header('Location: Appointment.php'); // Redirect back to the form
        exit();
    }

    // Insert the appointment data into the database
    $sql = "INSERT INTO appointments (full_name, email, phone, appointment_date, treatment, message)
            VALUES (:full_name, :email, :phone, :appointment_date, :treatment, :message)";

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Bind the form data to the SQL statement
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':appointment_date', $appointment_date);
    $stmt->bindParam(':treatment', $treatment);
    $stmt->bindParam(':message', $message);

    // Try to execute the statement and catch any errors
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Your appointment request has been submitted successfully!";
        header('Location: Appointment.php'); // Redirect back to the form or to a success page
        exit();
    } else {
        $_SESSION['error_message'] = "There was an error submitting your appointment. Please try again.";
        header('Location: Appointment.php'); // Redirect back to the form
        exit();
    }
} else {
    // If the form wasn't submitted, redirect back to the form
    header('Location: Appointment.php');
    exit();
}
?>
