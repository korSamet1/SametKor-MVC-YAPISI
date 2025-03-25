<?php
session_start(); // Oturum başlat
session_destroy(); // Oturumu sonlandır
header("Location: /smt/index.php"); // Ana sayfaya yönlendir
exit;
?>