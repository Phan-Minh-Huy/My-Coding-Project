<h2>✉️ Reply Message</h2>
<form action="replycontact.php" method="post">
    <input type="hidden" name="id" value="<?= $msg['id'] ?>">
    <input type="hidden" name="user_email" value="<?= htmlspecialchars($msg['email']) ?>">
    <input type="hidden" name="user_name" value="<?= htmlspecialchars($msg['name']) ?>">

    <div style="background: #111827; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
        <p><strong>To:</strong> <?= htmlspecialchars($msg['name']) ?> (<?= htmlspecialchars($msg['email']) ?>)</p>
        <p><strong>Customer Message:</strong><br><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
    </div>

    <label for="reply">Reply Content:</label>
    <textarea name="reply" rows="6" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: none; font-family: inherit;"><?= htmlspecialchars($msg['reply'] ?? '') ?></textarea>

    <input type="submit" value="🚀Send and Save" class="btn-edit" style="width: 100%; padding: 12px; background: #10b981;">
</form>