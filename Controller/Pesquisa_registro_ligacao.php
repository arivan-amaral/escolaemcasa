<?php 
session_start();
include_once '../Model/Conexao.php';
include_once '../Model/Escola.php';
include_once '../Model/Coordenador.php';
include_once 'Conversao.php';
try {
	
$result="";
$ano_letivo=$_SESSION['ano_letivo'];
 ;
$escola=$_GET['escola_id'];
$turma=$_GET['turma_id'];
$ficai=$_GET['ficai'];
 

if ($ficai =='Todos') {
	$ficai=" ";
}else{
	$ficai=" and busca_ativa.ficai = $ficai ";

}




if ($escola =='Todas') {
    $escola=" and busca_ativa.escola_id >0 ";
}else{
    $escola=" and busca_ativa.escola_id = $escola ";

}

if ($turma =='Todas') {
    $turma=" and busca_ativa.turma_id >0 ";
}else{
    $turma=" and busca_ativa.turma_id = $turma ";

}
    $result="<table>";
    $result.="<tbody>";
    $result.="<th>DADOS ALUNOS</th>";
    $result.="<th> FICAI</th>";
    $result.="<th>QUANTIDADE DE FALTAS</th>";
    $result.="<th>AÇÃO</th>";
    $result.="</tbody>";

$res=$conexao->query("SELECT descricao_chamada,quem_atendeu,
 aluno.nome as nome_aluno , quantidade_faltas , escola.nome_escola as nome_escola, turma.nome_turma, busca_ativa.ficai
    FROM busca_ativa,escola,aluno,turma,funcionario WHERE
busca_ativa.escola_id = escola.idescola and 
busca_ativa.funcionario_id=funcionario.idfuncionario and 
busca_ativa.turma_id = turma.idturma and 
busca_ativa.aluno_id= aluno.idaluno $escola $turma $ficai ORDER by busca_ativa.id desc LIMIT 500");



foreach ($res as $key => $value) {
	$nome_aluno=$value['nome_aluno'];
	$quantidade_faltas=$value['quantidade_faltas'];
    $nome_escola=$value['nome_escola'];
    $nome_turma=$value['nome_turma'];
    $ficai=$value['ficai'];
    $descricao_chamada=$value['descricao_chamada'];
    $quem_atendeu=$value['quem_atendeu'];

    if ($ficai==1) {
       $ficai="SIM";
    }else{
       $ficai="Não";

    }

	$result.="<tr>";
	$result.="<td>$nome_aluno<br>$nome_escola<br>$nome_turma</td>";
	$result.="<td>$ficai</td>";
    $result.="<td>$quantidade_faltas</td>";
    $result.="<td> <a  class='btn btn-info' data-toggle='modal' data-target='#modal-detalhes-busca-ativa' >Detalhes</a> </td>";
    $result.="<div class='modal fade' id='modal-detalhes-busca-ativa'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title'>BUSCA ATIVA</h4>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        

          <div class='modal-body'>
              <!-- /corpo -->
                <b> QUEM ATENDEU: $quem_atendeu</b><BR>
            <p>$descricao_chamada </p>
              <!-- /corpo -->
        </div>
      <button type='button' class='btn btn-default' data-dismiss='modal'><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>";
	$result.="</tr>";
}

    $result.="</tbody>";
    $result.="</table>";

echo "$result";


} catch (Exception $e) {
echo "$e";	
}
 ?>