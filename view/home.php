<?php
if (!isset($_SESSION['user'])) {
    // Show login/register box (already done)
} else {
    echo "<p>Welcome, " . htmlspecialchars($_SESSION['user']) . "!</p>";
}
?>


<style>
.home-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 30px;
  padding: 40px;
  text-align: center;
}

.card {
  background: #f7f7f7;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  transition: transform 0.2s ease;
}
.card:hover {
  transform: translateY(-5px);
}
.card a {
  text-decoration: none;
  color: #007BFF;
  font-weight: bold;
  display: inline-block;
  margin-top: 10px;
}
.login-form {
  padding: 20px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
  max-width: 400px;
  margin: 0 auto;
}
.login-form input {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
}
.login-form button {
  background-color: #007BFF;
  color: white;
  padding: 10px 20px;
  border: none;
  width: 100%;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
}
.login-form button:hover {
  background-color: #0056b3;
}
</style>

<main class="home-container">
  <div class="card">
    <h2>🚨 Emergency Help</h2>
    <p>Quickly access emergency services and locate nearby hospitals.</p>
    <a href="index.php?page=emergency">Go to Emergency</a>
  </div>

  <div class="card">
    <h2>🧠 Symptom Checker</h2>
    <p>Use AI to analyze your symptoms and get possible suggestions.</p>
    <a href="index.php?page=symptom_checker">Check Symptoms</a>
  </div>
</main>
<section style="padding: 40px;">
  <h2 style="text-align: center;">🔐 Login or Register</h2>

  <div style="text-align: center; margin-bottom: 20px;">
    <button onclick="showForm('login')" id="loginBtn">Login</button>
    <button onclick="showForm('register')" id="registerBtn">Register</button>
  </div>

  <!-- Login Form -->
  <form class="login-form" id="loginForm" action="view/login.php" method="POST">
    <input type="email" name="email" placeholder="Enter your email" required />
    <input type="password" name="password" placeholder="Enter your password" required />
    <button type="submit">Login</button>
  </form>

  <!-- Register Form -->
  <form class="login-form" id="registerForm" action="view/register.php" method="POST" style="display:none;">
    <input type="text" name="name" placeholder="Enter your name" required />
    <input type="email" name="email" placeholder="Enter your email" required />
    <input type="password" name="password" placeholder="Create a password" required />
    <button type="submit">Register</button>
  </form>
</section>

<script>
  function showForm(type) {
    const login = document.getElementById('loginForm');
    const register = document.getElementById('registerForm');
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');

    if (type === 'login') {
      login.style.display = 'block';
      register.style.display = 'none';
      loginBtn.style.background = '#007BFF';
      loginBtn.style.color = '#fff';
      registerBtn.style.background = '#eee';
      registerBtn.style.color = '#000';
    } else {
      login.style.display = 'none';
      register.style.display = 'block';
      registerBtn.style.background = '#007BFF';
      registerBtn.style.color = '#fff';
      loginBtn.style.background = '#eee';
      loginBtn.style.color = '#000';
    }
  }
</script>

<style>
  button#loginBtn,
  button#registerBtn {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin: 0 10px;
    font-weight: bold;
  }
</style>
