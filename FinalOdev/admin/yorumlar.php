<?php
include("../includes/db.php");

$yorumlar = mysqli_query($baglanti,

"SELECT yorumlar.*,
uyeler.kullanici_adi,
kitaplar.kitap_adi

FROM yorumlar

INNER JOIN uyeler
ON yorumlar.uye_id = uyeler.uye_id

INNER JOIN kitaplar
ON yorumlar.kitap_id = kitaplar.kitap_id

WHERE yorumlar.onay = 0

ORDER BY yorum_id DESC");
?>

<!doctype html>

<html lang="tr">

<head>

<meta charset="UTF-8">

<title>Yorum Onayları</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<?php
if(isset($_GET["onay"]))
{
?>

<div class="alert alert-success alert-dismissible fade show">

    ✅ Yorum başarıyla yayınlandı.

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
    </button>

</div>

<?php
if(isset($_GET["sil"]))
{
?>

<div class="alert alert-danger alert-dismissible fade show">

🗑️ Yorum başarıyla silindi.

<button type="button"
class="btn-close"
data-bs-dismiss="alert"></button>

</div>

<?php
}
?>

<?php
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Bekleyen Yorumlar</h2>

    <a href="index.php" class="btn btn-primary">
        ← Admin Paneline Dön
    </a>

</div>

<table class="table table-bordered">

<tr>

<th>ID</th>
<th>Kitap</th>
<th>Kullanıcı</th>
<th>Puan</th>
<th>Yorum</th>
<th>İşlem</th>

</tr>

<?php while($y=mysqli_fetch_assoc($yorumlar)){ ?>

<tr>

<td><?php echo $y["yorum_id"]; ?></td>

<td><?php echo $y["kitap_adi"]; ?></td>

<td><?php echo $y["kullanici_adi"]; ?></td>

<td><?php echo $y["puan"]; ?></td>

<td><?php echo $y["yorum"]; ?></td>

<td>

<a href="yorum_onay.php?id=<?php echo $y["yorum_id"]; ?>"
class="btn btn-success btn-sm">

Onayla

</a>

<a href="yorum_sil.php?id=<?php echo $y["yorum_id"]; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Bu yorumu silmek istediğinize emin misiniz?')">

Sil

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>