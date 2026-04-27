<?php
try {

   include 'includes/DatabaseConnection.php';
   include 'includes/DatabaseFunctions.php';
   $reviews = getReviews($pdo);
   $title = 'Film Reviews';
   $totalReviews = totalReviews($pdo);
   ob_start();
   include 'templated/reviews.html.php';
   $output = ob_get_clean();
} catch (PDOException $e) {
   $title = 'Database error';
   $output = $e->getMessage();
}
include 'templated/layout.html.php';
