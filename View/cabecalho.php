<?php
// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Obtém a data e horário atuais
$dataHoraAtual = new DateTime();
$horaAtual = $dataHoraAtual->format('H:i');
$dataAtual = $dataHoraAtual->format('Y-m-d');

// Define o intervalo de datas e horários permitidos
$dataInicio = "2024-12-11";
$dataFim = "2024-12-12";
$horaInicio = "22:00";
$horaFim = "04:00";

// Verifica se está fora do intervalo de datas e horários permitidos
if (
    $dataAtual < $dataInicio || $dataAtual > $dataFim || // Fora do intervalo de datas
    ($horaAtual < $horaInicio || $horaAtual > $horaFim)  // Fora do horário permitido
) {
    // Exibe a página de aviso
    echo "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Aviso</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                color: #333;
            }
            .container {
                text-align: center;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                width: 90%;
            }
            h1 {
                font-size: 24px;
                color: #ff4757;
            }
            p {
                font-size: 18px;
                margin: 15px 0;
                color: #555;
            }
            .horario {
                font-weight: bold;
                color: #1e90ff;
            }
            .info-datas {
                text-align: left;
                background-color: #f1f1f1;
                border-left: 5px solid #007bff;
                padding: 10px;
                margin-top: 20px;
                border-radius: 5px;
            }
            .btn-voltar {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                font-size: 16px;
                color: #ffffff;
                background-color: #007bff;
                text-decoration: none;
                border-radius: 5px;
                box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
            }
            .btn-voltar:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Aviso: Estamos de Manutenção</h1>
            
          
            
        </div>
    </body>
    </html>";
    exit; // Finaliza o script
}

?>

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

  <title><?php echo $_SESSION['NOME_APLICACAO']; ?></title>
  
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
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
