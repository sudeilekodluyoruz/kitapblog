<?php
session_start();
include("../includes/db.php");

$mesaj="";

if(isset($_GET["kayit"]))
{
    $mesaj="<div class='alert alert-success'>
    Kayıt başarılı. Giriş yapabilirsiniz.
    </div>";
}

if(isset($_POST["giris"]))
{
    $kullanici=mysqli_real_escape_string($baglanti,$_POST["kullanici"]);
    $sifre=$_POST["sifre"];

    $sorgu=mysqli_query($baglanti,
    "SELECT * FROM uyeler
    WHERE kullanici_adi='$kullanici'");

    if(mysqli_num_rows($sorgu)>0)
    {
        $uye=mysqli_fetch_assoc($sorgu);

  if(password_verify($sifre,$uye["sifre"]))
{
    if($uye["aktif"]==0)
{
    $mesaj = "<div class='alert alert-warning'>
    Hesabınızı doğrulamadınız.
    Lütfen mailinizi kontrol edin.
    </div>";
}
else
{$_SESSION["uye_id"]=$uye["uye_id"];
$_SESSION["kullanici"]=$uye["kullanici_adi"];
$_SESSION["ad_soyad"]=$uye["ad_soyad"];

header("Location:../index.php");
exit();
   
    }
}
        else
        {
            $mesaj="<div class='alert alert-danger'>
            Şifre yanlış.
            </div>";
        }
    }
    else
    {
        $mesaj="<div class='alert alert-danger'>
        Böyle bir kullanıcı bulunamadı.
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Giriş Yap</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#eef2f5;
}

.kutu{
width:430px;
max-width:95%;
margin:70px auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 0 10px rgba(0,0,0,.1);
}

</style>

</head>

<body>

<div class="kutu">

<h2 class="text-center mb-4">

📚 Giriş Yap

</h2>

<?php echo $mesaj; ?>

<form method="POST">

<label>Kullanıcı Adı</label>

<input
type="text"
name="kullanici"
class="form-control mb-3"
required>

<label>Şifre</label>

<input
type="password"
name="sifre"
class="form-control mb-4"
required>

<button
type="submit"
name="giris"
class="btn btn-primary w-100">

Giriş Yap

</button>

</form>

<hr>

<div class="text-center">

Hesabın yok mu?

<a href="kayit.php">

Kayıt Ol

</a>

</div>

</div>

</body>

</html>