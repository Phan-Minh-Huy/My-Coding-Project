<?php
session_start();
session_destroy(); // Cancel the entire session (recapture the token)
header('Location: login.php'); // Redirect to the login page
exit();
