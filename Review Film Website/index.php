<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunctions.php';
    $movies = getHomeMovies($pdo);
    $title = 'Film Review Website';
    ob_start();
    include 'templated/home.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Database error';
    $output = $e->getMessage();
}
include 'templated/layout.html.php';
