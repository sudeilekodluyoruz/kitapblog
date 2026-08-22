<?php
session_start();

// Oturum değişkenlerini temizle
$_SESSION = [];

// Oturumu sonlandır
session_destroy();

// Ana siteye yönlendir
header("Location: ../index.php");
exit;
?>