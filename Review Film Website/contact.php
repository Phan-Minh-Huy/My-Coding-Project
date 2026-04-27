<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
$title = 'Contact';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        insertContact($pdo, $name, $email, $message);
        $success = "✅ Message sent successfully!";
    } catch (PDOException $e) {
        $error = "❌ Error: " . $e->getMessage();
    }
}
ob_start();
include 'templated/contact.html.php';
