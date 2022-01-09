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

  $idturma=$_GET['turm'];
  $iddisciplina=$_GET['disc'];

  

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
                                              
                      <button type="button" class="btn btn-block btn-success"> Adicionar questões ao questionário: <b><?php echo $_GET['nome']; ?></b></button>

                      <form class="mt-12" action="../Controller/Cadastrar_questao.php" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-md-12">
          
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 >
                Descreva sua questão abaixo
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea name="nome" id="summernote" style="height: 245.719px;"></textarea>

            </div>
            <div class="card-footer">
              
            </div>

          </div>
        </div>
        <!-- /.col-->
      </div>




                                                          <h4 class='card-title'>Pontos</h4>
                                                          <div class='form-group'>
                                                              <input type='number' name='pontos' class='form-control' autocomplete='off'  placeholder='' required='' min="1">
                                                          </div>
                                                          
                                                          <h4 class='card-title'>Anexo (opcional) </h4>
                                                          <div class='form-group'>
                                                              <input type='file' name='imagem' class='form-control'>
                                                          </div>


                                                          <h4 class="card-title">Tipo </h4>
                                                          <div class="form-group">
                                                            <select name="tipo" class="form-control" onchange="gerar_questao(this.value);"  required="">
                                                                <option></option>
                                                                <option value="multipla">Múltipla Escolha</option>
                                                                <option value="multipla_justificada">Múltipla Escolha(Justificada)</option>
                                                                <option value="discursiva">Discursiva</option>

                                                            </select>
                                                          </div>

                                                          <div id="gerar_questao" style="background-color: #e8eaec;">
                                                            

                                                          </div>

                                                          

                                                          <input type="hidden" name="questionario_id" value="<?php echo $_GET['id'] ?>" class="form-control" required="">

                                                          <input type="hidden" name="turma_id" value="<?php echo $_GET['turm'] ?>" class="form-control" required="">

                                                          <input type="hidden" name="disciplina_id" value="<?php echo $_GET['disc']; ?>" class="form-control" required="">

                                                          <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">
                                                            Cadastrar Questão
                                                        </button>

                                                      </form>
                            
                                           
                                        
                  </div>
                </div>


<br>
<br>
        <div class="row">
          <div class="col-md-12">
            <h1>Lista de questões cadastradas</h1>

           <?php 
                                      
                                       $nome_questionario=$_GET['nome'];
                                           $questionario_id=$_GET['id'];

                                           $listar_questao=listar_questao($conexao,$questionario_id);
                                           $conta=1;
                                           foreach ($listar_questao as $key => $value) {
                                                 $idquestao=$value['id'];
                                                 $questao=converter_utf8($value['nome']);

                                                 $questao=str_replace("^;", "'", $questao);

                                                 $tipo=$value['tipo'];
                                              if ($idquestao%2==0) {
                                                 echo "<div class='p-3 mb-2 bg-light text-dark'>";
                                              }else{
                                                 echo "<div class='p-3 mb-2 bg-secondary text-white'>";

                                              }
                                                 echo "
                                                 <div class='form-group'>

                                                       <textarea  name='$idquestao' id='$idquestao' class='form-control' required onKeyup=alterar_pergunta_discursiva('$idquestao'); rows='5'>$questao</textarea>


                                                        id:$idquestao <a href='../Controller/Excluir_questao.php?id=$idquestao&questionario_id=$questionario_id&turma_id=$turma_id&disciplina_id=$disciplina_id&nome=$nome_questionario' class='btn btn-danger'> Excluir Questão</a><br>
                                                       <p id='res$idquestao'> </p>

                                                   </div>";
                                           
                                                    $arquivo_anexo=listar_arquivo($conexao,$idquestao);
                                                    foreach ($arquivo_anexo as $key => $value) {
                                                     $idarquivo=$value['id'];
                                                     $arquivo=$value['arquivo'];

                                                      echo "<a href='arquivo/$arquivo' class='btn btn-warning'> Ver arquivo Anexado </a><br>

                                                        <!-- <a href='Excluir_anexo.php?id=$idarquivo' class='btn btn-danger'> Excluir Anexado </a><br> -->";
                                                     
                                                    }
                                                    

                                                    $cont=1;
                                                    $listar_alternativa=listar_alternativa($conexao,$idquestao);
                                                    
                                                    if ($tipo=="multipla" || $tipo=="multipla_justificada") {
                                                    
                                                         
                                                     }

                                                   foreach ($listar_alternativa as $chave => $linha) {
                                                       $id=$linha['id'];
                                                       $tipo=$linha['tipo'];
                                                       $alternativa=$linha['nome'];
                                                       $questao_id=$linha['questao_id'];
                                                       $alternativa=str_replace("^;", "'", $alternativa);


                                                       echo "<br>";

                                                       if ($tipo=="discursiva") {
                                                       
                                                       }else if ($tipo=="multipla") {
                                                         
                                                          echo "                                                
                                                           <div class='custom-control custom-radio'>
                                                             <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input'>
                                                              <label class='custom-control-label' for='customRadio$id$cont'>
                                                              $alternativa</label>
                                                         </div>
                                                         ";

                                                       }else if ($tipo=="multipla_justificada") {
                                                           echo "                                                
                                                           <div class='custom-control custom-radio'>
                                                             <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input'>
                                                             <label class='custom-control-label' for='customRadio$id$cont'>$alternativa</label>
                                                         </div>
                                                         "; 

                                                       }
                                                       $cont++;


                                                    }

                                              echo "</div>";

                                             $conta++;
                                           }

                                        ?>

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