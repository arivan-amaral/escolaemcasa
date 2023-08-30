<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Chamada.php';

        $idfuncionario = $_SESSION['idfuncionario'];

try {


    $pesquisa = $_GET['pesquisa'];
   
    

    $result="
            <thead>
                <tr>
                    <th style='text-align: center;''>Status</th>
                    <th>Informações</th>
                </tr>
            </thead>
            <tbody>
 
    ";

    $conta=0;
    if ($pesquisa != '') {
        $res=pesquisar_chamado($conexao,$pesquisa);
        foreach ($res as $key => $value){
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
        $res_funcionario = buscar_funcionario($conexao,$id_funcionario);
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
        $result.="<tr>";
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

        $result.="
               </div>
             </div>
            ";
        $result.= "<td>
                <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                if ($id_func_respondeu > 0) {
                   $result.= "Data de Retorno:</b> $data_retorno     <br>
                ";
                }else{
                   $result.= "Data de Retorno:</b> Sem Retorno     <br>
                ";
                }
               
                 if($status == 'esperando_resposta'){

                //echo " Status: <font color='danger'>Esperando Resposta</font> ";
              }else if($status == 'em_andamento'){
                // echo "Data de Retorno: ";
              }else if($status == 'finalizado'){
                 $result.= "Data de Retorno: <br>
                Status: <font color='green'>Finalizado</font> ";
              }
                 $result.="
                Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                if ($id_solicitacao != null) {
                    $result.="Tipo de Solicitação: $nome_solicitacao <br>";
                }
                            
                 $result.="
              </td>
            </tr>
            ";
           
        
        $conta++;
        }
        if ($conta==0) {
            $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
        }
    }else{
        //
        $res_todos = pesquisar_todos_chamado($conexao,$idfuncionario);
        foreach ($res_todos as $key => $value){
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
        $res_funcionario = buscar_funcionario($conexao,$id_funcionario);
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
        $result.="<tr>";
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

        $result.="
               </div>
             </div>
            ";

        $result.= "<td>
                <b>Data de Solicitação:</b> $data_solicitado &nbsp;&nbsp;&nbsp; <b>";
                if ($id_func_respondeu > 0) {
                   $result.= "Data de Retorno:</b> $data_retorno     <br>
                ";
                }else{
                   $result.= "Data de Retorno:</b> Sem Retorno     <br>
                ";
                }
               
                 if($status == 'esperando_resposta'){

                //echo " Status: <font color='danger'>Esperando Resposta</font> ";
              }else if($status == 'em_andamento'){
                // echo "Data de Retorno: ";
              }else if($status == 'finalizado'){
                 $result.= "Data de Retorno: <br>
                Status: <font color='green'>Finalizado</font> ";
              }
                 $result.="
                Escola: $nome_escola - Diretor: $nome_funcionario <br> ";
                if ($id_solicitacao != null) {
                    $result.="Tipo de Solicitação: $nome_solicitacao <br>";
                }
                            
                 $result.="
              </td>
            </tr>
            ";
           
        
        $conta++;
        }
        if ($conta==0) {
            $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
        }
    }
    
    
$result.="</tbody>";
echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo "A pesquisa aceita apenas números";
}
?>