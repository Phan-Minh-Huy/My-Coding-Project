<form action="" method="post" enctype="multipart/form-data">
    <h2>✏️ Edit Review</h2>

    <input type="hidden" name="reviewid" value="<?= $review['id'] ?>">
    <input type="hidden" name="current_poster" value="<?= htmlspecialchars($review['poster']) ?>">

    <p>
        <label>Film</label>
        <select name="film" required>
            <?php foreach ($films as $film): ?>
                <option value="<?= $film['id'] ?>" <?= ($film['id'] == $review['filmid']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($film['title']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label>Reviewer</label>
        <select name="reviewerid" required>
            <?php foreach ($reviewers as $reviewer): ?>
                <option value="<?= $reviewer['id'] ?>" <?= ($reviewer['id'] == $review['reviewerid']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($reviewer['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>


    <label for="rating">Rating</label>
    <select name="rating" id="rating" required>
        <option value="5" <?= ($review['rating'] == 5) ? 'selected' : '' ?>>⭐⭐⭐⭐⭐</option>
        <option value="4" <?= ($review['rating'] == 4) ? 'selected' : '' ?>>⭐⭐⭐⭐</option>
        <option value="3" <?= ($review['rating'] == 3) ? 'selected' : '' ?>>⭐⭐⭐</option>
        <option value="2" <?= ($review['rating'] == 2) ? 'selected' : '' ?>>⭐⭐</option>
        <option value="1" <?= ($review['rating'] == 1) ? 'selected' : '' ?>>⭐</option>
    </select>

    <p>
        <label>Description</label>
        <textarea name="reviewtext" rows="4" cols="40" required><?= htmlspecialchars($review['reviewtext']) ?></textarea>
    </p>

    <input type="submit" value="update">
</form>