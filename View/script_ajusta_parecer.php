<?php 
	if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
	include_once '../Controller/Conversao.php';
    include("../Model/Aluno.php");

try {

if (isset($_GET['tokem'])) {
	$res=$conexao->query("SELECT * FROM nota_backup WHERE escola_id = 38 AND turma_id = 5676  and disciplina_id=43 and parecer_descritivo !='' GROUP BY aluno_id ");
	
	$conta_qnt_siglas=1;
	foreach ($res as $key => $value) {
		$aluno_id=$value['aluno_id'];
		$parecer_descritivo=$value['parecer_descritivo'];

		 $conexao->exec("UPDATE nota set parecer_descritivo='$parecer_descritivo'  WHERE
		  escola_id = 38 AND
		  turma_id = 5676 AND
		  periodo_id = 1
		  and avaliacao='av3' and aluno_id=$aluno_id and parecer_descritivo =''  ");


		echo "$conta_qnt_siglas =>  UPDATE nota set parecer_descritivo=$parecer_descritivo  WHERE escola_id = 38 AND turma_id = 5676 AND periodo_id = 1 and avaliacao='av3 and aluno_id=$aluno_id and parecer_descritivo   <br>";
		      $conta_qnt_siglas++;
	}


}
	 
	
} catch (Exception $e) {
	echo $e;
}

?>