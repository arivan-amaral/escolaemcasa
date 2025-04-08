<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador']) && !isset($_SESSION['idsecretario']) && !isset($_SESSION['idfuncionario'])) {

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
  include_once '../Controller/Conversao.php';
  include_once '../Model/Setor.php';
  include_once '../Model/Chamada.php';

  $idFuncionario=$_SESSION['idfuncionario'];
  $nome_gerente='';
  $nome_diretor='';
  $nome_escola='';

  $res_nome_funcionario = nome_funcionario($conexao,$idFuncionario);
  foreach ($res_nome_funcionario as $key => $value) {
    $nome_gerente=$value['nome'];
  }
  $id_chamada=$_REQUEST['id_chamada'];
  $setor_id=$_REQUEST['setor_id'];

  

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
  $id_setor = 0;
  $res_chamada = pesquisa_chamada($conexao,$id_chamada);
  foreach ($res_chamada as $key => $value) {
    $id_diretor = $value['funcionario_id'];
    $id_funci_respondeu = $value['func_respondeu_id'];
    $data_pre= new DateTime($value['data_previsao']);
    $data_previsao = $data_pre->format('d-m-Y');
    $id_setor = $value['setor_id'];
    $funcionario_id = $value['funcionario_id'];
    $status = $value['status'];
    $id_setor = $value['setor_id'];
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
                     }else if($data_retorno == '' && $data_previsao != '01-01-0001'){
                        echo " <h5><b>Gerente:</b>  $nome_gerente &emsp;&emsp;&emsp;&emsp; <b>Data de Retorno: 
                       </b> $data_previsao &emsp;<br><br>
                      </h5>"; 
                     }else if($data_retorno == '' && $data_previsao == '01-01-0001'){
                      echo " <h5><b>Gerente:</b> Sem Retorno &emsp;&emsp;&emsp;&emsp; <b>Data de Retorno: 
                       </b> Sem Retorno &emsp;<br><br>
                      </h5>"; 
                     } 


                      ?>   
                    <?php

                      $contador = 0;
                      $res_retorno =  buscar_pessoa_chat($conexao,$id_chamada,$idFuncionario);
                      foreach ($res_retorno as $key => $value) {
                      $mensagem = $value['mensagem'];
                      $data_teste= new DateTime($value['data']);
                      $data_mensagem = $data_teste->format('d-m-Y');
                      if($contador <1){
                        echo "<div class='col-md-12'><br>
                              <h6><b>Retorno:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                              <b>Data prevista para solução:</b>&emsp; $data_previsao </h6>
                              <textarea type='text' class='form-control' rows='7' disabled>$mensagem</textarea>
                              <br>
                              ";
                            echo"</div>";
                            $contador++;
                          }else{
                             echo "<div class='col-md-12'><br>
                              <h6><b>Retorno:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                              <b>Data prevista para solução:</b>&emsp; $data_mensagem </h6>
                              <textarea type='text' class='form-control' rows='7' disabled>$mensagem</textarea>
                              <br>
                              ";
                            echo"</div>";
                          }
                      
                            
                          }
                      if ($status == 'esperando_resposta') { if($idFuncionario != 2121){?>
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

                          <button type="submit" class="btn btn-block btn-primary" >Responder</button>
                        </div>
                      </form>


<?php 
if ($setor_id==14) {
  ?>
  <form action="../Controller/Transferir_chamado.php" method="GET">
  <input type="hidden" name="id_chamada_transferir" value="<?php echo $id_chamada; ?>">
          <div class="form-group">
                       <label for="exampleInputEmail1">Setor a transferir</label>
                       <select class="form-control"  id="setor_transferir" name="setor_transferir" onchange="javascript:mostraTipo(this);" required>
                        <!-- <option></option> -->
                        <?php 
                          $res_setores=todos_setores($conexao);
                          foreach ($res_setores as $key => $value) {
                            $setor_id = $value['id'];
                            $setor_nome = $value['nome'];
                            echo "<option value='$setor_id'>$setor_nome</option>";
                          }
                         ?>
                       </select> 
                      </div>
                      

                      <div class="form-group">
                       <label for="exampleInputEmail1" id="titulo_solicitacao">Tipo de Socilitação</label>
                       <select class="form-control"  id="tipo_solicitacao_transferir" name="tipo_solicitacao_transferir" required>
                        <?php 

                        
                        // $setor_id = $_REQUEST['setor_id'];
                        $res_tipos=buscar_tipo_solicitacao($conexao,1);
                        foreach ($res_tipos as $key => $value) {
                        $id = $value['id'];
                        $tipo_nome = $value['nome'];
                        echo "<option value='$id'>$tipo_nome</option>";
                        }
                        
                         ?>
                       </select> 
                      </div>



                       <!-- onclick="transferir_chamado();" -->
<button class="btn btn-block btn-warning"  >Transferir </button>
</form>
                        
<?php 
}
 ?>




                    <?php }else{ ?>
                       <div>
                      <h6><b>Mensagem:</b></h6>
                      <div id='mudar_mensagem'>
                         <textarea type='text' class='form-control' rows='3' name='mensagem' id='mensagem' required=''></textarea><br>
                      </div>
                     
                      <button type="button" class="btn btn-block btn-warning" onclick="questionar_chamada(<?php echo $id_chamada; ?>,<?php echo $id_funci_respondeu; ?>,<?php echo $id_setor; ?> );">
                      Questionar.
                      </button>
                    </div>



                    <?php 
if ($setor_id==14) {
  ?>
  <form action="../Controller/Transferir_chamado.php" method="GET">
  <input type="hidden" name="id_chamada_transferir" value="<?php echo $id_chamada; ?>">
          <div class="form-group">
                       <label for="exampleInputEmail1">Setor a transferir</label>
                       <select class="form-control"  id="setor_transferir" name="setor_transferir" onchange="javascript:mostraTipo(this);" required>
                        <!-- <option></option> -->
                        <?php 
                          $res_setores=todos_setores($conexao);
                          foreach ($res_setores as $key => $value) {
                            $setor_id = $value['id'];
                            $setor_nome = $value['nome'];
                            echo "<option value='$setor_id'>$setor_nome</option>";
                          }
                         ?>
                       </select> 
                      </div>
                      

                      <div class="form-group">
                       <label for="exampleInputEmail1" id="titulo_solicitacao">Tipo de Socilitação</label>
                       <select class="form-control"  id="tipo_solicitacao_transferir" name="tipo_solicitacao_transferir" required>
                        <?php 

                        
                        $setor_id = $_REQUEST['setor_id'];
                        $res_tipos=buscar_tipo_solicitacao($conexao,$setor_id);
                        foreach ($res_tipos as $key => $value) {
                        $id = $value['id'];
                        $tipo_nome = $value['nome'];
                        echo "<option value='$id'>$tipo_nome</option>";
                        }
                        
                         ?>
                       </select> 
                      </div>



                       <!-- onclick="transferir_chamado();" -->
<button class="btn btn-block btn-warning"  >Transferir </button>
</form>
                        
<?php 
}
 ?>
                  <?php }}elseif ($status == 'atrasado') { if($idFuncionario != 2121){?>

                   <div id="resp">
                      <button type="button" class="btn btn-block btn-primary" onclick="abrir_resposta();">
                      Responder
                      </button>
                    </div>
                    

                                        <?php 
                    if ($setor_id==14) {
                      ?>
                      <form action="../Controller/Transferir_chamado.php" method="GET">
                      <input type="hidden" name="id_chamada_transferir" value="<?php echo $id_chamada; ?>">
                              <div class="form-group">
                                           <label for="exampleInputEmail1">Setor a transferir</label>
                                           <select class="form-control"  id="setor_transferir" name="setor_transferir" onchange="javascript:mostraTipo(this);" required>
                                            <!-- <option></option> -->
                                            <?php 
                                              $res_setores=todos_setores($conexao);
                                              foreach ($res_setores as $key => $value) {
                                                $setor_id = $value['id'];
                                                $setor_nome = $value['nome'];
                                                echo "<option value='$setor_id'>$setor_nome</option>";
                                              }
                                             ?>
                                           </select> 
                                          </div>
                                          

                                          <div class="form-group">
                                           <label for="exampleInputEmail1" id="titulo_solicitacao">Tipo de Socilitação</label>
                                           <select class="form-control"  id="tipo_solicitacao_transferir" name="tipo_solicitacao_transferir" required>
                                            <?php 

                                            
                                            $setor_id = $_REQUEST['setor_id'];
                                            $res_tipos=buscar_tipo_solicitacao($conexao,$setor_id);
                                            foreach ($res_tipos as $key => $value) {
                                            $id = $value['id'];
                                            $tipo_nome = $value['nome'];
                                            echo "<option value='$id'>$tipo_nome</option>";
                                            }
                                            
                                             ?>
                                           </select> 
                                          </div>



                                           <!-- onclick="transferir_chamado();" -->
                    <button class="btn btn-block btn-warning"  >Transferir </button>
                    </form>
                                            
                    <?php 
                    }
                     ?>
                    <?php }else{ ?>
                       
                     <div>
                      <h6><b>Mensagem:</b></h6>
                     <div id='mudar_mensagem'>
                         <textarea type='text' class='form-control' rows='3' name='mensagem' id='mensagem' required=''></textarea><br>
                      </div>
                      <button type="button" class="btn btn-block btn-warning" onclick="questionar_chamada(<?php echo $id_chamada; ?>,<?php echo $id_funci_respondeu; ?>,<?php echo $id_setor; ?> );">
                      Questionar
                      </button>
                    </div>

                    <?php }} ?>
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

                          if($idFuncionario !=  2121){
                            if ($status == 'atrasado') {
                               echo"
                              <button class='btn btn btn-danger' style='width:30%;' data-toggle='modal' data-target='#abrirModal'>
                                Andamento
                              </button>";
                             }else{
                                if ($status != 'finalizado' ) {
                               echo"
                              <button class='btn btn btn-danger' style='width:30%;'  disabled>
                                Andamento
                              </button>";
                              }
                              
                             } 
                              if ($status != 'finalizado' && $idFuncionario == $id_diretor ) {
                                echo"&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                              <button class='btn btn btn-info' style='width: 30%;' onclick='finalizar_chat($id_chamada);'>
                                Finalizar
                              </button><br><br>"; 
                              }
                          }else{
                              echo"
                                <h6><b>Mensagem:</b></h6>
                                <div id='mudar_mensagem'>
                               <textarea type='text' class='form-control' rows='3' name='mensagem' id='mensagem' required=''></textarea><br>
                            </div>
                            
                              <button class='btn btn-block btn-warning'onclick='questionar_chamada($id_chamada,$id_funci_respondeu,$id_setor);' >
                               Questionar
                              </button>";
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
                      $contador_teste = 0;
                      $res_retorno =  buscar_pessoa_chat($conexao,$id_chamada,$id_funci_respondeu);
                      foreach ($res_retorno as $key => $value) {
                      $mensagem = $value['mensagem'];

                    
                      $data_teste= new DateTime($value['data']);
                      $data_anterior = $data_teste->format('d-m-Y');
                      if($contador_teste <1){
                            echo "<div class='col-md-12'>
                              <h6><b>Retorno:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;   <b>Data prevista para solução:</b> $data_anterior </h6>
                              <textarea type='text'  class='form-control' rows='7'  disabled>$mensagem</textarea>
                              <br>
                              ";
                            echo"</div>";
                            $contador_teste++;
                          }else{
                            echo "<div class='col-md-12'>
                              <h6><b>Retorno:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;   <b>Data prevista para solução:</b> $data_previsao </h6>
                              <textarea type='text'  class='form-control' rows='7'  disabled>$mensagem</textarea>
                              <br>
                              ";
                            echo"</div>";
                             
                          }
                      
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
 function abrir_resposta(){

   var result = document.getElementById('resp');
    result.innerHTML = 
    "<form class='mt-12' action='../Controller/Cadastrar_chat_chamado.php' method='post' enctype='multipart/form-data'>"+
      "<h6 ><b>Retorno:</b> &emsp;&emsp;"+
      "Data prevista para solução:"+
      "<input type='datetime-local' name='data_previsao' id='data_previsao' class='form-control' required=''>"+
      "</h6>"+
      "<input type='hidden' name='id_funcionario' id='id_funcionario' value='<?php echo $idFuncionario ?>'>"+
      "<input type='hidden' name='id_chamado' id='id_chamado' value='<?php echo $id_chamada ?>'>"+
      "<textarea type='text' class='form-control' rows='6' name='resposta' id='resposta' required=''></textarea><br>"+
      "<div onclick='carregando();'>"+
      "<button type='submit' class='btn btn-block btn-primary'>Responder.</button>"+
      "</div>"+
    "</form>";
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

    include_once 'rodape.php';

 ?>