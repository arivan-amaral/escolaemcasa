<?php
  session_start();
if (!isset($_SESSION['idfuncionario'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idfuncionario'];

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

  include_once '../Model/Aluno.php';

  include_once '../Controller/Conversao.php';

  include_once '../Model/Questionario.php';



  $idserie=$_GET['idserie'];
  $escola_id=$_GET['escola_id'];

  // $iddisciplina=$_GET['disc'];
  // // $turma=$_GET['turma'];
  // // $disciplina=$_GET['disciplina'];
  // $escola_id=$_GET['idescola'];

  $data=date("Y-m-d H:i:s");

   

?>

<script src="ajax.js?<?php echo rand(); ?>"></script>


<script type="text/javascript">

// Swal.fire({
//               icon: 'info',
//               title: 'Atenção',
//               text: 'Esta página está em manutenção!',

//           });
</script>

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
                  <div class="col-sm-1"></div>
                  <div class="col-sm-6">

                    

                        <h3 class="card-title">Lista de Questionário</h3>

                        <select class="form-control" id='questionario' >
                            
   <?php 
 

                                $listar_questao=listar_simulado_ativo($conexao,$idserie,$escola_id);
                                $conta=1;
                                foreach ($listar_questao as $key => $value) {
                                  $idquestionario=$value['id'];
                                  $questionario=converter_utf8($value['nome']);
                                  echo "
                                    <option value='$idquestionario' > $questionario </option>

                                  ";
                                }

                            ?>
                        </select>
                       <?php 


                      ?>
                 </div> 
                  <div class="col-sm-4"> 
                 <br>
                 <input type="hidden" id="escola_id" value="<?php echo $escola_id; ?>">
                 <input type="hidden" id="serie_id" value="<?php echo $idserie; ?>">
<input type="hidden" id='aluno' value="1"> 
<input type="hidden" id='indice' value=0> 
                      <a class="btn btn-primary"  onclick="resultado_questao_simulado();"> PESQUISAR</a>
                  </div>


                        
                </div>
<br>
<br>

                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10"> 
                    
                      <table class='table table-bordered'>

                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aluno</th>
                            <th>Opção</th>
                          </tr>
                        </thead>

                        <tbody id="resultado_questao">

                         <tbody>
                      </table>
                    
                  </div>
                </div>                

                <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10" id="paginacao" style="display:none"> 
                    <a onclick="resultado_questao_simulado();" class="btn btn-block btn-secondary">Listar mais alunos</a>
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

    include_once 'rodape_pesquisas.php';

 ?>