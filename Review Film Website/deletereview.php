<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if (isset($_POST['id'])) {
    try {
        $reviewId = $_POST['id'];
        // 1: Get image file name from database before deleting review
        // (Call the function to get review to know which image it is using)
        $review = getReviewById($pdo, $reviewId);
        // 2: Delete image file from the uploads directory
        if ($review && !empty($review['poster'])) {
            $filePath = 'uploads/' . $review['poster'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        // 3: Delete review from database
        deleteReview($pdo, $reviewId);
        header('Location: reviews.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
