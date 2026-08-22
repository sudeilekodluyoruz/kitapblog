<?php

include("../includes/db.php");

$id = (int)$_GET["id"];

mysqli_query($baglanti,

"UPDATE yorumlar

SET onay=1

WHERE yorum_id='$id'");

header("Location:yorumlar.php?onay=ok");
exit();

exit();