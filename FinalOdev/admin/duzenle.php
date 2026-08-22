<?php
session_start();

if (!isset($_SESSION['yonetici'])) {
    header("Location: giris.php");
    exit;
}

include("../includes/db.php");

if(!isset($_GET["id"])){
    header("Location:index.php");
    exit;
}

$id = (int)$_GET["id"];

$kitap = mysqli_query($baglanti,"SELECT * FROM kitaplar WHERE kitap_id='$id'");

if(mysqli_num_rows($kitap)==0){
    header("Location:index.php");
    exit;
}

$veri = mysqli_fetch_assoc($kitap);

$kategoriler = mysqli_query($baglanti,"SELECT * FROM kategoriler");

?>

<!DOCTYPE html>

<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Kitap Düzenle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

    background:#f1f3f6;

    font-family:Arial, Helvetica, sans-serif;

}

header{

    background:white;

    padding:18px 35px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 2px 8px rgba(0,0,0,.08);

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

.kutu{

    width:900px;

    max-width:95%;

    margin:35px auto;

    background:white;

    padding:30px;

    border-radius:12px;

    box-shadow:0 2px 10px rgba(0,0,0,.08);

}

.onizleme{

    width:150px;

    height:210px;

    object-fit:cover;

    border:1px solid #ddd;

    border-radius:6px;

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

<div class="kutu">

<h2>Kitap Bilgilerini Düzenle</h2>

<p class="text-secondary">

Aşağıdaki alanları güncelleyebilirsiniz.

</p>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Kitap Adı</label>

<input
type="text"
name="kitap_adi"
class="form-control"
value="<?php echo htmlspecialchars($veri['kitap_adi']); ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Yazar</label>

<input
type="text"
name="yazar"
class="form-control"
value="<?php echo htmlspecialchars($veri['yazar']); ?>"
required>

</div>

</div>
<div class="row">

    <div class="col-md-4 mb-3">

        <label class="form-label">Kategori</label>

        <select name="kitap_turu" class="form-select">

            <?php

            while($kategori = mysqli_fetch_assoc($kategoriler)){

                $secili = "";

                if($kategori["kategori_id"] == $veri["kitap_turu"]){

                    $secili = "selected";

                }

            ?>

            <option
                value="<?php echo $kategori["kategori_id"]; ?>"
                <?php echo $secili; ?>>

                <?php echo $kategori["kategori_adi"]; ?>

            </option>

            <?php } ?>

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Fiyat</label>

        <input
        type="number"
        step="0.01"
        name="fiyat"
        class="form-control"
        value="<?php echo $veri["fiyat"]; ?>">

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Basım Yılı</label>

        <input
        type="number"
        name="yili"
        class="form-control"
        value="<?php echo $veri["yili"]; ?>">

    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">

        <label class="form-label">Sayfa Sayısı</label>

        <input
        type="number"
        name="sayfa"
        class="form-control"
        value="<?php echo $veri["sayfa"]; ?>">

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Dil</label>

        <input
        type="text"
        name="dili"
        class="form-control"
        value="<?php echo htmlspecialchars($veri["dili"]); ?>">

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Barkod</label>

        <input
        type="text"
        name="barkod"
        class="form-control"
        value="<?php echo htmlspecialchars($veri["barkod"]); ?>">

    </div>

</div>

<hr>

<h5>Kapak Fotoğrafı</h5>

<div class="row">

    <div class="col-md-4">

        <p class="text-secondary">Mevcut Kapak</p>

        <img
        src="../assets/img/<?php echo $veri["kapak_foto"]; ?>"
        id="onizleme"
        class="onizleme">

    </div>

    <div class="col-md-8">

        <label class="form-label">

            Yeni Kapak Fotoğrafı (İsteğe Bağlı)

        </label>

        <input
        type="file"
        name="kapak_foto"
        class="form-control"
        accept="image/*"
        onchange="resimGoster(event)">

        <small class="text-secondary">

            Yeni resim seçmezsen mevcut kapak kullanılmaya devam eder.

        </small>

    </div>

</div>

<div class="mt-4">

    <button
    type="submit"
    name="guncelle"
    class="btn btn-primary">

        Değişiklikleri Kaydet

    </button>

    <a
    href="index.php"
    class="btn btn-secondary">

        Vazgeç

    </a>

</div>
<?php

if(isset($_POST["guncelle"])){

    $kitap_adi  = mysqli_real_escape_string($baglanti,$_POST["kitap_adi"]);
    $kitap_turu = $_POST["kitap_turu"];
    $yazar      = mysqli_real_escape_string($baglanti,$_POST["yazar"]);
    $sayfa      = $_POST["sayfa"];
    $yili       = $_POST["yili"];
    $dili       = mysqli_real_escape_string($baglanti,$_POST["dili"]);
    $fiyat      = $_POST["fiyat"];
    $barkod     = $_POST["barkod"];

    $kapak = $veri["kapak_foto"];

    if(!empty($_FILES["kapak_foto"]["name"])){

        if(file_exists("../assets/img/".$kapak)){

            unlink("../assets/img/".$kapak);

        }

        $uzanti = pathinfo($_FILES["kapak_foto"]["name"],PATHINFO_EXTENSION);

        $yeni_resim = time().rand(100,999).".".$uzanti;

        move_uploaded_file(

            $_FILES["kapak_foto"]["tmp_name"],

            "../assets/img/".$yeni_resim

        );

        $kapak = $yeni_resim;

    }

    $guncelle = mysqli_query($baglanti,"UPDATE kitaplar SET

    kitap_adi='$kitap_adi',

    kitap_turu='$kitap_turu',

    yazar='$yazar',

    sayfa='$sayfa',

    yili='$yili',

    dili='$dili',

    fiyat='$fiyat',

    barkod='$barkod',

    kapak_foto='$kapak'

    WHERE kitap_id='$id'");

    if($guncelle){

        echo "<script>

        alert('Kitap başarıyla güncellendi.');

        window.location='index.php';

        </script>";

        exit;

    }else{

        echo "<div class='alert alert-danger'>

        Güncelleme sırasında hata oluştu.

        </div>";

    }

}

?>
<script>

function resimGoster(event){

    document.getElementById("onizleme").src=

    URL.createObjectURL(event.target.files[0]);

}

</script>

</div>

</body>

</html>
