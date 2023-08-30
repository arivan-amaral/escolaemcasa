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

  include_once '../Controller/Conversao.php';

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

  include_once '../Model/Aluno.php';

  $idturma=$_GET['idturma']; 
  $idescola=$_GET['idescola']; 

?>



<script src="ajax.js"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

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

 <!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
        <!-- Info boxes -->
        <!-- .row -->



      <div class="row">

       <div class="card-body">

        <table class="table table-bordered">

          <thead>
            <tr>
              <th style="width: 10px">#id</th>
              <th>Dados do Aluno</th>
              
            </tr>
          </thead>

          <tbody>

            <?php 
               $result= listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);

               foreach ($result as $key => $value) {
                $nome_aluno=($value['nome_aluno']);
                $nome_turma=($value['nome_turma']);
                $id=$value['idaluno'];
                $status_aluno=$value['status_aluno'];
                $email=$value['email'];
                $senha=$value['senha'];

                  echo "
                     <tr>
                      <td>$id</td>

                      <td> 
                        <a class='text-primary' onclick='relatorio_de_visualizacao_video_coordenador($id);'> $nome_aluno </a> <BR>
                        
                        <span id='relatorio_de_visualizacao_video$id'>
                        ...
                        </span>

                      </td>
                      

                    </tr>
                  ";
               }
            ?>



            </tbody>

          </table>

        </div>

        

      </div>

 

        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>

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


<!--   <script>
    function removerChecked(id) {
        var ele = document.getElementByName(id);
        for(var i=0;i<ele.length;i++){
           ele[i].checked = false;
        }
    }

    function addChecked(id) {
        var ele = document.getElementByName(id);
        for(var i=0;i<ele.length;i++){
           ele[i].checked = true;
        }
    }
  </script> -->




 <?php 

    include_once 'rodape.php';

 ?>