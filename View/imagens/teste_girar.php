<?php 
	$path ='15873796015e9d7d9188c87.jpg';//$_GET['imagem'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);

		// Define o básico
	$graus = 90;
	$arquivo = "15873796015e9d7d9188c87.jpg";

	// Cria a imagem de JPEG (se for PNG deve usar imagecreatefrompng(), por exemplo)
	if ($ext=='png') {
		$imagem = imagecreatefrompng($arquivo);
	}else{
		$imagem = imagecreatefromjpeg($arquivo);
	}
	// Rotaciona
	$rotate = imagerotate($imagem, $graus, 0);

	echo "$rotate";
?>