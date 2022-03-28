<?php
session_start();
if (!isset($_COOKIE['dia_doservidor_publico2'])) {
  setcookie('dia_doservidor_publico2', 1, (time()+(30*24*3600)));
 // setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{
  setcookie('dia_doservidor_publico2', 0, (time()+(30*24*3600)));
  setcookie('dia_doservidor_publico2', $_COOKIE['dia_doservidor_publico2']+1);
}
  
###################################################
if (!isset($_SESSION['idcoordenador'])) {
  //header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
 include "cabecalho.php";
  include "alertas.php";
 
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';

if ($_COOKIE['dia_doservidor_publico2']<2 && date("m-d")=="10-28") {
?>
    <script>
     function dia_doservidor_publico(){
         Swal.fire({
           title: "Parabéns!",
           imageUrl: 'dia_doservidor_publico.png',
           // imageWidth: 400,
           // imageHeight: 200,
           imageAlt: 'dia_doservidor_publico',
         });
     }
setTimeout('dia_doservidor_publico();',3000);
  </script> 
<?php 
  }
?>

<style>
                      .quadro {
                        background-image: url(imagens/logo_educalem_natal.png);
                        background-repeat: no-repeat;
                   
                        background-position: center;
                         
                            background-size: 100% 100%;
                      }
                       </style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   


<script src="ajax.js?<?php echo rand(); ?>"></script>

<script type="text/javascript">
   // setInterval("licitalem_webhook();",30000);
   // setInterval("notificacao_ocorrencia();",10000);
</script>

<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1">
          </div>
          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

           <?php
              if (isset($nome_escola_global)) {
                echo $nome_escola_global; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

       <div class="row">

          <div class='col-sm-1'></div>
          <div class='col-lg-3 col-6'>

            <!-- small card -->
            <?php  

              $res_setores = buscar_setor($conexao,$idcoordenador);
              foreach ($res_setores as $key => $value) {
                $setor_id = $value['setor_id'];
                $res_setor = buscar_setor_id($conexao,$setor_id);
                foreach ($res_setor as $key => $value) {
                  $id_setor = $value['id'];
                  $nome = $value['nome'];
                  echo "<div class='small-box bg-danger'>
              <div class='inner'>
                <h3 class='text-center'>Setor: $nome</h3>
                <h4 class='text-center'>";
              
                    $res_quant = quantidade_chamada_pendente($conexao,$id_setor);
                    foreach ($res_quant as $key => $value) {
                      $quantidade = $value['chamada'];
                    }
                    echo $quantidade;
                ?>
                </h4>
                <p></p>
              </div>
              <div class='icon'>

              </div>
              <form method='POST' action='lista_chamada.php'>
              <input type='hidden' name='setor' id='setor' value='$id_setor'>
              <button class='small-box-footer'>
                Chamadas pendentes <ion-icon name='cloud-upload'></ion-icon>
              </button>
              </form>
              
              
            </div>
            <?php 
                }
              }
            ?>
            

            
          </div>
       </div>  

    </div>

  </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->

  <script type="text/javascript">

    setTimeout('listar_turmas_coordenador_automatico()',500);
    function listar_turmas_coordenador_automatico(){
        var idescola = document.getElementById("idescola").value;  
        listar_turmas_coordenador(idescola);
    }


  </script>



 <?php 

    include 'rodape.php';

 ?>