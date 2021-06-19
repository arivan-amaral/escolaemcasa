<?php
session_start();
if (!isset($_SESSION['idprofessor'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
include "cabecalho.php";
include "alertas.php";

  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';
  include '../Model/Questionario.php';

  $idescola=$_GET['idescola'];
  $idturma=$_GET['turm'];
  $iddisciplina=$_GET['disc'];

  

?>



<script src="ajax.js"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-10 alert alert-warning">

            <h1 class="m-0"><b>

               <?php
              if (isset($nome_escola_global)) {
                echo $nome_escola_global; 
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

              <li class="breadcrumb-item active">Questionário</li>

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
                                              
                      <button type="button" class="btn btn-block  btn-success"><?php if(isset($_GET['turma']))echo $_GET['turma']."  - ".$_GET['disciplina']; ?></button>


                              <form class="mt-12" action="../Controller/Cadastrar_questionario.php" method="post" enctype="multipart/form-data">

                                    <h4 class="card-title">Nome do Questionário</h4>
                                    <div class="form-group">
                                        <input type="text" name="nome" class="form-control" autocomplete="off"  required="">
                                    </div>


                                    <h4 class="card-title">Data de Início</h4>
                                    <div class="form-group">
                                        <input type="date" name="data" class="form-control"  required="">

                                    </div>

                                    <h4>Hora de Início</h4>
                                    <div class="form-group">
                                        <input type="time" class="form-control" name="hora_inicio" required>
                                    </div>
                                    <h4>Hora de Fim</h4>
                                    <div class="form-group">
                                        <input type="time" class="form-control" name="hora_fim" required>
                                    </div>

                                    <input type="hidden" name="turma_id" value="<?php echo $_GET['turm'] ?>" class="form-control" required="">

                                    <input type="hidden" name="disciplina_id" value="<?php echo $_GET['disc']; ?>" class="form-control" required="">

                                    <input type="hidden" name="idescola" value="<?php echo $_GET['idescola']; ?>" class="form-control" required="">

                                    <input type="hidden" name="turma" value="<?php echo $_GET['turma']; ?>" class="form-control" required="">     
                                    <input type="hidden" name="disciplina" value="<?php echo $_GET['disciplina']; ?>" class="form-control" required="">

                                    <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">
                                      Cadastrar
                                  </button>

                                </form>
                                           
                                        
                  </div>
                </div>



                <div class="row">
                  <div class="col-md-12">

                  <br>      
                    <div class="table">
                                            <a class="btn btn-block btn-danger">Lista de Questionário Enviados</a>

                                            <table id="zero_config" class="table">
                                                <thead>
                                                    <tr>

                                                       <th>Título</th>
                                                       
                                                        <th>Opção</th>
                                                       

                                                   </tr>
                                               </thead>
                                                <tbody>
                                                  
<?php 
                                               
                                                 

                                                    $turma_id=$_GET['turm'];
                                                    $disciplina_id=$_GET['disc'];


                                                    $result=listar_questionario($conexao,$idprofessor,$turma_id,$disciplina_id);

                                                    foreach ($result as $key => $value) {
                                                      $id=$value['id'];
                                                      $nome=($value['nome']);
                                                      $status=$value['status'];
                                                      $data=$value['data'];

                                                        echo "
                                                          <tr>

                                                       
                                                               <td>
                                                               id: $id
                                                                  <br>$nome</b>
                                                                
                                                                <input type='date' value='$data' onchange='alterar_data_questionario($id);' id='data$id' >
                                                                <span class='alert-success' id='resposta_alteracao_data'></span>
                                                                <br>
                                                            
                                                              ";
                                                              
                                                              if ($status==1) {
                                                                  echo"
                                                                 <span class='text-success'>
                                                                      Ativo
                                                                    </span>
                                                                    <br>
                                                                  ";
                                                              }else{
                                                                echo"
                                                                  <span class='text-danger'>
                                                                      Desativado
                                                                    </span>
                                                                  <br>";
                                                              }
                                                    

                                                             

                                                              if ($status==1) {
                                                                  echo"
                                                            <a href='#' onclick='alterar_status_questionario($id,$status);'>

                                                                 <span class='btn btn-primary'>
                                                                      Desativar
                                                                    </span>
                                                            </a>
                                                                    <br>
                                                                    <br>
                                                                  ";
                                                              }else if ($status==0) {
                                                                  echo"
                                                            <a href='#' onclick='alterar_status_questionario($id,$status);'>

                                                                 <span class='btn btn-warning'>
                                                                      Ativar
                                                                    </span>
                                                            </a>
                                                                    <br>
                                                                    <br>
                                                                  ";
                                                              }

                                                            echo "
                                                            </td>
                                                            
                                                            <td>
                                                            <a href='adicionar_questao.php?nome=$nome&id=$id&turma_id=$turma_id&disciplina_id=$disciplina_id'>
                                                                <span class='btn btn-primary'>
                                                                     Adicionar Questões
                                                                </span>
                                                              </a>
                                                            
                                                            <br>
                                                            <br>
                                                             <a href='adicionar_horario_individual_questionario.php?nome=$nome&id=$id&turma_id=$turma_id&disciplina_id=$disciplina_id&idescola=$idescola'>
                                                                <span class='btn btn-warning'>
                                                                     Agendar Hórario Individual
                                                                </span><br><br>
                                                            </a>

                                                          

                                                                 </td>";

                                                        echo "
                                                          </tr>
                                                        ";
                                                    }

                                                  ?>
                                                </tbody>


                                         </table>

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



 <?php 

    include 'rodape.php';

 ?>