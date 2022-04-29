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

        <div class="col-sm-12 alert alert-primary">
          <center>
            <h1 class="m-0"><b>

         MEUS CHAMADOS</b></h1>
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
            $descricao = '';
            $destino= '';
            $res_chat= buscar_chat($conexao,$id_chamada);
            foreach ($res_chat as $key => $value) {
               $descricao = $value['mensagem'];
                $destino = $value['arquivo'];
            }

            if ($status=='esperando_resposta') {
              echo "
            <tr>
              <td style='background-color: #007bff;'>
                <font style='color: white;'>Aguardando retorno...</font>
              </td>
              "; 
            }elseif ($status=='em_andamento') {
              echo "
            <tr>
              <td style='background-color: #F1C40F;'>
                Andamento...
              </td>
              "; 
            }elseif ($status=='finalizado') {
              echo "
            <tr>
              <td style='background-color:  #33CD09;'>
                Finalizado
              </td>
              "; 
            }elseif ($status=='atrasado') {
              echo "
            <tr>
              <td>
                Status: <font color='danger'>Chamado Atrasado</font>
              </td>
              "; 
            }
            
            echo"
              <td>
              Descrição: $descricao
              </td>
              <td>
                <div class='row'>";
                  if($status=='em_andamento' ){
                    echo"<div class='col-sm-6'>
                    <form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Retorno</button>
                    </form>
                  </div>";
                  }else{
                    echo"<div class='col-sm-6'>
                    <form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success' disabled >Retorno</button>
                    </form>
                  </div>";
                  }
                  
                  if($status != 'finalizado'){

                    echo "<div class='col-sm-6'>
                    <button class='btn btn-info' disabled 
                    onclick='finalizar_chat($id_chamada);'>Finalizar</button>
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