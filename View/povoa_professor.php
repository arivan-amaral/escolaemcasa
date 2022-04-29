<?php 
	include '../Model/Conexao_ecidade.php';
	include '../Model/Conexao.php';
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

	$res=$pdo->query("
		SELECT distinct ed232_i_codigo,ed232_c_descr, ed285_i_rechumano, z01_nome, z01_cgccpf, z01_telcel, ed18_i_codigo, ed18_c_nome, ed57_i_codigo, ed57_c_descr, login,senha
 from regenciahorario
      inner join periodoescola  on  periodoescola.ed17_i_codigo = regenciahorario.ed58_i_periodo
      inner join regencia  on  regencia.ed59_i_codigo = regenciahorario.ed58_i_regencia
      inner join escola  on  escola.ed18_i_codigo = periodoescola.ed17_i_escola
      inner join periodoaula  on  periodoaula.ed08_i_codigo = periodoescola.ed17_i_periodoaula
      inner join turno  on  turno.ed15_i_codigo = periodoescola.ed17_i_turno
      inner join disciplina  on  disciplina.ed12_i_codigo = regencia.ed59_i_disciplina
      inner join caddisciplina on caddisciplina.ed232_i_codigo= disciplina.ed12_i_caddisciplina
      inner join turma  on  turma.ed57_i_codigo = regencia.ed59_i_turma
      inner join calendario  on  calendario.ed52_i_codigo = turma.ed57_i_calendario
      inner join serie  on  serie.ed11_i_codigo = regencia.ed59_i_serie
      inner join ensino  on  ensino.ed10_i_codigo = serie.ed11_i_ensino
      inner join rechumano  on  rechumano.ed20_i_codigo = regenciahorario.ed58_i_rechumano
      inner join rechumanoescola  on  rechumanoescola.ed75_i_rechumano = rechumano.ed20_i_codigo           
      inner join rechumanoativ  on  rechumanoativ.ed22_i_rechumanoescola = rechumanoescola.ed75_i_codigo 
      inner join rechumanorelacao  on  rechumanorelacao.ed03_i_rechumanoativ = rechumanoativ.ed22_i_codigo    
      inner join rechumanocgm  on  rechumanocgm.ed285_i_rechumano = rechumano.ed20_i_codigo
      inner join protocolo.cgm on cgm.z01_numcgm = rechumanocgm.ed285_i_cgm
      inner join configuracoes.db_usuacgm on db_usuacgm.cgmlogin = cgm.z01_numcgm
      inner join configuracoes.db_usuarios on db_usuarios.id_usuario = db_usuacgm.id_usuario
where calendario.ed52_i_ano = 2020 and rechumanoativ.ed22_i_atividade = 1 offset 0  limit 10000 ");
		
		
$cont=1;
	foreach ($res as $key => $value) {

		echo "$cont <br>";
		$cont++;
	 }
		//foreach ($res as $key => $value) {
	// 	echo $value['ed232_i_codigo']." disciplina<br>";
	// 	echo $value['ed232_c_descr']." nome disciplina <br>";

	// 	echo $value['z01_nome']." 2<br>";
	// 	echo $value['z01_cgccpf']." 3<br>";
	// 	echo $value['z01_telcel']." 4<br>";
	// 	echo $value['ed18_i_codigo']." cod escola<br>";
	// 	echo $value['ed18_c_nome']." 6<br>";
	// 	echo $value['ed57_i_codigo']." cod turma<br>";
	// 	echo $value['ed57_c_descr']." 8<br>";
	// 	echo $value['login']." 9<br>";
	// 	echo $value['senha']." 10<br>";
	// 	echo "_____________________________________________________<br>";
	// 	$cont++;
	// }

} catch (Exception $e) {
	echo "$e";
}
 ?>