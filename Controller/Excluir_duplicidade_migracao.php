<?php 
set_time_limit(0);
// session_start();
include'../Model/Conexao.php';
include'../Model/Aluno.php';
include'../Model/Turma.php';
include'Conversao.php';
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