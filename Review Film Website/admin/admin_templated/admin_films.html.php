<h2>🎬 Manage Films</h2>
<a href="addfilm.php" class="btn-edit" style="display:inline-block; margin-bottom: 20px;">+ Add new Film</a>

<?php if (isset($error)): ?>
    <p style="color: #ef4444; font-weight: bold;"><?= $error ?></p>
<?php endif; ?>

<div class="admin-review-list">
    <?php foreach ($films as $film): ?>
        <blockquote class="review-item admin-card">
            <?php if (!empty($film['poster'])): ?>
                <img class="review-poster" src="../poster/<?= htmlspecialchars($film['poster']) ?>" alt="Poster">
            <?php endif; ?>

            <div class="review-content">
                <h3 style="color: white; margin-bottom: 5px;"><?= htmlspecialchars($film['title']) ?></h3>
                <small class="review-meta">Year: <?= htmlspecialchars($film['year'] ?? 'N/A') ?></small>
            </div>

            <div class="review-actions">
                <a class="btn-edit" href="editfilm.php?id=<?= $film['id'] ?>">Edit</a>

                <form action="films.php" method="post" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this film?');">
                    <input type="hidden" name="delete_film_id" value="<?= $film['id'] ?>">
                    <input class="btn-delete" type="submit" value="Delete">
                </form>
            </div>
        </blockquote>
    <?php endforeach; ?>
</div>