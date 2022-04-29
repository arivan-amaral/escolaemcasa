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

  // $idturma=$_GET['turma_id'];
  $idquestionario=$_GET['id']; 
  // $iddisciplina=$_GET['disc'];

  $idescola=$_GET['idescola'];
  $iddisciplina=$_GET['disciplina_id'];
  $idturma=$_GET['turma_id'];
  $idfuncionario=$_SESSION['idprofessor'];
  
  $nome_questionario=$_GET['nome'];


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
                                              
                      <button type="button" class="btn btn-block btn-primary"> Alterar horários individualmente no questionário: <b><?php echo $_GET['nome']; ?></b></button>

                    <br>
                    
                    <div class='form-group'>
                      <form action="../Controller/Horario_individual_questionario_turma.php" method="post">

                          <div class="row">
                              <div class="col-4">
                                <label><b>Hora início</b></label>
                                <input type="hidden"  value="<?php echo $idquestionario; ?>" id="idquestionario" name="idquestionario">
                                    
    
    
    
                                <input type="hidden" value="<?php echo $nome_questionario; ?>"  name="nome_questionario" >
                                <input type="hidden" value="<?php echo $iddisciplina; ?>"  name="disciplina_id" >
                                <input type="hidden" value="<?php echo $idescola; ?>"  name="escola_id" >
                                                               
                                <input type="hidden" value="<?php echo $idturma; ?>"  name="idturma" >
                                
                                <input type="time" class="form-control" name="hora_inicio" required>
                              </div>
                              <div class="col-4">
                                <label><b>Hora fim</b></label>
                                <input type="time" class="form-control" name="hora_fim" required>
                                
                              </div>
                              <div class="col-4">
                                <br>
                                <label></label>
                                    <button type="submit" class="btn  btn-success"> Aplicar</button>
                              </div>
                            </div>
                        
                      </form>

                    </div>
<br>
                                          <?php
                                                
                                              
                                           
                                             $res_a=$conexao->query("SELECT turma.nome_turma, aluno.nome,aluno.email,aluno.senha,aluno.idaluno FROM escola,ano_letivo,aluno,turma WHERE 
                                               ano_letivo.status_letivo=1 AND 
                                               ano_letivo.escola_id = escola.idescola AND ano_letivo.turma_id = turma.idturma AND
                                              ano_letivo.aluno_id = aluno.idaluno AND
                                              ano_letivo.status_letivo = 1 AND
                                              turma.idturma=$idturma and
                                              ano_letivo.escola_id=$idescola

                                              and aluno.status='Ativo' order by nome asc
                                                ");
                                              $i=1;
                                              foreach ($res_a as $key => $value) {
                                                   
                                                    $idaluno=$value['idaluno'];
                                                    $email=$value['email'];
                                                    $senha=$value['senha'];
                                                    $nome=($value['nome']);

                                                     echo"
                                                     <tr>
                                                        <td>
                                                           id: $idaluno
                                                        </td>

                                                        <td>
                                                            <h2>$nome</h2>
                                                        </td>

                                                         <td>
                                                        ";

                                                        $marcado=0;
                                                        $resultado_marcado=pesquisar_horario_agendado_questionario($conexao,$idaluno,$idquestionario);
                                                        
                                                        foreach ($resultado_marcado as $key => $value) {
                                                            $hora_inicio=$value['hora_inicio'];
                                                            $hora_fim=$value['hora_fim'];

                                                            echo " <label>Hora de Início</label>
                                                             <div class='form-group'>
                                                                 <input type='time' name='hora_inicio$idaluno' id='hora_inicio$idaluno' value='$hora_inicio' onchange='alterar_horario_individual_questionario($idaluno)' required>
                                                             </div>

                                                             <label>Hora Fim</label>
                                                             <div class='form-group'>
                                                                 <input type='time' name='hora_fim$idaluno' id='hora_fim$idaluno' value='$hora_fim' onchange='alterar_horario_individual_questionario($idaluno)' required>
                                                              </div>
                                                             <span id='horario_alterado$idaluno'> </span>
                                                             ";
                                                             $marcado++;
                                                        }
                                                        if ($marcado==0) {
                                                            echo " <label>Hora de Início.</label>
                                                             <div class='form-group'>
                                                                 <input type='time' name='hora_inicio$idaluno' id='hora_inicio$idaluno' value=''  onchange='cadastra_horario_individual_questionario($idaluno);' required>
                                                             </div>

                                                             <label>Hora Fim</label>
                                                             <div class='form-group'>
                                                                 <input type='time' name='hora_fim$idaluno' id='hora_fim$idaluno' value='' onchange='cadastra_horario_individual_questionario($idaluno)' required>
                                                             </div>";
                                                        }


                                                        echo "
                                                        </td>

                                                     </tr>
                                                      ";
                                                      $i++;
                                                   
                                                }

                       ?>
                                                                
                                       

                                        
                            
                                           
                                        
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