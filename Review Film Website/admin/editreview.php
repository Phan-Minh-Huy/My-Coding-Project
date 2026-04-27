<?php
include 'check.php';
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $posterName = $_POST['current_poster'];

        if (!empty($_FILES['poster']['name'])) {
            $posterName = time() . '_' . $_FILES['poster']['name'];
            move_uploaded_file($_FILES['poster']['tmp_name'], '../uploads/' . $posterName);

            if (!empty($_POST['current_poster']) && file_exists('../uploads/' . $_POST['current_poster'])) {
                unlink('../uploads/' . $_POST['current_poster']);
            }
        }

        updateReview($pdo, $_POST['reviewid'], $_POST['reviewtext'], $_POST['rating'], $_POST['film'], $_POST['reviewerid'], $posterName);

        deleteReviewGenres($pdo, $_POST['reviewid']);
        if (isset($_POST['genre'])) {
            foreach ($_POST['genre'] as $genreId) {
                insertReviewGenre($pdo, $_POST['reviewid'], $genreId);
            }
        }

        header('Location: index.php');
        exit();
    } else {
        $review = getReviewById($pdo, $_GET['id']);
        $films = getFilms($pdo);
        $reviewers = getReviewers($pdo);
        $genres = getGenres($pdo);
        $currentGenres = getReviewGenreIds($pdo, $_GET['id']);

        $title = 'Edit Review (Admin)';
        ob_start();
        include '../admin/admin_templated/admin_editreview.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Database error';
    $output = $e->getMessage();
}

include '../admin/admin_templated/admin_layout.html.php';
