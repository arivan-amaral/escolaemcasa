<?php 
include '../Model/Conexao.php';
$pagina_estatica="pagina_estatica/listar_alunos_da_turma.php idturma=6288 nome_turma=MATERNAL 20I 20A idescola=227 idserie=1.php";

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

   $criar_nova=false;
if (file_exists("pagina_estatica/".$nome_url)) {
  $data_file = date("Y-m-d H:i:s", filemtime("$pagina_estatica"));
  $data_atual= date('Y-m-d H:i:s');
  $diferenca=(strtotime($data_atual) - strtotime($data_file));
  if ($diferenca>500) {
    $criar_nova=true;
    
  }else{
    $criar_nova=false;

  }

}else{
  $criar_nova=true;

}

echo "
<br>
<br>
diferença:$diferenca";

?>