<?php
session_start();
include "../Model/Conexao.php";
include '../Model/Chamada.php';

try {
    $result="";
    
    $setor_id = $_GET['setor_id'];
    $res_chamadas=mostrar_minhas_chamadas($conexao,$setor_id,$_SESSION["idfuncionario"]);
    foreach ($res_chamadas as $key => $value) {
        $id = $value['id'];
        $tipo_solicitacao = $value['tipo_solicitacao'];
        $nome_solicitado = "";
        $data_hora = "";
        $descricao = "";
        if ($tipo_solicitacao != '') {
            $res_nome_solicitacao = pesquisa_tipo_solicitacao($conexao,$tipo_solicitacao);
            foreach ($res_nome_solicitacao as $key => $value) {
                $nome_solicitado = $value['nome'];
            }
        }
       
        $res_chat_chamada = mostrar_chat_chamada($conexao,$id,$_SESSION["idfuncionario"]);
        foreach ($res_chat_chamada as $key => $value) {
            $data_hora = $value['data'];
            $descricao = $value['mensagem'];
        }
        
        $result.= " <tr>
                        <td><br>
                        Protocolo: $id <br>
                        Tipo de Solicitação:  $nome_solicitado <br>
                        Data da Solicitação:  $data_hora 
                        </td>
                        <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <textarea type='text' class='form-control' rows='5'disabled style='resize: none;'>$descricao</textarea>
                        </td>
                    </tr>";
    }
    
    
    echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>