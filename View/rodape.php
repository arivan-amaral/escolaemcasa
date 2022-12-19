<?php
if (isset($_SESSION['cargo'])) {
  if ($_SESSION['cargo']=="Secretário" || $_SESSION['cargo']=="Coordenador"){
        // echo "
        //   <script>
        //       setInterval('pesquisar_solicitacao_transferencia_por_escola()',20000);
        //   </script>
        // ";
  }
}



?>

<script type='text/javascript'>
      function modal_avaliacao() {
          $(document).ready(function() {
              $('#modal-avaliacao').modal('show');
            });
      }

      setTimeout('modal_avaliacao();',500);
      
</script>
<script type="text/javascript">
  function verificar_chamado(){
   var resultado = document.getElementById("total_chamados");          
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Calcular_chamados.php", true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 resultado.innerHTML = xmlreq.responseText;

           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
  }
    ////setTimeout('verificar_chamado()',5000);
  
  // setInterval(verificar_chamado(),2000);
  
</script>

<script type="text/javascript">
  function verificar_chamado(){
   var resultado = document.getElementById("total_mensagens");          
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Calcular_mensagem.php", true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 resultado.innerHTML = xmlreq.responseText;

           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
  }
  //setTimeout(verificar_chamado(),5000);
</script>

<script type="text/javascript">
  function verificar_chamado_atraso(){
    var resultado = document.getElementById("total_chamadas_atrasadas");          
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Calcular_chamada_atrasada.php", true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 resultado.innerHTML = xmlreq.responseText;

           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
    
  }

  //setTimeout(verificar_chamado_atraso(),15000);
</script>
<script type="text/javascript">
  function verificar_chamado_finalizada(){
   var resultado = document.getElementById("total_chamadas_finalizadas");          
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Calcular_chamada_finalizado.php", true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 resultado.innerHTML = xmlreq.responseText;

           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
  }
  //setTimeout(verificar_chamado_finalizada(),4000);
</script>
<script type="text/javascript">
  function verificar_chamado_andamento(){
   var resultado = document.getElementById("total_chamadas_andamento");          
      var xmlreq = CriaRequest();
      xmlreq.open("GET", "../Controller/Calcular_chamada_andamento.php", true);

      xmlreq.onreadystatechange = function(){
    
       if (xmlreq.readyState == 4) {
           if (xmlreq.status == 200) {
                 resultado.innerHTML = xmlreq.responseText;

           }else{
                 alert('Erro desconhecido, verifique sua conexão com a internet');

              result.innerHTML ="Erro ao receber mensagens";                 
           }
       }
      };
   xmlreq.send(null);
  }
  //setTimeout(verificar_chamado_andamento(),7000);
</script>

<div class="modal fade" id="modal-avaliacao">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">AVALIE NOSSA PLATAFORMA!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        

          <div class="modal-body">
<center>
              <div class="star-wrapper">
                             <div class="star">
                                 <img src="http://i.stack.imgur.com/AtiAi.png" alt="" />
                             </div>
                             <div class="star">
                                 <img src="http://i.stack.imgur.com/AtiAi.png" alt="" />
                             </div>
                             <div class="star">
                                 <img src="http://i.stack.imgur.com/AtiAi.png" alt="" />
                             </div>
                             <div class="star">
                                 <img src="http://i.stack.imgur.com/AtiAi.png" alt="" />
                             </div>
                             <div class="star">
                                 <img src="http://i.stack.imgur.com/AtiAi.png" alt="" />
                             </div>
                         </div>
</center>
<br>


                          <div class="card card-outline card-info">
                          <b>
                              Faça um comentário, para que possamos melhorar cada vez mais a nossa plataforma
                            </b>
                            <b style="color: red;">POR FAVOR, NÃO COLOCAR EMOJI</b>
                          
                          <!-- /.card-header -->
                          <div class="card-body">
                            <textarea name="descricao" id="summernote" rows="5" style="height: 245.719px;" required></textarea>

                          </div>
                          <div class="card-footer">
                            
                          </div>

                        </div>

              <!-- corpo -->



              <!-- /corpo -->          
          </div>
      <button type="button" class="btn btn-default" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>




<script  src = "https://unpkg.com/ionicons@5.4.0/dist/ionicons.js" > </script>


<script type="text/javascript">
      
   function mask(o, f) {
     setTimeout(function() {
       var v = mphone(o.value);
       if (v != o.value) {
         o.value = v;
       }
     }, 1);
   }

   function mphone(v) {
     var r = v.replace(/\D/g, "");
     r = r.replace(/^0/, "");
     if (r.length > 10) {
       r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
     } else if (r.length > 5) {
       r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
     } else if (r.length > 2) {
       r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
     } else {
       r = r.replace(/^(\d*)/, "($1");
     }
     return r;
   }

</script>









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


<br>
<br>
<br>
 
 

<div class="modal fade" id="abrirModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Digite os Dados</h4>
      
        </div>
          <div class="modal-body">
          <form class='mt-12' action='../Controller/Cadastrar_chat_chamado_diretor.php' method='post' enctype='multipart/form-data'>
            <h4 class='card-title'>Solicitação</h4>
            <input type='hidden' name='id_funcionario' id='id_funcionario' value='<?php echo $idFuncionario; ?>'>
            <input type='hidden' name='id_chamado' id='id_chamado' value=' <?php echo $id_chamada; ?>'>
             <textarea type='text' class='form-control' rows='10' name='resposta' id='resposta' required=''></textarea><br>

              <h4 class='card-title'>Anexo</h4>
              <div class='form-group' >
                  <input name="arquivo[]" class="form-control"  type="file" multiple>
              </div>
              <br> 
              <div class='form-group'>

              <button class='btn btn btn-info' style='width: 30%;'>Enviar</button>
              </div>
          </form>
        
              <!-- /corpo -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




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
                      <label>Email/Usuário</label>
                  </div>
                    <input type="text" class="form-control"  name="email" id="email" required>
                  
                  <div class="input-group">
                      <label>Senha</label>
                  </div>
                 
                    <div id="input">
                      <input type="password" name="senha" id="senha" value="" autocomplete="off" required />
                      <img src="http://i.stack.imgur.com/H9Sb2.png" alt="">
                    </div>
                    <br>
                    <br>

          
                   <style type="text/css">
                    #input > * {
                      height: 2.0em;
                      float: left;
                    }

                    #input img {
                      cursor: pointer;
                    }

                   </style>

                    <script type="text/javascript">
                     var input = document.querySelector('#input input');
                     var img = document.querySelector('#input img');
                     img.addEventListener('click', function () {
                       input.type = input.type == 'text' ? 'password' : 'text';
                     });
                    
                    </script>

                  <div class="row">    <!-- Final Select Bairros -->
                      <div class="col-sm-12">
                          <div class="g-recaptcha" data-sitekey="6LfEhacaAAAAABLjT--1aIilzCidREblF9cwIm62"></div>
                      </div>
                  </div>

               
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                     <div id="botao_continuar" onclick='carregando_login()'>
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
<!--   <footer class="main-footer footer-bottom clearfix">
    <strong>Copyright &copy;  <?php echo date("Y");?><br><a href="https://valleteclab.com.br/">VALLE TEC LAB</a>.</strong>
    Todos os Direitos Reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 2.0
    </div>
  </footer> -->

  
</div>



<script type="text/javascript">



  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    });

 function carregando_login(){



    var email =  document.getElementById("email").value;
    var senha =  document.getElementById("senha").value;

  if (email=="" || senha=="" ) {
      Swal.fire('Preencha os campos obrigatorios!', '', 'info');
      
    

  }else{
        let timerInterval
        Swal.fire({
          title: 'Aguarde, verificando dados...',
          html: '',
          timer: 200000,
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
    }//else
  }


</script>




 
<script src="plugins/jquery/jquery.min.js"></script>


 <script type="text/javascript" src="jquery.mask.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->

<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<!-- ############################################################################################ -->


 
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

<!-- Page specific script -->
<script>
  // $(function () {
  //               $('#datetimepicker4').datetimepicker({
            
  //                   Default: false,
  //                   Accepts:  ['2022-02-10']
  //               });
  //           });  

  // $(function () {
  //   $('#datetimepicker4').datetimepicker(
  //   {


  //   });
                
  // });

$(function () {
        // $('#datetimepicker4').datetimepicker();
        // $('#datetimepicker4').datetimepicker({
        //     useCurrent: false,

        // });

        // $("#datetimepicker4").on("options.minDate", function (e) {

        //     $('#datetimepicker4').  ('minDate', e.date);
        // });

        // $("#datetimepicker4").on("change.datetimepicker", function (e) {
        //     $('#datetimepicker4').datetimepicker('maxDate', e.date);
        // });
        // 
        // 
        $(function () {
        $('#datetimepicker4').datetimepicker();
 
        $("#datetimepicker4").on("change.datetimepicker", function (e) {
            // $('#datetimepicker4').datetimepicker('minDate', e.date);
            alert('t'+e.date);
             $('#datetimepicker4').datetimepicker('disabledDates', ['2022/10/02']);
        });
        // $("#datetimepicker4").on("change.datetimepicker", function (e) {
        //     $('#datetimepicker4').datetimepicker('maxDate', e.date);
        // });
    });
    });
 

</script>


<!-- ############################################################################################ -->
<script type="text/javascript">
	$(function() {
	  var Toast = Swal.mixin({
	    toast: true,
	    position: 'top-end',
	    showConfirmButton: false,
	    timer: 3000
	  });
	   $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
</script>

<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="plugins/codemirror/codemirror.js"></script>
<script src="plugins/codemirror/mode/css/css.js"></script>
<script src="plugins/codemirror/mode/xml/xml.js"></script>
<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

</body>
</html>