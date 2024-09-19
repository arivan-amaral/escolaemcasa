<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Chamada.php';
include_once '../Model/Setor.php';
include_once '../Model/Escola.php';
 

try {

    $pesquisa = $_GET['pesquisa'];
    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];
    $escola = $_GET['escola'];
    
    //arivan chamados
    $idfuncionario = $_SESSION['idfuncionario'];

    
    $result="
   <thead>
      <tr>
        <th  style='text-align: center;'>Escola/Setor</th>
        <th  style='text-align: center;'>Solicitante</th>
        <th  style='text-align: center;'>Data Solicitação</th>
        <th  style='text-align: center;'>Setor/Unidade Escolar</th>
        <th  style='text-align: center;'>Retorno</th>
        <th  style='text-align: center;'>Data Retorno</th>
        <th  style='text-align: center;'>Status Chamados</th>
        <th  style='text-align: center;'>Enviar</th>
      </tr>
    </thead>
    <tbody>
    ";

    $conta=0;


    $res_todos = pesquisar_todos_chamado($conexao,$idfuncionario);
    foreach ($res_todos as $key => $value){
    $id_chamada = $value['id'];
    $status = $value['status'];
    $id_funcionario = $value['funcionario_id'];
    $id_func_respondeu = $value['func_respondeu_id'];
    $id_solicitacao = $value['tipo_solicitacao'];
    $nome_funcionario = '';
    $nome_retorno = '';
    $nome_escola='';
    $data_retorno = $value['data_previsao'];
    $nome_setor ='';
    $setor_id = $value['setor_id'];
    $mensagem_retorno = '';



 
    
 
 

    $result.="<tr>
    </div>
         </div>
    <td>$nome_escola</td>
    <td>$nome_funcionario</td>
    <td>$data_solicitado</td>
    <td>$nome_setor</td>";
    if ($nome_retorno != '') {
        $result.=" <td>$nome_retorno</td>";
    }else{
        $result.="<td>Sem retorno</td>";
    }
   
    if ($data_retorno != '0001-01-01 00:00:00') {
        $result.="<td>$data_retorno</td>";
    }else{
        $result.="<td>Sem data de retorno</td>";
    }


    if ($status == 'esperando_resposta') {
      $result.= "<td style='background-color: #6495ED;'>Novo</td>";
    }elseif ($status == 'em_andamento') {
      $result.= "<td style='background-color: #FFFF00;'>Andamento</td>";
    }elseif ($status == 'finalizado') {
      $result.= "<td style='background-color: #00FF00; '>Finalizado</td>";
    }elseif ($status == 'atrasado') {
      $result.= "<td style='background-color: #FF0000; color: white;'>Atrasado</td>";
      $result.="<td>
          <div>
            <!--h2>Envio de Mensagens a usuários do setor</h2-->
            <!-- Button to Open the Modal -->
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal$id_chamada'>
              Mensagem
            </button>

            <!-- The Modal -->
            <div class='modal' id='myModal$id_chamada'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                
                  <!-- Modal Header -->
                  <div class='modal-header'>
                    <h3 class='modal-title'>Escola: $nome_escola<br> $nome_funcionario- Protocolo: $id_chamada - $nome_setor</h3>
                    <button type='button' class='close' data-dismiss='modal'>×</button>
                  </div>
                  
                  <!-- Modal body -->
                  <form method='GET'>
                  <div class='modal-body'>
                    <h3>Lista de Usuário</h3>
                    <a><strong>Mensagem:</strong></a><br>
                    <textarea id='mensagem' name='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
                    <a><strong>Solicitação:    Data: $data_solicitado  <br>
                    </strong></a>
                    <textarea id='story' name='story' rows='3' cols='40' disabled>$descricao</textarea><br><br>
                    <a><strong>Retorno:";
       
                    if ($data_retorno == '0001-01-01 00:00:00' || $nome_retorno == '') {
                        $result.=" Sem retorno ";
                    }else{
                        $result.="$nome_retorno  Data: $data_retorno";
                    }
                                     
                    $result.="</strong></a><br>
                    <textarea id='story' name='story' rows='3' cols='40' disabled>$mensagem_retorno</textarea><br><br>
                    ";
 

                    $result.="<a type='button' class='btn btn-success' data-dismiss='modal' onclick='cadastrar_mensagem($id_chamada,$id_func_respondeu)'>Enviar</a>
                  </div>
                  </form>
                  <!-- Modal footer -->
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar</button>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
      </td>";
    }
    
    

  $result.="</tr>";
    
    $conta++;
    }
    if ($conta==0) {
        $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
    }

    
    
$result.="</tbody>";
echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>