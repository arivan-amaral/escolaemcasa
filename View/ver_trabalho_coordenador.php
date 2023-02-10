<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idcoordenador'];

}
include "cabecalho.php";
include "alertas.php";

  include "barra_horizontal.php";
  include 'menu.php';
  include_once '../Model/Conexao.php';
  include '../Controller/Conversao.php';

  include '../Model/Trabalho.php';



  $idescola=$_GET['idescola'];
  $idturma=$_GET['turm'];

  $iddisciplina=$_GET['disc'];

  

?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



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

              echo $_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          <div class="col-sm-2">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Aulas</li>

            </ol>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->



            </section>



            <!-- Main content -->

            <section class="content">

              <div class="container-fluid">



                <div class="row">
                  <div class="col-md-12">

                    <!-- The time line -->


                    <div class="timeline">
<br>
<br>
<br>

                      <!-- timeline time label -->
                    <?php 
                      $result= listar_trabalho($conexao, $idprofessor,$idturma,$iddisciplina,$idescola);
                      $cont=0;
                      foreach ($result as $key => $value) {
                         $id=$value['id'];

                         $titulo=$value['titulo'];

                         $descricao=$value['descricao'];

                         $extensao=$value['extensao'];
                         
                         $caminho=$value['caminho'];

                         $data_entrega=$value['data_entrega'];

                         if ($extensao=="") {

                             echo "

                             <div class='time-label'>

                               <span class='bg-blue'>Data Entrega: $data_entrega</span>

                             </div>

                             <!-- /.timeline-label -->

                             <!-- timeline item -->

                             <div>

                               <i class='fas fa-envelope bg-blue'></i>

                               <div class='timeline-item'>

                                 <span class='time'><i class='fas fa-clock'></i> $data_entrega</span>

                                 <h3 class='timeline-header'><a href='#'>$titulo</a>  </h3>



                                 <div class='timeline-body'>

                                   $descricao

                                 </div>

                             

                                 <div class='timeline-footer'>
                                    <a href='#' onclick='excluir_trabalho($id);' class='btn btn-sm bg-danger'>Deletar Trabalho</a>

                                   <a class='btn btn-sm bg-warning' data-toggle='modal' data-target='#modal-default' onclick='listar_alunos_trabalho($id,$idturma,$iddisciplina);'> VER QUEM ENTREGOU </a>
          

                                 </div>
                                 
                               </div>

                             </div>";




                         }else {

                              

                             echo "

                             <!-- timeline time label -->

                             <div class='time-label'>

                               <span class='bg-primary'>Data entrega: $data_entrega</span>

                             </div>

                             

                             <!-- /.timeline-label -->

                             <!-- timeline item -->

                             <div>

                               <i class='fa fa-camera bg-purple'></i>

                               <div class='timeline-item'>

                                 <span class='time'><i class='fas fa-clock'></i>$data_entrega</span>

                                 <h3 class='timeline-header'><a href='#'>$titulo</a> $descricao</h3>

                                 <div class='timeline-body'>
                                    
                                    <a href='trabalho/$caminho' target='_blank'>";
                                    $extensao = strtolower ( $extensao );

                                    if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx', $extensao ) ) {
                                       echo"<img src='imagens/arquivos.png' width='200' height='200' alt='...'  ><br>
                                       $caminho
                                       ";
                                    }else{
                                        echo"<img src='trabalho/$caminho' width='300' height='300' alt='...'  >";
                                    }
                                  
                                  echo"
                                    </a>                                 

                                 </div>

                                 <div class='timeline-footer'>
                                    <a href='#' onclick='excluir_trabalho($id);' class='btn btn-sm bg-danger'>Deletar Trabalho</a>
                                   
                                   <a class='btn btn-sm bg-warning' data-toggle='modal' data-target='#modal-default'  onclick='listar_alunos_trabalho($id,$idturma,$iddisciplina);'> VER QUEM ENTREGOU </a>


                                 </div>
 
                               </div>
 

                             </div>
                             ";

                          

                      }



                      }

                    ?>

                      <div>
                        <i class='fas fa-clock bg-gray'></i>
                      </div>
                    </div>

                      













               



            <!-- /.content -->

          </div>        

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



  <div class='modal fade' id='modal-default'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h4 class='modal-title'>Escolha o aluno</h4>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
            <div class='modal-body' id="listar_alunos">
                
                
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


 <?php 

    include 'rodape.php';

 ?>