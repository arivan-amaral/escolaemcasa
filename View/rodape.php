
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
                    <input type="text" class="form-control"  name="email" required>
                  
                  <div class="input-group">
                      <label>Senha</label>
                  </div>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                    <input type="password" class="form-control"  name="senha" id='senha' required>
                    <a id="olho" href="#olho" name="olho">MOSTRAR SENHA </a>
                    <br>
                    <!-- <img id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII="/>  -->
                    <script type="text/javascript">
                      
                      var senha = $('#senha');
                      var olho= $("#olho");

                      olho.mousedown(function() {
                        senha.attr("type", "text");
                      });

                      olho.mouseup(function() {
                        senha.attr("type", "password");
                      });
                      // para evitar o problema de arrastar a imagem e a senha continuar exposta, 
                      //citada pelo nosso amigo nos comentários
                      $( "#olho" ).mouseout(function() { 
                        $("#senha").attr("type", "password");
                      });

                    </script>

                  <div class="row">    <!-- Final Select Bairros -->
                      <div class="col-sm-12">
                          <div class="g-recaptcha" data-sitekey="6LfEhacaAAAAABLjT--1aIilzCidREblF9cwIm62"></div>
                      </div>
                  </div>

               
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
  <footer class="main-footer footer-bottom clearfix">
    <strong>Copyright &copy;  <?php echo date("Y");?><br><a href="https://valleteclab.com.br/">VALLE TEC LAB</a>.</strong>
    Todos os Direitos Reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 2.0
    </div>
  </footer>

  
</div>











<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
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