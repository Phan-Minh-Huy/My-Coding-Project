<h2 style="margin-bottom: 20px;">✏️ Edit Review (Full Access)</h2>

<form action="" method="post" enctype="multipart/form-data" style="background: #1f2937; padding: 20px; border-radius: 8px;">

    <input type="hidden" name="reviewid" value="<?= $review['id'] ?>">
    <input type="hidden" name="current_poster" value="<?= htmlspecialchars($review['poster']) ?>">

    <label>Select Film:</label>
    <select name="film" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; background: #111827; color: white; border: 1px solid #374151;">
        <?php foreach ($films as $film): ?>
            <option value="<?= $film['id'] ?>" <?= ($film['id'] == $review['filmid']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($film['title']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Review Description:</label>
    <textarea name="reviewtext" rows="5" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; background: #111827; color: white; border: 1px solid #374151;"><?= htmlspecialchars($review['reviewtext']) ?></textarea>

    <label>Reviewer:</label>
    <select name="reviewerid" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; background: #111827; color: white; border: 1px solid #374151;">
        <option value="10" <?= ($review['reviewerid'] == 10) ? 'selected' : '' ?>>Admin</option>
        <?php foreach ($reviewers as $reviewer): ?>
            <option value="<?= $reviewer['id'] ?>" <?= ($reviewer['id'] == $review['reviewerid']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($reviewer['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Genres:</label>
    <div class="genre-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px; background: #111827; padding: 10px; border-radius: 4px;">
        <?php foreach ($genres as $genre): ?>
            <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                <input type="checkbox" name="genre[]" value="<?= $genre['id'] ?>" <?= in_array($genre['id'], $currentGenres) ? 'checked' : '' ?>>
                <?= htmlspecialchars($genre['name']) ?>
            </label>
        <?php endforeach; ?>
    </div>

    <label>Rating:</label>
    <select name="rating" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; background: #111827; color: white; border: 1px solid #374151;">
        <option value="5" <?= ($review['rating'] == 5) ? 'selected' : '' ?>>⭐⭐⭐⭐⭐</option>
        <option value="4" <?= ($review['rating'] == 4) ? 'selected' : '' ?>>⭐⭐⭐⭐</option>
        <option value="3" <?= ($review['rating'] == 3) ? 'selected' : '' ?>>⭐⭐⭐</option>
        <option value="2" <?= ($review['rating'] == 2) ? 'selected' : '' ?>>⭐⭐</option>
        <option value="1" <?= ($review['rating'] == 1) ? 'selected' : '' ?>>⭐</option>
    </select>

    <label>Current Media:</label><br>
    <?php if (!empty($review['poster'])): ?>
        <?php
        $fileExt = strtolower(pathinfo($review['poster'], PATHINFO_EXTENSION));
        $isVid = in_array($fileExt, ['mp4', 'webm', 'ogg']);
        ?>
        <?php if ($isVid): ?>
            <video controls width="150" style="border-radius: 4px; margin-bottom: 10px;">
                <source src="../uploads/<?= htmlspecialchars($review['poster']) ?>" type="video/<?= $fileExt ?>">
            </video>
        <?php else: ?>
            <img src="../uploads/<?= htmlspecialchars($review['poster']) ?>" width="100" style="border-radius: 4px; margin-bottom: 10px;">
        <?php endif; ?>
    <?php endif; ?>

    <br><label>Upload New Poster/Video (Leave blank to keep current):</label>
    <input type="file" name="poster" accept="image/*, video/*" style="width: 100%; margin-top: 5px; color: #9ca3af; margin-bottom: 20px;">

    <input type="submit" value="💾 Update Review" style="width: 100%; padding: 12px; background: #10b981; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">

</form>