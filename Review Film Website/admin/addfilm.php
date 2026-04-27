<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $posterName = null;
        if (!empty($_FILES['poster']['name'])) {
            $posterName = time() . '_' . $_FILES['poster']['name'];
            move_uploaded_file($_FILES['poster']['tmp_name'], '../poster/' . $posterName);
        }
        insertFilm($pdo, $_POST['title'], $_POST['description'], $_POST['year'], $posterName);
        header('Location: films.php');
        exit();
    } catch (PDOException $e) {
        $title = 'Database error';
        $output = $e->getMessage();
    }
} else {
    $title = 'Add New Film';
    ob_start();
?>
    
<?php
    include '../admin/admin_templated/admin_addfilm.html.php';
    $output = ob_get_clean();
}
include '../admin/admin_templated/admin_layout.html.php';
?>