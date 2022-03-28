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

 $setor_id=$_POST['setor'];

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

         LISTA DE CHAMADAS PENDENTES</b></h1>
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

         <th>Informações</th>
         <th>Descrição</th>
         <th>Anexo</th>
         <th>Opção</th>

       </tr>
     </thead>
     <tbody>
      
        <?php 
          $res_chamada = buscar_chamada($conexao,$setor_id,'esperando_resposta');
          foreach ($res_chamada as $key => $value) {
            $id_chamada = $value['id'];
            $id_funcionario = $value['funcionario_id'];
            $res_funcionario = buscar_funcionario($conexao,$funcionario);
            $nome = '';
            $email = '';
            $whatsapp = '';
            foreach ($res_funcionario as $key => $value) {
              $nome = $value['nome'];
              $email = $value['email'];
              $whatsapp = $value['whatsapp'];
            }
            $descricao = $value['descricao'];
            $destino = $value['arquivo'];
            echo "
            <tr>
              <td>
                Nome do Funcionario: $nome <br>
                Email: $email <br>
                Whatsapp: $whatsapp
              </td>
              <td>
              Descrição: $descricao
              </td>
              <td>
              Anexo: <img src='anexo_chamada/$destino' width='320' height='205'>
              </td>
              <td>
                <form method='POST' action='responder_chamada.php'>
                  <input type='hidden' name='id_chamada' id='id_chamada'>
                  <button type='button' class='btn btn-success'>RESPONDER</button>
                </form>
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

include 'rodape.php';

?>