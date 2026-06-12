<?php
include 'db.php';

// --- REGISTER LOGIC ---
if (isset($_POST['register_btn'])) {
    $username = mysqli_real_escape_with_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hashing

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?msg=success");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// --- LOGIN LOGIC ---
if (isset($_POST['login_btn'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php"); // Redirect to analyzer
        } else {
            header("Location: login.php?error=invalid_password");
        }
    } else {
        header("Location: login.php?error=user_not_found");
    }
}
?>