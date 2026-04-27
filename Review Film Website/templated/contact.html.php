<h2>Contact Us</h2>

<form action="contact.php" method="post">

    <label>Your Name</label>
    <input type="text" name="name">

    <label>Your Email</label>
    <input type="email" name="email" required>

    <label>Your Message</label>
    <textarea name="message" rows="5" required></textarea>

    <input type="submit" value="Send Message">

</form>

<?php if (!empty($success)): ?>
    <p class="success"><?= $success ?></p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<?php
$output = ob_get_clean();
include 'templated/layout.html.php';
