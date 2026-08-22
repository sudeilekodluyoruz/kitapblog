<?php
include("includes/db.php");

if(!isset($_GET["id"]))
{
    header("Location:index.php");
    exit();
}

$kategori_id=(int)$_GET["id"];

$kategori=mysqli_query($baglanti,
"SELECT * FROM kategoriler
WHERE kategori_id='$kategori_id'");

if(mysqli_num_rows($kategori)==0)
{
    header("Location:index.php");
    exit();
}

$kat=mysqli_fetch_assoc($kategori);

$kitaplar=mysqli_query($baglanti,
"SELECT *
FROM kitaplar
WHERE kitap_turu='$kategori_id'
ORDER BY kitap_id DESC");

$toplam=mysqli_num_rows($kitaplar);
?>

<!DOCTYPE html>

<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>

<?php echo $kat["kategori_adi"]; ?>

</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand fw-bold"
href="index.php">

<i class="fa-solid fa-book-open"></i>

Sude'nin Kitaplığı

</a>

<button
class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a class="nav-link"
href="index.php">

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

$liste=mysqli_query($baglanti,
"SELECT * FROM kategoriler");

while($k=mysqli_fetch_assoc($liste))
{

?>

<li>

<a class="dropdown-item"

href="kategori.php?id=<?php echo $k["kategori_id"]; ?>">

<?php echo $k["kategori_adi"]; ?>

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

<li class="nav-item ms-3">

<a href="admin/giris.php"
class="btn btn-warning">

Yönetici

</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container mt-5">

<h2 class="fw-bold">

<i class="fa-solid fa-folder-open text-primary"></i>

<?php echo $kat["kategori_adi"]; ?>

</h2>

<p class="text-muted">

Bu kategoride toplam

<strong>

<?php echo $toplam; ?>

</strong>

kitap bulunmaktadır.

</p>

<div class="alert alert-light border">

Bu sayfada

<strong>

<?php echo $kat["kategori_adi"]; ?>

</strong>

kategorisindeki kitaplar listelenmektedir.

</div>

<div class="row">

<?php

if($toplam>0)
{

while($kitap=mysqli_fetch_assoc($kitaplar))
{

?>

<div class="col-lg-3 col-md-4 col-sm-6 mb-4">

<div class="card h-100 shadow-sm book-card">

<img

src="assets/img/<?php echo $kitap["kapak_foto"]; ?>"

class="card-img-top"

style="height:320px;object-fit:cover;">

<div class="card-body d-flex flex-column">

<h5>

<?php echo $kitap["kitap_adi"]; ?>

</h5>

<p class="text-muted">

<?php echo $kitap["yazar"]; ?>

</p>

<span class="badge bg-primary mb-3">

<?php echo $kat["kategori_adi"]; ?>

</span>

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

<div class="alert alert-warning text-center p-5">

<h4>

Bu kategoride henüz kitap bulunmuyor.

</h4>

<a
href="index.php"
class="btn btn-secondary mt-3">

Ana Sayfaya Dön

</a>

</div>

</div>

<?php

}

?>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>