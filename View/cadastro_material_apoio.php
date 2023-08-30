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

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

  include_once '../Controller/Conversao.php';
  include_once '../Model/Material_apoio.php';



  $idtrabalho=$_GET['idtrabalho'];
  $idturma=$_GET['turm'];
  $iddisciplina=$_GET['disc'];
  $idescola=$_GET['idescola'];
  
   $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
  $url_get=$array_url[1];

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
 

                    <div class="timeline">

                      <!-- timeline time label -->

                                  <div class='time-label'>

                                    <span class='bg-blue'>MATERIAL DE APOIO</span>

                                  </div>

                                  <!-- /.timeline-label -->

                                  <!-- timeline item -->

                                  <div>

                                 <!--    <i class='fas fa-envelope bg-blue'></i>
 -->
                                    <div class='timeline-item'>

                                      <span class='time'><i class='fas fa-clock'></i> $data_entrega</span>

                                      <h3 class='timeline-header'><a href='#'>CADASTRAR MATERIAL DE APOIO</a>  </h3>

                                    
                                <form id='formFiles$modal' name='formFiles$modal' action='../Controller/Cadastrar_material_apoio.php' enctype='multipart/form-data' method='post'>

                                    
                                    <div class='form-group'>
                                      <label class='col-form-label' for='inputWarning'><i class='far fa-edit'></i>Título</label>
                                      <input type='text' name='titulo' class='form-control is-warning' placeholder="título" required>
                                    </div>
                     
                                    <div class='form-group'>
                                        <!-- <label for='customFile'>Custom File</label> -->

                                          <label class='col-form-label'>ADICIONAR ARQUIVO</label><br>
                                        
                                          <input name='arquivo' type='file' multiple='multiple' required="" />
                                        
                                      </div>

                                        <?php  
                                         echo "
                                          <input name='idturma' type='hidden' value='$idturma' />
                                          <input name='iddisciplina' type='hidden' value='$iddisciplina' />
                                          <input name='idescola' type='hidden' value='$idescola' />
                                        
                                        ";
                                        ?>
                                        <input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">
                                  <div onclick='carregando()'>
                                    <button type='submit' class='btn btn-block btn-primary btn-flat'>SALVAR</button>
                                  </div> 
                                  

                                  </form>
                                    <br>
                                    

                                    </div>
                                  </div>





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
                          
                          $result=listar_material_apoio_turma_disciplina($conexao, $idescola, $idturma, $iddisciplina);
                           $cont=0;
                           foreach ($result as $key => $value) {
                              
                              $cont++;
                              $id=$value['id'];
                              $titulo=$value['titulo'];

                              $descricao=$value['descricao'];

                              $extensao=$value['extensao'];
                              
                              $arquivo=$value['arquivo'];
                              $data=$value['data'];
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

                                    <a href='#' onclick='excluir_material_apoio($id);' class='btn btn-sm bg-danger'>Excluir</a>

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

    include_once 'rodape_pesquisas.php';

 ?>