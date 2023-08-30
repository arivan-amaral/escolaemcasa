<?php
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";


$res=$conexao->query("SELECT * from aluno where aluno.imagem_carteirinha_transporte !=''");
foreach ($res as $key => $value) {

$imagem_carteirinha_transporte=$value['imagem_carteirinha_transporte'];

$new_width = 1000;
$new_height = 900;

// Carregue a imagem original
$original_image = imagecreatefromjpeg("imagem_carteirinha_transporte/bkp_fotos/$imagem_carteirinha_transporte");

// Obtenha as dimensões da imagem original
$original_width = imagesx($original_image);
$original_height = imagesy($original_image);

// Calcule a posição central da imagem original
$center_x = round($original_width / 2);
$center_y = round($original_height / 2);

// Calcule as coordenadas do ponto superior esquerdo da imagem cortada
$top_left_x = $center_x - round($new_width / 2);
$top_left_y = $center_y - round($new_height / 2);

// Crie uma nova imagem com as dimensões desejadas
$cropped_image = imagecreatetruecolor($new_width, $new_height);

// Recorte a imagem original para a nova imagem
imagecopyresampled($cropped_image, $original_image, 0, 0, $top_left_x, $top_left_y, $new_width, $new_height, $new_width, $new_height);

// Salve a nova imagem
imagejpeg($cropped_image, "imagem_carteirinha_transporte/cortada/$imagem_carteirinha_transporte");

// Libere a memória usada pelas imagens
imagedestroy($original_image);
imagedestroy($cropped_image);

}