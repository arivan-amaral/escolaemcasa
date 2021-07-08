<?php
date_default_timezone_set('America/Bahia');

  include 'seguranca_aluno.php';

  include "cabecalho.php";
  include "alertas.php";

  include "barra_horizontal.php";

  include 'menu.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';

  include '../Controller/Conversao.php';

  include '../Model/Questionario.php';



  $idturma=$_GET['turm'];

  $iddisciplina=$_GET['disc'];
  $turma=$_GET['turma'];
  $disciplina=$_GET['disciplina'];

  $data=date("Y-m-d H:i:s");

  

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

              echo "  ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          <div class="col-sm-2">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>

              <li class="breadcrumb-item active">Início</li>

            </ol>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



   



            <!-- Main content -->

            <section class="content">

              <div class="container-fluid">

                <div class="row">

                  <div class="col-md-12">

                    




                    <button type="button" class="btn btn-block  btn-success"><?php echo $turma."  - ".$disciplina ?></button>
                    <br>


            <?php 
                                            $iddisciplina=$_GET['disc'];
                                            $idturma=$_GET['turm'];

                                            echo "
                                            <input type='hidden' id='iddisciplina' value='$iddisciplina'>
                                            <input type='hidden' id='idturma' value='$idturma'>";
                                            $data_atual=date("Y-m-d");
                                            //$selec_questionario=selecionar_questionario($conexao,$iddisciplina,$idturma);
                                            $selec_questionario=selecionar_questionario_data($conexao,$iddisciplina,$idturma,$data_atual);
                                            $questionario_id="";

                                            foreach ($selec_questionario as $key => $value) {
                                            

                                              $questionario_id=$value['id'];
                                              $nome_questionario=$value['nome'];
                                              $data_questionario=$value['data'];

                                              // echo "id: $questionario_id - $data_questionario ";
                                             //  echo "<script>";
                                             // echo "alert($questionario_id);";

                                             // echo "</script>  ";
                                             
                                            }

                                        if ($questionario_id !="") {                                            

                                                $hora_atual=date("H:i:s");

                                                  
                                             //  echo "<script>";
                                             // echo "alert('$hora_atual');";
                                             // echo "</script>  ";

                                                $verificar_horario=verificar_horario_questionario_aluno($conexao,$idaluno,$hora_atual,$questionario_id);
                                                
                                                $conta_horario=0;
                                                foreach ($verificar_horario as $key => $value) {
                                                  $conta_horario++;
                                                } 
                                                   

                                               if ($conta_horario==0 || $questionario_id=="") {

                                                   $questionario_id=0;
                                                   echo "<script>";
                                                   echo "Swal.fire({
                                                      icon: 'error',
                                                      title: 'Oops...',
                                                      text: 'Você não tem prova nesse hórario, verifique com seu professor!',
                                                      
                                                    });";

                                                   echo "</script>";
                                                }
                                               

                                         } else{
                                            echo "<script>";
                                            echo "Swal.fire({
                                               icon: 'error',
                                               title: 'Oops...',
                                               text: 'Você não tem prova nesse hórario, verifique com seu professor!',
                                               
                                             });";

                                            echo "</script>";

                                         }


if ($questionario_id>0) {

                                            $listar_questao=listar_questao($conexao,$questionario_id);
                                            
                                                     
                                            $conta=1;
                                            foreach ($listar_questao as $key => $value) {
                                              $idquestao=$value['id'];
                                              $questao=$value['nome'];

                                              $questao=str_replace("^;", "'", $questao);
                                              $questao=str_replace('Ã§', 'ç', $questao);
                                              $questao= str_replace('Ã©', 'é', $questao);
                                              $questao=str_replace('Ã¡','á',$questao);
                                              $questao= str_replace('Ã£', 'ã', $questao);
                                                $questao= str_replace('Ã³', 'ó', $questao); 
                                              

                                              $tipo=$value['tipo'];

                                              echo "<hr>
                                              $questao
                                              ";

                                                     $arquivo_anexo=listar_arquivo($conexao,$idquestao);
                                                     foreach ($arquivo_anexo as $key => $value) {
                                                      $arquivo=$value['arquivo'];

                                                       echo "<a href='arquivo/$arquivo' class='btn btn-warning' target='_blank'> Ver arquivo Anexado </a><br>";
                                                     }
                                                     

                                                     $cont=1;
                                                     
                                                     
                                                     $listar_alternativa=listar_alternativa($conexao,$idquestao);
                                                     
                                                     
                                                     if ($tipo=="multipla" || $tipo=="multipla_justificada") {
                                                     
                                                          // echo "                                                
                                                          //   <div class='custom-control custom-radio'>
                                                          //     <input type='radio' id='customRadio$idquestao$conta' name='alternativa$idquestao' class='custom-control-input' checked>
                                                          //      <label class='custom-control-label' for='customRadio$idquestao$conta'>
                                                          //      N. D. A  </label>
                                                          // </div>
                                                          // ";
                                                      }

                                                    foreach ($listar_alternativa as $chave => $linha) {
                                                        
                                                        $id=$linha['id'];
                                                        $tipo=$linha['tipo'];
                                                        $alternativa=$linha['nome'];
                                                        $questao_id=$linha['questao_id'];
                                              
                                                    $alternativa=str_replace("^;", "'", $alternativa);
                                                     $alternativa=str_replace("^;", "'", $alternativa);
                                              $alternativa=str_replace('Ã§', 'ç', $alternativa);
                                              $alternativa= str_replace('Ã©', 'é', $alternativa);
                                              $alternativa=str_replace('Ã¡','á',$alternativa);
                                              $alternativa= str_replace('Ã£', 'ã', $alternativa);
                                              
                                              $alternativa= str_replace('Ã³', 'ó', $alternativa); 
                                              

                                  
                                  //pesquisa as respostas do banco de dado para serem listadas como já respondidadas
                                  $listar_alternativa=listar_resposta_alternativa_aluno($conexao,$idquestao,$idaluno );
                                                          $resposta_discursiva="";
                                                          $alternativa_id="";
                                         foreach ($listar_alternativa as $chave => $linha) {
                                          $alternativa_id=$linha['alternativa_id'];
                                          $resposta_discursiva=$linha['resposta_discursiva'];
                                         }
                                    //fim pesquisa

                                                        echo "<br>  
                                                        <input type='hidden' id='questao_id$id' value='$questao_id'>
                                                        ";

                                                        if ($tipo=="discursiva") {
                                                        
                                                       

                                                            echo "                                                
                                                            <h5> Descreva sua resposta abaixo.</h5>
                                                            <div class='form-group'>
                                                                <textarea type='text'  name='$id' class='form-control' 
                                                                id='$id' onKeyup='resposta_discursiva($id)' value='' required rows='5'>$resposta_discursiva</textarea>

                                                            </div>

                                                            
                                                            <div id='rd$id' class='alert-success'>
                                                            </div>
                                                            <div id='erro_rd$id' class='alert-danger'>
                                                            </div>
                                                          ";
                                                        }else if ($tipo=="multipla") {

                                                          
                                                            
                                                           if ($id==$alternativa_id) {
                                                             echo "                                                
                                                              <div class='custom-control custom-radio'>
                                                                <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_multipla($id)' value='$id' checked>

                                                                 <label class='custom-control-label' for='customRadio$id$cont'>
                                                                 $alternativa</label>
                                                            </div>
                                                            ";
                                                          }else{
                                                             echo "                                                
                                                              <div class='custom-control custom-radio'>
                                                                <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_multipla($id)' value='$id'>

                                                                 <label class='custom-control-label' for='customRadio$id$cont'>
                                                                 $alternativa</label>
                                                            </div>";

                                                          }




                                                        }else if ($tipo=="multipla_justificada") {
                                                         
                                                          if ($id==$alternativa_id){
                                                              echo "                                                
                                                              <div class='custom-control custom-radio'>
                                                                <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_justificada($id,$cont)' value='$id' checked>

                                                                <label class='custom-control-label' for='customRadio$id$cont'>$alternativa</label>
                                                            </div>

                                                             <h5> Justifique sua resposta.</h5>
                                                              <div class='form-group'>
                                                                  <textarea  name='resposta$id' class='form-control' required id='$id' onKeyup='resposta_justificada($id,$cont)'>$resposta_discursiva</textarea>
                                                              </div>
                                                            "; 
                                                          }else {
                                                              echo "                                                
                                                              <div class='custom-control custom-radio'>
                                                                <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_justificada($id,$cont)' value='$id'>

                                                                <label class='custom-control-label' for='customRadio$id$cont'>$alternativa</label>
                                                            </div>

                                                             <h5> Justifique sua resposta.</h5>
                                                              <div class='form-group'>
                                                                  <textarea  name='resposta$id' class='form-control' required id='$id' onKeyup='resposta_justificada($id,$cont)'></textarea>
                                                              </div>
                                                            "; 
                                                          }


                                                        }
                                                        $cont++;


                                                     }

                                                echo "
                                                     
                                                
                                              ";
                                              $conta++;
                                            }


                                         ?>
                                        
                                        
                                            
                                              
                                              <button  class="btn waves-effect waves-light btn-lg btn-warning" onclick="alert('Essa página será recarregada, certifique-se que todas suas respostas permanecerão, se sim, pode sair da página que suas resposta estão conosco, obrigado... '); refreshPage();">
                                                  Finalizar Questionário
                                              </button>



<?php } ?>


                  </div>        

                </div>

              </div>

            </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>


<script type="text/javascript">

 function carregando(){
        let timerInterval
        Swal.fire({
          title: 'Aguarde, sua atividade está sendo enviada!',
          html: ' <b></b> ',
          timer: 100000,
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
  }

</script>




  <!-- /.control-sidebar -->

  <script type="text/javascript">

function refreshPage(){
    window.location.reload();
} 

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

    include 'rodape_pesquisas.php';

 ?>