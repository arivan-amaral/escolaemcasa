<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

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
include_once '../Model/Setor.php';
include_once '../Model/Chamada.php';

 $setor_id= $_GET['setor'];

 $escola_id= $_GET['escola'];
 $nome_setor = "";
 $quant_total = 0;
 $quant_finalizada = 0;
 $res_quantidade_resolvida = quantidade_chamada_finalizadas($conexao,$setor_id);
 foreach ($res_quantidade_resolvida as $key => $value) {
   $quant_finalizada = $value['chamada'];
 }
 $res_quantidade_total =  quantidade_chamada_total($conexao,$setor_id);
 foreach ($res_quantidade_total as $key => $value) {
   $quant_total = $value['chamada'];
 }
 $res_nome_setor = buscar_setor_id($conexao,$setor_id);
 foreach ($res_nome_setor as $key => $value) {
   $nome_setor = $value['nome'];
 }
?>

 

<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" >

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <!-- update by Rivaldo / alert-danger  -->
        <div class="col-sm-12 alert alert-primary"> 
          <center>
            <h1 class="m-0"><b>
        <?php  echo"$nome_setor - $quant_total Chamados "; ?>
         </b></h1>
        </center>

      </div><!-- /.col -->

      

    </div><!-- /.row -->

  </div><!-- /.container-fluid -->
</div>

<!-- /.content-header -->




<!-- Main content -->

<section class="content">

<div class="container-fluid">

      <?php 
echo "
    <div class='row g-2'>
        <div class='col-md-2 col-sm-6'>
            <a class='btn btn-primary w-100' onclick=listar_chamados('$setor_id','esperando_resposta') >
                $quantidade_pendente &nbsp;&nbsp; Novos Chamados
            </a>
        </div>
        <div class='col-md-2 col-sm-6'>
            <a  class='btn btn-warning w-100' onclick=listar_chamados('$setor_id','em_andamento')>
                $quantidade_andamento &nbsp;&nbsp; Em Andamento
            </a>
        </div>
        <div class='col-md-2 col-sm-6'>
            <a class='btn btn-danger w-100' onclick=listar_chamados('$setor_id','atrasado')>
                $quantidade_atraso &nbsp;&nbsp; Atrasados
            </a>
        </div>
        <div class='col-md-2 col-sm-6'>
            <a  class='btn btn-success w-100' onclick=listar_chamados('$setor_id','finalizado')>
                $quantidade_resolvidos &nbsp;&nbsp; Chamados Resolvidos
            </a>
        </div>
        <div class='col-md-2 col-sm-6' onclick=listar_chamados('$setor_id','todos')>
            <a  class='btn btn-light w-100' >
                Ver todos
            </a>
        </div>
    </div>
";



       ?>
<div class='card-body'>
  <table class='table table-bordered'>
    <thead>
       <tr>
         <th style="text-align: center;">Status</th>
         <th>Informações</th>
         <th>Opção</th>

       </tr>
     </thead>
     <tbody id="tabela_chamados">
      
        <?php 
          if ($escola_id != null) {
            $res_chamada = buscar_chamada_atraso2_escola($conexao,$setor_id,$escola_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario = '';
              $nome_funcionario_retorno = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }
              echo "
              <tr>";
              if ($status == 'esperando_resposta') {
                echo "<td style='background-color:#2E64FE;  
                text-align: center;color: white;'>
                Novo <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'em_andamento') {
                echo "<td style=' background-color:#F1C40F; 
                text-align: center;'>
                Andamento<br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'finalizado') {
                echo "<td style=' background-color:#82FA58;
                text-align: center;color: white'>
                Resolvido <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'atrasado') {
                echo "<td style=' background-color:#FE2E2E; 
                text-align: center;color: white'>
                Atrasado <br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b> $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                 
                   if($status == 'esperando_resposta'){

                  //echo " Status: <font color='danger'>Esperando Resposta</font> ";
                }else if($status == 'em_andamento'){
                  // echo "Data de Retorno: ";
                }else if($status == 'finalizado'){
                  echo "Data de Retorno: <br>
                  Status: <font color='green'>Finalizado</font> ";
                }
                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario <br> ";
                  }
                 
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                      # code...
                    }
                  }
                              
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 

            $res_chamada = buscar_chamada_novas_escola($conexao,$setor_id,$escola_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario = '';
              $nome_funcionario_retorno = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }
              echo "
              <tr>";
              if ($status == 'esperando_resposta') {
                echo "<td style='background-color:#2E64FE;  
                text-align: center;color: white;'>
                Novo <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'em_andamento') {
                echo "<td style=' background-color:#F1C40F; 
                text-align: center;'>
                Andamento<br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'finalizado') {
                echo "<td style=' background-color:#82FA58;
                text-align: center;color: white'>
                Resolvido <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'atrasado') {
                echo "<td style=' background-color:#FE2E2E; 
                text-align: center;color: white'>
                Atrasado <br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b> $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                 
                   if($status == 'esperando_resposta'){

                  //echo " Status: <font color='danger'>Esperando Resposta</font> ";
                }else if($status == 'em_andamento'){
                  // echo "Data de Retorno: ";
                }else if($status == 'finalizado'){
                  echo "Data de Retorno: <br>
                  Status: <font color='green'>Finalizado</font> ";
                }
                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario <br> ";
                  }
                 
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                      # code...
                    }
                  }
                              
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 

            $res_chamada = buscar_chamada_andamento_escola($conexao,$setor_id,$escola_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario = '';
              $nome_funcionario_retorno = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }
              echo "
              <tr>";
              if ($status == 'esperando_resposta') {
                echo "<td style='background-color:#2E64FE;  
                text-align: center;color: white;'>
                Novo <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'em_andamento') {
                echo "<td style=' background-color:#F1C40F; 
                text-align: center;'>
                Andamento<br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'finalizado') {
                echo "<td style=' background-color:#82FA58;
                text-align: center;color: white'>
                Resolvido <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'atrasado') {
                echo "<td style=' background-color:#FE2E2E; 
                text-align: center;color: white'>
                Atrasado <br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b> $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                 
                   if($status == 'esperando_resposta'){

                  //echo " Status: <font color='danger'>Esperando Resposta</font> ";
                }else if($status == 'em_andamento'){
                  // echo "Data de Retorno: ";
                }else if($status == 'finalizado'){
                  echo "Data de Retorno: <br>
                  Status: <font color='green'>Finalizado</font> ";
                }
                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario <br> ";
                  }
                 
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                      # code...
                    }
                  }
                              
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 

            $res_chamada = buscar_chamada_finalizado_escola($conexao,$setor_id,$escola_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario = '';
              $nome_funcionario_retorno = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }
              echo "
              <tr>";
              if ($status == 'esperando_resposta') {
                echo "<td style='background-color:#2E64FE;  
                text-align: center;color: white;'>
                Novo <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'em_andamento') {
                echo "<td style=' background-color:#F1C40F; 
                text-align: center;'>
                Andamento<br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'finalizado') {
                echo "<td style=' background-color:#82FA58;
                text-align: center;color: white'>
                Resolvido <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'atrasado') {
                echo "<td style=' background-color:#FE2E2E; 
                text-align: center;color: white'>
                Atrasado <br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b> $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                 
                   if($status == 'esperando_resposta'){

                  //echo " Status: <font color='danger'>Esperando Resposta</font> ";
                }else if($status == 'em_andamento'){
                  // echo "Data de Retorno: ";
                }else if($status == 'finalizado'){
                  echo "Data de Retorno: <br>
                  Status: <font color='green'>Finalizado</font> ";
                }
                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario <br> ";
                  }
                 
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                      # code...
                    }
                  }
                              
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 

          }else{

            $res_chamada = buscar_chamada_atraso2($conexao,$setor_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario_retorno = '';
              
              $nome_funcionario = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }

              echo "
              <tr>";
              if ($status == 'atrasado') {
                echo "<td style=' background-color:#FE2E2E; 
                text-align: center;color: white'>
                Atrasado <br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b>  $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                 

                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario -";
                  }
                  
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                   
                    }
                  }
                    $tem_questionamento = 0;
                  $nome_setor = "";
                  $res_questionado = pesquisa_questionado($conexao,$id_chamada);
                  foreach ($res_questionado as $key => $value) {
                    $tem_questionamento = $value['id'];
                  }
                  $res_setor = buscar_setor_id($conexao,$setor_id);
                  foreach ($res_setor as $key => $value) {
                    $nome_setor = $value['nome'];
                  }
                  if( $tem_questionamento > 0){
                      if ($nome_setor == "") {
                      echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> CHAMADA QUESTIONADA - $nome_funcionario_retorno </b>";
                    }else{
                      echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> CHAMADA QUESTIONADA - $nome_setor </b>";
                    }
                  }
                              
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 

            $res_chamada = buscar_chamada_novas($conexao,$setor_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario_retorno = '';
 
              $nome_funcionario = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }
              echo "
              <tr>";
              if ($status == 'esperando_resposta') {
                echo "<td style='background-color:#2E64FE;  
                text-align: center;color: white;'>
                Novo <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'em_andamento') {
                echo "<td style=' background-color:#F1C40F; 
                text-align: center;'>
                Andamento<br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'finalizado') {
                echo "<td style=' background-color:#82FA58;
                text-align: center;color: white'>
                Resolvido <br> <b>Protocolo: $id_chamada</b></td>";
              }elseif ($status == 'atrasado') {
                echo "<td style=' background-color:#FE2E2E; 
                text-align: center;color: white'>
                Atrasado <br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b>  $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                 
                   if($status == 'esperando_resposta'){

                  //echo " Status: <font color='danger'>Esperando Resposta</font> ";
                }else if($status == 'em_andamento'){
                  // echo "Data de Retorno: ";
                }else if($status == 'finalizado'){
                  echo "Data de Retorno: <br>
                  Status: <font color='green'>Finalizado</font> ";
                }
                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario <br> ";
                  }
                  
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                      # code...
                    }
                  }
                              
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 

            $res_chamada = buscar_chamada_andamento($conexao,$setor_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario_retorno = '';
 
              $nome_funcionario = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }
              echo "
              <tr>";
             if ($status == 'em_andamento') {
                echo "<td style=' background-color:#F1C40F; 
                text-align: center;'>
                Andamento<br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b>  $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                

                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario <br> ";
                  }
                  
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                      # code...
                    }
                  }
                  $tem_questionamento = 0;
                  $nome_setor = "";
                  $res_questionado = pesquisa_questionado($conexao,$id_chamada);
                  foreach ($res_questionado as $key => $value) {
                    $tem_questionamento = $value['id'];
                  }
                  $res_setor = buscar_setor_id($conexao,$setor_id);
                  foreach ($res_setor as $key => $value) {
                    $nome_setor = $value['nome'];
                  }
                  if( $tem_questionamento > 0){
                    if ($nome_setor == "") {
                      echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> CHAMADA QUESTIONADA - $nome_funcionario_retorno </b>";
                    }else{
                      echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> CHAMADA QUESTIONADA - $nome_setor </b>";
                    }
                    

                  }    
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 

            $res_chamada = buscar_chamada_finalizado($conexao,$setor_id);
            foreach ($res_chamada as $key => $value) {
              $id_chamada = $value['id'];
              $status = $value['status'];
              $id_funcionario = $value['funcionario_id'];
              $setor_id = $value['setor_id'];
              $id_solicitacao = $value['tipo_solicitacao'];
              $nome_funcionario_retorno = '';
 
              $nome_funcionario = '';
              $nome_escola='';
              $data_retorno = '';
              $id_func_respondeu = $value['func_respondeu_id'];

              $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
              foreach ($res_chat_resposta as $key => $value) {
                $data_retorno = $value['data'];
              }
              $res_nome_resposta =nome_funcionario($conexao,$id_func_respondeu);
              foreach ($res_nome_resposta as $key => $value) {
                $nome_funcionario_retorno = $value['nome'];
              }
              $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_funcionario as $key => $value) {
                  $nome_funcionario = $value['nome'];
                }
              $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
                foreach ($res_nome_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                  $res_buscar_escola = buscar_escola($conexao,$id_escola);
                  foreach ($res_buscar_escola as $key => $value) {
                    $nome_escola= $value['nome_escola'];
                  }
                }
              
              $res_funcionario = buscar_funcionario($conexao,$idfuncionario);
              $nome = '';
              $email = '';
              $whatsapp = '';
              $descricao = '';
              $nome_solicitacao = '';

              $data_solicitado = '';
              $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$id_funcionario);
              foreach ($res_chat as $key => $value) {
                $data_solicitado = $value['data'];
              }
              if($id_solicitacao != null){
                $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
                foreach ($res_solicitacao as $key => $value) {
                   $nome_solicitacao = $value['nome'];
                }
              }
              
              foreach ($res_funcionario as $key => $value) {
                $nome = $value['nome'];
                $email = $value['email'];
                $whatsapp = $value['whatsapp'];
              }
              $res_chat= buscar_chat($conexao,$id_chamada);
              foreach ($res_chat as $key => $value) {
                 $descricao = $value['mensagem'];
                 
              }
              echo "
              <tr>";
            if ($status == 'finalizado') {
                echo "<td style=' background-color:#82FA58;
                text-align: center;color: white'>
                Resolvido <br> <b>Protocolo: $id_chamada</b></td>";
              }
               

                 echo "<td>
                  <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                  if ($id_func_respondeu > 0) {
                    echo "Data de Retorno:</b> $data_retorno &emsp;<b>Retorno:</b>  $nome_funcionario_retorno   <br>
                  ";
                  }else{
                    echo "Data de Retorno:</b> Sem Retorno     <br>
                  ";
                  }
                 
                  if($status == 'finalizado'){
                  echo "
                  Status: <font color='green'>Finalizado</font> ";
                }
                
                  if ($nome_escola != '') {
                     echo"
                  Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                  }else if($nome_escola == ''){
                     echo"
                   Diretor: $nome_funcionario <br> ";
                  }
                  
                  if ($id_solicitacao != null) {
                    if ($setor_id != 11) {
                     echo"Tipo de Solicitação: $nome_solicitacao <br>";
                      # code...
                    }
                  }
                  $tem_questionamento = 0;
                  $nome_setor = "";
                  $res_questionado = pesquisa_questionado($conexao,$id_chamada);
                  foreach ($res_questionado as $key => $value) {
                    $tem_questionamento = $value['id'];
                  }
                  $res_setor = buscar_setor_id($conexao,$setor_id);
                  foreach ($res_setor as $key => $value) {
                    $nome_setor = $value['nome'];
                  }
                  if( $tem_questionamento > 0){
                      if ($nome_setor == "") {
                      echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> CHAMADA QUESTIONADA - $nome_funcionario_retorno </b>";
                    }else{
                      echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> CHAMADA QUESTIONADA - $nome_setor </b>";
                    }
                  }      
                  echo"
                </td>
                <td>";
                if ($id_funcionario != $_SESSION['idfuncionario']) {
                  if($status == 'esperando_resposta'){
   
                    echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                      echo "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                  
                  }
                }
                
                  
              echo "    
                </td>
              </tr>
              ";
            } 
          }
            
        ?>

    </tbody>
  </table>
  <br>
  <div class="row">
    <div class="col-sm-12 alert alert-success">
      <?php
      if ( $quant_finalizada == 0) {
         echo "
        <center>
            <h4 class='m-0'><b>
              <form method='GET'>
                $quant_finalizada Chamados Resolvidos 
                <input type='hidden' name='setor_id' id='setor_id' value='$setor_id'>
                <a class='btn btn-primary' disabled>Ver</a>
              </form>
            </b></h4>
        </center>

      
      ";
       }else{
        echo "
        <center>
            <h4 class='m-0'><b>
              <form method='GET'>
                $quant_finalizada Chamados Resolvidos 
                <input type='hidden' name='setor_id' id='setor_id' value='$setor_id'>
                <a class='btn btn-primary'  onclick='ver_resolvidos($setor_id);'>Ver</a>
              </form>
            </b></h4>
        </center>

      
      ";
        }  ?>
      
    </div>
  </div>
</div>


</div>

</section>

</div>


<?php 

include_once 'rodape.php';

?>