 <?php
// if (isset($_SESSION['cargo'])) {
//   // code...
//  unset($_SESSION['cargo']);
//  header("location:index.php");
// }

   // $nome_escola_global="EDUCA LEM -";

   // define("NOME_APLICACAO", "EDUCA LEM");
 

if ( session_status() !== PHP_SESSION_ACTIVE )
 {
    session_start();
}
   $_SESSION["NOME_APLICACAO"]="EDUCA LEM";
    $_SESSION["ORGAO"]= "PREFEITURA MUNICIPAL LUÍS EDUARDO MAGALHÃES";
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-M4J38HN6M9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-M4J38HN6M9');
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
