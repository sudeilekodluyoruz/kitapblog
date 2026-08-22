<?php
session_start();

if(!isset($_SESSION["yonetici"]))
{
    header("Location:giris.php");
    exit();
}

include("../includes/db.php");

$uyeler=mysqli_query($baglanti,
"SELECT * FROM uyeler
ORDER BY uye_id DESC");
?>

<!DOCTYPE html>

<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Üyeler</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#eef2f5;
}

.kutu{
width:95%;
margin:40px auto;
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<div class="kutu">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>👥 Üye Listesi</h2>

<a href="index.php" class="btn btn-secondary">
Panele Dön
</a>

</div>

<table class="table table-bordered table-hover align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Ad Soyad</th>

<th>Kullanıcı Adı</th>

<th>E-Posta</th>

<th>Kayıt Tarihi</th>

<th width="120">İşlem</th>

</tr>

</thead>

<tbody>

<?php

while($uye=mysqli_fetch_assoc($uyeler))
{

?>

<tr>

<td><?php echo $uye["uye_id"]; ?></td>

<td><?php echo $uye["ad_soyad"]; ?></td>

<td><?php echo $uye["kullanici_adi"]; ?></td>

<td><?php echo $uye["email"]; ?></td>

<td><?php echo $uye["kayit_tarihi"]; ?></td>

<td>

<a
href="uye_sil.php?id=<?php echo $uye["uye_id"]; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Üye silinsin mi?')">

Sil

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</body>

</html>