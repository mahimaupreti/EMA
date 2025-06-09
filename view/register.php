<?php
session_start();
require_once '../db.php'; // Your DB connection

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name === '' || $email === '' || $password === '') {
        $error = 'All fields are required.';
    } else {
        // Check if user already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'Email already registered.';
        } else {
            // Insert new user with hashed password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $name, $email, $hashed_password);

            if ($insert->execute()) {
                $_SESSION['user'] = $name;  // Store name in session for consistency
                header("Location: ../index.php?page=home");
                exit;
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
        $stmt->close();
    }
}
?>

<div class="form-container">
    <h2>📝 Register</h2>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Full Name" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>"><br>
        <input type="email" name="email" placeholder="Email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="index.php?page=login">Login here</a></p>
</div>

<style>
.form-container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 0 10px #ccc;
    border-radius: 10px;
}
input, button {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
}
button {
    background: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}
.error {
    color: red;
    margin-bottom: 10px;
}
</style>
