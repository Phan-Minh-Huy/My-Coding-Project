<?php
include 'check.php'; // Khóa bảo mật Admin

include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $posterName = null;
        // Image upload processing
        if (!empty($_FILES['poster']['name'])) {
            $posterName = time() . '_' . $_FILES['poster']['name'];
            move_uploaded_file($_FILES['poster']['tmp_name'], '../uploads/' . $posterName);
        }

        insertReview($pdo, $_POST['reviewtext'], $_POST['rating'], $_POST['film'], $_POST['reviewerid'], $posterName);
        $reviewId = $pdo->lastInsertId();
        // Add genres
        if (isset($_POST['genre'])) {
            foreach ($_POST['genre'] as $genre) {
                insertReviewGenre($pdo, $reviewId, $genre);
            }
        }

        // After adding the review, redirect back to the admin homepage
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        $title = 'Database error';
        $output = $e->getMessage();
    }
} else {
    try {
        $films = getFilms($pdo);
        $reviewers = getReviewers($pdo);
        $genres = getGenres($pdo);
        $title = 'Add Film Review (Admin)';

        ob_start();
        include '../admin/admin_templated/admin_addreview.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'Database error';
        $output = $e->getMessage();
    }
}
include '../admin/admin_templated/admin_layout.html.php';
