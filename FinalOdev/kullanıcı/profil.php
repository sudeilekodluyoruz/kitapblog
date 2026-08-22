<?php
session_start();

if(!isset($_SESSION["uye_id"]))
{
    header("Location:giriss.php");
    exit();
}

include("../includes/db.php");

$id=$_SESSION["uye_id"];

$sorgu=mysqli_query($baglanti,
"SELECT * FROM uyeler
WHERE uye_id='$id'");

$uye=mysqli_fetch_assoc($sorgu);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Profilim</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#eef2f5;
}

.kutu{
width:650px;
max-width:95%;
margin:50px auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,.1);
}

.baslik{
text-align:center;
margin-bottom:25px;
}

</style>

</head>

<body>

<div class="kutu">

<div class="baslik">

<h2>👤 Profilim</h2>

<p class="text-muted">
Üyelik bilgilerin aşağıda yer almaktadır.
</p>

</div>

<table class="table table-bordered">

<tr>

<th width="220">Ad Soyad</th>

<td><?php echo $uye["ad_soyad"]; ?></td>

</tr>

<tr>

<th>Kullanıcı Adı</th>

<td><?php echo $uye["kullanici_adi"]; ?></td>

</tr>

<tr>

<th>E-Posta</th>

<td><?php echo $uye["email"]; ?></td>

</tr>

<tr>

<th>Kayıt Tarihi</th>

<td><?php echo $uye["kayit_tarihi"]; ?></td>

</tr>

</table>

<div class="text-center mt-4">

<a href="../index.php" class="btn btn-primary">

Anasayfaya Dön

</a>

<a href="cikiss.php" class="btn btn-danger">

Çıkış Yap

</a>

</div>

</div>

</body>

</html>