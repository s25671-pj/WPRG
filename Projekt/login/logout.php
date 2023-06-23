<?php
session_start(); // Rozpocznij sesję

// Zeruj wszystkie zmienne sesyjne
$_SESSION = array();

// Zniszcz sesję
session_destroy();

// Przekieruj użytkownika na stronę logowania lub inną stronę po wylogowaniu
header("Location: ../main/index.php");
exit;
?>