<?php
session_start();
include("includes/db.php");

$filtre_modu = false;
$sorgu_ek = "";
$baslik = "";
$arama = "";

if(isset($_GET["ara"]))
{
    $arama = mysqli_real_escape_string($baglanti,$_GET["ara"]);
}

if(isset($_GET["sirala"]) && !empty($_GET["sirala"]))
{
    $filtre_modu=true;
    $secim=$_GET["sirala"];

    if($secim=="fiyat_artan")
    {
        $sorgu_ek="ORDER BY fiyat ASC";
        $baslik="Fiyata Göre (Artan)";
    }
    elseif($secim=="fiyat_azalan")
    {
        $sorgu_ek="ORDER BY fiyat DESC";
        $baslik="Fiyata Göre (Azalan)";
    }
    elseif($secim=="a_z")
    {
        $sorgu_ek="ORDER BY kitap_adi ASC";
        $baslik="İsme Göre (A-Z)";
    }
    elseif($secim=="z_a")
    {
        $sorgu_ek="ORDER BY kitap_adi DESC";
        $baslik="İsme Göre (Z-A)";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sude'nin Kitaplığı</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">

<i class="fa-solid fa-book-open"></i>

Sude'nin Kitaplığı

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link active" href="index.php">
Anasayfa
</a>
</li>

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle"
href="#"
data-bs-toggle="dropdown">

Kategoriler

</a>

<ul class="dropdown-menu">

<?php

$kat=mysqli_query($baglanti,"SELECT * FROM kategoriler");

while($k=mysqli_fetch_assoc($kat))
{
?>

<li>

<a class="dropdown-item"
href="kategori.php?id=<?=$k["kategori_id"]?>">

<?=$k["kategori_adi"]?>

</a>

</li>

<?php
}
?>

</ul>

</li>

<li class="nav-item">

<a class="nav-link"
href="#footer">

İletişim

</a>

</li>

<?php if(isset($_SESSION["uye_id"])) { ?>

<li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle"
       href="#"
       role="button"
       data-bs-toggle="dropdown">

        <i class="fa-solid fa-user"></i>
        <?php echo $_SESSION["kullanici"]; ?>

    </a>

    <ul class="dropdown-menu">

        <li>
           <a class="dropdown-item" href="kullanıcı/profil.php">
                <i class="fa-solid fa-user me-2"></i>Profilim
            </a>
        </li>

        <li>
           <a class="dropdown-item" href="kullanıcı/cikiss.php">
                <i class="fa-solid fa-right-from-bracket me-2"></i>Çıkış Yap
            </a>
        </li>

    </ul>

</li>

<?php } else { ?>

<li class="nav-item">

    <a class="nav-link" href="kullanıcı/giriss.php">
        Giriş Yap
    </a>

</li>

<li class="nav-item ms-2">

   <a class="btn btn-primary ms-2" href="kullanıcı/kayit.php">
        Kayıt Ol
    </a>

</li>

<?php } ?>

<li class="nav-item ms-2">

    <a href="admin/giris.php"
       class="btn btn-warning">

        Yönetici

    </a>

</li>

</ul>

</div>

</div>

</nav>

<!-- HERO -->

<section class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1>

Kitap Dünyasına Hoş Geldiniz

</h1>

<p>

Roman, Bilim Kurgu, Korku, Polisiye ve daha birçok kitap türünü
inceleyebilirsiniz.

</p>

<a href="#kitaplar"
class="btn btn-primary">

Kitapları Gör

</a>

</div>

<div class="col-lg-6 text-center">

<i class="fa-solid fa-book hero-icon"></i>

</div>

</div>

</div>

</section>

<!-- ARAMA -->

<div class="container mt-5">

<form action="index.php" method="GET">

<div class="row">

<div class="col-md-8">

<input
type="text"
name="ara"
class="form-control"

placeholder="Kitap adı veya yazar ara..."

value="<?php echo $arama;?>">

</div>

<div class="col-md-2">

<select
name="sirala"
class="form-select">

<option value="">Sıralama</option>

<option value="a_z">A-Z</option>

<option value="z_a">Z-A</option>

<option value="fiyat_artan">Fiyat ↑</option>

<option value="fiyat_azalan">Fiyat ↓</option>

</select>

</div>

<div class="col-md-2">

<button
class="btn btn-success w-100">

Ara

</button>

</div>

</div>

</form>

</div>

<div class="container mt-5" id="kitaplar">
    <?php

$sql = "SELECT * FROM kitaplar";

if($arama != "")
{
    $sql .= " WHERE kitap_adi LIKE '%$arama%' 
              OR yazar LIKE '%$arama%'";
}

if($sorgu_ek != "")
{
    $sql .= " " . $sorgu_ek;
}
else
{
    $sql .= " ORDER BY kitap_id DESC";
}

$sonuc = mysqli_query($baglanti,$sql);

?>

<h3 class="mb-4">

<?php

if($arama!="")
{
    echo "Arama Sonuçları";
}
else
{
    echo "Kitaplar";
}

?>

</h3>

<div class="row">

<?php

if(mysqli_num_rows($sonuc)>0)
{

while($kitap=mysqli_fetch_assoc($sonuc))
{

?>

<div class="col-md-3 mb-4">

<div class="card h-100 shadow-sm book-card">

<img
src="assets/img/<?php echo $kitap["kapak_foto"]; ?>"
class="card-img-top"
height="330">

<div class="card-body d-flex flex-column">

<h5 class="card-title">

<?php echo $kitap["kitap_adi"]; ?>

</h5>

<p class="text-muted">

<?php echo $kitap["yazar"]; ?>

</p>

<h4 class="text-success">

<?php echo $kitap["fiyat"]; ?> ₺

</h4>

<div class="mt-auto">

<a
href="detay.php?id=<?php echo $kitap["kitap_id"]; ?>"
class="btn btn-primary w-100">

İncele

</a>

</div>

</div>

</div>

</div>

<?php

}

}
else
{

?>

<div class="col-12">

<div class="alert alert-warning">

Aradığınız kitaba ait sonuç bulunamadı.

</div>

</div>

<?php

}

?>

</div>

<hr class="my-5">

<h3 class="mb-4">

En Uygun Fiyatlı Kitaplar

</h3>

<div class="row">

<?php

$uygun=mysqli_query($baglanti,
"SELECT * FROM kitaplar ORDER BY fiyat ASC LIMIT 4");

while($u=mysqli_fetch_assoc($uygun))
{

?>

<div class="col-md-3 mb-4">

<div class="card shadow-sm h-100">

<img
src="assets/img/<?php echo $u["kapak_foto"];?>"
class="card-img-top"
height="300">

<div class="card-body">

<h6>

<?php echo $u["kitap_adi"];?>

</h6>

<p>

<?php echo $u["yazar"];?>

</p>

<h5 class="text-danger">

<?php echo $u["fiyat"];?> ₺

</h5>

<a
href="detay.php?id=<?php echo $u["kitap_id"];?>"
class="btn btn-outline-danger w-100">

Detay

</a>

</div>

</div>

</div>

<?php

}

?>

</div>

</div>

<footer class="bg-dark text-white mt-5 py-4" id="footer">

<div class="container text-center">

<h4>Sude'nin Kitaplığı</h4>

<p>

Bu proje Web Projesi dersi final ödevi kapsamında hazırlanmıştır.

</p>

<p>

İstanbul / Türkiye

</p>

<a href="admin/giris.php" class="btn btn-warning">

Yönetici Girişi

</a>

<hr>

<p class="mb-0">

© 2026 Tüm Hakları Saklıdır.

</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>