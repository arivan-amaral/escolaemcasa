<?php 
session_start();
//$_COOKIE['video_nota']=$_COOKIE['video_nota']+1;
if (!isset($_COOKIE['video_nota'])) {
  setcookie('video_nota', 1, (time()+(300*24*3600)));
 // $_COOKIE['video_nota']=$_COOKIE['video_nota']+1;

}
else if ($_COOKIE['video_nota']<6) {
    //   echo"<script type='text/javascript'>
    //   function modal_video() {
    //       $(document).ready(function() {
    //           $('#modal-video').modal('show');
    //         });
    //   }

    //   setTimeout('modal_video();',500);
      
    // </script>";
  setcookie('video_nota',$_COOKIE['video_nota']+1 );

  //$_COOKIE['video_nota']=$_COOKIE['video_nota']+1;
}

if (!isset($_SESSION['idfuncionario'])) {
       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idfuncionario'];

}
  include_once "cabecalho.php";
  include_once "alertas.php";
  include_once "barra_horizontal.php";

  include_once 'menu.php';

  include_once '../Controller/Conversao.php';

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

  include_once '../Model/Aluno.php';
  include_once '../Model/Professor.php';

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

             echo $nome_turma ." - ". $nome_disciplina; ?></button>
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

  <form action="../Controller/Cadastrar_diario_avaliacao_aluno.php" method="post">

      <br>
      <div class="row">
        
  

        <div class="col-sm-1"></div>
        <div class="col-sm-4">
          <?php

          if (!isset($_GET['funcionario'])) {
     
          ?>
          <div class="form-group">
            <label for="exampleInputEmail1" class="text-danger">Disciplina da turma <?php echo $nome_turma; ?></label>

            <select class="form-control" id='iddisciplina' name='iddisciplina' required=""  onchange="limpa_avaliacao();">
              <option></option>
              <?php 
             
                $resultado_disciplina=listar_disciplina_professor_na_turma($conexao,$idescola,$idturma,$idprofessor,$_SESSION['ano_letivo']);
                  
                  foreach ($resultado_disciplina as $key => $value) {
                  $iddisciplina=$value['iddisciplina'];
                  $nome_disciplina=$value['nome_disciplina'];
                   
                    echo"<option value='$iddisciplina'>$nome_disciplina</option>";

                  
                  
                }

               ?>
            </select>
          </div>
          <?php 

          }else{
            echo "
            <label class='text-danger'>Disciplina da turma $nome_turma</label>
            <input type='text' class='form-control' name='iddisciplina' id='iddisciplina' value='$iddisciplina' readonly> ";
          }

          ?>
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

              <a class="btn btn-primary" onclick="lista_avaliacao_aluno_por_data();">BUSCAR </a>
          </div>
        </div>

      </div>


<input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">

<input type="hidden" name="idserie" id="idserie" value="<?php echo $idserie; ?>" >
<input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
<input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
<!-- <input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>" readonly> -->




<!-- ####################################################################### -->


<!-- <div class="row">

    <div class="col-md-1"></div>



    <div class="col-md-10">

                <div class="card">

                  <div class="card-header">

                    <h3 class="card-title">AVALIAÇÕES CADASTRADAS</h3>

                  </div>

                  <div class="card-body">

                    <div id="accordion">

                          <div class='card card-primary'>

                            <div class='card-header'>

                              <h4 class='card-title w-100'>



                                <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne' aria-expanded='false'><b class='text-warning'>
                                    CLIQUE AQUI PARA VER AS AVALIAÇÕES CADASTRADAS 
                                  </b>

                                </a>

                              </h4>

                            </div>

                            <div id='collapseOne' class='collapse' data-parent='#accordion' style=''>

                              <div class='card-body'>


                          
                                         <table class='table table-primary'>
                                              <thead>
                                                <tr>
                                                  <th style='width: 10px'>#</th>
                                                  <th>Avaliações</th>
                                                  <th>
                                                  Opções
                                                  </th>
                                                </tr>
                                              </thead>
                                              <tbody> -->


                                                <?php 
                                          //       $conta=1;
                                          //       $array_avaliacao= array('0'=>'av1','1'=>'av2','2'=>'av3','3'=>'av4','4'=>'DIAGNÓSTICO INICIAL','5'=>'RP');

                                          // foreach ($array_avaliacao as $key => $value) {
                                          //         $avaliacao=$value;
                                                
                                          //       $resultado=listar_todas_avaliacao_lancada($conexao,$idescola,$idturma,$iddisciplina,$avaliacao);
                                          //           foreach ($resultado as $key => $value) {
                                          //             $data_nota=$value['data_nota'];
                                          //             $turma_id  =$value['turma_id'];
                                          //             $disciplina_id  =$value['disciplina_id'];
                                          //             $escola_id=$value['escola_id'];
                                          //             $avaliacao=$value['avaliacao'];
                                          //             $periodo_id=$value['periodo_id'];
                                          //             $nome_periodo="";
                                          //             $res_periodo=$conexao->query("SELECT * FROM periodo where id=$periodo_id ");
                                          //             foreach ($res_periodo as $key => $value) {
                                          //               $nome_periodo=$value["descricao"];
                                          //             }


                                          //             echo"
                                          //             <tr>
                                          //             <td>
                                          //             $conta
                                                      
                                          //             <input type='hidden' id='data_nota$conta' value='$data_nota'>
                                          //             <input type='hidden' id='turma_id$conta' value='$turma_id'>
                                          //             <input type='hidden' id='disciplina_id$conta' value='$disciplina_id'>
                                          //             <input type='hidden' id='escola_id$conta' value='$escola_id'>
                                          //             <input type='hidden' id='avaliacao$conta' value='$avaliacao'>
                                          //             <input type='hidden' id='periodo_id$conta' value='$periodo_id'>

                                           
                                          //             </td>
                                          //               <td>Periodo: $nome_periodo - Avaliação $avaliacao - ".converte_data($data_nota)."</td>
                                          //               <td>
                                          //               <!-- a onclick='excluir_avaliacao($conta);' class='btn btn-danger'>EXCLUIR AVALIAÇÃO</a -->

                                          //               </td>
                                          //               <td>
                                          //                 <a href='#listaAlunos' onclick='editar_avaliacao_aluno_por_data($conta);' class='btn btn-primary'>EDITAR AVALIAÇÃO</a>
                                          //               </td>

                                          //             </tr>";
                                          //             $conta++;
                                          //           }
                                          //       }

                                              ?>
<!-- 
                                              </tbody>
                                        </table>
              

                            </div>

                          </div>

                    </div>

                  </div>


                </div>

              </div>

        </div>

  </div>
 -->

<!-- ####################################################################### -->







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

    include_once 'rodape.php';

 ?>