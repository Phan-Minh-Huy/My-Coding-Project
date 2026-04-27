<h2 style="margin-bottom: 20px;">✏️ Edit Film</h2>

<form action="editfilm.php" method="post" enctype="multipart/form-data" style="background: #1f2937; padding: 20px; border-radius: 8px;">
    <input type="hidden" name="id" value="<?= $film['id'] ?>">
    <input type="hidden" name="current_poster" value="<?= htmlspecialchars($film['poster']) ?>">

    <label for="title">Film Title:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($film['title']) ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #374151; background: #111827; color: white;">

    <label for="year">Release Year:</label>
    <input type="number" id="year" name="year" value="<?= htmlspecialchars($film['year']) ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #374151; background: #111827; color: white;">

    <label for="description">Film Description :</label>
    <textarea name="description" id="description" rows="8" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #374151; background: #111827; color: white; resize: vertical;"><?= htmlspecialchars($film['description'] ?? '') ?></textarea>

    <label>Current Poster:</label><br>
    <?php if (!empty($film['poster'])): ?>
        <img src="../poster/<?= htmlspecialchars($film['poster']) ?>" width="120" style="margin-bottom: 15px; border-radius: 5px; border: 2px solid #374151;"><br>
    <?php endif; ?>

    <label for="poster">Change Poster (Leave blank to keep current):</label>
    <input type="file" id="poster" name="poster" accept="image/*" style="width: 100%; margin-bottom: 25px; color: #9ca3af;">

    <input type="submit" value="💾 Save Changes" style="width: 100%; padding: 12px; background: #10b981; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
</form>