<?php 
set_time_limit(0);
  include_once '../Model/Conexao.php';
	include '../Controller/Conversao.php';

	$indice=0;
	$limite=250;

	if (isset($_GET['indice'])) {
		$indice=$_GET['indice'];
		$limite=$_GET['limite'];
	}
try {

$res_turma=$conexao->query("SELECT * FROM turma  limit $indice , $limite ");
	foreach ($res_turma as $key => $value) {
		$idturma= trim($value['idturma']);
		$nome_turma= trim($value['nome_turma']);
		
		// $array = explode(' ANO', $nome_turma);
		// $nome_turma=trim($array[0]);
		// $nome_turma=str_replace("PRE ","PRE ",$nome_turma);
		 $nome_turma=str_replace("PRE II ","PRE- II  - ",$nome_turma);
		 //$nome_turma=str_replace("PRE II ","PRE II - ",$nome_turma);
		// $nome_turma=str_replace(" I","I",$nome_turma);

		// $res_migra=$conexao->query("SELECT * FROM ecidademigrado_movescolar where turma_descr like '%$nome_turma%'");
		// foreach ($res_migra as $key2 => $value2) {
		// 		$idmovimentacao=$value2['idmovimentacao'];
		// 		$migra_nome_turma=$value2['turma_descr'];
   			echo "turma $idturma $nome_turma >>      <br>";
  			$conexao->exec("UPDATE ecidademigrado_movescolar SET turma_id=$idturma where turma_descr like '%$nome_turma%' AND turma_id IS NULL ");
		// 	// code...
		// }
		
	}

	 
 
		// echo "quantidade inserida: $conta";

		// if ($existe==0) {
		// 	echo "nao encontrada:$nome_turma <br><br>";
		// 	$nome_turma= str_replace('?', 'º', $nome_turma);
		// 	$conexao->exec("INSERT INTO turma(idturma,nome_turma) VALUES ($idturma,'$nome_turma')");
		// 	$quantidade_turmas++;
		// }else{
		// 	$turma_encontrada.= "encontrada:$nome_turma <br><br>";
		// 	$conta++;
		// }



$novo_indice=$indice+$limite;
echo "<br>limite:
<a href='migra_turmas.php?limite=$limite&indice=$novo_indice'> $indice + $limite</a><br>
 <img src='acabou.gif'>";
//echo "quantidade_turmas: $quantidade_turmas  quantidade total= $conta";
// echo "UPDATE escola.aluno set ed47_v_ender = '$endereco', ed47_v_numero = '$numero', 
// ed47_v_compl = '$complemento',ed47_v_bairro = '$bairro', ed47_v_telef = '$telefone' 
// where ed47_i_codigo = 'id_aluno'");


	
} catch (Exception $e) {
	echo "$e";
}
 ?>