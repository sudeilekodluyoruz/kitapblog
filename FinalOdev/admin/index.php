<?php
session_start();

if (!isset($_SESSION['yonetici'])) {
    header("Location: giris.php");
    exit;
}

include("../includes/db.php");

$toplam_kitap = mysqli_num_rows(mysqli_query($baglanti,"SELECT * FROM kitaplar"));
$toplam_kategori = mysqli_num_rows(mysqli_query($baglanti,"SELECT * FROM kategoriler"));

$kitaplar = mysqli_query($baglanti,"SELECT * FROM kitaplar ORDER BY kitap_id DESC LIMIT 100");

?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Yönetim Paneli</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

    background:#eef2f5;

    font-family:Arial, Helvetica, sans-serif;

}

/* ÜST MENÜ */

header{

    background:white;

    padding:18px 40px;

    box-shadow:0 2px 10px rgba(0,0,0,.08);

    display:flex;

    justify-content:space-between;

    align-items:center;

}

.logo{

    font-size:26px;

    font-weight:bold;

    color:#0d6efd;

}

nav a{

    text-decoration:none;

    color:#444;

    margin-left:20px;

    font-weight:600;

}

nav a:hover{

    color:#0d6efd;

}

/* ANA ALAN */

.container-box{

    width:90%;

    margin:35px auto;

}

.welcome{

    background:white;

    border-radius:12px;

    padding:30px;

    margin-bottom:25px;

    box-shadow:0 3px 12px rgba(0,0,0,.08);

}

.welcome h2{

    margin-bottom:10px;

}

.quick-area{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:20px;

    margin-bottom:30px;

}

.quick-card{

    background:white;

    padding:25px;

    border-radius:12px;

    text-align:center;

    box-shadow:0 2px 10px rgba(0,0,0,.08);

    transition:.3s;

}

.quick-card:hover{

    transform:translateY(-4px);

}

.quick-card a{

    text-decoration:none;

    color:#222;

    display:block;

}

.quick-card h4{

    margin-top:15px;

}

.list-box{

    background:white;

    border-radius:12px;

    padding:25px;

    box-shadow:0 2px 10px rgba(0,0,0,.08);

}

.table img{

    width:55px;

    height:75px;

    object-fit:cover;

    border-radius:4px;

}

</style>

</head>

<body>

<header>

<div class="logo">

Sude'nin Kitaplığı

</div>

<nav>

<a href="index.php">Anasayfa</a>

<a href="ekle.php">Kitap Ekle</a>

<a href="cikis.php">Çıkış</a>


</nav>

</header>

<div class="container-box">

<div class="welcome">

<h2>Yönetim Paneline Hoş Geldiniz</h2>

<p>

Bu panel üzerinden kitap ekleyebilir, mevcut kayıtları düzenleyebilir veya silebilirsiniz.

</p>

<p>
<b>Tarih :</b> <?php echo date("d.m.Y"); ?>
</p>

<p>
<b>Toplam Kitap :</b> <?php echo $toplam_kitap; ?>
</p>

<div class="quick-card">

<a href="uyeler.php">



<h4>Üyeler</h4>

<p>Kayıtlı üyeleri görüntüle.</p>




<div class="quick-card">
<a href="yorumlar.php" >

<h4>Yorum Onayları</h4>


</div>

<div class="list-box" id="liste">

<h3>Son Eklenen Kitaplar</h3>

<hr>

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>

<th>ID</th>

<th>Kapak</th>

<th>Kitap Adı</th>

<th>Yazar</th>

<th>Fiyat</th>

<th>İşlem</th>

</tr>

</thead>

<tbody>
    <?php while($satir = mysqli_fetch_assoc($kitaplar)) { ?>
<tr>

    <td><?php echo $satir['kitap_id']; ?></td>

    <td>
        <img src="../assets/img/<?php echo $satir['kapak_foto']; ?>">
    </td>

    <td><?php echo $satir['kitap_adi']; ?></td>

    <td><?php echo $satir['yazar']; ?></td>

    <td><?php echo $satir['fiyat']; ?> TL</td>

    <td>
        <a href="duzenle.php?id=<?php echo $satir['kitap_id']; ?>" class="btn btn-sm btn-primary">Düzenle</a>
        <a href="sil.php?id=<?php echo $satir['kitap_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
    </td>

</tr>
<?php } ?>