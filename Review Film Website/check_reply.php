<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$title = 'Check Message';
$results = null;
$search_email = '';

if (isset($_POST['email'])) {
    $search_email = $_POST['email'];
    $results = getUserMessages($pdo, $search_email);
}

ob_start();
?>

<?php
include 'templated/check_reply.html.php';
$output = ob_get_clean();
include 'templated/layout.html.php';
