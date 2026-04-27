<?php
include 'check.php';
try {
    include '../includes/DatabaseConnection.php';


    $stmt = $pdo->prepare('SELECT poster FROM review WHERE id = :id');
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    $review = $stmt->fetch();


    if ($review && !empty($review['poster'])) {
        $filePath = '../uploads/' . $review['poster'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }


    $sql = 'DELETE FROM review WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();

    header('Location: index.php');
    exit();
} catch (PDOException $e) {
    $title = 'Database error';
    $output = $e->getMessage();
    include '../admin/admin_templated/admin_layout.html.php';
}
