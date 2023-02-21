<?php
 session_start();
 if (!isset($_SESSION['idprofessor'])) {

        header("location:index.php?status=0");

 }else{

   $idprofessor=$_SESSION['idprofessor'];

 }
  include_once "cabecalho.php";
  include_once "alertas.php";

  include_once "barra_horizontal.php";

  include_once 'menu.php';

  include_once '../Model/Conexao.php';

  include_once '../Model/Aluno.php';

  include_once '../Controller/Conversao.php';

  include_once '../Model/Trabalho.php';



  // $idturma=$_GET['turm'];

  $idaluno=$_GET['idaluno'];
  $idtrabalho=$_GET['idtrabalho'];
  $trabalho_entregue_id=$_GET['idtrabalho'];
  

  $data=date("Y-m-d H:i:s");

  

?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-10 alert alert-success">

            <h1 class="m-0"><b>ALUNO: 

             <?php 

              $result=meus_dados_aluno($conexao,$idaluno);
              $nome_aluno="";
              foreach ($result as $key => $value) {
                echo $value['nome'];
                $nome_aluno= $value['nome'];
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

                  <div class="col-sm-12">

                    




                    <div class="timeline">

                      <!-- timeline time label -->



                      <?php 

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
                                      <span class='bg-blue'>Data recebido: ".converte_data_hora($data_recebido)."</span>
                                    </div>";
                                
                              }else{
                                echo" 
                                 <div class='time-label'>
                                    <span class='bg-red'>Data recebido com atraso: ".converte_data_hora($data_recebido)."</span>
                                  </div>";
                                
                              }


                             

                              if ($extensao=="") {

                                  echo "                          

                                  <!-- /.timeline-label -->

                                  <!-- timeline item -->

                                  <div>

                                    <i class='fas fa-envelope bg-blue'></i>

                                    <div class='timeline-item'>

                                      <span class='time'><i class='fas fa-clock'></i> ".converte_data_hora($data_entrega)."</span>

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

                                      <span class='time'><i class='fas fa-clock'></i>".converte_data_hora($data_entrega)."</span>

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
                           if ($cont==0) {
                            echo "
                            <script>
                            Swal.fire(
                              'Nenhum trabalho recebido!',
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




<div class='card card-widget'>
              <div class='card-header'>
                <div class='user-block'>
                  <!-- <img class='img-circle' src='../dist/img/user1-128x128.jpg' alt='User Image'> -->
                  <span class='username'><a href='#'><?php echo $nome_aluno; ?></a></span>
                  
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
                    <input type="hidden" id="funcionario_id" value="<?php echo $idprofessor; ?>">

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