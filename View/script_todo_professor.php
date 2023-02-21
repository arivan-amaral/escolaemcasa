<?php session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Coordenador.php';
try {
  
$res=$conexao->query("SELECT 
         idturma,
         serie.id as 'idserie',
         serie.nome as 'nome_serie',
         nome_turma,
         idescola,
         nome_escola,
         relacionamento_turma_escola.turno
        FROM escola,turma,serie,relacionamento_turma_escola WHERE

    relacionamento_turma_escola.escola_id= escola.idescola and 
    relacionamento_turma_escola.turma_id = turma.idturma AND
    turma.serie_id = serie.id AND
    relacionamento_turma_escola.ano='2022'

   ORDER BY escola.nome_escola,turma.nome_turma");


  $result="<table>
  <thead>
    <th>#</th>
    <th>#</th>
    <th>#</th>
    
  </thead>
  <tbody>";
  $turno="";
$conta=1;
  foreach ($res as $key => $value) {

    $idturma=$value['idturma'];
    $idserie=$value['idserie'];

    $nome_serie=$value['nome_serie'];
    $nome_turma=strtoupper($value['nome_turma']);
    $idescola=($value['idescola']);
    $nome_escola=($value['nome_escola']);
    if (isset($value['turno'])) {
        $turno=($value['turno']);
    }else{
      $turno="REMOTO";
    }
    
        $result.= " 
        <tr>
      <td colspan='3'><b><font color='greem'>$nome_escola</font> <b><font color='blue'>$nome_turma</font></td>
      
    </tr>";

    $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

      foreach ($pes as $chave => $linha) {
        $nome_disciplina=strtoupper($linha['nome_disciplina']);
        $iddisciplina=strtoupper($linha['iddisciplina']);
        $nome=strtoupper($linha['nome']);

        $result.= " 
        <tr>
      <td>$conta</td>
      <td>$nome</td>
      <td>$nome_disciplina</td>
    </tr>
       
        
        
        ";
      } 
$conta++;
    
  }
  echo "$result";
  echo "</tbody>
</table>";
} catch (Exception $e) {
  echo "$e";
}
