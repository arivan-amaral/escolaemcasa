<?php
	session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Aluno.php");
    

try {
    $professor_id=$_SESSION['idfuncionario'];
    $ano_letivo=$_SESSION['ano_letivo'];

    $idescola=$_POST['idescola'];
   	$idturma=$_POST['idturma'];
    // $iddisciplina=$_POST['iddisciplina'];
     $iddisciplina=1;
    $data_ocorrencia=$_POST['data_ocorrencia'];
    $data_ocorrencia_lancada=$_POST['data_ocorrencia_lancada'];


    $url_get=$_POST['url_get'];
   	

foreach ($_POST['aluno_id'] as $key => $value) {
    $aluno_id=$_POST['aluno_id'][$key];
    limpar_ocorrencia_cadastrada($conexao,$iddisciplina, $idturma,$idescola,$professor_id,$data_ocorrencia,$aluno_id,$ano_letivo);
    $descricao="";

    if (isset($_POST["ocorrencia$aluno_id"])) {
      $descricao=$_POST["ocorrencia$aluno_id"];
    }

    cadastro_ocorrencia($conexao,$idescola, $idturma, $iddisciplina, $professor_id, $aluno_id, $descricao, $data_ocorrencia,$ano_letivo);

}

  

    $_SESSION['status']=1;
    header("location: ../View/acompanhamento_pedagogico.php?$url_get");
} catch (Exception $e) {
    $_SESSION['status']=0;
    header("location: ../View/acompanhamento_pedagogico.php?$url_get");;

}
?>