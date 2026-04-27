<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

// Handle contact deletion
if (isset($_POST['delete_contact_id'])) {
    deleteContact($pdo, $_POST['delete_contact_id']);
    header('Location: contacts.php');
    exit();
}

$contacts = getContacts($pdo);
$title = 'Manage Messages';

ob_start();
?>

<?php
include '../admin/admin_templated/admin_contacts.html.php';
$output = ob_get_clean();
include '../admin/admin_templated/admin_layout.html.php';
?>