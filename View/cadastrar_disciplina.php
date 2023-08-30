<?php 
session_start();
  include_once "cabecalho.php";
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
  
  
 
?>

<script src="ajax.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-1">
        </div>
         <div class="col-md-10">
            <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">CADASTRAR DISCIPLINA</h3>
                  </div>
                  
                  <form action="../Controller/Disciplina.php" method="post">
                    <div class='card-body'>
                    
                           
                                <div class='form-group'>
                                  <label for='exampleInputEmail1'>Nome</label>
                                  <input type='text' class='form-control' name='nome' >
                                </div>

                                
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Concluir</button>
                      </div>

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