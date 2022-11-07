<?php
session_start();

  
###################################################
if (!isset($_SESSION['idcoordenador'])) {
  //header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
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


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- #################################################################### -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="shortcut icon" href="imagens/logo.png"/>

  <title><?php echo "$nome_escola_global"; ?></title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- *********************************************************************************** -->
  
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script>
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">



  <script async src="https://www.googletagmanager.com/gtag/js?id=G-XHETRNN05Z"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-XHETRNN05Z');
  </script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" onload="window.print()">
<div class="wrapper">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   


<script src="ajax.js?<?php echo rand(); ?>"></script>

<script type="text/javascript">
   // setInterval("licitalem_webhook();",30000);
   // setInterval("notificacao_ocorrencia();",10000);
</script>

<div class="content-wrapper" style="min-height: 529px;">
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