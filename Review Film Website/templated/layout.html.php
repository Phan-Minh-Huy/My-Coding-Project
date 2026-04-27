<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="film.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>🎬 Film Review Website</h1>
            <nav>
                <a href="index.php">Home</a>
                <a href="reviews.php">Reviews</a>
                <a href="addreview.php">Add Review</a>
                <a href="contact.php">Contact</a>
                <a href="check_reply.php">🔍 Check Reply</a>
                <a href="admin/index.php">👤Admin</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <?= $output ?>
    </div>
    <footer>
        <p>Film Review Website © 2026</p>
    </footer>
</body>

</html>