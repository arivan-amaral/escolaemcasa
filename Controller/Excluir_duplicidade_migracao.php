<?php 
set_time_limit(0);
// session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';
include_once '../Model/Turma.php';
include_once 'Conversao.php';
$indice=$_GET['indice'];
$limite=$_GET['limite'];
try{
$res_aluno=$conexao->query("SELECT * FROM aluno limit $indice,$limite");
foreach ($res_aluno as $key => $value) {
    $idaluno=$value['idaluno'];

    $res=$conexao->query("SELECT * FROM ecidade_matricula WHERE aluno_id=$idaluno limit 1");
    $conta_exclusao=0;
     foreach ($res as $key => $value) {
         $conta_exclusao++;
     }

     if($conta_exclusao==0){
        echo "$idaluno <br>";
        $res=$conexao->exec("DELETE FROM aluno WHERE idaluno=$idaluno");
     }

}


} catch (Exception $e) {
    echo $e;
 	 //$_SESSION['status']=0;
	// header("location:../View/cadastro_aluno.php");
}
?>