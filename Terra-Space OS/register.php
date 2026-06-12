<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Terra-Space OS | Register</title>
    <style>
        body { background: #05070a; color: white; font-family: 'Consolas', monospace; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { width: 350px; padding: 30px; border: 1px solid #333; border-top: 4px solid #0B3D91; background: rgba(11, 13, 23, 0.9); }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #0b0d17; border: 1px solid #444; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #FC3D21; color: white; border: none; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="letter-spacing:2px;">NEW RESEARCHER</h2>
        <form action="auth.php" method="POST">
            <input type="text" name="username" placeholder="CHOOSE_ID" required>
            <input type="password" name="password" placeholder="SET_SECURITY_KEY" required>
            <button type="submit" name="register_btn">CREATE ACCOUNT</button>
        </form>
        <p style="font-size:10px; text-align:center; margin-top:15px;">Already have access? <a href="login.php" style="color:#0B3D91;">LOGIN</a></p>
    </div>
</body>
</html>