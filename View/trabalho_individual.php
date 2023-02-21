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


  $idtrabalho=$_GET['idtrabalho'];
  $trabalho_entregue_id=$_GET['idtrabalho'];
  $idturma=$_GET['idturma'];
  $iddisciplina=$_GET['iddisciplina'];
  $idescola=$_SESSION['escola_id'];
  
  $turma="";
  $disciplina="";
  $res_t=$conexao->query("SELECT * FROM turma where idturma=$idturma");
  foreach ($res_t as $key => $value) {
    $turma=$value['nome_turma'];
  }
  $res_d=$conexao->query("SELECT * FROM disciplina where iddisciplina=$iddisciplina");
  foreach ($res_d as $key => $value) {
    $disciplina=$value['nome_disciplina'];
  }
   
 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];

  $data=date("Y-m-d H:i:s");

     echo"<script>
          setTimeout('notificacao_video_whatsapp($idturma)',5000);
      </script>";
 

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

              echo "  ".$_SESSION['nome'];  

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

                    
                    <button type="button" class="btn btn-block  btn-success"><?php echo $turma."  - ".$disciplina ?></button>
<br>

  <input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">

                    <div class="timeline">

                      <!-- timeline time label -->
                      <?php 

                           $result=listar_trabalho_aluno_por_idtrabalho($conexao,$idtrabalho);
                           $cont=0;
                           $modal=0;
                           foreach ($result as $key => $value) {
                              
                              $cont++;
                              $modal++;
                              $idtrabalho=$value['id'];
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
                                <form id='formFiles$modal' name='formFiles$modal' action='../Controller/Entregar_atividade.php' enctype='multipart/form-data' method='post'>

                                    
                                    <div class='form-group'>
                                      <label class='col-form-label' for='inputWarning'><i class='far fa-edit'></i>Resposta </label>
                                      <textarea type='text' name='comentario' class='form-control is-warning' id='inputWarning' placeholder='Se preferir responda em texto aqui...' rows='3'></textarea>
                                    </div>
                     
                                    <div class='form-group'>
                                        <!-- <label for='customFile'>Custom File</label> -->

                                          <label class='col-form-label'>ADICIONAR ARQUIVO (OPCIONAL)</label><br>
                                        
                                          <input name='arquivo[]' type='file' multiple='multiple' /><br>
                                          <font color='red'><b> ( OBS: NÃO é permitido o envio de vídeos como resposta) </b></font>
                                        
                                      </div>


                                          <input name='idtrabalho' type='hidden' value='$idtrabalho' />
                                          <input name='idturma' type='hidden' value='$idturma' />
                                          <input name='iddisciplina' type='hidden' value='$iddisciplina' />
                                          <input name='nome_turma' type='hidden' value='$turma' />
                                          <input name='nome_disciplina' type='hidden' value='$disciplina' />";
                                        

                                  echo"<div onclick='carregando()'>
                                    <button type='submit' class='btn btn-block btn-primary btn-flat'>ENTREGAR</button>
                                  </div> 
                                  

                                  </form>
                                    <br>
                                    

                                    </div>
                                  </div>




                                  ";

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

                                      <h3 class='timeline-header'><a href='#'>$titulo</a> descricao</h3>

                                      <div class='timeline-body'>
                                         
                                         <a href='trabalho/$caminho' target='_blank'>";
                                         $extensao = strtolower ( $extensao );

                                         if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx', $extensao ) ) {
                                            echo"<img src='imagens/arquivos.png' width='200' height='200' alt='...'  ><br>
                                            $caminho
                                            ";
                                         }else{
                                             echo"<img src='trabalho/$caminho' width='250' height='250' alt='...'  >";
                                         }
                                       
                                       echo"
                                         </a>
                                      </div>
                              
                                <form id='formFiles$modal' name='formFiles$modal' action='../Controller/Entregar_atividade.php' enctype='multipart/form-data' method='post'>

                                  <div class='form-group'>
                                    <label class='col-form-label' for='inputWarning'><i class='far fa-edit'></i>Resposta</label>
                                    <textarea type='text' name='comentario' class='form-control is-warning' id='inputWarning' placeholder='Se preferir responda em texto aqui...' rows='3'></textarea>
                                  </div>
                                  
                                  <div class='form-group'>
                                      <!-- <label for='customFile'>Custom File</label> -->

                                       <label class='col-form-label'>ADICIONAR ARQUIVO</label><br>
                                      
                                       <input name='arquivo[]' type='file' multiple='multiple' />
                                        
                                      
                                    </div>


                                    <input name='idtrabalho' type='hidden' value='$idtrabalho' />
                                    <input name='idturma' type='hidden' value='$idturma' />
                                    <input name='iddisciplina' type='hidden' value='$iddisciplina' />
                                    <input name='nome_turma' type='hidden' value='$turma' />
                                    <input name='nome_disciplina' type='hidden' value='$disciplina' />";

                              

                                echo"<div onclick='carregando()'>
                                  <button type='submit' class='btn btn-block btn-primary btn-flat'>ENTREGAR</button>
                                </div>

                              </form>

                                  <br>



                                    </div>

                                  </div>





                                  <!-- END timeline item -->



                                  ";

                              }





                           }
                           if ($cont==0) {
                            echo "
                            <script>
                            Swal.fire(
                              'Nenhum trabalho postado por enquanto!',
                              '',
                              'warning'
                            )
                            </script>

                            ";
                          }



                      ?>         







                      <!-- END timeline item -->

                      <div>

                        <i class="fas fa-clock bg-gray"></i>

                      </div>

                    </div>


                   




                  </div>        

                </div>

              </div>

            </section>


            <section class="content">

              <div class="container-fluid">

                <div class="row">

                  <div class="col-md-12">

                    




                    <div class="timeline">

                      <!-- timeline time label -->



                      <?php 
                            $idaluno=$_SESSION['idaluno'];
                           $result=ver_trabalhos_entregues($conexao,$idaluno, $idtrabalho);
                           $cont=0;
                           foreach ($result as $key => $value) {
                              
                              $cont++;
                              $idtrabalho=$value['id'];
                              $titulo=$value['titulo'];

                              $comentario=$value['comentario'];

                              $extensao=$value['extensao'];
                              
                              $caminho=$value['caminho'];

                              $data_entrega=$value['data_entrega'];
                              $data_recebido=$value['data_recebido'];

                              $data_inicio = new DateTime($data_entrega);
                              $data_fim = new DateTime($data_recebido);

                              // Resgata diferença entre as datas
                              $dateInterval = $data_inicio->diff($data_fim);
                         
                       
                           // Resgata diferença entre as datas
                           $dateInterval = $data_inicio->diff($data_fim);


                           $cal_data=floor(strtotime($data_entrega) - strtotime($data_recebido));
                          
                          // $data_recebido='2021-02-08 23:59:00';

                          if ($cal_data >= -80000  ) {
                                echo"       
                                 <div class='time-label'>
                                      <span class='bg-blue'>Data enviado:".converte_data_hora($data_recebido)."</span>
                                    </div>";
                                
                          }else{
                                echo" 
                                 <div class='time-label'>
                                    <span class='bg-red'>Data enviado com atraso: ".converte_data_hora($data_recebido)." </span>
                                  </div>";
                          }


                             

                              if ($extensao=="") {

                                   echo "                          

                                  <!-- /.timeline-label -->

                                  <!-- timeline item -->

                                  <div>

                                    <i class='fas fa-envelope bg-blue'></i>

                                    <div class='timeline-item'>

                                      <span class='time'><i class='fas fa-clock'></i>".converte_data_hora($data_entrega)."</span>

                                      <!-- h3 class='timeline-header'><a href='#'>$titulo</a>  </h3 -->

                                      <div class='timeline-body'>
                                        $comentario
                                      </div>
                                    <a  onclick='excluir_trabalho_aluno($idtrabalho);' class='btn btn-sm bg-danger'>Excluir </a>
                                                                  

                                    </div>
                                  </div>




                                  ";

                              }else {

                                   

                                  echo "

                               
                                  

                                  <!-- /.timeline-label -->

                                  <!-- timeline item -->

                                  <div>

                                    <i class='fa fa-camera bg-purple'></i>

                                    <div class='timeline-item'>

                                      <span class='time'><i class='fas fa-clock'></i>$data_entrega</span>

                                      <h3 class='timeline-header'><a href='#'>$titulo</a> RESPOSTA: $comentario</h3>

                                      <div class='timeline-body'>
                                         
                                         <a href='trabalho_entregue/$caminho' target='_blank'>";
                                         $extensao = strtolower ( $extensao );

                                         if ( strstr ( '.pdf;.docx;.doc;.txt;.odt;.pptx', $extensao ) ) {
                                            echo"<img src='imagens/arquivos.png' width='200' height='200' alt='...'  ><br>
                                            $caminho
                                            ";
                                         }else{
                                             echo"

                                             <a href='trabalho_entregue/$caminho' target='_blank'>
                                                <img src='trabalho_entregue/$caminho' width='200' height='200' alt='...'  >
                                             </a>";
                                         }
                                       
                                       echo"
                                         </a>
                                      </div>
                              
<a  onclick='excluir_trabalho_aluno($idtrabalho);' class='btn btn-sm bg-danger'>Excluir </a>
                                    </div>

                                  </div>





                                  <!-- END timeline item -->



                                  ";

                              }




                           }
                          

                      ?>         







                      <!-- END timeline item -->

                      <div>

                        <i class="fas fa-clock bg-gray"></i>

                      </div>

                    </div>





 <div class='card card-widget'>
                                  <div class='card-header'>
                                    <div class='user-block'>
                                      <!-- <img class='img-circle' src='../dist/img/user1-128x128.jpg' alt='User Image'> -->
                                      <span class='username'><a href='#'><?php echo $_SESSION['nome']; ?></a></span>
                                      
                                    </div>
                                    <!-- /.user-block -->
                                    <div class='card-tools'>
                                      <button type='button' class='btn btn-tool' title='Mark as read'>
                                        <i class='far fa-circle'></i>
                                      </button>
                                      <button type='button' class='btn btn-tool' data-card-widget='collapse'>
                                        <i class='fas fa-minus'></i>
                                      </button>
                                      <button type='button' class='btn btn-tool' data-card-widget='remove'>
                                        <i class='fas fa-times'></i>
                                      </button>
                                    </div>
                                    <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  
                                  <!-- /.card-body -->
                                  <div class='card-footer card-comments' style='display: block;' id="resenha">
                                   




                               




                                    <!-- /.card-comment -->
                                  </div>
                                  <!-- /.card-footer -->
                                 
                                  <div class="row">
                                  <!-- <div class='card-footer' style='display: block;'> -->
                                      <div class="col-sm-1"></div>
                                      <div class="col-sm-10">


                                

                                        <input type="hidden" id="trabalho_entregue_id" value="<?php echo $trabalho_entregue_id; ?>">
                                        <input type="hidden" id="aluno_id" value="<?php echo $idaluno; ?>">
                                        <input type="hidden" id="funcionario_id" value="">

                                        <textarea type='text' id="resposta" class='form-control' placeholder='Responder' rows="4"></textarea>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-1"></div>
                                      <div class="col-sm-10">

                                        <a class="btn btn-block btn-primary" onclick="enviar_resenha();">Enviar</a>
                                      </div>
                                     
                                
                                      <!-- </div> -->
                                  </div>
                                  <!-- /.card-footer -->
                               <br>



                        </div>

                  </div>        

                </div>

              </div>

            </section>







</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

<script type="text/javascript">
    receber_resenha();
setInterval("receber_resenha()",10000);

 function carregando(){
        let timerInterval
        Swal.fire({
          title: 'Aguarde, sua atividade está sendo enviada!',
          html: '',
          timer: 200000,
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