<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

}
include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";

include_once 'menu.php';
include_once '../Controller/Conversao.php';

if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Setor.php';
include_once '../Model/Chamada.php';


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

            MEUS CHAMADOS - 

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
         <th>Descrição</th>
         <th style="width: 200px; text-align: center;">Opções</th>
       </tr>
     </thead>
     <tbody>

        <?php 
          $res_chamada =  buscar_minhas_chamada_atraso($conexao,$idfuncionario);
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

              echo "
            <tr>
              <td style='background-color: #E43F1C;  text-align: center;'>
                <font style='color: white;'>Chamado Atrasado...<br><b>Protocolo:  $id_chamada </b></font>
              </td>
              "; 
            
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
              <b>$nome_setor</b> &emsp;&emsp;
               $descricao
              </td>
              <td>
                <div class='row'>
                <div class='col-sm-6'>
                    <form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Retorno</button>
                    </form>
                  </div>
                  <div class='col-sm-6'>
                    <button class='btn btn-info'  
                    onclick='finalizar_chat($id_chamada);'>Finalizar</button>
                  </div>";
               echo" </div>
                
              </td>
            </tr>
            ";
          }
          $res_chamado_novo = buscar_minhas_chamada_novas($conexao,$idfuncionario);
          foreach ($res_chamado_novo as $key => $value) {
            $id_chamada = $value['id'];
            $status = $value['status'];
            $id_funcionario = $value['funcionario_id'];
            $id_func_respondeu = $value['func_respondeu_id'];
            $data_previsão = $value['data_previsao'];
            $id_setor = $value['setor_id'];
            $nome_setor = '';
            $res_setor = buscar_setor_id($conexao,$id_setor);
            foreach ($res_setor as $key => $value) {
              $nome_setor = $value['nome'];
            }
            $descricao = '';
            $nome_resposta = '';
            $data_emissao = '';
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

              echo "
            <tr>
              <td style='background-color: #007bff;  text-align: center;'>
                <font style='color: white;'>Aguardando retorno...<br><b>Protocolo:  $id_chamada </b></font>
              </td>
              "; 
            
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
              <b>$nome_setor</b>  &emsp;&emsp;
               $descricao
              </td>
              <td>

                <div class='row'>
                 <div class='col-sm-6'>
                    <form method='POST' action='responder_chamada.php' disabled>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success' disabled >Retorno</button>
                    </form>
                  </div>
                  <div class='col-sm-6'>
                    <button class='btn btn-info' disabled
                    onclick='finalizar_chat($id_chamada);'>Finalizar</button>
                  </div>
                </div>
              </td>
            </tr>
            ";
          }
          $res_chamado_andamento = buscar_minhas_chamada_andamento($conexao,$idfuncionario);
          foreach ($res_chamado_andamento as $key => $value) {
            $id_chamada = $value['id'];
            $status = $value['status'];
            $id_funcionario = $value['funcionario_id'];
            $id_func_respondeu = $value['func_respondeu_id'];
            $data_previsão = $value['data_previsao'];
            $id_setor = $value['setor_id'];
            $nome_setor = '';
            $res_setor = buscar_setor_id($conexao,$id_setor);
            foreach ($res_setor as $key => $value) {
              $nome_setor = $value['nome'];
            }
            $descricao = '';
            $nome_resposta = '';
            $data_emissao = '';
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

              echo "
            <tr>
              <td style='background-color: #F1C40F;  text-align: center;'>
                Andamento...<br><b>Protocolo:  $id_chamada </b>
              </td>
              "; 
            
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
              <b>$nome_setor</b>  &emsp;&emsp;
               $descricao
              </td>
              <td>
                <div class='row'>
                <div class='col-sm-6'>
                    <form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Retorno</button>
                    </form>
                  </div> 
                  <div class='col-sm-6'>
                    <button class='btn btn-info' 
                    onclick='finalizar_chat($id_chamada);'>Finalizar</button>
                  </div>
                </div>
                
              </td>
            </tr>
            ";
          }
          $res_chamado_finalizado = buscar_minhas_chamada_finalizado($conexao,$idfuncionario);
          foreach ($res_chamado_finalizado as $key => $value) {
            $id_chamada = $value['id'];
            $status = $value['status'];
            $id_funcionario = $value['funcionario_id'];
            $id_func_respondeu = $value['func_respondeu_id'];
            $data_previsão = $value['data_previsao'];
            $id_setor = $value['setor_id'];
            $nome_setor = '';
            $res_setor = buscar_setor_id($conexao,$id_setor);
            foreach ($res_setor as $key => $value) {
              $nome_setor = $value['nome'];
            }
            $descricao = '';
            $nome_resposta = '';
            $data_emissao = '';
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
              
              echo "
            <tr>
              <td style='background-color:  #33CD09;  text-align: center;'>
                Finalizado<br><b>Protocolo:  $id_chamada </b>
              </td>
              "; 
            

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
              <b>$nome_setor</b>  &emsp;&emsp;
              $descricao
              </td>
              <td>
                <div class='row'>
                  <div class='col-sm-6'>
                    <form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'  >Visualizar</button>
                    </form>
                  </div>
                </div>
                
              </td>
            </tr>
            ";
          }
        ?>

    </tbody>
  </table>
</div>


</div>

</section>

</div>



<?php 

include_once 'rodape.php';

?>