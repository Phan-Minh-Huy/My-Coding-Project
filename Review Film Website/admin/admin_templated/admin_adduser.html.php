<h2>👥 Add User</h2>

<?php if (!empty($error_message)): ?>
    <div style="background-color: #ffebee; color: #c62828; padding: 12px; margin-bottom: 20px; border-left: 4px solid #c62828; border-radius: 4px; font-weight: bold;">
        <?= htmlspecialchars($error_message) ?>
    </div>
<?php endif; ?>

<form action="adduser.php" method="post">
    <label>Username:</label>
    <input type="text" name="name" required
        value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
        style="width:100%; padding:10px; margin-bottom:15px; border-radius:4px; border:none;">

    <label>Email:</label>
    <input type="email" name="email" required
        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
        style="width:100%; padding:10px; margin-bottom:15px; border-radius:4px; border:none;">

    <input type="submit" value="Add User" class="btn-edit" style="width:100%; padding:12px;">
</form>