<?php
session_start();

include 'includes/header.php';

$page = $_GET['page'] ?? 'home';

// Pages requiring login
$protected_pages = ['fitness', 'diet_plan', 'recipes', 'expert'];



// Allow only whitelisted pages
$allowed_pages = ['home', 'emergency', 'symptom_checker', 'hospitals', 'first_aid', 'expert', 'fitness', 'recipes', 'diet_plan', 'login', 'register'];

if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

include "view/{$page}.php";

include 'includes/footer.php';
?>



<style>
  body {
    background-color:rgba(231, 221, 35, 0.69); /* Light blue (change this to your preferred color) */
    margin: 0;
    font-family: Arial, sans-serif;
  }
</style

