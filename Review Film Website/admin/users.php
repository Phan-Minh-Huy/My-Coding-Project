<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Handle user deletion
if (isset($_POST['delete_user_id'])) {
    try {
        deleteReviewer($pdo, $_POST['delete_user_id']);
        header('Location: users.php');
        exit();
    } catch (PDOException $e) {
        $error = "This user cannot be removed because they already have reviews!";
    }
}

$reviewers = getReviewers($pdo);
$title = 'Manage Users';

ob_start();
?>
<?php if (isset($error)): ?>
    <p style="color: #ef4444; font-weight: bold;"><?= $error ?></p>
<?php endif; ?>
<?php
include '../admin/admin_templated/admin_users.html.php';
$output = ob_get_clean();
include '../admin/admin_templated/admin_layout.html.php';
?>