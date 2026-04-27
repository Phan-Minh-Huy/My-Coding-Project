<section>
    <h2>Check Message</h2>
    <form action="check_reply.php" method="post" style="margin-bottom: 30px;">
        <input type="email" name="email" placeholder="Enter your email here" required
            value="<?= htmlspecialchars($search_email) ?>" style="padding: 10px; width: 250px;">
        <input type="submit" value="See response" class="btn-edit">
    </form>

    <?php if ($results !== null): ?>
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $row): ?>
                <div style="background: #1f2937; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid #3b82f6;">
                    <p><strong>Description:</strong> <?= htmlspecialchars($row['message']) ?></p>

                    <?php if (!empty($row['reply'])): ?>
                        <div style="margin-top: 10px; padding: 10px; background: #064e3b; color: #a7f3d0; border-radius: 4px;">
                            <strong>Admin replied:</strong> <?= htmlspecialchars($row['reply']) ?>
                        </div>
                    <?php else: ?>
                        <p style="color: #94a3b8; font-style: italic;">(Waiting for Admin response...)</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No messages found with this email.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>