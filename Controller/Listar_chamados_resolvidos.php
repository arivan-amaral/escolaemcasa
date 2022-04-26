<?php
session_start();
include "../Model/Conexao.php";
include "../Model/Chamada.php";
try {

    $setor = $_GET['setor_id'];
    $result = "";
    $res_resolvidos = buscar_chamada_finalizada($conexao,$setor); 
    foreach ($res_resolvidos as $key => $value) {
        $id_chamada = $value['id'];
        $status = $value['status'];
        $id_funcionario = $value['funcionario_id'];
         $id_solicitacao = $value['tipo_solicitacao'];
        $nome_funcionario = '';
        $nome_escola='';
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
        $destino = '';
        $data_solicitado = '';
        $res_chat = mostrar_chat_chamada($conexao,$id_chamada,$_SESSION['idfuncionario']);
        foreach ($res_chat as $key => $value) {
          $data_solicitado = $value['data'];
        }
        $res_solicitacao = pesquisa_tipo_solicitacao($conexao,$id_solicitacao);
        foreach ($res_solicitacao as $key => $value) {
           $nome_solicitacao = $value['nome'];
        }
        foreach ($res_funcionario as $key => $value) {
          $nome = $value['nome'];
          $email = $value['email'];
          $whatsapp = $value['whatsapp'];
        }
        $res_chat= buscar_chat($conexao,$id_chamada);
        foreach ($res_chat as $key => $value) {
           $descricao = $value['mensagem'];
            $destino = $value['arquivo'];
        }
        $result.="
        <tr>
          <td>
            Data de Solicitação: $data_solicitado <br>
            ";
             if($status == 'esperando_resposta'){

            $result.=" Status: <font color='danger'>Esperando Resposta</font> ";
          }else if($status == 'em_andamento'){
            $result.="
            Data de Retorno: <br>
            Status: <font color='yellow'>Em Andamento</font> ";
          }else if($status == 'finalizado'){
            $result.="Data de Retorno: <br>
            Status: <font color='green'>Finalizado</font> ";
          }
            $result.="<br>
            Escola: $nome_escola - Diretor: $nome_funcionario <br> 
            Tipo de Solicitação: $nome_solicitacao <br>             
            Protocolo: $id_chamada
          </td>
          <td>";
          if($status == 'esperando_resposta'){

            $result.="<form method='POST' action='responder_chamada.php'>
              <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
              <button class='btn btn-success' onclick='responder_chat($id_chamada);'>RESPONDER</button>
            </form>";
          }else{
            $result.="<form method='POST' action='responder_chamada.php'>
              <input type='hidden' name='id_chamada' id='id_chamada' value='$id_chamada'>
              <button class='btn btn-success' onclick='responder_chat($id_chamada);'>Ver Chat</button>
            </form>";
          }
            
        $result.="    
          </td>
        </tr>
        ";
    }
  
    echo $result;
} catch (Exception $exc) {

    echo $exc;
}

?>