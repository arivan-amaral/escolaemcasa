<?php  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="shortcut icon" href="imagens/logo_pirilampo.png"/>

  <title>EDUCA LEM</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- *********************************************************************************** -->
  
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
<?php
  
  include_once "alertas.php";

  include_once "barra_horizontal.php";

  include_once 'menu.php';

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

  include_once '../Model/Aluno.php';

  include_once '../Controller/Conversao.php';

  include_once '../Model/Trabalho.php';



  $idturma=$_GET['turm'];

  $iddisciplina=$_GET['disc'];
  $turma=$_GET['turma'];
  $disciplina=$_GET['disciplina'];

  $data=date("Y-m-d H:i:s");

   
  echo"<script>
          setTimeout('notificacao_video_whatsapp($idturma)',5000);
      </script>";
 

?>



<script src="ajax.js"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>PIRILAMPO EAD

             <?php if (isset($_SESSION['nome'])) {

              echo " - ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

 <!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



   



            <!-- Main content -->

            <section class="content">

              <div class="container-fluid">

                <div class="row">

                  <div class="col-md-12">

                    


<div class="card-body">
    <div id="actions" class="row">
      <div class="col-lg-6">
        <div class="btn-group w-100">
          <span class="btn btn-success col fileinput-button">
            <i class="fas fa-plus"></i>
            <span>Adicionar arquivos</span>
          </span>
          <button type="submit" class="btn btn-primary col start">
            <i class="fas fa-upload"></i>
            <span>Enviar todos os arquivo</span>
          </button>
          <button type="reset" class="btn btn-warning col cancel">
            <i class="fas fa-times-circle"></i>
            <span>Cancelar envio</span>
          </button>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-center">
        <div class="fileupload-process w-100">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </div>
      </div>
    </div>

    <div class="table table-striped files" id="previews">
      <div id="template" class="row mt-2">
        <div class="col-auto">
            <span class="preview">
               <img src="data:," alt="" data-dz-thumbnail />
            </span>
        </div>
        <div class="col d-flex align-items-center">
            <p class="mb-0">
              <span class="lead" data-dz-name></span>
              (<span data-dz-size></span>)
            </p>
            <strong class="error text-danger" data-dz-errormessage></strong>
        </div>
        <div class="col-4 d-flex align-items-center">
            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
            </div>
        </div>
        <div class="col-auto d-flex align-items-center">
          <div class="btn-group">
            <button class="btn btn-primary start">
              <i class="fas fa-upload"></i>
              <span>Enviar</span>
            </button>
            <button data-dz-remove class="btn btn-warning cancel">
              <i class="fas fa-times-circle"></i>
              <span>Cancelar</span>
            </button>
            <button data-dz-remove class="btn btn-danger delete">
              <i class="fas fa-trash"></i>
              <span>Deletar</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

                    <button type="button" class="btn btn-block btn-xs btn-success"><?php echo $turma."  - ".$disciplina ?></button>
                    <br>


                    <div class="timeline">

                      <!-- timeline time label -->

        







                      <!-- END timeline item -->

                      <div>

                        <i class="fas fa-clock bg-gray"></i>

                      </div>

                    </div>







                  </div>        

                </div>

              </div>

            </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>


<script type="text/javascript">

 function carregando(){
        let timerInterval
        Swal.fire({
          title: 'Aguarde, sua atividade está sendo enviada!',
          html: ' <b></b> ',
          timer: 100000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
              const content = Swal.getContent()
              if (content) {
                const b = content.querySelector('b')
                if (b) {
                  b.textContent = Swal.getTimerLeft()
                }
              }
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
          }
        })
  }

</script>




  <!-- /.control-sidebar -->

  <script type="text/javascript">

    /* Máscaras ER */

    function mascara(o,f){

        v_obj=o

        v_fun=f

        setTimeout("execmascara()",1)

    }

    function execmascara(){

        v_obj.value=v_fun(v_obj.value)

    }

    function mtel(v){

        v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito

        v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos

        v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos

        return v;

    }



  </script>



 <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Digite seus Dados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
            <form action="../Controller/Login.php" method="post">
          <!-- corpo -->
                  <div class="input-group">
                      <label>Usuário</label>
                  </div>
                    <input type="text" class="form-control"  name="usuario" >
                  
                  <div class="input-group">
                      <label>Senha</label>
                  </div>
                    <input type="password" class="form-control"  name="senha" >
                  
               
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                     <div id="botao_continuar">
                       <button type="submit" class="btn btn-primary" >ENTRAR</button>
                     </div>
                </div>
            </form>
              <!-- /corpo -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



 <!-- Main Footer --><br>


  
</div>




<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "../Controller/Drop_updload.php", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Certifique-se de que os arquivos não sejam enfileirados até que sejam adicionados manualmente

    previewsContainer: "#previews", // Define the container to display the previews

    clickable: ".fileinput-button" // Defina o elemento que deve ser usado como gatilho de clique para selecionar arquivos
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { alert('1'); myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
     //alert('2');
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
     //alert('3');
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>


</body>
</html>