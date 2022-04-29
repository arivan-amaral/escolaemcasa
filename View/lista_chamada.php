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
include '../Model/Setor.php';
include '../Model/Chamada.php';

 $setor_id= $_POST['setor'];
 $nome_setor = "";
 $quant_total = 0;
 $quant_finalizada = 0;
 $res_quantidade_resolvida = quantidade_chamada_finalizadas($conexao,$setor_id);
 foreach ($res_quantidade_resolvida as $key => $value) {
   $quant_finalizada = $value['chamada'];
 }
 $res_quantidade_total =  quantidade_chamada_total($conexao,$setor_id);
 foreach ($res_quantidade_total as $key => $value) {
   $quant_total = $value['chamada'];
 }
 $res_nome_setor = buscar_setor_id($conexao,$setor_id);
 foreach ($res_nome_setor as $key => $value) {
   $nome_setor = $value['nome'];
 }
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
        <?php  echo"$nome_setor - $quant_total Chamados "; ?>
         </b></h1>
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
         <th>Status</th>
         <th>Informações</th>
         <th>Opção</th>

       </tr>
     </thead>
     <tbody id="tabela_chamados">
      
        <?php 
          $res_chamada = buscar_chamada2($conexao,$setor_id);
          foreach ($res_chamada as $key => $value) {
            $id_chamada = $value['id'];
            $status = $value['status'];
            $id_funcionario = $value['funcionario_id'];
            $id_solicitacao = $value['tipo_solicitacao'];
            $nome_funcionario = '';
            $nome_escola='';
            $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
              foreach ($res_nome_funcionario as $key => $value) {
                $nome_funcionario = $value['nome'];
              }
            $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
              foreach ($res_nome_escola as $key => $value) {
                $id_escola = $value['escola_id'];
                $res_buscar_escola = buscar_escola($conexao,$id_escola);
                foreach ($res_buscar_escola as $key => $value) {
                  $nome_escola= $value['nome_escola'];
                }
              }
            
            $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
            $nome = '';
            $email = '';
            $whatsapp = '';
            $descricao = '';
            $nome_solicitacao = '';
            $destino = '';
            $data_solicitado = '';
            $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$_SESSION['idfuncionario']);
            foreach ($res_chat as $key => $value) {
              $data_solicitado = $value['data'];
            }
            $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
            foreach ($res_solicitacao as $key => $value) {
               $nome_solicitacao = $value['nome'];
            }
            foreach ($res_funcionario as $key => $value) {
              $nome = $value['nome'];
              $email = $value['email'];
              $whatsapp = $value['whatsapp'];
            }
            $res_chat= buscar_chat($conexao,$id_chamada);
            foreach ($res_chat as $key => $value) {
               $descricao = $value['mensagem'];
                $destino = $value['arquivo'];
            }
            echo "
            <tr>";
            if ($status == 'esperando_resposta') {
              echo "<td style='background-color:#2E64FE; transform: rotate(270deg);
              text-align: center;color: white;'>
              Novo</td>";
            }elseif ($status == 'em_andamento') {
              echo "<td style=' background-color:#F1C40F; transform: rotate(270deg); 
              text-align: center;'>
              Andamento</td>";
            }elseif ($status == 'finalizado') {
              echo "<td style=' background-color:#82FA58; transform: rotate(270deg);
              text-align: center;color: white'>
              Resolvido</td>";
            }elseif ($status == 'atrasado') {
              echo "<td style=' background-color:#FE2E2E; transform: rotate(270deg);
              text-align: center;color: white'>
              Atrasado</td>";
            }
             

               echo "<td>
                Data de Solicitação: $data_solicitado <br>
                ";
                 if($status == 'esperando_resposta'){

                //echo " Status: <font color='danger'>Esperando Resposta</font> ";
              }else if($status == 'em_andamento'){
                echo "
                Data de Retorno: ";
              }else if($status == 'finalizado'){
                echo "Data de Retorno: <br>
                Status: <font color='green'>Finalizado</font> ";
              }
                echo"
                Escola: $nome_escola - Diretor: $nome_funcionario <br> 
                Tipo de Solicitação: $nome_solicitacao <br>             
                Protocolo: $id_chamada
              </td>
              <td>";
              if($status == 'esperando_resposta'){
 
                echo "<form method='POST' action='responder_chamada.php'>
                  <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                  <button class='btn btn-success'>Responder</button>
                </form>";
              }else{
                echo "<form method='POST' action='responder_chamada.php'>
                  <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                  <button class='btn btn-success'>Ver</button>
                </form>";
              }
                
            echo "    
              </td>
            </tr>
            ";
          }   
        ?>

    </tbody>
  </table>
  <br>
  <div class="row">
    <div class="col-sm-12 alert alert-success">
      <?php
      if ( $quant_finalizada == 0) {
         echo "
        <center>
            <h4 class='m-0'><b>
              <form method='GET'>
                $quant_finalizada Chamados Resolvidos 
                <input type='hidden' name='setor_id' id='setor_id' value='$setor_id'>
                <a class='btn btn-primary' disabled>Ver</a>
              </form>
            </b></h4>
        </center>

      
      ";
       }else{
        echo "
        <center>
            <h4 class='m-0'><b>
              <form method='GET'>
                $quant_finalizada Chamados Resolvidos 
                <input type='hidden' name='setor_id' id='setor_id' value='$setor_id'>
                <a class='btn btn-primary'  onclick='ver_resolvidos($setor_id);'>Ver</a>
              </form>
            </b></h4>
        </center>

      
      ";
        }  ?>
      
    </div>
  </div>
</div>


</div>

</section>

</div>


<?php 

include 'rodape.php';

?>