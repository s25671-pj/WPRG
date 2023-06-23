<?php
session_start();

if (!isset($_COOKIE['isLoggedIn']) || $_COOKIE['isLoggedIn'] !== 'true') {
    // Użytkownik nie jest zalogowany
    header('Location: ../login/login.php'); // Przekierowanie na stronę logowania
    exit();
}

// Użytkownik jest zalogowany
$username = $_SESSION['username'];
?>