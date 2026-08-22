<?php
session_start();

if(!isset($_SESSION['yonetici'])) { header("Location: giris.php"); exit; }

include("../includes/db.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];


    $resim_bul = mysqli_query($baglanti, "SELECT kapak_foto FROM kitaplar WHERE kitap_id = $id");
    $resim_veri = mysqli_fetch_assoc($resim_bul);
    

    $dosya_yolu = "../assets/img/" . $resim_veri['kapak_foto'];
    if(file_exists($dosya_yolu)) {
        unlink($dosya_yolu); 
    }
    $sil = mysqli_query($baglanti, "DELETE FROM kitaplar WHERE kitap_id = $id");

    if($sil) {
        header("Location: index.php");
    } else {
        echo "Hata oluştu: " . mysqli_error($baglanti);
    }
}
?>