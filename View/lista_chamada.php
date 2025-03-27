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
include_once '../Model/Coordenador.php';

 $escola_id= $_GET['escola'];

 

 if (isset($_GET['setor'])) {
  $setor_id=$_GET['setor'];
 }else{
  $setor_id='';
 }


if (isset($_GET['status'])) {
  $status=$_GET['status'];
}else{
  $status='';
}

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


<script>
    function filtrarTabela() {
        const filtro = document.getElementById("filtroInput").value.toLowerCase();
        const tabela = document.getElementById("minhaTabela");
        const linhas = tabela.getElementsByTagName("tr");

        for (let i = 1; i < linhas.length; i++) { // começa em 1 para ignorar o cabeçalho
            let linha = linhas[i];
            let colunas = linha.getElementsByTagName("td");
            let linhaVisivel = false;

            for (let j = 0; j < colunas.length; j++) {
                if (colunas[j].innerText.toLowerCase().includes(filtro)) {
                    linhaVisivel = true;
                    break;
                }
            }

            if (linhaVisivel) {
                linha.style.display = ""; // mostra a linha
            } else {
                linha.style.display = "none"; // esconde a linha
            }
        }
    }
</script>
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
// echo "
//     <div class='row g-2'>
//         <div class='col-md-2 col-sm-6'>
//             <a href='#' class='btn btn-primary w-100' onclick=listar_chamados('$setor_id','esperando_resposta') >
//                 $quantidade_pendente &nbsp;&nbsp; Novos Chamados
//             </a>
//         </div>
//         <div class='col-md-2 col-sm-6'>
//             <a  class='btn btn-warning w-100' onclick=listar_chamados('$setor_id','em_andamento') >
//                 $quantidade_andamento &nbsp;&nbsp; Em Andamento
//             </a>
//         </div>
//         <div class='col-md-2 col-sm-6'>
//             <a href='#' class='btn btn-danger w-100' onclick=listar_chamados('$setor_id','atrasado') >
//                 $quantidade_atraso &nbsp;&nbsp; Atrasados
//             </a>
//         </div>
//         <div class='col-md-2 col-sm-6'>
//             <a  class='btn btn-success w-100' onclick=listar_chamados('$setor_id','finalizado') >
//                 $quantidade_resolvidos &nbsp;&nbsp; Chamados Resolvidos
//             </a>
//         </div>
 
//     </div>
// ";      ?>


<div class="row">
  <div class="col-sm-2">
    <div class="form-group">
     <label for="exampleInputEmail1">Status</label>
          <input type="hidden" class="form-control" name="setor_id" id="setor_id" value="<?php echo $setor_id; ?>" >

     <select class="form-control" name="status" id="status" onchange="listar_chamados()">
         <option value="todos">Escolha o status</option>
         <option value="esperando_resposta">Novos Chamados</option>
         <option value="em_andamento">Em Andamento</option>
         <option value="atrasado">Atrasados</option>
         <option value="finalizado">Chamados Resolvidos</option>
     </select>
    </div>
  </div>  


  <div class="col-sm-3">
    <div class="form-group">
     <label for="exampleInputEmail1">ESCOLA</label>
     <select class="form-control select2"  id="escola" name="escola" >
      <option value="Todas">TODAS</option>
      <?php  
  
        $res_escola= escola_associada($conexao,$idcoordenador);
          $lista_escola_associada=""; 
        $sql_escolas="AND ( escola_id = -1 ";
        $sql_escolas_enviada="AND ( escola_id_origem = -1 ";
        foreach ($res_escola as $key => $value) {
            $id=$value['idescola'];
           $nome_escola=($value['nome_escola']);
            $sql_escolas.=" OR escola_id = $id ";
            $sql_escolas_enviada.=" OR escola_id_origem = $id ";

            $lista_escola_associada.= "
                 <option value='$id'>$nome_escola </option>

             ";
        }

        echo "$lista_escola_associada";

      ?>
      
    
     </select> 
    </div>
  </div> 
  
 <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">Data inicial</label>
           <input type="date" class="form-control" name="data_inicial" id="data_inicial" value="<?php echo date("Y"); ?>-01-01">
          </div>
        </div>
         <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">Data final</label>
           <input type="date" class="form-control" name="data_final" id="data_final" value="<?php echo date("Y-m-d"); ?>">
          </div>

          </div>
  </div>
<div class="row">

      <div class="col-sm-4">
        <div class="form-group">
         <label for="exampleInputEmail1">Pesquisa</label>
         <input type="text" class="form-control" name="pesquisa" id="pesquisa">
        </div>
      </div>


      <div class="col-sm-2" style="margin-top: 7px;" ><br>
       <a  class="btn btn-primary" onclick="pesquisa_chamado()">Pesquisar</a>
      </div>
    </div>
</div>




<div class='card-body'>
     <input type="text" id="filtroInput" onkeyup="filtrarTabela()" placeholder="Digite para filtrar...">
  <table class='table table-bordered' id="minhaTabela">
    <thead>
       <tr>
         <th style="text-align: center;">Status</th>
         <th>Informações</th>
         <th>Opção</th>

       </tr>
     </thead>
     <tbody id="tabela_chamados">
    <?php 

    try {


        $result = "";
          $res_resolvidos =listar_chamados($conexao,$setor_id, $status); 

              foreach ($res_resolvidos as $key => $value) {
                $id_chamada = $value['id'];
                $status = $value['status'];
                $id_funcionario = $value['funcionario_id'];
                $id_solicitacao = $value['tipo_solicitacao'];
                $nome_funcionario = '';
                $nome_escola='';
                $data_retorno = '';
                $id_func_respondeu = $value['func_respondeu_id'];

                $res_chat_resposta = buscar_pessoa_chat_retorno($conexao,$id_chamada,$id_func_respondeu);
                foreach ($res_chat_resposta as $key => $value) {
                  $data_retorno = $value['data'];
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
                
                $res_funcionario = buscar_funcionario($conexao,$_SESSION['idfuncionario']);
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
                $result.= "
                <tr>";
                if ($status == 'esperando_resposta') {
                   $result.= "<td style='background-color:#2E64FE;  
                  text-align: center;color: white;'>
                  Novo <br> <b>Protocolo: $id_chamada</b></td>";
                }elseif ($status == 'em_andamento') {
                   $result.= "<td style=' background-color:#F1C40F; 
                  text-align: center;'>
                  Andamento<br> <b>Protocolo: $id_chamada</b></td>";
                }elseif ($status == 'finalizado') {
                   $result.= "<td style=' background-color:#82FA58;
                  text-align: center;color: white'>
                  Resolvido <br> <b>Protocolo: $id_chamada</b></td>";
                }elseif ($status == 'atrasado') {
                   $result.= "<td style=' background-color:#FE2E2E; 
                  text-align: center;color: white'>
                  Atrasado <br> <b>Protocolo: $id_chamada</b></td>";
                }
                 

                    $result.= "<td>
                    <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                    if ($id_func_respondeu > 0) {
                       $result.= "Data de Retorno:</b> $data_retorno     <br>
                    ";
                    }else{
                       $result.= "Data de Retorno:</b> Sem Retorno     <br>
                    ";
                    }
                               
                     $result.="
                    Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                    if ($id_solicitacao != null) {
                        $result.="Tipo de Solicitação: $nome_solicitacao <br>";
                    }
                                
                     $result.="
                  </td>
                  <td>";
                  if($status == 'esperando_resposta'){
     
                     $result.= "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Responder</button>
                    </form>";
                  }else{
                    if ($status == 'atrasado') {
                       $result.= "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-danger'>Visualizar</button>
                    </form>";
                    }else{
                       $result.= "<form method='POST' action='responder_chamada.php'>
                      <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
                      <button class='btn btn-success'>Visualizar</button>
                    </form>";
                    }
                    
                  }
                    
                 $result.= "    
                  </td>
                </tr>
                ";
        }
      
        echo $result;
    } catch (Exception $exc) {

         echo $exc;
    }
     ?>
    </tbody>
  </table>
  <br>

    </div>
  </div>
</div>


</div>

</section>

</div>
<?php 


include_once 'rodape.php';

?>