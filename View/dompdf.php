<?php
require __DIR__.'/vendor/autoload.php';

use Dompdf\Dompdf;

use Dompdf\Options;

//INSTANCIA DE OPTIONS

$options = new Options();

$options->setChroot(__DIR__);

$options->setIsRemoteEnabled(true);

//INSTANCIA DE DOMPOF

$dompdf = new Dompdf($options);

//CARREGA O HTML PARA DENTRO DA CLASSE

$dompdf->loadHtmlFile(__DIR__.'/teste.html');

$dompdf->setPaper ('A3','landscape');

$dompdf->render();

//IMPRIME D CONTELIDO DO ARQUIVO PDF NA TELA 
// header ("Content-type: application/pdf");

// echo $dompdf->output();

$dompdf->stream("arquivo.pdf");
?>