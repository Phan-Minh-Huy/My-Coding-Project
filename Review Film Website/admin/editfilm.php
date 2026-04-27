<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 1. Restore the old image name as the default.
        $posterName = $_POST['current_poster'];

        // 2. If a new image file is selected, overwrite the existing one
        if (!empty($_FILES['poster']['name'])) {
            $posterName = time() . '_' . $_FILES['poster']['name'];
            // Synchronize the storage directory to ../poster/
            move_uploaded_file($_FILES['poster']['tmp_name'], '../poster/' . $posterName);
        }

        // 3. Call the movie update function ($_POST['description'] has been added)
        updateFilm($pdo, $_POST['id'], $_POST['title'], $_POST['description'], $_POST['year'], $posterName);

        header('Location: films.php');
        exit();
    } catch (PDOException $e) {
        $title = 'Database error';
        $output = $e->getMessage();
    }
} else {
    // Retrieve information from old movies to display on the form.
    $film = getFilmById($pdo, $_GET['id']);
    $title = 'Edit Film';
    ob_start();
?>
    
<?php
    include '../admin/admin_templated/admin_editfilm.html.php';
    $output = ob_get_clean();
}
include '../admin/admin_templated/admin_layout.html.php';
?>