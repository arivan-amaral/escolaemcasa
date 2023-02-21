<?php 
session_start();
if (!isset($_SESSION['idcoordenador'])) {
  header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
  include_once "cabecalho.php";
  include_once "alertas.php";
  
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  
  
?>

<script src="ajax.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">CADASTRO DE ESCOLA</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="../Controller/Cadastrar_escola.php" method="POST">
                    <div class="card-body">

                      <div class="form-group">
                        <label for="exampleInputEmail1">Nome da escola</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="nome_escola" placeholder="Nome da escola" required="">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Endereço</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="endereco_escola" placeholder="Endereço da escola" required="">
                      </div>

                     

                      <div class="form-group">
                        <label for="exampleInputEmail1">Código da escola</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_escola" placeholder="Criar Senha" required="">
                      </div>
                      
                    

                      
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Concluir</button>
                    </div>

                  </form>
                </div>
             </div> <!-- </div> class=col- 10 -->
      </div> <!-- </div> row  -->
</div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


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
<?php
  include_once 'rodape.php';
?>