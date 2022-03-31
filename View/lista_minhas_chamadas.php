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
         <th>Informações</th>
         <th>Descrição</th>
         <th>Opções</th>
       </tr>
     </thead>
     <tbody>

        <?php 
          $res_chamada =  buscar_minhas_chamada($conexao,$idfuncionario);
          foreach ($res_chamada as $key => $value) {
            $id_chamada = $value['id'];
            $status = $value['status'];
            $id_funcionario = $value['funcionario_id'];
            $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
            $nome = '';
            $email = '';
            $whatsapp = '';
            $descricao = '';
            $destino= '';
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
                <div class='row'>
                  <div class='col-sm-6'>
                    <form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Ver Chat</button>
                    </form>
                  </div>";
                  if($status != 'finalizado'){

                    echo "<div class='col-sm-6'>
                    <button class='btn btn-info' onclick='finalizar_chat($id_chamada);'>Finalizar</button>
                  </div>";

                  }
               echo" </div>
                
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