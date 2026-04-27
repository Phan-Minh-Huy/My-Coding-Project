<h2>👥 Manage Users</h2>
<a href="adduser.php" class="btn-edit" style="display:inline-block; margin-bottom: 20px;">+ Add New User</a>
<div class="admin-review-list">
    <?php foreach ($reviewers as $user): ?>
        <blockquote class="review-item admin-card">
            <div class="review-content">
                <h3 style="color: white; margin-bottom: 5px;"><?= htmlspecialchars($user['name']) ?></h3>
                <small class="review-meta">Email: <?= htmlspecialchars($user['email']) ?></small>
            </div>
            <div class="review-actions">
                <a class="btn-edit" href="edituser.php?id=<?= $user['id'] ?>">Edit</a>
                <form action="users.php" method="post" class="delete-form">
                    <input type="hidden" name="delete_user_id" value="<?= $user['id'] ?>">
                    <input class="btn-delete" type="submit" value="Delete">
                </form>
            </div>
        </blockquote>
    <?php endforeach; ?>
</div>