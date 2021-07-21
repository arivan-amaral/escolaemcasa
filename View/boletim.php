<?php 
  include"../Controller/Conversao.php";
  include"../Model/Conexao.php";
  include"../Model/Aluno.php";
  include"boletim_maternall_II.php";
  include"boletim_serie_1ano_id_3.php";
  include"boletim_fundamental_II.php";
  
$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];


if ($idserie==3) {
  echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";

    $numero=1;
    $res_alunos=listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
    foreach ($res_alunos as $key => $value) {
      $idaluno=$value['idaluno'];
      $nome_aluno=$value['nome_aluno'];
      boletim_1ano($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno);
      echo "<br><br>";
      $numero++;
    }

}
else if ($idserie >3 && $idserie <=8) {
    echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";
    $numero=1;
      $res_alunos=listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
      foreach ($res_alunos as $key => $value) {
        $idaluno=$value['idaluno'];
        $nome_aluno=$value['nome_aluno'];
          boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno);
        echo "<br><br>";
        $numero++;
      }

}else if ($idserie<3){

  echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";
  $numero=1;
    $res_alunos=listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
    foreach ($res_alunos as $key => $value) {
      $idaluno=$value['idaluno'];
      $nome_aluno=$value['nome_aluno'];
        boletim_maternal_1_2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno);
      echo "<br><br>";
      $numero++;
    }

}else if ($idserie > 8) {
    echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";
    $numero=1;
      $res_alunos=listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
      foreach ($res_alunos as $key => $value) {
        $idaluno=$value['idaluno'];
        $nome_aluno=$value['nome_aluno'];
          boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno);
        echo "<br><br>";
        $numero++;
      }
      
}

?>