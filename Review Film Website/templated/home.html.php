<h2>Featured Films</h2>
<p>Discover the movies that offer the best viewing experience.</p>
<div class="home-links">
    <a href="reviews.php" class="btn-primary">View All Reviews</a>
    <a href="addreview.php" class="btn-primary">Add Film Review</a>
</div>

<div class="movie-grid">
    <?php foreach ($movies as $movie): ?>
        <div class="movie-card">

            <a href="filmdetail.php?id=<?= $movie['id'] ?>" style="text-decoration: none; color: inherit; display: block;">

                <img src="poster/<?= htmlspecialchars($movie['poster']) ?>" alt="<?= htmlspecialchars($movie['title']) ?> Poster">

                <div class="movie-info">
                    <h3><?= htmlspecialchars($movie['title']) ?></h3>
                </div>

            </a>
        </div>
    <?php endforeach; ?>
</div>