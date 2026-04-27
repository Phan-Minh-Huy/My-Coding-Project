<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateReviewer($pdo, $_POST['id'], $_POST['name'], $_POST['email']);
    header('Location: users.php');
    exit();
} else {
    $user = getReviewerById($pdo, $_GET['id']);
    $title = 'Edit User';
    ob_start();
?>
<?php
    include '../admin/admin_templated/admin_edituser.html.php';
    $output = ob_get_clean();
}
include '../admin/admin_templated/admin_layout.html.php';
?>