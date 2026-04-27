<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if (isset($_POST['delete_film_id'])) {
    try {
        $filmId = $_POST['delete_film_id'];


        $stmt = $pdo->prepare('SELECT poster FROM film WHERE id = :id');
        $stmt->bindValue(':id', $filmId);
        $stmt->execute();
        $film = $stmt->fetch();


        if ($film && !empty($film['poster'])) {
            $filePath = '../poster/' . $film['poster'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        deleteFilm($pdo, $filmId);

        header('Location: films.php');
        exit();
    } catch (PDOException $e) {
        $error = "Cannot delete this film because it has reviews. Please delete the reviews first!";
    }
}

// Get film list
$films = getFilms($pdo);
$title = 'Manage Films';

ob_start();
?>

<?php
include '../admin/admin_templated/admin_films.html.php';
$output = ob_get_clean();
include '../admin/admin_templated/admin_layout.html.php';
?>