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



  $idturma=$_GET['turm'];

  $iddisciplina=$_GET['disc'];
  $turma=$_GET['turma'];

  $disciplina=$_GET['disciplina'];
  $idescola=$_SESSION['escola_id'];
  $idaluno=$_SESSION["idaluno"];
  $idserie=$_SESSION['serie_id'];

  $data=date("Y-m-d H:i:s");

  $diasemana_get=$_GET['diasemana'];
   

 

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




                    
                    <div class="col-md-12">
                      
                     
                      
                                  <div class="card card-default">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                        <i class="fas fa-bullhorn"></i>
                                        Trabalhos 
                                      </h3>
                                    </div>

                                    <?php

                                    if ( $idserie<3) {
                                      $res_pendencia=$conexao->query("SELECT * FROM trabalho WHERE escola_id=$idescola and turma_id=$idturma and data_hora_visivel<='$data' order by id desc ");
                                    }else{
                                      $res_pendencia=$conexao->query("SELECT * FROM trabalho WHERE escola_id=$idescola and turma_id=$idturma and disciplina_id=$iddisciplina and data_hora_visivel<='$data' order by id desc ");
                                    }
                                      foreach ($res_pendencia as $key => $value) {
                                        $idtrabalho=$value['id'];
                                        $titulo=$value['titulo'];
                                        $descricao=$value['descricao'];
                                        $data_entrega=$value['data_entrega'];
                                        //$data_visivel=$value['data_hora_visivel'];

                                        $data_visivel_simples=data_simples($value['data_hora_visivel']);
                                        $diasemana_bd= date('w', strtotime($data_visivel_simples));
                          
                                        if ( ($diasemana_get== $diasemana_bd )&& $idserie<3) {
                                       

                                            $res=$conexao->query("SELECT * FROM trabalho_entregue WHERE trabalho_id=$idtrabalho  and aluno_id = $idaluno limit 1");
                                            $cont=0;
                                            foreach ($res as $key => $value) {
                                              $cont++;
                                            }
                                            if ($cont==0) {
                                              echo"

                                                <div class='card-body'>
                                                <a href='trabalho_individual.php?idtrabalho=$idtrabalho&idturma=$idturma&iddisciplina=$iddisciplina&idescola=$idescola'>
                                                    <div class='callout callout-danger'>
                                                      <h5>$titulo </h5>
                                                      <p>$descricao</p>
                                                      <B>DATA DE ENTREGA: ".converte_data_hora($data_entrega)."</B>
                                                    </div>
                                                  </a>
                                                  </div>
                                                  ";
                                            }else{
                                              echo"<div class='card-body'>
                                              <a href='trabalho_individual.php?idtrabalho=$idtrabalho&idturma=$idturma&iddisciplina=$iddisciplina&idescola=$idescola'>
                                                  <div class='callout callout-success'>
                                                    <h5>$titulo</h5>
                                                    <p>$descricao</p>
                                                    <B>DATA DE ENTREGA: ".converte_data_hora($data_entrega)."</B>
                                                  </div>
                                                </a>
                                                </div>";
                                            }
                                        }else if ($idserie>2){


                                          $res=$conexao->query("SELECT * FROM trabalho_entregue WHERE trabalho_id=$idtrabalho  and aluno_id = $idaluno limit 1");
                                          $cont=0;
                                          foreach ($res as $key => $value) {
                                            $cont++;
                                          }
                                          if ($cont==0) {
                                            echo"
                                              <div class='card-body'>
                                              <a href='trabalho_individual.php?idtrabalho=$idtrabalho&idturma=$idturma&iddisciplina=$iddisciplina&idescola=$idescola'>
                                                  <div class='callout callout-danger'>
                                                    <h5>$titulo</h5>
                                                    <p>$descricao</p>
                                                    <B>DATA DE ENTREGA: ".converte_data_hora($data_entrega)."</B>
                                                  </div>
                                                </a>
                                                </div>
                                                ";
                                          }else{
                                            echo"<div class='card-body'>
                                            <a href='trabalho_individual.php?idtrabalho=$idtrabalho&idturma=$idturma&iddisciplina=$iddisciplina&idescola=$idescola'>
                                                <div class='callout callout-success'>
                                                  <h5>$titulo</h5>
                                                  <p>$descricao</p>
                                                  <B>DATA DE ENTREGA: ".converte_data_hora($data_entrega)."</B>
                                                </div>
                                              </a>
                                              </div>";
                                          }


                                        }
                                    

                                          

                                    }                                  

                                    ?>
                                    
                                  </div>
                                  <!-- /.card -->







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