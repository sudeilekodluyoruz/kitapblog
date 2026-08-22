<?php
session_start();
include("../includes/db.php");

$mesaj = "";

if(!isset($_SESSION["mail"]))
{
    header("Location:kayit.php");
    exit();
}

$email = $_SESSION["mail"];

if(isset($_POST["dogrula"]))
{
    $kod = $_POST["kod"];

    $kontrol = mysqli_query($baglanti,

    "SELECT * FROM uyeler
    WHERE email='$email'
    AND dogrulama_kodu='$kod'");

    if(mysqli_num_rows($kontrol)>0)
    {
        mysqli_query($baglanti,

        "UPDATE uyeler
        SET aktif='1',
        dogrulama_kodu=NULL
        WHERE email='$email'");

        unset($_SESSION["mail"]);

        $mesaj = "
        <div class='alert alert-success'>
        Mail başarıyla doğrulandı.<br>
        3 saniye sonra giriş ekranına yönlendiriliyorsunuz.
        </div>";

        header("refresh:3;url=giriss.php");
    }
    else
    {
        $mesaj = "
        <div class='alert alert-danger'>
        Girdiğiniz doğrulama kodu yanlış.
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">

<title>Mail Doğrulama</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#eef2f5;
}

.kutu{

width:450px;
margin:80px auto;
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

📧 Mail Doğrulama

</h2>

<?php echo $mesaj; ?>

<p class="text-center">

Mail adresinize gönderilen
6 haneli doğrulama kodunu giriniz.

</p>

<form method="POST">

<input
type="text"
name="kod"
class="form-control mb-3"
maxlength="6"
placeholder="Doğrulama Kodu"
required>

<button
type="submit"
name="dogrula"
class="btn btn-success w-100">

Kodu Doğrula

</button>

</form>

</div>

</body>

</html>