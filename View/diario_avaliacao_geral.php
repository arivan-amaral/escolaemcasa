<?php 
session_start();
//$_COOKIE['video_nota']=$_COOKIE['video_nota']+1;
if (!isset($_COOKIE['video_nota'])) {
  setcookie('video_nota', 1, (time()+(300*24*3600)));
 // $_COOKIE['video_nota']=$_COOKIE['video_nota']+1;

}
else if ($_COOKIE['video_nota']<6) {

  setcookie('video_nota',$_COOKIE['video_nota']+1 );

  //$_COOKIE['video_nota']=$_COOKIE['video_nota']+1;
}

if (!isset($_SESSION['idfuncionario'])) {
       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idfuncionario'];

}
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Professor.php';

  $idserie=$_GET['idserie']; 
  $idescola=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 
  $ano_letivo=$_SESSION['ano_letivo']; 
 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);

  $funcionario='';
 if (isset($_GET['funcionario'])) {
    $funcionario=$_GET['funcionario'];
 }
 // funcionario=secretaria
 $url_get=$array_url[1];
?>



<script src="ajax.js?<?php echo rand(); ?>"></script>

<script type="text/javascript">


                  //Swal.fire('ATENÇÃO, A PÁGINA DE NOTAS ESTÁ EM MANUTENÇÃO ATÉ DIA 26/03/2022.', '', 'info');

</script>

<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

                <div class="row mb-2">

                  <div class="col-sm-12 alert alert-danger text-center">

                    <h1 class="m-0"><b>           
        ÁREA DE REGISTRO DE NOTAS
                     </b></h1>

                  </div><!-- /.col -->

                  

                </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
        <!-- Info boxes -->
        <!-- .row -->
           
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <button class="btn btn-block btn-lg btn-secondary"><?php

            $nome_turma='';
            $nome_disciplina='';
            if (isset($_GET['turma'])) {
              $nome_turma=$_GET['turma'];
            } 
            if (isset($_GET['disciplina'])) {
               $nome_disciplina=$_GET['disciplina'];

            }

             echo $nome_turma ." - DISCIPLINAS DA TURMA";?></button>
        </div>
      </div>
      <br>




<!-- ################################################################################# -->

            <?php
            echo "<div class='row'>
              <div class='col-lg-3 col-6'>
                <!-- small card -->
                <div class='small-box bg-info'>
                  <div class='inner'>
                    <h3></h3>

                    <p></p>
                  </div>
                  <div class='icon'>

                  </div>
                  <a  href='cadastrar_conteudo.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                    Conteúdo <ion-icon name='document-text'></ion-icon>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class='col-lg-3 col-6'>
                <!-- small card -->
                <div class='small-box bg-success'>
                  <div class='inner'>
                    <h3> </h3>

                    <p></p>
                  </div>
                  <div class='icon'>
                    <i class='ion ion-stats-bars'></i>
                  </div>
                  <a href='diario_frequencia.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                    Frequência <i class='fa fa-calendar'></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class='col-lg-3 col-6'>
                <!-- small card -->
                <div class='small-box bg-secondary'>
                  <div class='inner'>
                    <h3></h3>

                    <p> </p>
                  </div>
                  <div class='icon'>

                  </div>
                  <a  href='acompanhamento_pedagogico.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                    Ocorrência  <ion-icon name='bookmark-outline'></ion-icon>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class='col-lg-3 col-6'>
                <!-- small card -->
                <div class='small-box bg-danger'>
                  <div class='inner'>
                    <h3></h3>

                    <p></p>
                  </div>
                  <div class='icon'>

                  </div>
                  <a  href='diario_avaliacao.php?disc=$iddisciplina&turm=$idturma&turma=$nome_turma&disciplina=$nome_disciplina&idescola=$idescola&idserie=$idserie' class='small-box-footer' target='_blanck'>
                    Avaliação <i class='fas fa-chart-pie'></i>
                  </a>
                </div>
              </div>

            </div>";
            ?>  
<!-- ################################################################################# -->

  <form action="../Controller/Cadastrar_diario_avaliacao_aluno_geral.php" method="post">

      <br>
      <div class="row">
        
  

        
        <div class="col-sm-5">
          <?php

          // if (!isset($_GET['funcionario'])) {
     
          ?>
          <div class="form-group">
            <label for="exampleInputEmail1" class="text-danger">Escolha o aluno da turma: <?php echo $nome_turma; ?></label>

            <select class="form-control" id='idaluno' name='idaluno' required=""  onchange="limpa_avaliacao();">
              <option></option>
              <?php 
                if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
                  $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
                }

                $conta_aluno=1;
                 foreach ($res_alunos as $key => $value) {

                  $idaluno=$value['idaluno'];
                  $nome_aluno=($value['nome_aluno']);
                  // $nome_aluno=($value['nome_aluno']);
                  $matricula_aluno=$value['matricula'];
                    echo"<option value='$idaluno'> $conta_aluno- $nome_aluno (Matri. $matricula_aluno )</option>";
                    $conta_aluno++;
                  }
               ?>
            </select>
          </div>

        </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label for="exampleInputEmail1">Período</label>

            <select class="form-control" id='periodo' name='periodo' required="" onchange="limpa_avaliacao();">
              <option></option>
              <?php 
                $resultado=listar_trimestre($conexao,$ano_letivo);
                foreach ($resultado as $key => $value) {
                  $idperiodo=$value['id'];
                  $descricao=$value['descricao'];
                  if ($idserie <3 && $idperiodo==6) {
                    echo"<option value='$idperiodo'>$descricao</option>";

                  }else if ($idperiodo !=6) {
                    echo"<option value='$idperiodo'> $descricao</option>";
                  }
                  
                }

               ?>
            </select>
          </div>
        </div>



        <div class="col-sm-3">
          <div class="form-group">
            <br>
            <label for="exampleInputEmail1"> <br></label>

              <a class="btn btn-primary" onclick="lista_avaliacao_aluno_geral();">BUSCAR </a>
          </div>
        </div>

      </div>


<input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">

<input type="hidden" name="idserie" id="idserie" value="<?php echo $idserie; ?>" >
<input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
<input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
<!-- <input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>" readonly> -->








<a name="listaAlunos"></a>
  <div id="listagem_avaliacao">


  </div>

   

      <div class="row" id="botao_continuar">
        
      </div>
      
 </form>
        <!-- Main row -->

        <!-- /.row -->

      </div>





    </div>

  </section>

</div>



<script>
    function somenteNumeros(num,tamanho) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        var valor_campo_nota=campo.value;
        campo.value=valor_campo_nota.replace(",", ".");

   
        if (er.test(campo.value)) {
          campo.value = "";
                  Swal.fire('Esse campo é permitido apenas números, consulte seu coordenador para mais informações.', '', 'info')


        }else{

            if(campo.value>tamanho){
              Swal.fire('A nota não pode ser maior que: '+tamanho+'.', '', 'info')
              campo.value = "";
            }
        }


    }


    function aguardando() {
              let timerInterval
        Swal.fire({
          title: 'Aguarde, ação está sendo realizada...',
          html: '',
          timer: 60000,
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




<div class="modal fade" id="modal-video">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">VEJA O QUE MUDOU <?php echo $_COOKIE['video_nota']; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        

          <div class="modal-body">
              <!-- /corpo -->
        
            <b> Como resolver a duplicidade nas avaliações </b>
             <a  href='https://youtu.be/f6omYxWvGeY' target="_blank">
              <img src='imagens/assista-video.gif' width='200' classe='img-fluid' >
             </a>
             <br>
             <br>           

             <b> Como lançar as notas no novo formato </b>
             <a  href='https://youtu.be/URKraLoTQHU' target="_blank">
              <img src='imagens/assista-video.gif' width='200' classe='img-fluid' >
             </a>
             <br>
             <br>


              <!-- /corpo -->
        </div>
      <button type="button" class="btn btn-default" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



 <?php 

    include 'rodape.php';

 ?>