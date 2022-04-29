<?php 
setcookie('notificado', '1', (time()+(300*24*3600)));

 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];
header("location:diario_frequencia.php?$url_get");
?>