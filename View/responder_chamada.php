<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador']) && !isset($_SESSION['idsecretario']) && !isset($_SESSION['idfuncionario'])) {

       header("location:index.php?status=0");

}else{

  $idprofessor=$_SESSION['idfuncionario'];

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
  $validar_func = false;
  $id_diretor = 0;
  $arquivo_presente = 0;
  $id_funci_respondeu = 0;
  $status = '';

  $res_chamada = pesquisa_chamada($conexao,$id_chamada);
  foreach ($res_chamada as $key => $value) {
    $id_diretor = $value['funcionario_id'];
    $id_funci_respondeu = $value['func_respondeu_id'];
    $data_pre= new DateTime($value['data_previsao']);
    $data_previsao = $data_pre->format('d-m-Y');
    $id_setor = $value['setor_id'];
    $funcionario_id = $value['funcionario_id'];
    $status = $value['status'];
    $res_data_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_funci_respondeu);
    foreach ($res_data_retorno as $key => $value) {
      $data_retorno= $value['data'];
    }
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

  if($id_funci_respondeu == $_SESSION['idfuncionario']){
    $validar_func = true;
  }else{
    if($id_funci_respondeu == 0){
       $validar_func = true;
    }else{
      $validar_func = false;

    } 
  }
  $res_verificar = verificar_arquivos($conexao,$id_chamada);
  foreach ($res_verificar as $key => $value) {
    $arquivo_presente = $value['id'];
  }
  $res_arquivos= buscar_arquivos($conexao,$id_chamada);
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
                  echo $setor;?> -
                  Protocolo: <?php echo $id_chamada; ?></b>
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
                <?php if ($validar_func == true) { ?>
                <div class="row">
                  <div class="col-md-6">
                    <?php if ($data_retorno != '') {
                     echo " <h5><b>Gerente:</b> $nome_gerente &emsp;&emsp;&emsp;&emsp; <b>Data de Retorno: 
                       </b> $data_retorno &emsp;<br><br>
                      </h5>"; 
                     }else if($data_retorno == '' && $data_previsao != ''){
                        echo " <h5><b>Gerente:</b> $nome_gerente &emsp;&emsp;&emsp;&emsp; <b>Data de Retorno: 
                       </b> $data_previsao &emsp;<br><br>
                      </h5>"; 
                     }else if($data_retorno == '' && $data_previsao == ''){
                      echo " <h5><b>Gerente:</b> $nome_gerente &emsp;&emsp;&emsp;&emsp; <b>Data de Retorno: 
                       </b> Sem Retorno &emsp;<br><br>
                      </h5>"; 
                     } 


                      ?>   
                    <?php


                      $res_retorno =  buscar_pessoa_chat($conexao,$id_chamada,$idFuncionario);
                      foreach ($res_retorno as $key => $value) {
                      $mensagem = $value['mensagem'];
                      

                      echo "<div class='col-md-12'><br>
                              <h6><b>Retorno:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                              <b>Data prevista para solução:</b>&emsp; $data_previsao </h6>
                              <textarea type='text' class='form-control' rows='7' disabled>$mensagem</textarea>
                              <br>
                              ";
                            echo"</div>";
                          }
                      if ($status == 'esperando_resposta') { ?>
                      <br>
                      <form class="mt-12" action="../Controller/Cadastrar_chat_chamado.php" method="post" enctype="multipart/form-data">
                         
                          <h6 ><b>Retorno:</b> &emsp;&emsp;

                            Data prevista para solução:
                            
                            <input type="datetime-local" name="data_previsao" id="data_previsao" class="form-control" required="">
                          </h6>
                              
                          
            

                          
                          <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo $idFuncionario ?>">
                          <input type="hidden" name="id_chamado" id="id_chamado" value="<?php echo $id_chamada ?>">

                          

                          <textarea type='text' class='form-control' rows='6' name="resposta" id="resposta" required=""></textarea><br>

                          

                        <div onclick='carregando();'>

                          <button type="submit" class="btn btn-block btn-primary" onclick='responder_chat(<?php echo $id_chamada ?>);'>Responder</button>
                        </div>
                      </form>
                  <?php }elseif ($status == 'atrasado') {?>
                    <div id="resp">

                      <button type="button" class="btn btn-block btn-primary" onclick="abrir_resposta(<?php echo $id_chamada; ?> , <?php echo $idFuncionario; ?>);">
                      Responder
                      </button>
                    </div>
                    

                    <?php } ?>
                  </div>
                  <div class="col-md-6">
                    <?php  
                      $res_chamada = pesquisa_chat($conexao,$id_chamada);
                      foreach ($res_chamada as $key => $value) {
                        $descricao = $value['mensagem'];

                        $data_solicitado = $value['data'];
                    if ($arquivo_presente > 0) {
                       echo "
                    <div class='row'>
                      <div class='col-md-11'>
                      <h5>Escola: $nome_escola <br>
                       Diretor(a): $nome_diretor</h5><br>
                      </div>
                      <div class='col-md-1'>
                      <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#abrirModal2'>
                        <i class='fas fa-image'></i>
                      </button>
                      </div>
                       

                    </div>
                    


                        <h6><b>Solicitação:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <b>Data Emissão:</b> &nbsp;&nbsp;$data_solicitado </h6>
                        <textarea type='text' class='form-control'  rows='7'disabled >$descricao</textarea>
                      " ;
                    }else{
                       echo "
                    <div class='row'>
                       <h5><b>Escola:</b> $nome_escola <br>
                       <b>Diretor(a):</b> $nome_diretor</h5><br>
                    </div>
                      <br>


                        <h6><b>Solicitação:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <b>Data:</b>&nbsp;&nbsp; $data_solicitado  </h6>
                        <textarea type='text' class='form-control'  rows='7' disabled >$descricao</textarea>
                      " ;
                    }
                   

                    }

                      $res_solicitacao = buscar_pessoa_chat($conexao,$id_chamada,$id_diretor);
                      foreach ($res_solicitacao as $key => $value) {
                      $mensagem = $value['mensagem'];

                      $data_anterior = $value['data'];
                        echo "<div class='col-md-12'><br><br>
                              <h6 ><b>Andamento:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <b>Data de Emissão:</b> &nbsp;&nbsp; $data_anterior </h6>
                              <textarea type='text'  class='form-control' rows='7' disabled>$mensagem</textarea><br>
                              ";
                            echo"</div>";

                        echo"</div>";
                      }
                    ?>

                  </div>
                </div>
                <?php }elseif ($validar_func == false) { ?>
                <div class="row">
                  <div class="col-md-6">
                     <?php  
                      $res_chamada = pesquisa_chat($conexao,$id_chamada);
                      foreach ($res_chamada as $key => $value) {
                        $data_solicitado = $value['data'];
                    } 
                      if ($arquivo_presente > 0){
                        echo "<div class='row'>
                        <div class='col-md-11'>
                        <h5><b>Escola:</b> $nome_escola <br>
                         <b>Diretor(a):</b> $nome_diretor</h5><br>
                        </div>
                        <div class='col-sm-1' style='left: -90px;'>
                        <button type='button' class='btn btn-primary' data-toggle='modal' 
                        data-target='#abrirModal2'>
                          <i class='fas fa-image'></i>
                        </button>
                        </div>
                      </div>";
                      }else{
                        echo "<div class='row'>
                        <h5><b>Escola:</b> $nome_escola <br>
                         <b>Diretor(a):</b> $nome_diretor</h5><br>
                      </div>
                      <br>";
                      }

                    ?>
                   
                    <?php 
                       $res_chat_inicial =  buscar_chat_inical($conexao,$id_chamada,$id_diretor);
                      foreach ($res_chat_inicial as $key => $value) {
                        $mensagem1 = $value['mensagem'];

                        $data_anterior1 = $value['data'];

                        echo "<div class='col-md-12'>
                              <h6><b>Solicitação Inicial:</b>  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data:&nbsp;$data_anterior1</h6>
                              <textarea type='text'  class='form-control' rows='7' disabled>$mensagem1</textarea>
                              <br>
                              ";
                            echo"</div>";
                      }
                      $res_solicitacao = buscar_pessoa_chat($conexao,$id_chamada,$id_diretor);
                      foreach ($res_solicitacao as $key => $value) {
                      $mensagem = $value['mensagem'];
  
                      $data_anterior = $value['data'];
                        echo "<div class='col-md-12'>
                              <h6 ><b>Andamento:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Data de Emissão:$data_anterior </h6>
                              <textarea type='text' class='form-control' rows='7'  disabled>$mensagem</textarea>
                              <br>
                              ";

                        echo"</div>";
                      }
                      echo"
                        <div class='form-group'>";

                          if ($status == 'atrasado') {
                             echo"
                            <button class='btn btn btn-danger' style='width:30%;' data-toggle='modal' data-target='#abrirModal'>
                              Andamento
                            </button>";
                           }else{
                              if ($status != 'finalizado') {
                             echo"
                            <button class='btn btn btn-danger' style='width:30%;'  disabled>
                              Andamento
                            </button>";
                            }
                            
                           } 
                            if ($status != 'finalizado') {
                              echo"&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <button class='btn btn btn-info' style='width: 30%;' onclick='finalizar_chat($id_chamada);'>
                              Finalizar
                            </button><br><br>"; 
                            }
                                                    
                        echo"</div>";
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
                        <h5><b>Gerente:</b> <?php echo $nome_ge; ?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <b>Data de Retorno:</b> &emsp;<?php echo $data_retorno; ?></h5><br><br>
                    <?php  
                      $res_retorno =  buscar_pessoa_chat($conexao,$id_chamada,$id_funci_respondeu);
                      foreach ($res_retorno as $key => $value) {
                      $mensagem = $value['mensagem'];

                      $data_anterior = $value['data'];

                      echo "<div class='col-md-12'>
                              <h6><b>Retorno:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;   <b>Data prevista para solução:</b> $data_previsao</h6>
                              <textarea type='text'  class='form-control' rows='7'  disabled>$mensagem</textarea>
                              <br>
                              ";
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
    var data= document.getElementById('data_previsao').value;
    if(descricao == "" || data == ""){

    }else{
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
  
  <div class="modal fade" id="abrirModal2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Arquivos Anexados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
            <?php  
            foreach ($res_arquivos as $key => $value) {
              $arquivo = $value['arquivo'];
              if (mb_strpos($arquivo, '.pdf') !== false) {
                 echo "  <div class='card bg-light mb-3' style='max-width: 30rem;'>
                        <a href='chamados/$arquivo' class='btn btn btn-success' download>Baixar Arquivo:  $arquivo</a>
                      </div>";
              }else if (mb_strpos($arquivo, '.docx') !== false) {
                 echo "  <div class='card bg-light mb-3' style='max-width: 30rem;'>
                        <a href='chamados/$arquivo' class='btn btn-block btn-success' download>Baixar Arquivo:  $arquivo</a>
                      </div>";
              }else if (mb_strpos($arquivo, '.doc') !== false) {
                 echo "  <div class='card bg-light mb-3' style='max-width: 30rem;'>
                        <a href='chamados/$arquivo' class='btn btn btn-success' download>Baixar Arquivo:  $arquivo</a>
                      </div>";
              }else if (mb_strpos($arquivo, '.txt') !== false) {
                 echo "  <div class='card bg-light mb-3' style='max-width: 30rem;'>
                        <a href='chamados/$arquivo' class='btn btnbtn-success' download>Baixar Arquivo:  $arquivo</a>
                      </div>";
              }else if (mb_strpos($arquivo, '.odt') !== false) {
                 echo "  <div class='card bg-light mb-3' style='max-width: 30rem;'>
                        <a href='chamados/$arquivo' class='btn btn btn-success' download>Baixar Arquivo:  $arquivo</a>
                      </div>";
              }else{
                 echo "  <div class='card bg-light mb-3' style='max-width: 30rem;'>
                        <img src='chamados/$arquivo'>
                      </div>";
              }
             
            }

            ?>
        
              <!-- /corpo -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
 <?php 

    include 'rodape.php';

 ?>