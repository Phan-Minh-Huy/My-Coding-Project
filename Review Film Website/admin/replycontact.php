<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $reply_text = $_POST['reply'];
    $user_email = $_POST['user_email'];
    $user_name = $_POST['user_name'];

    try {
        // 1. Save reply to Database
        updateContactReply($pdo, $id, $reply_text);

        // 2. Send Email to user (Similar to contact.php)
        $to = $user_email;
        $subject = "Reply from Admin - Film Review Website";
        $body = "Hello $user_name,\n\nHere is the response to your message:\n\n$reply_text\n\nBest regards,\nAdmin Team";
        $headers = "From: admin@filmreview.com";

        // Use @mail to hide errors because XAMPP has not configured to send real mail
        @mail($to, $subject, $body, $headers);

        header('Location: contacts.php');
        exit();
    } catch (PDOException $e) {
        $title = 'Database error';
        $output = $e->getMessage();
    }
} else {
    $msg = getContactById($pdo, $_GET['id']);
    $title = 'Reply to Message';
    ob_start();
?>
<?php
    include '../admin/admin_templated/admin_replycontact.html.php';
    $output = ob_get_clean();
}
include '../admin/admin_templated/admin_layout.html.php';
?>