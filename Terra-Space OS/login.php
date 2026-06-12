<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Terra-Space OS | Terminal Login</title>
    <style>
        body { background: #05070a; color: white; font-family: 'Consolas', monospace; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { width: 350px; padding: 30px; border: 1px solid #333; border-top: 4px solid #FC3D21; background: rgba(11, 13, 23, 0.9); box-shadow: 0 0 20px rgba(0,0,0,0.5); }
        h2 { text-align: center; letter-spacing: 3px; font-size: 20px; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #0b0d17; border: 1px solid #444; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #0B3D91; color: white; border: none; cursor: pointer; font-weight: bold; transition: 0.3s; }
        button:hover { background: #FC3D21; }
        .footer-link { font-size: 10px; text-align: center; margin-top: 15px; color: #888; }
        .footer-link a { color: #FC3D21; text-decoration: none; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>MISSION ACCESS</h2>
        <form action="auth.php" method="POST">
            <input type="text" name="username" placeholder="RESEARCHER_ID" required>
            <input type="password" name="password" placeholder="SECURITY_KEY" required>
            <button type="submit" name="login_btn">INITIALIZE LOGIN</button>
        </form>
        <div class="footer-link">New Researcher? <a href="register.php">REQUEST ACCESS</a></div>
    </div>
</body>
</html>