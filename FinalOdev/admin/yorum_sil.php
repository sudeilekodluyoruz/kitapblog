<?php

include("../includes/db.php");

$id = (int)$_GET["id"];

mysqli_query($baglanti,
"DELETE FROM yorumlar
WHERE yorum_id='$id'");

header("Location:yorumlar.php?sil=ok");
exit();

?>