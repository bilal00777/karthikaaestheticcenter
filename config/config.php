<?php
// config/config.php

$host = 'localhost';
$dbname = 'karthika';
$username = 'root';
$password = '';



// $host = 'localhost';
// $dbname = 'u566723939_karthika';
// $username = 'u566723939_karthika';
// $password = 'Heystu@960571';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
