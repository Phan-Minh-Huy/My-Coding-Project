<?php
try {
    include 'check.php';
    include '../includes/DatabaseConnection.php';
    include '../includes/DatabaseFunctions.php';

    $title = 'Admin Panel';

    $reviews = getReviews($pdo);

    ob_start();
?>

<?php
    include '../admin/admin_templated/admin_index.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {

    $title = 'Database error';
    $output = $e->getMessage();
}

include '../admin/admin_templated/admin_layout.html.php';
?>