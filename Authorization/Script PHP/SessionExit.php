<?php
session_start(); // начало сессии
$_SESSION['user'] = array();
session_destroy(); // уничтожение сессии
header('Location: /'); // редирект на главную
?>
