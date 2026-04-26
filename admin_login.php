<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f0f0; }
        .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 8px; margin: 10px 0; }
        button { background: #007bff; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; }
        h2 { text-align: center; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Admin Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once 'config.php';
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (password_verify($pass, $row['password_hash'])) {
                $_SESSION['admin_logged_in'] = true;
                header('Location: admin_dashboard.php');
                exit;
            }
        }
        echo '<p class="error">Invalid username or password</p>';
    }
    ?>
</div>
</body>
</html>