<h2>Film Reviews</h2>
<p><?= $totalReviews ?> reviews appear here.</p>

<?php foreach ($reviews as $review): ?>
    <blockquote class="review-item">
        <?php if (!empty($review['poster'])): ?>
            <img class="review-poster" src="uploads/<?= htmlspecialchars($review['poster']) ?>" alt="Poster">
        <?php endif; ?>

        <div class="review-content">
            <p class="review-text"><?= htmlspecialchars($review['reviewtext']) ?></p>

            <small class="review-meta">
                <?= htmlspecialchars($review['reviewdate']) ?>
                |
                <strong><?= htmlspecialchars($review['reviewer']) ?></strong>
                |
                <?= htmlspecialchars($review['genres'] ?? 'No genre') ?>
            </small>
        </div>

        <div class="review-film-title">
            <h3>
                🎬 <?= htmlspecialchars($review['film_title']) ?>
            </h3>
        </div>

        <div class="review-rating" style="color: #fbbf24; font-size: 1.2rem; margin-bottom: 10px;">
            <?= str_repeat('⭐', (int)($review['rating'] ?? 5)) ?>
        </div>
        <div class="review-actions">
            <a class="btn-edit" href="editreview.php?id=<?= $review['review_id'] ?>">Edit</a>

            <form action="deletereview.php" method="post" onsubmit="return confirm('Do you want this review deleted? If so, it will be permanently deleted.');" class="delete-form">
                <input type="hidden" name="id" value="<?= $review['review_id'] ?>">
                <input class="btn-delete" type="submit" value="Delete">
            </form>
        </div>
    </blockquote>
<?php endforeach; ?>