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
                  echo "Data de Retorno:</b> $data_retorno     <br>
                ";
                }else{
                  echo "Data de Retorno:</b> Sem Retorno     <br>
                ";
                }
                           
                echo"
                Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                if ($id_solicitacao != null) {
                   echo"Tipo de Solicitação: $nome_solicitacao <br>";
                }
                            
                echo"
              </td>
              <td>";
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
                
            echo "    
              </td>
            </tr>
            ";
    }
  
    echo $result;
} catch (Exception $exc) {

    echo $exc;
}

?>