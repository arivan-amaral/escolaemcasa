<?php 
include '../Model/Conexao.php';
$pagina_estatica="pagina_estatica/listar_alunos_da_turma.php idturma=6269 nome_turma=2 20ANO 20C idescola=13 idserie=4.php";

if (file_exists($pagina_estatica)) {
	$data_file = date("Y-m-d H:i:s", filemtime("$pagina_estatica"));
	echo "data atualização: $data_file";
}



    //$d1 = $data_file; // Data e hora que o atendimento começou
    //$d2 = "+ 3 hours"; // Tempo esperado para finalizar o atendimento
    // $teste = strtotime($d1 . $d2);
    $data_atual= date('Y-m-d H:i:s');
    $diferenca=(strtotime($data_atual) - strtotime($data_file));
    if ($diferenca>500) {
    	
    }

?>