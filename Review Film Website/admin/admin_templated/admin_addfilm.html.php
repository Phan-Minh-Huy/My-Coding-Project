<h2>🎬 Add new Film</h2>
<form action="addfilm.php" method="post" enctype="multipart/form-data">
    <label for="title">Film name:</label>
    <input type="text" id="title" name="title" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: none;">

    <label for="description">Film Description:</label>
    <textarea id="description" name="description" rows="5" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: none; resize: vertical;"></textarea>

    <label for="year">Year:</label>
    <input type="number" id="year" name="year" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: none;">

    <label for="poster">Poster Film</label>
    <input type="file" id="poster" name="poster" accept="image/*" style="width: 100%; margin-bottom: 20px; color: white;">

    <input type="submit" value="➕ Add Film" class="btn-edit" style="width: 100%; padding: 12px;">
</form>