<?php
session_start();

if(!isset($_SESSION["yonetici"]))
{
    header("Location:giris.php");
    exit();
}

include("../includes/db.php");

$id=(int)$_GET["id"];

mysqli_query($baglanti,
"DELETE FROM uyeler
WHERE uye_id='$id'");

header("Location:uyeler.php");
exit();