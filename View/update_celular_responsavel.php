<?php 
	include '../Model/Conexao_ecidade.php';
	// include_once '../Model/Conexao.php';
	// $pdo;
	// $res=listar_alunos($pdo);
	$indice=800;
	$limite=200;

	if (isset($_GET['indice'])) {
		$indice=$_GET['indice'];
		$limite=$_GET['limite'];
	}
try {
	
$servername = "localhost";
$username = "root";
$password = "";
	//instancia objeto PDO, conectando no MySQL
    $conexao = new PDO("mysql:host=$servername;dbname=educalem", $username, $password);
    // apresenta o erro PDO 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$res_local=$conexao->query("SELECT * FROM aluno where whatsapp ='' limit $indice , $limite");
$conta=0;
foreach ($res_local as $key_local => $value_local) {
		$idaluno=$value_local['idaluno'];
		$res=$pdo->query("SELECT
		ed47_i_codigo,
		ed47_celularresponsavel,
		ed18_i_codigo,
		to_ascii(ed18_c_nome,'LATIN1') as ed18_c_nome,
		ed57_i_codigo,
		to_ascii(ed57_c_descr,'LATIN1') as ed57_c_descr,
		ed60_i_codigo,
		to_ascii(ed47_v_nome,'LATIN1') as ed47_v_nome,
		ed47_v_sexo,
	  ed47_d_nasc,
	  ed47_v_telef,
	  ed47_v_telcel

	from matricula
	  inner join aluno on aluno.ed47_i_codigo = ed60_i_aluno
	  inner join turma on turma.ed57_i_codigo = matricula.ed60_i_turma
	  inner join escola on escola.ed18_i_codigo = turma.ed57_i_escola
	  inner join calendario on calendario.ed52_i_codigo = turma.ed57_i_calendario
	where calendario.ed52_i_ano = 2021 and matricula.ed60_c_situacao = 'MATRICULADO' and ed47_i_codigo=$idaluno
	order by  ed47_i_codigo asc,ed60_i_turma asc ");
			
		foreach ($res as $key => $value) {
			$telefone=$value['ed47_celularresponsavel'];
			if ($telefone !="") {
				$conta++;
				$conexao->exec("UPDATE aluno set whatsapp='$telefone' where idaluno=$idaluno");
				echo "$idaluno<br>";
			}
		}
		
}
$novo_indice=$limite+$indice;
echo "<br>limite:
<a href='update_celular_responsavel.php?limite=$limite&indice=$novo_indice'> $indice + $limite</a><br>
 <img src='acabou.gif'>";
 echo $conta;

} catch (Exception $e) {
	echo "$e";
}
 ?>