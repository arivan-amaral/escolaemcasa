<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idprofessor'];

}
include "cabecalho.php";
include "alertas.php";

  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';
  include '../Model/Setor.php';
  include '../Model/Chamada.php';

  $idFuncionario=$_SESSION['idfuncionario'];
  $nome_gerente='';
  $nome_diretor='';
  $nome_escola='';
  $res_nome_funcionario = nome_funcionario($conexao,$idFuncionario);
  foreach ($res_nome_funcionario as $key => $value) {
    $nome_gerente=$value['nome'];
  }
  $id_chamada=$_POST['id_chamada'];
  $status = '';
  $setor = '';
  $data_previsao='';
  $data_retorno='';
  $data_solicitado='';
  $validar = 0;
  $validar_func = 0;
  $id_diretor = 0;
  $id_funci_respondeu = 0;
  $res_validar_funcionario = validar_funcionario($conexao,$id_chamada,$idFuncionario);
  foreach ($res_validar_funcionario as $key => $value) {
    $validar_func = $value['id'];
  }
  $res_chamada = pesquisa_chamada($conexao,$id_chamada);
  foreach ($res_chamada as $key => $value) {
    $id_diretor = $value['funcionario_id'];
    $id_funci_respondeu = $value['func_respondeu_id'];
    $data_previsao= $value['data_previsao'];
    $data_retorno= $value['data_retorno'];
    $id_setor = $value['setor_id'];
    $funcionario_id = $value['funcionario_id'];

    $res_nome_diretor = nome_funcionario($conexao,$funcionario_id);
      foreach ($res_nome_diretor as $key => $value) {
        $nome_diretor= $value['nome'];
      }
    $res_nome_escola = escola_funcionario($conexao,$funcionario_id);
      foreach ($res_nome_escola as $key => $value) {
        $id_escola = $value['escola_id'];
        $res_buscar_escola = buscar_escola($conexao,$id_escola);
        foreach ($res_buscar_escola as $key => $value) {
          $nome_escola= $value['nome_escola'];
        }
      }
    $res_nome_setor =  buscar_setor_id($conexao,$id_setor);
      foreach ($res_nome_setor as $key => $value) {
        $setor = $value['nome'];
      }
  }
  $res_validar = validar_chamada($conexao,$idFuncionario,$id_chamada);
  foreach ($res_validar as $key => $value) {
    $validar = $value['chamados'];
  }
?>
 
 

<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-12 alert alert-Primary">

            <h1 class="m-0"><b>
              <center>
                 <?php
              echo $setor;
              ?> - Protocolo: <?php echo $id_chamada; ?></b>
              </center>
           </h1>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->



            </section>



            <!-- Main content -->

            <section class="content">
              <div class="container-fluid">
                <?php if ($validar_func > 0) { ?>
                <div class="row">
                  <div class="col-md-6">
                    <form class="mt-12" action="../Controller/Cadastrar_chat_chamado.php" method="post" enctype="multipart/form-data">
                        <h5>Gerente: <?php echo $nome_gerente; ?> <br>
                       Data: <?php echo $data_retorno; ?></h5>
                        <br>
                        <h6 >Retorno &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Previsão de Solução:  <?php echo $data_previsao; ?></h6>
                        <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo $idFuncionario ?>">
                        <input type="hidden" name="id_chamado" id="id_chamado" value="<?php echo $id_chamada ?>">
                        <textarea type='text' class='form-control' rows='10' name="resposta" id="resposta" required=""></textarea>
                    <h4 class="card-title">Anexo</h4>
                    <div class="form-group" >
                        <input type="file" name="arquivo" class="form-control" >
                    </div>
                    <h4 class="card-title">Data de Previsão do Retorno</h4>
                        <div class="form-group">
                            <input type="datetime-local" name="data_previsao" id="data_previsao" class="form-control" required="">
                        </div>
                      <div onclick='carregando();'>
                        <button type="submit" class="btn btn-block btn-primary">Responder</button>
                      </div>
                    </form>
                    <?php  
                      $res_retorno =  buscar_pessoa_chat($conexao,$id_chamada,$idFuncionario);
                      foreach ($res_retorno as $key => $value) {
                      $mensagem = $value['mensagem'];
                      $arquivo = $value['arquivo'];
                      $data_anterior = $value['data'];

                      echo "<div class='col-md-12'><br>
                              <h6 >Retorno &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data &nbsp;&nbsp;:$data_anterior </h6>
                              <textarea type='text' class='form-control' rows='10'  disabled>$mensagem</textarea>
                              <br>
                              ";
                              if ($arquivo != "") {
                                echo"<h4 class='card-title'>Anexo</h4>
                              <br><a class='btn btn-block btn-success' href='chamadas/$arquivo' download>Arquivo</a> ";
                              }
                            echo"</div>";
                          }
                    ?>
                  </div>
                  <div class="col-md-6">
                    <?php  
                      $res_chamada = pesquisa_chat($conexao,$id_chamada);
                      foreach ($res_chamada as $key => $value) {
                        $descricao = $value['mensagem'];
                        $arquivo = $value['arquivo'];
                        $data_solicitado = $value['data'];

                    echo "
                      <h5>Escola: $nome_escola <br>
                       Diretor(a): $nome_diretor</h5><br>

                        <h6>Solicitação &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data:$data_solicitado </h6>
                        <textarea type='text' class='form-control' rows='6'disabled >$descricao</textarea>
                      " ;
                      if($arquivo != ""){
                        echo "<h6>Anexo:</h6>
                      <a class='btn btn-block btn-success' href='chamadas/$arquivo' download>Arquivo</a>                      
                    ";
                      }
                    }

                      $res_solicitacao = buscar_pessoa_chat($conexao,$id_chamada,$id_diretor);
                      foreach ($res_solicitacao as $key => $value) {
                      $mensagem = $value['mensagem'];
                      $arquivo = $value['arquivo'];
                      $data_anterior = $value['data'];
                        echo "<div class='col-md-12'>
                              <br>
                              <h6 >Andamento xx&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data de Emissão:$data_anterior </h6>
                              <textarea type='text' class='form-control' rows='10' disabled>$mensagem</textarea><br>
                              ";
                              if ($arquivo != "") {
                                echo"<h4 class='card-title'>Anexo</h4>
                              <br><a class='btn btn-block btn-success' href='chamadas/$arquivo' download>Arquivo</a> ";
                              }
                            echo"</div>";

                        echo"</div>";
                      }
                    ?>

                  </div>
                </div>
                <?php }elseif ( $validar_func == 0) {?>
                <div class="row">
                  <div class="col-md-6">
                     <?php  
                      $res_chamada = pesquisa_chat($conexao,$id_chamada);
                      foreach ($res_chamada as $key => $value) {
                        $data_solicitado = $value['data'];
                    } ?>
                    <form class='mt-12' action='../Controller/Cadastrar_chat_chamado.php' method='post' enctype='multipart/form-data'>
                    <h5 ><b>Escola:</b> <?php echo $nome_escola; ?>
                     <b>Diretor(a):</b> <?php echo $nome_diretor; ?></h5>

                      <!--h6>Solicitação: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data:&nbsp; <!?php echo $data_solicitado; ?>
                      </h6>

                      <input type='hidden' name='id_funcionario' id='id_funcionario' value='$idFuncionario'>
                      <input type='hidden' name='id_chamado' id='id_chamado' value='$id_chamada'>
                       <textarea type='text' class='form-control' rows='10' name='resposta' id='resposta' required=''></textarea><br-->

                        <!--h4 class='card-title'>Anexo</h4>
                        <div class='form-group' >
                            <input type='file' name='arquivo' class='form-control' >
                        </div>
                        <br> 
                        <div class='form-group'>
                        <button class='btn btn btn-danger' style='width: 30%;'>Andamento</button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <button class='btn btn btn-info' style='width: 30%;' onclick='finalizar_chat($id_chamada);'>Finalizar</button>
                        </div-->
                      </form>
                   
                    <?php 
                       $res_chat_inicial =  buscar_chat_inical($conexao,$id_chamada,$id_diretor);
                      foreach ($res_chat_inicial as $key => $value) {
                        $mensagem1 = $value['mensagem'];
                        $arquivo1 = $value['arquivo'];
                        $data_anterior1 = $value['data'];
                        echo "<div class='col-md-12'><br>
                              <h6><b>Solicitação Inicial:</b>  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data:&nbsp;$data_anterior1</h6>
                              <textarea type='text' class='form-control' rows='7' disabled>$mensagem1</textarea>
                              <br>
                              ";
                              if ($arquivo1 != "") {
                                echo"<h4 class='card-title'>Anexo</h4>
                              <br><a class='btn btn-block btn-success' href='chamadas/$arquivo1' download>Arquivo</a> ";
                              }
                            echo"</div>


                            

                            <div class='form-group'>
                                <button class='btn btn btn-danger' style='width:30%;'>
                                  Andamento
                                </button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                <button class='btn btn btn-info' style='width: 30%;' onclick='finalizar_chat($id_chamada);'>
                                  Finalizar
                                </button><br><br>

                                <h4 class='card-title'>Anexo</h4>

                                <div class='form-group' >
                                    <input type='file' name='arquivo' class='form-control' >
                                </div>

                              
                        </div>
                            ";

                        
                      }
                      $res_solicitacao = buscar_pessoa_chat($conexao,$id_chamada,$id_diretor);
                      foreach ($res_solicitacao as $key => $value) {
                      $mensagem = $value['mensagem'];
                      $arquivo = $value['arquivo'];
                      $data_anterior = $value['data'];
                        echo "<div class='col-md-12'>
                              <h6 >Andamento &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data de Emissão:$data_anterior </h6>
                              <textarea type='text' class='form-control' rows='10'  disabled>$mensagem</textarea>
                              <br>
                              ";
                              if ($arquivo != "") {
                                echo"<h4 class='card-title'>Anexo</h4>
                              <br><a class='btn btn-block btn-success' href='chamadas/$arquivo' download>Arquivo</a> ";
                              }
                            echo"</div>";

                        echo"</div>";
                      }
                    ?>
                  </div>
                  <div class="col-md-6">
                        <?php 
                          $nome_ge = ''; 
                          $res_nome_funcionario = nome_funcionario($conexao,$id_funci_respondeu);
                          foreach ($res_nome_funcionario as $key => $value) {
                            $nome_ge =$value['nome'];
                          }

                        ?>
                        <h5><b>Gerente:</b> <?php echo $nome_ge; ?>
                        <!--?php echo $data_retorno; ?--></h5><br>
                    <?php  
                      $res_retorno =  buscar_pessoa_chat($conexao,$id_chamada,$id_funci_respondeu);
                      foreach ($res_retorno as $key => $value) {
                      $mensagem = $value['mensagem'];
                      $arquivo = $value['arquivo'];
                      $data_anterior = $value['data'];

                      echo "<div class='col-md-12'><br>
                              <h6><b>Retorno:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Previsão da Solução: $data_anterior</h6>
                              <textarea type='text' class='form-control' rows='7'  disabled>$mensagem</textarea>
                              <br>
                              ";
                              if ($arquivo != "") {
                                echo"<h4 class='card-title'>Anexo</h4>
                              <br><a class='btn btn-block btn-success' href='chamadas/$arquivo' download>Arquivo</a> ";
                              }
                            echo"</div>";
                          }
                    ?>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>



                <div class="row">
                  <div class="col-md-12">

                    <!-- The time line -->


                    <div class="timeline">
<br>
<br>
<br>

<script type="text/javascript">

 function carregando(){


    var descricao =  document.getElementById("resposta").value;
        let timerInterval
        Swal.fire({
          title: 'Aguarde, ação está sendo realizada...',
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

                      <div>
                        <i class='fas fa-clock bg-gray'></i>
                      </div>
                    </div>

                      













               



            <!-- /.content -->

          </div>        

      </div>

    </div>

  </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>


 <?php 

    include 'rodape.php';

 ?>