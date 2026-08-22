<?php
session_start();
include("../includes/db.php");

$hata = "";

if (isset($_POST["giris"])) {

    $kullanici = trim($_POST["kullanici"]);
    $sifre = md5(trim($_POST["sifre"]));

    $sql = "SELECT * FROM yoneticiler WHERE kadi='$kullanici' AND sifre='$sifre'";
    $sonuc = mysqli_query($baglanti, $sql);

    if ($sonuc && mysqli_num_rows($sonuc) == 1) {

        $_SESSION["yonetici"] = $kullanici;

        header("Location: index.php");
        exit;

    } else {

        $hata = "Kullanıcı adı veya şifre hatalı!";

    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Yönetici Girişi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#eef2f5;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial;
}

.giris{
    width:420px;
    background:white;
    padding:35px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,.1);
}

h2{
    text-align:center;
    margin-bottom:10px;
}

p{
    text-align:center;
    color:#666;
    margin-bottom:25px;
}

</style>

</head>

<body>

<div class="giris">

<h2>📚 Sude Kitap</h2>

<p>Yönetici Giriş Paneli</p>

<?php
if($hata!=""){
?>
<div class="alert alert-danger">
<?php echo $hata; ?>
</div>
<?php
}
?>

<form method="POST">

<div class="mb-3">

<label>Kullanıcı Adı</label>

<input
type="text"
name="kullanici"
class="form-control"
required>

</div>

<div class="mb-4">

<label>Şifre</label>

<input
type="password"
name="sifre"
class="form-control"
required>

</div>

<div class="d-grid">

<button
type="submit"
name="giris"
class="btn btn-primary">

Giriş Yap

</button>

</div>

</form>

</div>

</body>

</html>
