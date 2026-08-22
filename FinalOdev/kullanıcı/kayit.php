<?php
session_start();
include("../includes/db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";

$mesaj = "";

if(isset($_POST["kayit"])){

    $ad_soyad = mysqli_real_escape_string($baglanti, trim($_POST["ad_soyad"]));
    $kullanici = mysqli_real_escape_string($baglanti, trim($_POST["kullanici"]));
    $email = mysqli_real_escape_string($baglanti, trim($_POST["email"]));

    $sifre = $_POST["sifre"];
    $sifre2 = $_POST["sifre2"];

    if($sifre != $sifre2){

        $mesaj = "<div class='alert alert-danger'>Şifreler uyuşmuyor.</div>";

    }else{

        $kontrol = mysqli_query($baglanti,
        "SELECT * FROM uyeler
        WHERE kullanici_adi='$kullanici'
        OR email='$email'");

        if(mysqli_num_rows($kontrol)>0){

            $mesaj = "<div class='alert alert-warning'>
            Bu kullanıcı adı veya e-posta kullanılmaktadır.
            </div>";

        }else{
            $kod = rand(100000,999999);

$hash = password_hash($sifre,PASSWORD_DEFAULT);

$ekle = mysqli_query($baglanti,

"INSERT INTO uyeler
(ad_soyad,kullanici_adi,email,sifre,dogrulama_kodu,aktif)

VALUES

('$ad_soyad',
'$kullanici',
'$email',
'$hash',
'$kod',
'0')");

           if($ekle){

    $mail = new PHPMailer(true);

    try{

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        $mail->Username = "klcsude005@gmail.com";
        $mail->Password = "hakh xmsw onhe emcq";

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";

        $mail->setFrom("klcsude005@gmail.com","Sude Kitaplığı");
        $mail->addAddress($email,$ad_soyad);

        $mail->isHTML(true);

        $mail->Subject = "E-Posta Doğrulama";

       $mail->Body = "
<h2>Merhaba $ad_soyad</h2>

<p>Mail doğrulama kodunuz:</p>

<h1>$kod</h1>

<p>Bu kodu sitedeki doğrulama ekranına giriniz.</p>
";

        $mail->send();

       $_SESSION["mail"] = $email;
header("Location:onay.php");
exit();
        exit();

   }catch(Exception $e){

    $mesaj = "<div class='alert alert-danger'>
    Mail gönderilemedi.<br>
    ".$mail->ErrorInfo."
    </div>";

}

} else {

    $mesaj = "<div class='alert alert-danger'>
    Kayıt başarısız.
    </div>";

}
        }

    }

}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Kayıt Ol</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#eef2f5;

}

.kutu{

width:450px;

max-width:95%;

margin:60px auto;

background:white;

padding:30px;

border-radius:12px;

box-shadow:0 0 12px rgba(0,0,0,.1);

}

</style>

</head>

<body>

<div class="kutu">

<h2 class="text-center mb-4">

📚 Üye Kayıt

</h2>

<?php echo $mesaj; ?>

<form method="POST">

<label>Ad Soyad</label>

<input
type="text"
name="ad_soyad"
class="form-control mb-3"
required>

<label>Kullanıcı Adı</label>

<input
type="text"
name="kullanici"
class="form-control mb-3"
required>

<label>E-Posta</label>

<input
type="email"
name="email"
class="form-control mb-3"
required>

<label>Şifre</label>

<input
type="password"
name="sifre"
class="form-control mb-3"
required>

<label>Şifre Tekrar</label>

<input
type="password"
name="sifre2"
class="form-control mb-4"
required>

<button
type="submit"
name="kayit"
class="btn btn-primary w-100">

Kayıt Ol

</button>

</form>

<hr>

<div class="text-center">

Zaten hesabın var mı?

<a href="giriss.php">

Giriş Yap

</a>

</div>

</div>

</body>

</html>