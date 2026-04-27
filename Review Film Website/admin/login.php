<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    // Use your coursework password '12345' for admin login
    if ($password === '12345') {
        $_SESSION['admin_logged_in'] = true; // Grant access token
        header('Location: index.php');       // Redirect to admin panel
        exit();
    } else {
        $error = 'Wrong password. Please try again.';
    }
}
include '../admin/admin_templated/admin_login.html.php';
