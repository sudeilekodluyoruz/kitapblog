<?php
session_start();

if (!isset($_SESSION['yonetici'])) {
    header("Location: giris.php");
    exit;
}

include("../includes/db.php");

$mesaj = "";

$otomatik_barkod = rand(100000000000,999999999999);

if(isset($_POST["kaydet"])){

    $kitap_adi  = mysqli_real_escape_string($baglanti,$_POST["kitap_adi"]);
    $kitap_turu = $_POST["kitap_turu"];
    $yazar      = mysqli_real_escape_string($baglanti,$_POST["yazar"]);
    $sayfa      = $_POST["sayfa"];
    $yili       = $_POST["yili"];
    $dili       = mysqli_real_escape_string($baglanti,$_POST["dili"]);
    $fiyat      = $_POST["fiyat"];

    $barkod = empty($_POST["barkod"])
        ? $otomatik_barkod
        : $_POST["barkod"];

    $kapak = "";

    if(isset($_FILES["kapak_foto"]) && $_FILES["kapak_foto"]["error"]==0){

        $uzanti = pathinfo($_FILES["kapak_foto"]["name"],PATHINFO_EXTENSION);

        $kapak = time().rand(100,999).".".$uzanti;

        move_uploaded_file(
            $_FILES["kapak_foto"]["tmp_name"],
            "../assets/img/".$kapak
        );
    }

    $sql = "INSERT INTO kitaplar
    (kitap_adi,kitap_turu,yazar,sayfa,yili,dili,fiyat,barkod,kapak_foto)

    VALUES

    ('$kitap_adi',
    '$kitap_turu',
    '$yazar',
    '$sayfa',
    '$yili',
    '$dili',
    '$fiyat',
    '$barkod',
    '$kapak')";

    if(mysqli_query($baglanti,$sql)){

        $mesaj="Kitap başarıyla eklendi.";

    }else{

        $mesaj="Kayıt sırasında hata oluştu.";

    }

}

$kategoriler = mysqli_query($baglanti,"SELECT * FROM kategoriler");

?>

<!DOCTYPE html>

<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Yeni Kitap Ekle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

    background:#eef2f5;

    font-family:Arial,Helvetica,sans-serif;

}

header{

    background:white;

    padding:18px 35px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 2px 10px rgba(0,0,0,.08);

}

header h3{

    margin:0;

    color:#0d6efd;

}

header a{

    text-decoration:none;

    margin-left:18px;

    color:#444;

    font-weight:bold;

}

header a:hover{

    color:#0d6efd;

}

.form-box{

    width:900px;

    max-width:95%;

    margin:35px auto;

    background:white;

    border-radius:12px;

    padding:30px;

    box-shadow:0 0 10px rgba(0,0,0,.08);

}

.preview{

    width:140px;

    height:190px;

    border:1px solid #ddd;

    object-fit:cover;

    border-radius:6px;

    display:block;

    margin-top:10px;

}

</style>

</head>

<body>

<header>

<h3>📚 Sude Kitap</h3>

<div>

<a href="index.php">Anasayfa</a>

<a href="ekle.php">Kitap Ekle</a>

<a href="cikis.php">Çıkış</a>

</div>

</header>

<div class="form-box">

<h2>Yeni Kitap Ekle</h2>

<p class="text-secondary">

Aşağıdaki bilgileri doldurarak sisteme yeni kitap ekleyebilirsiniz.

</p>

<?php

if($mesaj!=""){

?>

<div class="alert alert-info">

<?php echo $mesaj; ?>

</div>

<?php

}

?>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Kitap Adı</label>

<input
type="text"
name="kitap_adi"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Yazar</label>

<input
type="text"
name="yazar"
class="form-control"
required>

</div>
<div class="row">

    <div class="col-md-4 mb-3">

        <label class="form-label">Kategori</label>

        <select name="kitap_turu" class="form-select" required>

            <?php
            while($kategori = mysqli_fetch_assoc($kategoriler)){
            ?>

            <option value="<?php echo $kategori["kategori_id"]; ?>">
                <?php echo $kategori["kategori_adi"]; ?>
            </option>

            <?php
            }
            ?>

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Fiyat (TL)</label>

        <input
        type="number"
        step="0.01"
        name="fiyat"
        class="form-control"
        required>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Basım Yılı</label>

        <input
        type="number"
        name="yili"
        class="form-control"
        value="<?php echo date('Y'); ?>">

    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">

        <label class="form-label">Sayfa Sayısı</label>

        <input
        type="number"
        name="sayfa"
        class="form-control">

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Dil</label>

        <input
        type="text"
        name="dili"
        class="form-control"
        value="Türkçe">

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Barkod</label>

        <input
        type="text"
        name="barkod"
        class="form-control"
        value="<?php echo $otomatik_barkod; ?>">

    </div>

</div>

<div class="mb-3">

    <label class="form-label">Kapak Fotoğrafı</label>

    <input
    type="file"
    name="kapak_foto"
    class="form-control"
    accept="image/*"
    onchange="resimGoster(event)"
    required>

    <img
    id="onizleme"
    class="preview"
    src="../assets/img/resim_yok.png"
    alt="Önizleme">

</div>

<div class="mt-4">

    <button
    type="submit"
    name="kaydet"
    class="btn btn-primary">

        Kitabı Kaydet

    </button>

    <a
    href="index.php"
    class="btn btn-secondary">

        İptal

    </a>

</div>

</form>

</div>

<script>

function resimGoster(event){

    const resim = document.getElementById("onizleme");

    resim.src = URL.createObjectURL(event.target.files[0]);

}

</script>

<footer class="text-center mt-5 mb-4 text-secondary">

<hr>

<p>

Sude Kitap Yönetim Paneli © <?php echo date("Y"); ?>

</p>

</footer>

</body>

</html>