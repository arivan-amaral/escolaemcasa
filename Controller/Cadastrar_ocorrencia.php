<?php
	session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    

try {
    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_POST['idescola'];
   	$idturma=$_POST['idturma'];
    $iddisciplina=$_POST['iddisciplina'];
    $data_ocorrencia=$_POST['data_ocorrencia'];
    $data_ocorrencia_lancada=$_POST['data_ocorrencia_lancada'];


    $url_get=$_POST['url_get'];
   	

foreach ($_POST['aluno_id'] as $key => $value) {
    $aluno_id=$_POST['aluno_id'][$key];
    limpar_ocorrencia_cadastrada($conexao,$iddisciplina, $idturma,$idescola,$professor_id,$data_ocorrencia,$aluno_id);
    $descricao="";

    if (isset($_POST["ocorrencia$aluno_id"])) {
      $descricao=$_POST["ocorrencia$aluno_id"];
    }

    cadastro_ocorrencia($conexao,$idescola, $idturma, $iddisciplina, $professor_id, $aluno_id, $descricao, $data_ocorrencia);

}

  

    $_SESSION['status']=1;
    header("location: ../View/acompanhamento_pedagogico.php?$url_get");
} catch (Exception $e) {
    $_SESSION['status']=0;
    header("location: ../View/acompanhamento_pedagogico.php?$url_get");;

}
?>