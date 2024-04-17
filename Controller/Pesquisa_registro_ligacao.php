<?php 
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Escola.php';
include_once '../Model/Coordenador.php';
include_once 'Conversao.php';
try {
	
$result="";
$ano_letivo=$_SESSION['ano_letivo'];
$nivel_acesso_id=$_SESSION['nivel_acesso_id'];

 $data_sql_inicial=$ano_letivo."-01-01";
 $data_sql_final=$ano_letivo."-12-31";

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
    $result.="<th>PROFISSIONAL</th>";

    $result.="<th>LIGAÇÕES</th>";
    $result.="<th> EXITOSA</th>";

    $result.="<th> FICAI</th>";
    $result.="<th>FALTAS</th>";
    $result.="<th>AÇÃO</th>";
    $result.="</tbody>";

$res=$conexao->query("SELECT COUNT(*) AS quantidade_ligacao, exitosa,  busca_ativa.data as data_ligacao, busca_ativa.id,busca_ativa.periodo_inicial,busca_ativa.periodo_final, descricao_chamada,quem_atendeu,
 aluno.nome as nome_aluno , quantidade_faltas , escola.nome_escola as nome_escola, turma.nome_turma, busca_ativa.ficai,funcionario.nome as nome_funcionario
    FROM 
    busca_ativa, registro_ligacao_busca_ativa,escola,aluno,turma,funcionario
     WHERE
    registro_ligacao_busca_ativa.busca_ativa_id = busca_ativa.id and 
busca_ativa.escola_id = escola.idescola and 
registro_ligacao_busca_ativa.funcionario_id=funcionario.idfuncionario and 
busca_ativa.turma_id = turma.idturma and 
busca_ativa.aluno_id= aluno.idaluno $escola $turma $ficai 
and busca_ativa.periodo_final BETWEEN '$data_sql_inicial' AND '$data_sql_final' 

GROUP BY  busca_ativa_id ORDER by registro_ligacao_busca_ativa.data DESC LIMIT 500");


foreach ($res as $key => $value) {
	$id=$value['id'];
    $nome_aluno=$value['nome_aluno'];
    $nome_funcionario=$value['nome_funcionario'];

	$quantidade_faltas=$value['quantidade_faltas'];
    $nome_escola=$value['nome_escola'];
    $nome_turma=$value['nome_turma'];
    $ficai=$value['ficai'];
    $descricao_chamada=$value['descricao_chamada'];
    $quem_atendeu=$value['quem_atendeu'];
    $quantidade_ligacao=$value['quantidade_ligacao'];
    $periodo_inicial=$value['periodo_inicial'];
    $periodo_final=$value['periodo_final'];
    $data_ligacao=$value['data_ligacao'];
    $exitosa=$value['exitosa'];
    $exitosa=$value['exitosa'];
 
    if ($ficai==1) {
       $ficai="SIM";
    }else{
       $ficai="Não";

    }

    if ($exitosa==1) {
       $exitosa="SIM";
       $cor='success';
    }else{
       $exitosa="NÃO";
       $cor='danger';


    }

	$result.="<tr>";
	$result.="<td>$nome_aluno<br>$nome_escola<br>$nome_turma</td>";
    $result.="<td>$nome_funcionario</td>";

    $result.="<td><b class='text-danger'>$quantidade_ligacao</b><br> $periodo_inicial <> $periodo_final</td>";
    $result.="<td class='alert-$cor'>$exitosa</td>";

	$result.="<td>$ficai</td>";
    $result.="<td>$quantidade_faltas</td>";
    $result.="<td> 
    <a  class='btn btn-info' data-toggle='modal' data-target='#modal-detalhes-busca-ativa$id' >Detalhes</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
     
$mesmo_periodo=verificar_periodo_ligacao_busca_ativa($data_ligacao, date('Y-m-d H:i:s'));
if ($mesmo_periodo==1) {
 
     $result.="<a href='editar_cadastro_registro_ligacao.php?id=$id' class='btn btn-success' >Registrar nova chamada  </a> ";
    if ($nivel_acesso_id>=3) {
     
         $result.="<a class='btn btn-default' data-toggle='modal' data-target='#modal-busca-ativa-resposta$id'>Resposta SME</a> ";
    }
}


 $result.="
    </td>";



    $result.="<div class='modal fade' id='modal-detalhes-busca-ativa$id'>
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
          ";
          $res_lig=$conexao->query("SELECT registro_ligacao_busca_ativa.id as 'id_regist_lig', funcionario.nome as quem_ligou , registro_ligacao_busca_ativa.quem_atendeu, registro_ligacao_busca_ativa.data as data_ligacao, registro_ligacao_busca_ativa.descricao_chamada, registro_ligacao_busca_ativa.resposta_sme
 FROM registro_ligacao_busca_ativa, funcionario WHERE registro_ligacao_busca_ativa.busca_ativa_id = $id AND registro_ligacao_busca_ativa.funcionario_id = funcionario.idfuncionario    "); 
            
            $resposta_sme='';
            foreach ($res_lig as $key => $value) {
                $id_regist_lig=$value['id_regist_lig'];
                $quem_atendeu=$value['quem_atendeu'];
                $quem_ligou=$value['quem_ligou'];
                $data_ligacao=$value['data_ligacao'];
                $descricao_chamada=$value['descricao_chamada'];
              

                $result.="ID: $id
                <b> QUEM ATENDEU: $quem_atendeu</b><BR>
                <b> QUEM LIGOU: $quem_ligou</b> Data da ligação: $data_ligacao<BR>
                <p>$descricao_chamada </p>

                <hr>
                ";               
                if ($value['resposta_sme']!='') {
                     $resposta_sme=$value['resposta_sme'];
                    $result.="<BR><b class='text-danger'>RESPOSTA SME</b><BR>
                    <P> $resposta_sme </p><hr>
                ";
                 }

                

            }



        $result.="      
        <!-- /corpo -->
        </div>
      <button type='button' class='btn btn-default' data-dismiss='modal'><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>";




    $result.="<div class='modal fade' id='modal-busca-ativa-resposta$id'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title'>Resposta SME</h4>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        

          <div class='modal-body'>
              <!-- /corpo -->



                         <div class='row'>
                        <div class='col-sm-12'>
                          <div class='form-group'>
                            <label for='respostasme$id_regist_lig'>Rresposta SME (#$id)</label>
                            <textarea rows='3' class='form-control' id='respostasme$id_regist_lig' name='resposta_sme'></textarea>
                          </div>
                        </div>

                      
          ";
      

        $result.="      
        <!-- /corpo -->
        </div>
      <button type='button' class='btn btn-default' data-dismiss='modal'><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Fechar</font></font></button>
        <a class='btn btn-primary' onclick='enviar_resposta_sme($id_regist_lig);'> Enviar </a>

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