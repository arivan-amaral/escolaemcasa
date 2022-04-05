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

 
$array_url=explode('php?', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];

?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" >

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-12 alert alert-info">
          <center>
            <h1 class="m-0"><b>

         LISTA SOLICITAÇÕES DE TRANSFERÊNCIAS ENVIADAS</b></h1>
        </center>

      </div><!-- /.col -->

      

    </div><!-- /.row -->

  </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->

<!-- <h1 class="text-danger
">PÁGINA EM MANUTENÇÃO</h1> -->

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
          $sql_escolas="AND ( escola_id_origem = -1 ";
          foreach ($res_escola as $key => $value) {
              $id=$value['idescola'];
              $sql_escolas.=" OR escola_id_origem = $id ";
          }
           
          
          $res= lista_solicitacao_transferencia_enviada($conexao,$visualizada,$sql_escolas);
            foreach ($res as $key => $value) {
              $nome_aluno=$value['nome'];
              $idaluno=$value['aluno_id'];
              $data_solicitacao= converte_data_hora($value['data_solicitacao']);
              $observacao=$value['observacao'];
              $resposta_solicitacao=$value['resposta_solicitacao'];
              $aceita=$value['aceita'];
              if ($aceita==1) {
                $cor="success";
                $status="ACEITA";

              }elseif ($aceita==2) {
                $cor="danger";
                $status="RECUSADA";

              }else{
                $cor="secondary";
                $status="PENDENTE";

              }

              $id_escola_origem=$value['escola_id_origem'];
              $id_escola_destino=$value['escola_id'];
              
              $res_escola_origem=buscar_escola_por_id($conexao,$id_escola_origem);
              $nome_escola_origem="";
              foreach ($res_escola_origem as $key => $value) {
                $nome_escola_origem=$value['nome_escola']; 
              }              

              $res_escola_destino=buscar_escola_por_id($conexao,$id_escola_destino);
              if ($id_escola_destino==0) {
                  $nome_escola_destino="ESCOLA FORA DA REDE MUNICIPAL";
              }else{

              $nome_escola_destino="";
              }
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
                      <b> PARA A ESCOLA: </b><b class='text-primary'> $nome_escola_destino </b>
                       <span class='float-right text-sm text-danger'><i class='fas fa-star'></i></span>
                 <BR>
                     <b>OBSERVAÇÃO: </b><b class='text-danger'>$observacao</b>
                     <BR>
                     <b class='text-sm'>Solicitação de transferência</b>
                     <p class='text-sm text-muted'><i class='far fa-clock mr-1'></i> $data_solicitacao</p>
                   </div>
                 </div>
                <b class='btn btn-$cor'>";

                  if ($id_escola_destino==0) {
                   echo "<form action='declaracao_transferencia.php' method='post' target='_blanck'>
                     <input type='hidden' name='aluno_id' value='$idaluno'>
                     <input type='hidden' name='escola_id' value='$id_escola_origem'>
                     <input type='hidden' name='nome_aluno' value='$nome_aluno'>

                     <input type='hidden' name='turma_id' value='$idaluno'>
                     <input type='hidden' name='serie_id' value='$idaluno'>


 
                      <button type='submit' class='btn btn-primary'>GUIA DE TRANSFERÊNCIA.</button>
                   </form>";
                  }else{

                  echo "$status";
                  }
              echo"</b>
                  
                 <p>
                  $resposta_solicitacao
                 </p>
                 
      

               </td>
               <td>
                <b class='btn btn-$cor'>$status</b>
               </td>
               </tr>";
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