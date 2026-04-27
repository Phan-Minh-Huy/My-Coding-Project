<h2>Edit User</h2>
<form action="edituser.php" method="post">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required style="width:100%; padding:10px; margin-bottom:15px; border-radius:4px; border:none;">

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required style="width:100%; padding:10px; margin-bottom:15px; border-radius:4px; border:none;">

    <input type="submit" value="💾 Save the change" class="btn-edit" style="width:100%; padding:12px; background:#10b981;">
</form>