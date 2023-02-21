<?php
  include_once 'seguranca_aluno.php';

  include_once "cabecalho.php";
  include_once "alertas.php";

  include_once "barra_horizontal.php";

  include_once 'menu.php';

  include_once '../Model/Conexao.php';

  include_once '../Model/Aluno.php';

  include_once '../Controller/Conversao.php';

  include_once '../Model/Trabalho.php';
  include_once '../Model/Material_apoio.php';

  $idaluno=$_SESSION['idaluno'];
  $idescola=$_SESSION['escola_id'];
  $idturma=$_SESSION['turma_id'];
  $iddisciplina=$_GET['iddisciplina'];


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

                <div class="row">

                  <div class="col-md-12">

                    




                    <div class="timeline">

                      <!-- timeline time label -->



                      <?php 
                          
                          $result=listar_material_apoio_turma_disciplina($conexao, $idescola, $idturma, $iddisciplina);
                           $cont=0;
                           foreach ($result as $key => $value) {
                              
                              $cont++;
                              $id=$value['id'];
                              $titulo=$value['titulo'];

                              $descricao=$value['descricao'];

                              $extensao=$value['extensao'];
                              
                              $arquivo=$value['arquivo'];
                              $data=converte_data_hora($value['data']);
                                echo"       
                                 <div class='time-label'>
                                      <span class='bg-blue'>Data enviado: $data</span>
                                    </div>";
                              
                          
                                  echo "
                                  <div>
                                    <i class='fa fa-camera bg-purple'></i>
                                    <div class='timeline-item'>
                                      <h3 class='timeline-header'><a href='#'>$titulo</a></h3>
                                      <div class='timeline-body'>
                                         <a href='material_apoio/$arquivo' target='_blank'>";
                                         $extensao = strtolower ( $extensao );
                                         if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx', $extensao ) ) {
                                            echo"<img src='imagens/arquivos.png' width='200' height='200' alt='...'  ><br>
                                           $arquivo
                                            ";
                                         }else{
                                             echo"
                                             <a href='material_apoio/$arquivo' target='_blank'>
                                                <img src='material_apoio/$arquivo' width='200' height='200' alt='...'  >
                                             </a>";
                                         }
                                       
                                       echo"
                                         </a>
                                         <br>

                               

                                      </div>
                                    </div>
                                  </div>

                                  ";

                              }
                      ?>         
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

    include_once 'rodape_pesquisas.php';

 ?>