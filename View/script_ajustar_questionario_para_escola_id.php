<?php 
include"../Model/Conexao.php";
include"../Model/Questionario.php";
include"../Model/Professor.php";

if (isset($_GET['indice'])) {
    $indice=$_GET['indice'];
}else{
    $indice=0;
}
$res_fun=$conexao->query("SELECT * from funcionario where descricao_funcao='Professor' or descricao_funcao='Professora' and status=1");
foreach ($res_fun as $key_p => $value_p) {
    $idprofessor=$value_p['idfuncionario'];
    $result_disciplinas_t=listar_disciplina_professor($conexao,$idprofessor);
        $conta=0;
    foreach ($result_disciplinas_t as $key => $value) {                            
        $disciplina_id=$value['iddisciplina'];
        $turma_id=$value['idturma'];

        $disciplina=($value['nome_disciplina']);
        $nome_escola=($value['nome_escola']);
        $turma=($value['nome_turma']);
        $escola_id=($value['escola_id']);

        $result=listar_questionario($conexao,$idprofessor,$turma_id,$disciplina_id);
        foreach ($result as $key_l => $value_l) {
          $id=$value_l['id'];
          $conexao->exec("UPDATE questionario set escola_id=$escola_id where id=$id ");
        }
    }

    // code...
}
?>