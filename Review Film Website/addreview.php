<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $posterName = null;
        if (!empty($_FILES['poster']['name'])) {
            $posterName = time() . '_' . $_FILES['poster']['name'];
            move_uploaded_file($_FILES['poster']['tmp_name'], 'uploads/' . $posterName);
        }
        $reviewId = insertReview($pdo, $_POST['reviewtext'], $_POST['rating'], $_POST['film'], $_POST['reviewerid'], $posterName);
        if (isset($_POST['genre'])) {
            foreach ($_POST['genre'] as $genre) {
                insertReviewGenre($pdo, $reviewId, $genre);
            }
        }
        header('Location: reviews.php');
        exit();
    } catch (PDOException $e) {
        $title = 'Database error';
        $output = $e->getMessage();
        include 'templated/layout.html.php';
        exit();
    }
} else {
    try {
        $films = getFilms($pdo);
        $reviewers = getReviewers($pdo);
        $genres = getGenres($pdo);
        $title = 'Add Film Review';

        ob_start();
        include 'templated/addreview.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'Database error';
        $output = $e->getMessage();
    }
}

include 'templated/layout.html.php';
