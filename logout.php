<?php
session_start();

// Usuń wszystkie zmienne sesyjne
session_unset();

// Zniszcz sesję
session_destroy();

// Przekieruj użytkownika na stronę logowania
header('Location: index.php');
?>
