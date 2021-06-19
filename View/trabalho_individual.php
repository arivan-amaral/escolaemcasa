<?php
  include 'seguranca_aluno.php';

  include "cabecalho.php";
  include "alertas.php";

  include "barra_horizontal.php";

  include 'menu.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';

  include '../Controller/Conversao.php';

  include '../Model/Trabalho.php';


  $idtrabalho=$_GET['idtrabalho'];
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
  

  $data=date("Y-m-d H:i:s");

     echo"<script>
          setTimeout('notificacao_video_whatsapp($idturma)',5000);
      </script>";
 

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
                              

                              if ($dateInterval->days > 0  ) {
                                echo" 
                                 <div class='time-label'>
                                    <span class='bg-red'>Data enviado com atraso: $data_recebido</span>
                                  </div>";
                                
                              }else{
                                echo"       
                                 <div class='time-label'>
                                      <span class='bg-blue'>Data enviado: $data_recebido</span>
                                    </div>";
                              }


                             

                              if ($extensao=="") {

                                  echo "                          

                                  <!-- /.timeline-label -->

                                  <!-- timeline item -->

                                  <div>

                                    <i class='fas fa-envelope bg-blue'></i>

                                    <div class='timeline-item'>

                                      <span class='time'><i class='fas fa-clock'></i> $data_entrega</span>

                                      <h3 class='timeline-header'><a href='#'>$titulo</a>  </h3>

                                      <div class='timeline-body'>
                                        $comentario
                                      </div>
                                                                  

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

    include 'rodape_pesquisas.php';

 ?>