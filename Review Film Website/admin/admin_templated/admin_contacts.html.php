<h2>✉️ Contact Mailbox</h2>

<div class="admin-review-list">
    <?php foreach ($contacts as $msg): ?>
        <blockquote class="review-item admin-card">
            <div class="review-content">
                <h3 style="color: white; margin-bottom: 5px;">From: <?= htmlspecialchars($msg['name']) ?></h3>
                <small class="review-meta">Email: <?= htmlspecialchars($msg['email']) ?></small>

                <div style="background: #111827; padding: 10px; border-radius: 4px; margin-top: 10px; color: #d1d5db;">

                    <?= nl2br(htmlspecialchars($msg['message'])) ?>
                </div>

                <?php if (!empty($msg['reply'])): ?>
                    <div style="background: #064e3b; padding: 10px; border-radius: 4px; margin-top: 10px; color: #a7f3d0; border-left: 3px solid #10b981;">

                        <?= nl2br(htmlspecialchars($msg['reply'])) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="review-actions" style="flex-direction: column; gap: 10px;">
                <a class="btn-edit" href="replycontact.php?id=<?= $msg['id'] ?>" style="width: 100%; text-align: center;">
                    <?= empty($msg['reply']) ? 'Reply' : 'Edit Reply' ?>
                </a>

                <form action="contacts.php" method="post" class="delete-form" onsubmit="return confirm('Do you want to delete this message?');">
                    <input type="hidden" name="delete_contact_id" value="<?= $msg['id'] ?>">
                    <input class="btn-delete" type="submit" value="Delete" style="width: 100%;">
                </form>
            </div>
        </blockquote>
    <?php endforeach; ?>
</div>