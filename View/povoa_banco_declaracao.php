<?php 
	include_once '../Model/Conexao_ecidade.php';
	include_once '../Controller/Conversao.php';
	// if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
	// $pdo;
	// $res=listar_alunos($pdo);
	$indice=0;
	$limite=250;

	if (isset($_GET['indice'])) {
		$indice=$_GET['indice'];
		$limite=$_GET['limite'];
	}
try {
	
$servername = "localhost";
$username = "root";
$password = "UQ2K2V3cfV6F";
	//instancia objeto PDO, conectando no MySQL
    $conexao = new PDO("mysql:host=$servername;dbname=educalem", $username, $password);
    // apresenta o erro PDO 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$res=$pdo->query("SELECT
	ed47_i_codigo,
	ed18_i_codigo,
	to_ascii(ed18_c_nome,'LATIN1') as ed18_c_nome,
	ed57_i_codigo,
	to_ascii(ed57_c_descr,'LATIN1') as ed57_c_descr,
	ed60_i_codigo,
	to_ascii(ed47_v_nome,'LATIN1') as ed47_v_nome,
	ed47_v_sexo,
  ed47_d_nasc,
  ed47_v_telef,
  ed47_v_telcel,

  ed47_v_mae,
  ed47_v_pai,
  ed47_i_censoufnat

from matricula
  inner join aluno on aluno.ed47_i_codigo = ed60_i_aluno
  inner join turma on turma.ed57_i_codigo = matricula.ed60_i_turma
  inner join escola on escola.ed18_i_codigo = turma.ed57_i_escola
  inner join calendario on calendario.ed52_i_codigo = turma.ed57_i_calendario
where calendario.ed52_i_ano = 2021 and matricula.ed60_c_situacao = 'MATRICULADO'
order by  ed47_i_codigo asc,ed60_i_turma asc  offset $indice  limit $limite");
		
		$endereco="";
		$telefone="";
		$numero="";
		$bairro="";
		$complemento="";
		$conta=1; 
		$quantidade_turmas=0;
		$turma_encontrada="";

	foreach ($res as $key => $value) {
		$idaluno=$value['ed47_i_codigo'];
		$idescola=$value['ed18_i_codigo'];
		$idturma=$value['ed57_i_codigo'];
		$nome_aluno= trim($value['ed47_v_nome']);
		$nome_turma= trim($value['ed57_c_descr']);
		$nome_escola= trim($value['ed18_c_nome']);
		$sexo= trim($value['ed47_v_sexo']);
		$data_nascimento= trim($value['ed47_d_nasc']);

		$mae= trim($value['ed47_v_mae']);
		$pai= trim($value['ed47_v_pai']);

		$telefone= trim($value['ed47_v_telef']);
		$whatsapp= trim($value['ed47_v_telcel']);
		if ($whatsapp=="") {
			$whatsapp=$telefone;
		}
		$whatsapp= converte_telefone($whatsapp);
		// $whatsapp=str_replace("'","",$nome_turma);


		$array = explode('-', $nome_turma);
		$array_aluno = explode(' ', $nome_aluno);
		
		$primeiro_nome=trim($array_aluno[0]);
		$primeiro_nome.=".$idaluno";
		$senha="escolaemcasa".$idaluno;
		$nome_turma=trim($array[0]);
		$nome_turma=str_replace("  "," ",$nome_turma);

		$res_turma=$conexao->query("SELECT * FROM turma where nome_turma like '$nome_turma%' limit 1 ");
		$existe=0;
		foreach ($res_turma as $key_turma => $value_turma) {
			$turma_id=$value_turma['idturma'];
			$res_a=$conexao->query("SELECT * FROM aluno where idaluno=$idaluno limit 1 ");
				$c_a=0;
			foreach ($res_a as $key_a => $value_a) {
				$c_a=1;
			}

			if ($c_a==0) {
				echo "$idaluno,$nome_aluno, $primeiro_nome,$senha, $whatsapp,$sexo,$data_nascimento <bR>";
		
			}else{
				echo "$conta - EDITANDO - $idaluno-  $nome_aluno mae: $mae pai:$pai  <br>";

			}


				$existe=1;
				$conta++;
			
		}

		if ($existe==0) {
  			echo "turma $nome_turma não existente: id aluno $idaluno<br>";
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

}

$novo_indice=$indice+$limite;
echo "<br>limite:
<a href='povoa_banco.php?limite=$limite&indice=$novo_indice'> $indice + $limite</a><br>
 <img src='acabou.gif'>";
//echo "quantidade_turmas: $quantidade_turmas  quantidade total= $conta";
// echo "UPDATE escola.aluno set ed47_v_ender = '$endereco', ed47_v_numero = '$numero', 
// ed47_v_compl = '$complemento',ed47_v_bairro = '$bairro', ed47_v_telef = '$telefone' 
// where ed47_i_codigo = 'id_aluno'");


	
} catch (Exception $e) {
	echo "$e";
}
 ?>