<?php 
session_start();
//$_COOKIE['video_nota']=$_COOKIE['video_nota']+1;
if (!isset($_COOKIE['video_nota'])) {
  setcookie('video_nota', 1, (time()+(300*24*3600)));
 // $_COOKIE['video_nota']=$_COOKIE['video_nota']+1;

}
else if ($_COOKIE['video_nota']<6) {
      echo"<script type='text/javascript'>
      function modal_video() {
          $(document).ready(function() {
              $('#modal-video').modal('show');
            });
      }

      setTimeout('modal_video();',500);
      
    </script>";
  setcookie('video_nota',$_COOKIE['video_nota']+1 );

  //$_COOKIE['video_nota']=$_COOKIE['video_nota']+1;
}

if (!isset($_SESSION['idprofessor'])) {
      // header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";

  include 'menu.php';

  include '../Controller/Conversao.php';

  include '../Model/Conexao.php';

  include '../Model/Aluno.php';
  include '../Model/Professor.php';

  $idserie=$_GET['idserie']; 
  $idescola=$_GET['idescola']; 
  $idturma=$_GET['turm']; 
  $iddisciplina=$_GET['disc']; 
 $array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 $url_get=$array_url[1];
?>



<script src="ajax.js?<?php echo rand(); ?>"></script>

<script type="text/javascript">


                   // Swal.fire('ATENÇÃO, A PÁGINA DE NOTAS ESTÁ EM MANUTENÇÃO PARA FACILITAR O LANÇAMENTO.', '', 'info');

</script>

<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1"></div>
          <div class="col-sm-10 alert alert-warning text-center">

            <h1 class="m-0"><b>           

             <?php
             echo "$nome_escola_global"; 

             if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

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
  <form action="../Controller/Cadastrar_diario_avaliacao_aluno.php" method="post">
           
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


<div class="row">

    <div class="col-md-1"></div>


          <div class="col-sm-10">
          <div class="form-group">
            <label for="exampleInputEmail1" style="color:red;">ATALHO PARA DIÁRIO DE AVALIAÇÃO EM OUTRAS TURMAS/DISCIPLINAS</label>

            <select multiple="multiple" class="form-control" id="atalho" >
              <?php
              $result=listar_disciplina_professor($conexao,$idprofessor);


              $conta=1;
              foreach ($result as $key => $value) {

                $disciplina=($value['nome_disciplina']);
                $nome_escola_atalho=($value['nome_escola']);
                $idescola_atalho=($value['idescola']);
                $iddisciplina_atalho=$value['iddisciplina'];
                $idturma_atalho=$value['idturma'];
                $nome_turma_atalho=($value['nome_turma']);
                $idserie_atalho=$value['serie_id'];

                echo "
                <option value='diario_avaliacao.php?disc=$iddisciplina_atalho&turm=$idturma_atalho&turma=$nome_turma_atalho&disciplina=$disciplina&idescola=$idescola_atalho&idserie=$idserie_atalho' onclick='atalho();' >
                    Mudar para turma =>  $nome_turma_atalho - $disciplina  
                  </option> 

                ";
                $conta++;
              }


              ?>
            </select>
          </div>
        </div>


</div>

      <br>
      <div class="row">
        
        <div class="col-sm-1"></div>
  

        <div class="col-sm-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Período</label>

            <select class="form-control" id='periodo' name='periodo' required="">
              <option></option>
              <?php 
                $resultado=listar_trimestre($conexao);
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

              <a href="#" class="btn btn-primary" onclick="lista_avaliacao_aluno_por_data();">BUSCAR </a>
          </div>
        </div>

      </div>


<input type="hidden" name="url_get" id="url_get" value="<?php echo $url_get; ?>">

<input type="hidden" name="idserie" id="idserie" value="<?php echo $idserie; ?>" >
<input type="hidden" name="idescola" id="idescola" value="<?php echo $idescola; ?>">
<input type="hidden" name="idturma" id="idturma" value="<?php echo $idturma; ?>">
<input type="hidden" name="iddisciplina" id="iddisciplina" value="<?php echo $iddisciplina; ?>" readonly>




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
        
            <b> Como resolver a duplicidade das notas </b>
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