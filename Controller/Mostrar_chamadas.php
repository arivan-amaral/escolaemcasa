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
        $setor_id = $value['setor_id'];
        $data_hora = "";
        $nome_escola = "";
        $descricao = "";
        if ($tipo_solicitacao != '' && $setor_id != 11) {
            $res_nome_solicitacao = pesquisa_tipo_solicitacao($conexao,$tipo_solicitacao);
            foreach ($res_nome_solicitacao as $key => $value) {
                $nome_solicitado = $value['nome'];
            }
        }
        if ($setor_id == 11) {
            $res_nome_escola = buscar_escola($conexao,$tipo_solicitacao);
            foreach ($res_nome_escola as $key => $value) {
                $nome_escola = $value['nome_escola'];
            }
        }
       
        $res_chat_chamada = mostrar_chat_chamada($conexao,$id,$_SESSION["idfuncionario"]);
        foreach ($res_chat_chamada as $key => $value) {
            $data_hora = $value['data'];
            $descricao = $value['mensagem'];
        }
        
        $result.= " <tr>
                        <td><br>
                        Protocolo: $id <br>";
                         if ($tipo_solicitacao != '' && $setor_id != 11) {
                          $result.="Tipo de Solicitação:  $nome_solicitado <br>";
                         }
                         if ($setor_id == 11) {
                            $result.="Enviado Para:  $nome_escola <br>";
                         }

                        $result.="Data da Solicitação:  $data_hora 
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