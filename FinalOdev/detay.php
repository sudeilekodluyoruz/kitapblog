<?php
session_start();
include("includes/db.php");

if(!isset($_GET["id"]))
{
    header("Location:index.php");
    exit();
}

$id=(int)$_GET["id"];

$sql="SELECT kitaplar.*, kategoriler.kategori_adi
FROM kitaplar
INNER JOIN kategoriler
ON kitaplar.kitap_turu=kategoriler.kategori_id
WHERE kitap_id=$id";

$sonuc=mysqli_query($baglanti,$sql);

if(mysqli_num_rows($sonuc)==0)
{
    header("Location:index.php");
    exit();
}

$kitap=mysqli_fetch_assoc($sonuc);

$puan_sorgu=mysqli_query($baglanti,

"SELECT
AVG(puan) AS ortalama,
COUNT(*) AS toplam

FROM yorumlar

WHERE kitap_id='$id'");

$puan=mysqli_fetch_assoc($puan_sorgu);

$ortalama=round($puan["ortalama"],1);

$toplam_yorum=$puan["toplam"];

if(isset($_POST["yorum_gonder"]) && isset($_SESSION["uye_id"])) { $uye_id=$_SESSION["uye_id"]; $puan=(int)$_POST["puan"]; $yorum=mysqli_real_escape_string($baglanti,$_POST["yorum"]); mysqli_query($baglanti,
"INSERT INTO yorumlar
(kitap_id,uye_id,puan,yorum,onay)
VALUES
('$id','$uye_id','$puan','$yorum',0)"); }
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $kitap["kitap_adi"]; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">

<i class="fa-solid fa-book-open"></i>

Sude'nin Kitaplığı

</a>

<button class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

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

$kategori=mysqli_query($baglanti,"SELECT * FROM kategoriler");

while($k=mysqli_fetch_assoc($kategori))
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

<!-- Breadcrumb -->

<div class="container mt-4">

<nav>

<ol class="breadcrumb">

<li class="breadcrumb-item">

<a href="index.php">

Anasayfa

</a>

</li>

<li class="breadcrumb-item active">

<?php echo $kitap["kitap_adi"]; ?>

</li>

</ol>

</nav>

</div>

<!-- Kitap -->

<div class="container mt-3 mb-5">

<div class="card shadow">

<div class="row">

<div class="col-md-4 text-center p-4">

<img
src="assets/img/<?php echo $kitap["kapak_foto"]; ?>"
class="img-fluid rounded shadow">

</div>

<div class="col-md-8">

<div class="card-body">

<h2 class="mb-3">

<?php echo $kitap["kitap_adi"]; ?>

</h2>

<h5 class="text-secondary mb-4">

<?php echo $kitap["yazar"]; ?>

</h5>

<table class="table">

<tr>

<th width="180">

Kategori

</th>

<td>

<?php echo $kitap["kategori_adi"]; ?>

</td>

</tr>

<tr>

<th>

Basım Yılı

</th>

<td>

<?php echo $kitap["yili"]; ?>

</td>

</tr>

<tr>

<th>

Sayfa Sayısı

</th>

<td>

<?php echo $kitap["sayfa"]; ?>

</td>

</tr>

<tr>

<th>

Dil

</th>

<td>

<?php echo $kitap["dili"]; ?>

</td>

</tr>

<tr>

<th>

Barkod

</th>

<td>

<?php echo $kitap["barkod"]; ?>

</td>

</tr>

<tr>

<th>

Fiyat

</th>

<td class="text-success fw-bold fs-4">

<?php echo $kitap["fiyat"]; ?> ₺

</td>

</tr>

<tr>

<th>

Puan

</th>

<td>

<?php

if($toplam_yorum>0)
{

for($i=1;$i<=5;$i++)
{

if($i<=round($ortalama))
{

echo "<span style='color:orange;font-size:22px;'>★</span>";

}
else
{

echo "<span style='color:#ccc;font-size:22px;'>★</span>";

}

}

echo " <strong>".$ortalama."/5</strong>";

echo " <span class='text-muted'>(".$toplam_yorum." yorum)</span>";

}
else
{

echo "<span class='text-muted'>Henüz puan verilmedi.</span>";

}

?>

</td>

</tr>


</table>

<a href="index.php"
class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>

Ana Sayfaya Dön

</a>

</div>

</div>

</div>

</div>

</div>
<!-- KİTAP ÖZETİ -->

<div class="container mb-5">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                <i class="fa-solid fa-book-open-reader"></i>
                Kitap Özeti
            </h4>

        </div>

        <div class="card-body">

            <?php

            if(!empty($kitap["ozet"]))
            {
                echo nl2br($kitap["ozet"]);
            }
            else
            {
                echo "<div class='alert alert-warning'>
                        Bu kitap için henüz özet eklenmemiştir.
                      </div>";
            }

            ?>

        </div>

    </div>

</div>
<div class="container mb-5">

<hr>

<h3>Kullanıcı Yorumları</h3>

<?php if(isset($_SESSION["uye_id"])) { ?>

<form method="POST">

<label>Puan</label>

<select name="puan" class="form-select mb-3">

<option value="5">★★★★★</option>
<option value="4">★★★★☆</option>
<option value="3">★★★☆☆</option>
<option value="2">★★☆☆☆</option>
<option value="1">★☆☆☆☆</option>

</select>

<textarea
name="yorum"
class="form-control"
rows="4"
placeholder="Yorumunuzu yazınız..."
required></textarea>

<button
type="submit"
name="yorum_gonder"
class="btn btn-primary mt-3">

Yorumu Gönder

</button>

</form>

<?php } else { ?>

<div class="alert alert-warning">

Yorum yapmak için giriş yapmalısınız.

</div>

<?php } ?>

<hr>

<?php

$yorumlar=mysqli_query($baglanti,

"SELECT yorumlar.*,
uyeler.kullanici_adi

FROM yorumlar

INNER JOIN uyeler

ON yorumlar.uye_id=uyeler.uye_id

WHERE kitap_id='$id'
AND yorumlar.onay=1

ORDER BY yorum_id DESC");

while($y=mysqli_fetch_assoc($yorumlar))
{

?>

<div class="card mb-3">

<div class="card-body">

<h5>

<?php echo $y["kullanici_adi"]; ?>

</h5>

<p>

<?php
for($i=1;$i<=5;$i++)
{
echo ($i<=$y["puan"]) ? "⭐" : "☆";
}
?>

</p>

<p>

<?php echo nl2br($y["yorum"]); ?>

</p>

<small class="text-muted">

<?php echo $y["tarih"]; ?>

</small>

</div>

</div>

<?php

}

?>

</div>

<!-- BENZER KİTAPLAR -->

<div class="container mb-5">

<h3 class="mb-4">

<i class="fa-solid fa-book"></i>

Benzer Kitaplar

</h3>

<div class="row">

<?php

$kategori=$kitap["kitap_turu"];

$benzer=mysqli_query($baglanti,

"SELECT *
FROM kitaplar
WHERE kitap_turu='$kategori'
AND kitap_id!='$id'
LIMIT 4");

if(mysqli_num_rows($benzer)>0)
{

while($b=mysqli_fetch_assoc($benzer))
{

?>

<div class="col-md-3 mb-4">

<div class="card h-100 shadow-sm book-card">

<img

src="assets/img/<?php echo $b["kapak_foto"]; ?>"

class="card-img-top"

style="height:320px;object-fit:cover;">

<div class="card-body d-flex flex-column">

<h5>

<?php echo $b["kitap_adi"]; ?>

</h5>

<p class="text-muted">

<?php echo $b["yazar"]; ?>

</p>

<h5 class="text-success">

<?php echo $b["fiyat"]; ?> ₺

</h5>

<div class="mt-auto">

<a

href="detay.php?id=<?php echo $b["kitap_id"]; ?>"

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

<div class="alert alert-info">

Bu kategoriye ait başka kitap bulunamadı.

</div>

</div>

<?php

}

?>

</div>

</div>

<!-- FOOTER -->

<footer class="bg-dark text-white pt-4 pb-3 mt-5" id="footer">

<div class="container">

<div class="row">

<div class="col-md-4">

<h5>Sude'nin Kitaplığı</h5>

<p>

İnternet Programcılığı Final Projesi kapsamında hazırlanmıştır.

</p>

</div>

<div class="col-md-4">

<h5>Hızlı Menü</h5>

<ul class="list-unstyled">

<li><a href="index.php" class="text-white text-decoration-none">Anasayfa</a></li>

<li><a href="admin/giris.php" class="text-white text-decoration-none">Yönetici Girişi</a></li>

</ul>

</div>

<div class="col-md-4">

<h5>İletişim</h5>

<p>

<i class="fa-solid fa-location-dot"></i>

İstanbul / Türkiye

</p>

<p>

<i class="fa-solid fa-envelope"></i>

ogrenci@uni.edu.tr

</p>

</div>

</div>

<hr>

<div class="text-center">

© 2026 Sude'nin Kitaplığı

</div>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>