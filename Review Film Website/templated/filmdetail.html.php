<div class="film-detail-container">
    <h2>🎬 <?= htmlspecialchars($film['title']) ?></h2>

    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
        <img src="poster/<?= htmlspecialchars($film['poster']) ?>" width="200" alt="Poster">
        <div class="description-film">
            <h3>Description</h3>
            <p><?= (htmlspecialchars($film['description'])) ?></p>
        </div>
    </div>
</div>