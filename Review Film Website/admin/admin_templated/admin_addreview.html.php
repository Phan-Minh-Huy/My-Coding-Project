<form action="" method="post" enctype="multipart/form-data">
    <h2>Add Review</h2>

    <p>
        <label>Film</label>
        <select name="film" required>
            <option value="">Select Film</option>

            <?php foreach ($films as $film): ?>
                <option value="<?= $film['id'] ?>">
                    <?= htmlspecialchars($film['title']) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </p>

    <p>
        <label>Description</label>
        <textarea name="reviewtext" rows="4" cols="40"></textarea>
    </p>

    <p>
        <label>Reviewer:</label>
        <strong>Admin</strong>

        <input type="hidden" name="reviewerid" value="10">
    </p>

    <p>
        <label>Genre</label>
    <div class="genre-group">

        <?php foreach ($genres as $genre): ?>
            <label>
                <input type="checkbox" name="genre[]" value="<?= $genre['id'] ?>">
                <?= htmlspecialchars($genre['name']) ?>
            </label>
        <?php endforeach; ?>

    </div>
    </p>

    <label for="rating">Rating</label>
    <select name="rating" id="rating" required>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
    </select>

    <p>
        <label>Poster</label><br>
        <input type="file" name="poster" accept="image/*">
    </p>

    <p>
        <input type="submit" value="Add Review">
    </p>
</form>