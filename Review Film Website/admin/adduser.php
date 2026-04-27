<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

$error_message = ''; // Variable to store error messages, if any.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Try to execute the user addition
        insertReviewer($pdo, $_POST['name'], $_POST['email']);

        // If successful, redirect back to the users list
        header('Location: users.php');
        exit();
    } catch (PDOException $e) {
        // If there's an error (especially a duplicate data error), catch it here
        if ($e->getCode() == 23000) {
            $error_message = "A user with this email already exists. Please use a different email.";
        } else {
            $error_message = "System error " . $e->getMessage();
        }
    }
}

$title = 'Add User';
ob_start();
?>
<?php
include '../admin/admin_templated/admin_adduser.html.php';
$output = ob_get_clean();
include '../admin/admin_templated/admin_layout.html.php';
?>