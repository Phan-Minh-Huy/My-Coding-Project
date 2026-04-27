<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>👤 Film Review Admin</h1>
            <nav>
                <a href="index.php">Dashboard</a>
                <a href="addreview.php">Add Review</a>
                <a href="films.php">🎬 Manage Films</a>
                <a href="users.php">👥 Manage Users</a>
                <a href="contacts.php">✉️ Messages</a>
                <a href="logout.php" style="color: #ef4444;">🚪 Logout</a>

            </nav>
        </div>
    </header>

    <div class="container">
        <div class="admin-form-container">
            <?= $output ?>
        </div>
    </div>

    <footer>
        <p>Film Review Website © 2026 | Admin Panel</p>
    </footer>
</body>

</html>