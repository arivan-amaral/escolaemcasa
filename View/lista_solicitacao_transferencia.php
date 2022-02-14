<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

}
include "cabecalho.php";
include "alertas.php";
include "barra_horizontal.php";

include 'menu.php';
include '../Controller/Conversao.php';

include '../Model/Conexao.php';

include '../Model/Aluno.php';
include '../Model/Coordenador.php';
include '../Model/Escola.php';
include '../Model/Serie.php';
include '../Model/Turma.php';

 
$array_url=explode('php', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];
$ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];

?>

 

<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" >

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-12 alert alert-danger">
          <center>
            <h1 class="m-0"><b>

         LISTA SOLICITAÇÕES DE TRANSFERÊNCIAS RECEBIDAS</b></h1>
        </center>

      </div><!-- /.col -->

      

    </div><!-- /.row -->

  </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->




<!-- Main content -->

<section class="content">

<div class="container-fluid">


<div class='card-body'>
  <table class='table table-bordered'>
    <thead>
       <tr>
         <th>#</th>

         <th>Dados da solicitação</th>
         <th>Opção</th>
  
       </tr>
     </thead>
     <tbody>
        <?php 

          $visualizada=0;
          $aceita=0;
           $quantidade=1;
          $res_escola= escola_associada($conexao,$idfuncionario);
          $sql_escolas="AND ( escola_id = -1 ";
          foreach ($res_escola as $key => $value) {
              $id=$value['idescola'];
              $sql_escolas.=" OR escola_id = $id ";
          }
           
          
          $res= lista_solicitacao_transferencia_recebida($conexao,$visualizada,$aceita,$sql_escolas);
            foreach ($res as $key => $value) {
              $idsolicitacao=$value['idsolicitacao'];
              $idaluno=$value['idaluno'];
              $turma_id_origem=$value['turma_id_origem'];
              $nome_aluno=$value['nome'];
              $matricula_aluno=$value['matricula_aluno'];
              $data_solicitacao= converte_data_hora($value['data_solicitacao']);

              $observacao=$value['observacao'];
              $idserie=$value['serie_id'];
              $nome_serie=$value['nome_serie'];
              
              $aceita=$value['aceita'];
              if ($aceita==1) {
                $cor="success";
                $status="ACEITA";
                $opcao="<a class='btn btn-$cor' >FOI ACEITA</a>";

              }elseif ($aceita==2) {
                $cor="warning";
                $status="RECUSADA";
                $opcao="<a class='btn btn-$cor'>FOI RECUSADA</a>";

              }else{
                $cor="primary";
                $status="PENDENTE";
                $opcao="
                <a class='btn btn-$cor'  data-toggle='modal' data-target='#modal_transferencia$idsolicitacao'>VER VAGAS/ACEITAR</a><br><br> 

                <a class='btn btn-danger'  data-toggle='modal' data-target='#rejeitar_transferencia$idsolicitacao'>REJEITAR</a><br><br>

                ";
                // <a class='btn btn-danger' ata-toggle='modal' data-target='#rejeita_solicitacao$idsolicitacao'>REJEITAR</a><br>


              }

              $id_escola_origem=$value['escola_id_origem'];
              $id_escola_destino=$value['escola_id'];
              
              $res_escola_origem=buscar_escola_por_id($conexao,$id_escola_origem);
              $nome_escola_origem="";
              foreach ($res_escola_origem as $key => $value) {
                $nome_escola_origem=$value['nome_escola']; 
              }              

              $res_escola_destino=buscar_escola_por_id($conexao,$id_escola_destino);
              $nome_escola_destino="";
              foreach ($res_escola_destino as $key => $value) {
                $nome_escola_destino=$value['nome_escola']; 
              }
              echo"
              <tr>
              <td>
                $quantidade
              </td>
              <td>
               
                 <div class='media'>
                   <img src='fotos/user.png' alt='Profissional' class='img-size-50 mr-3 img-circle'>
                   
                   <div class='media-body'>
                
                      <p class='text-lg'> Aluno:  $nome_aluno </p>
                       <b>DA ESCOLA:</b> <b class='text-secondary'> $nome_escola_origem </b> <br> 
                      <b> PARA A ESCOLA: </b><b class='text-primary'> $nome_escola_destino </b><br>
                      <b> SERIE: </b><b class='text-primary'> $nome_serie </b>
                       <span class='float-right text-sm text-danger'><i class='fas fa-star'></i></span>
                 <BR>
                     <b>OBSERVAÇÃO: </b><b class='text-danger'>$observacao</b>
                     <BR>
                     <b class='text-sm'>Solicitação de transferência</b>
                     <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> $data_solicitacao</p>
                   </div>
                 </div>
                 
               

               </td>
               <td>
                $opcao
               </td>
               </tr>

               <div class='modal fade bd-example-modal-lg' id='modal_transferencia$idsolicitacao'>
                 <div class='modal-dialog modal-lg'>
                   <div class='modal-content'>
                     <div class='modal-header alert alert-primary'>
                       <h4 class='modal-title'>ACEITAR TRANSFERÊNCIA DO ALUNO: $nome_aluno</h4>
                       <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                         <span aria-hidden='true'>&times;</span>
                       </button>
                     </div>
                  <form method='post'  id='aceita_solicitacao$idsolicitacao' name='aceita_solicitacao$idsolicitacao'>
                     <div class='modal-body'>    

                        <div class='row'>
                              <div class='col-sm-3'>


                <input  type='hidden' name='aceitar_idserie_destino' id='aceitar_idserie_destino$idsolicitacao' class='form-control' value='$idserie'>      
                  
                <input  type='hidden' name='turma_id_origem' id='turma_id_origem$idsolicitacao' class='form-control' value='$turma_id_origem'>      
               
                <input  type='hidden' name='idsolicitacao' class='form-control' value='$idsolicitacao'>
                <input  type='hidden' name='matricula_aluno' class='form-control' value='$matricula_aluno'>
                                   
                                    <div class='form-group'>
                                      <label for='exampleInputEmail1'>Ano letivo</label>
                                      <select  id='aceitar_ano_letivo$idsolicitacao' name='aceitar_ano_letivo' class='form-control' >
                                       <option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>
                                    </select>

                                
                                      </div>
                                    </div>
                              

                                <input type='hidden' class='form-control' id='aceitar_idescola_destino$idsolicitacao' name='aceitar_idescola_destino' value='$id_escola_destino'>    

                                <input type='hidden' class='form-control' id='idaluno$idsolicitacao' name='idaluno' value='$idaluno'> 

                                <input type='hidden' class='form-control'    id='aceitar_idescola_origem$idsolicitacao' name='aceitar_idescola_origem' value='$id_escola_destino'> 
                                   

                                <div class='col-sm-3'>
                                 <div class='form-group'>

                                   <label for='exampleInputEmail1' class='text-danger'>Novo Turno</label>
                                   <select class='form-control' name='aceitar_turno' id='aceitar_turno$idsolicitacao' onchange='listar_turma_aceita_transferencia($idsolicitacao);'>
                                     <option></option>
                                     <option value='MATUTINO'>MATUTINO</option>
                                     <option value='VESPERTINO'>VESPERTINO</option>
                                     <option value='NOTURNO'>NOTURNO</option>
                                     <option value='INTEGRAL'>INTEGRAL</option>
                                   </select>
                                 </div>
                               </div> 


                               
                               <div class='col-sm-3'>
                                 <div class='form-group' >
                                    <label class='text-danger'>Nova turma</label>
                                    <select id='aceitar_nova_turma$idsolicitacao' name='aceitar_nova_turma' class='form-control' onchange='quantidade_vaga_restante_transferencia_turma($idsolicitacao);' >

                                    </select>
                                 </div>
                               </div>

                                <div class='col-sm-4'>
                                 <div class='form-group' >
                                   <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

                                   <input type='text'  name='vaga_escola' id='vaga_escola$idsolicitacao' value='0' readonly class='alert alert-secondary'>

                                 </div>
                               </div>

                             </div>

                 <div class='modal-footer justify-content-between'>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
                  <!-- onclick='carregando_login()' -->
                  <div id='botao_continuar'>
                    <button type='button' name='btnSendaceita_solicitacao$idsolicitacao' id='btnSendaceita_solicitacao$idsolicitacao' class='btn btn-primary' onclick=aceitar_solicitacao_transferencia('$idsolicitacao');>ACEITAR</button>
                  </div>
                </div>

            </form>

                <!-- /corpo -->
               </div>
               </div>
               <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
              </div>
           
    <!-- ****************** /.regeitar solicitacao *********************************************** -->


     <div class='modal fade bd-example-modal-lg' id='rejeitar_transferencia$idsolicitacao'>
                 <div class='modal-dialog modal-lg'>
                   <div class='modal-content'>
                     <div class='modal-header alert alert-danger'>
                       <h4 class='modal-title'>REJEITAR TRANSFERÊNCIA DO ALUNO: $nome_aluno</h4>
                       <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                         <span aria-hidden='true'>&times;</span>
                       </button>
                     </div>
                     <div class='modal-body'>    
                        <div class='row'>
<!-- h1 class='text-danger'>FUNCIONALIDADE EM MANUTENÇÃO</h1 -->
<form method='post'  id='rejeita_solicitacao$idsolicitacao' name='aceita_solicitacao$idsolicitacao'>

  <input  type='hidden' name='idsolicitacao' class='form-control' value='$idsolicitacao'>
  <input  type='hidden' name='matricula_aluno' class='form-control' value='$matricula_aluno'>

                              <div class='col-sm-10'>
                                   <label for='exampleInputEmail1' class='text-danger'>Motivo da rejeição</label>
                              <textarea class='form-control' rows='5' placeholder='Descreva o motivo da rejeição dessa solicitação' name='resposta_solicitacao' id='descricao_regeitar_solicitacao$idsolicitacao'></textarea>
                              </div>
                        </div>

                             </div>

                 <div class='modal-footer justify-content-between'>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
                  
                  <div id='botao_continuar'>
                    <button type='button' class='btn btn-danger' onclick='rejeitar_solicitacao_transferencia($idsolicitacao);' id='btnSendrejeita_solicitacao$idsolicitacao' name='btnSendrejeita_solicitacao$idsolicitacao' >REJEITAR SOLICITAÇÃO</button>
                  </div>
                </div>

   </form>

  <!-- /corpo -->
               </div>
               </div>
               <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
              </div>

               ";
               $quantidade++;

            }
        ?>

    </tbody>
  </table>
</div>


</div>

</section>

</div>




<?php 

include 'rodape.php';

?>