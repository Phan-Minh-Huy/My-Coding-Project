<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$filmId = $_GET['id'];
$film = getFilmById($pdo, $filmId);

if (!$film) {
    header('Location: index.php');
    exit();
}
$reviews = getReviewsByFilmId($pdo, $filmId);

$title = $film['title'] . ' - Details';
ob_start();
?>


<?php
include 'templated/filmdetail.html.php';
$output = ob_get_clean();
include 'templated/layout.html.php';
?>