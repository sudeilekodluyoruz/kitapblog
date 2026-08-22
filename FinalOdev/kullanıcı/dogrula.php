<?php
include("../includes/db.php");

if(isset($_GET["kod"]))
{
    $kod = mysqli_real_escape_string($baglanti,$_GET["kod"]);

    $sorgu = mysqli_query($baglanti,
    "SELECT * FROM uyeler
    WHERE onay_kodu='$kod'");

    if(mysqli_num_rows($sorgu)>0)
    {
        mysqli_query($baglanti,
        "UPDATE uyeler
        SET aktif='1',
            onay_kodu=NULL
        WHERE onay_kodu='$kod'");

        echo "
        <h2>✅ Hesabınız başarıyla doğrulandı.</h2>
        <br>
        <a href='giriss.php'>Giriş Yap</a>";
    }
    else
    {
        echo "Geçersiz doğrulama bağlantısı.";
    }
}
else
{
    echo "Kod bulunamadı.";
}
?>