<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #0b101a;
            color: white;
        }

        .login-box {
            background: #151c2b;
            padding: 40px;
            border-radius: 8px;
            border: 1px solid #1e293b;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }

        .login-box h2 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #3b82f6;
            font-size: 24px;
        }

        .login-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #1e293b;
            background: #0b101a;
            color: white;
            font-size: 16px;
        }

        .login-box input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .login-box input[type="submit"] {
            width: 100%;
            background: #3b82f6;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .login-box input[type="submit"]:hover {
            background: #2563eb;
        }

        .error {
            color: #ef4444;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .back-link {
            display: block;
            margin-top: 25px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: white;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>🔒 Admin Login</h2>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <input type="password" name="password" placeholder="Enter Key" required>
            <input type="submit" value="Login">
        </form>

        <a href="../index.php" class="back-link">&larr; Return to home page</a>
    </div>
</body>

</html>