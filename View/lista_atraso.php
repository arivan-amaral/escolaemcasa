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

include_once '../Model/Conexao.php';
include '../Model/Setor.php';
include '../Model/Chamada.php';


?>

 

<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" >

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-12 alert alert-primary">
          <center>
            <h1 class="m-0"><b>

            CHAMADOS EM ATRASO QUESTIONADOS PELO SECRETARIO - 

             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b>
            </h1>
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
         <th style="text-align: center;">Status</th>
         <th style="width: 280px; text-align: center;">Informações Retorno</th>
         <th>Questionamento</th>
         <th>Descrição</th>
         <th style="width: 200px; text-align: center;">Opções</th>
       </tr>
     </thead>
     <tbody>

        <?php 
          $res = verificar_todos_atraso_atrasado($conexao);

          foreach ($res as $key => $value) {
            $mensagem=$value['mensagem'];
            $protocolo = $value['id_chamada'];
            $res_verificar = pesquisa_chamada($conexao,$protocolo);
            foreach ($res_verificar as $key => $value) {
              $status = $value['status'];
             
              $res_chamada =  pesquisar_chamado($conexao,$protocolo);
              foreach ($res_chamada as $key => $value) {
                $id_chamada = $value['id'];
                $status = $value['status'];
                $id_funcionario = $value['funcionario_id'];
                $id_func_respondeu = $value['func_respondeu_id'];
                $data_previsão = $value['data_previsao'];
                $id_setor = $value['setor_id'];
                $nome_setor = '';
                $descricao = '';
                $nome_resposta = '';
                $data_emissao = '';
                $res_setor = buscar_setor_id($conexao,$id_setor);
                foreach ($res_setor as $key => $value) {
                  $nome_setor = $value['nome'];
                }
                $res_funcionario = buscar_funcionario($conexao,$id_func_respondeu);
                 foreach ($res_funcionario as $key => $value) {
                   $nome_resposta = $value['nome'];
                }
                $res_chat_resposta = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
                foreach ($res_chat_resposta as $key => $value) {
                  $data_emissao = $value['data'];
                }

                $res_chat= buscar_chat($conexao,$id_chamada);
                foreach ($res_chat as $key => $value) {
                   $descricao = $value['mensagem'];
                }

                 if ($status == 'esperando_resposta') {
                 echo "                
                  <tr>
                  <td style='background-color:#2E64FE;  text-align: center;'>
                    <font style='color: white;'>Chamado Nova <br><b>Protocolo:  $id_chamada </b></font>
                  </td>
                  "; 
                }elseif ($status == 'em_andamento') {
                   echo "
                  <tr>
                    <td style='background-color: #F1C40F;  text-align: center;'>
                      <font style='color: white;'>Andamento<br><b>Protocolo:  $id_chamada </b></font>
                    </td>
                    "; 
                }elseif ($status == 'finalizado') {
                   echo "
                    <tr>
                      <td style='background-color:#82FA58;  text-align: center;'>
                        <font style='color: white;'>Resolvido<br><b>Protocolo:  $id_chamada </b></font>
                      </td>
                  "; 
                }elseif ($status == 'atrasado') {
                   echo "
                <tr>
                  <td style='background-color: #E43F1C;  text-align: center;'>
                    <font style='color: white;'>Chamado Atrasado...<br><b>Protocolo:  $id_chamada </b></font>
                  </td>
                  "; 
                }

                 
                
                if ($id_func_respondeu > 0) {
                  echo "<td>
                   Gerente: $nome_resposta <br>
                   Data de Emissão: $data_emissao  <br>
                   Data de Previsão: $data_previsão
                  </td>";
                }else{
                  echo "<td>
                   Sem Retorno
                  </td>";
                }
                

                echo" 
                  <td>
            
                   $mensagem
                  </td>
                  <td>
                  <b>$nome_setor</b> &emsp;&emsp;
                   $descricao
                  </td>
                  <td>
                    <div class='row'>
                    <div class='col-sm-12'>
                        <form method='POST' action='responder_chamada.php'>
                          <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                          <button class='btn btn-danger'>Visualizar</button>
                        </form>
                      </div>
                     ";
                   echo" </div>
                    
                  </td>
                </tr>
                ";
              }
              
            }
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