<?php
session_start();

if (!isset($_SESSION['user'])) {
    // User not logged in, redirect to home page or login page
    header("Location: index.php?page=home");
    exit();
}
?>



<?php
session_start();
require_once '../db.php'; // Your DB connection

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        $error = "Please enter email and password.";
    } else {
        // Prepare statement to get user by email
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $name, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user'] = $name;  // Store user's name in session
                header("Location: ../index.php?page=home");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }
        $stmt->close();
    }
}
?>

<div class="form-container">
    <h2>🔐 Login</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>"><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="index.php?page=register">Register here</a></p>
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
    background: #28a745;
    color: white;
    border: none;
    cursor: pointer;
}
.error {
    color: red;
    margin-bottom: 10px;
}
</style>
