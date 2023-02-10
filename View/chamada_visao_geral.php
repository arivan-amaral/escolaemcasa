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

  include_once '../Model/Conexao.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';
   
  $res_chamadas_totais_novas = quantidade_chamada_novas_vg($conexao);
  $res_chamadas_totais_atrasadas = quantidade_chamada_atraso_vg($conexao);
  $res_chamadas_totais_resolvidos = quantidade_chamada_finalizadas_vg($conexao);
  $res_chamadas_totais_andamento = quantidade_chamada_andamento_vg($conexao);
  $res_chamadas_totais = quantidade_chamada_total_vg($conexao);

  $quant_novas = 0;
  $quant_atraso = 0;
  $quant_resolvido = 0;
  $quant_andamento = 0;
  $quant_total = 0;

  foreach ($res_chamadas_totais_novas as $key => $value) {
    $quant_novas = $value['chamada'];
  }
  foreach ($res_chamadas_totais_atrasadas as $key => $value) {
    $quant_atraso = $value['chamada'];
  }
  foreach ($res_chamadas_totais_resolvidos as $key => $value) {
    $quant_resolvido = $value['chamada'];
    
  }
  foreach ($res_chamadas_totais_andamento as $key => $value) {
    $quant_andamento = $value['chamada'];
  }
  foreach ($res_chamadas_totais as $key => $value) {
    $quant_total = $value['chamada'];
  }

  $valor_base = 4000;
  $valor = 500;

  $porcentagem_novas = ($quant_novas / $quant_total) * 100;
  $porcentagem_atraso = ($quant_atraso / $quant_total) * 100;
  $porcentagem_resolvidos = ($quant_resolvido / $quant_total) * 100;
  $porcentagem_andamento = ($quant_andamento / $quant_total) * 100;



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
                echo $_SESSION['NOME_APLICACAO']; 
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

    <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center" style="background-color: #EAEDED; font-size: 24px; ">
                      <strong>Visão Geral dos Chamados</strong>
                      
                    </p>

                    <div class="progress-group">
                      Novos Chamados
                      <span class="float-right"><b><?php echo  $quant_novas; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo $porcentagem_novas."%" ?>"></div>
                      </div>

                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Chamados em Atrasados
                      <span class="float-right"><b><?php echo  $quant_atraso; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?php echo $porcentagem_atraso."%" ?>"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Resolvidos
                      <span class="float-right"><b><?php echo  $quant_resolvido; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $porcentagem_resolvidos."%" ?>"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Chamados em Andamento
                      <span class="float-right"><b><?php echo  $quant_andamento; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php echo $porcentagem_andamento."%" ?>"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <form name='gerarPDF$id' action='pdf_visao_geral_chamada.php' method='POST'  target='_blank'>
                      <button type='submit' class='btn btn-block btn-primary' >GERAR PDF</button>
                    </form>
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->



    <!-- Main content -->

    <!--section class="content">

      <div class="container-fluid">

       <div class="row">
    

            

            
         
       </div>  

    </div>

  </section-->

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