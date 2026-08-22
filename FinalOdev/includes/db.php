<?php
$host = "localhost";
$kullanici = "root";
$sifre = ""; 
$veritabani = "odevv_db";
$baglanti = mysqli_connect($host, $kullanici, $sifre, $veritabani);
mysqli_set_charset($baglanti, "utf8");
?>