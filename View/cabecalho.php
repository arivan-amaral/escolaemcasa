<?php
// if (isset($_SESSION['cargo'])) {
//   // code...
//  unset($_SESSION['cargo']);
//  header("location:index.php");
// }
  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";


   $nome_escola_global="-";

   // define("NOME_APLICACAO", "EDUCA LEM");


if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
   $_SESSION["NOME_APLICACAO"]="EDUCA LEM";
    $_SESSION["ORGAO"]= "PREFEITURA DE LUÍS EDUARDO MAGALHÃES";
    $_SESSION["CIDADE"]= "LUÍS EDUARDO MAGALHÃES- BA";
    $_SESSION["CEP"]= "47850-000";
    $_SESSION["IDCIDADE"]=515;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- #################################################################### -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="shortcut icon" href="imagens/logo.png"/>

  <title>educalem 01<?php echo $_SESSION['NOME_APLICACAO']; ?></title>
  
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
  
  
 
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">



 
 <!-- Google tag (gtag.js) -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=G-2069K2CNY9"></script>
 <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'G-2069K2CNY9');
 </script>



<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


  <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.min.css" />
  <!-- Hotjar Tracking Code for https://educalem.com.br -->
  <script>
      (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:3816517,hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
  </script>

  
</head>

<?php

// Define a data atual
$dataAtual = date('Y-m-d');

// Define a data do aviso
$dataAviso = '2024-12-16';

// Exibe o aviso somente na data definida
if ($dataAtual === $dataAviso) {
    echo "
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Função para mostrar o alerta
        function exibirAlerta() {
            var aviso = document.createElement('div');
            aviso.style.position = 'fixed';
            aviso.style.top = '20px';
            aviso.style.left = '50%';
            aviso.style.transform = 'translateX(-50%)';
            aviso.style.backgroundColor = '#ff9800';
            aviso.style.color = 'white';
            aviso.style.padding = '15px';
            aviso.style.borderRadius = '5px';
            aviso.style.fontSize = '16px';
            aviso.style.zIndex = '1000';
            aviso.style.boxShadow = '0px 4px 8px rgba(0, 0, 0, 0.2)';
            aviso.innerHTML = 'Manutenção Programada: O sistema estará em manutenção das 23:00 às 00:00. Durante este período, o site poderá ficar temporariamente indisponível. Agradecemos a sua compreensão!';
            
            document.body.appendChild(aviso);
            
            // Fechar o aviso após 5 segundos
            setTimeout(function() {
                aviso.style.display = 'none';
            }, 5000);
        }

        // Chama a função para exibir o alerta após 1 segundos
        setTimeout(exibirAlerta, 1000); // 10000 ms = 10 segundos
    });
    </script>
    ";
}
?>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
