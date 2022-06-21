<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Chamada.php';
include '../Model/Setor.php';
include '../Model/Escola.php';


try {

    $pesquisa = $_GET['pesquisa'];
    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];
    
    $result="
           <thead>
              <tr>
                <th  style='text-align: center;'>Escola</th>
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
if ($pesquisa != '' || $data_inicial != '') {

   // PESQUISA ESCOLA
      $res_escola = buscar_escola_por_nome($conexao,$pesquisa);
      foreach ($res_escola as $key => $value) {
        $id_escola = $value['idescola'];
        $res=pesquisar_chamado_escola($conexao,$id_escola);
        foreach ($res as $key => $value){
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
        $res_nome_setor= buscar_setor_id($conexao,$setor_id);

        foreach ($res_nome_setor as $key => $value) {
            $nome_setor = $value['nome'];
        }

        $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_funcionario as $key => $value) {
            $nome_funcionario = $value['nome'];
        }

        $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
          foreach ($res_nome_funcionario_resposta as $key => $value) {
            $nome_retorno = $value['nome'];
        }

        $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_escola as $key => $value) {
            $id_escola = $value['escola_id'];
            $res_buscar_escola = buscar_escola($conexao,$id_escola);
            foreach ($res_buscar_escola as $key => $value) {
              $nome_escola= $value['nome_escola'];
            }
        }
        if ($nome_escola == '') {
            $nome_escola = "Não Afiliada";
        }
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
        
     
        $res_chat= buscar_chat($conexao,$id_chamada);
        foreach ($res_chat as $key => $value) {
           $descricao = $value['mensagem'];
        }

        $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
        foreach ($res_chat_retorno as $key => $value) {
            $mensagem_retorno = $value['mensagem'];
        }


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
                        <textarea id='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
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
                       /* 
                        $res_funcionario_setor = buscar_funcionario_setor($conexao,$setor_id);
                        foreach ($res_funcionario_setor as $key => $value) {
                            $id_funcionario_cadastado = $value['funcionario_id'];
                            $nome_funcionario_cadastrado = '';
                            $telefone_funcionario= '';
                            $res_nome_funcionario_setor = nome_funcionario($conexao,$id_funcionario_cadastado);
                            foreach ($res_nome_funcionario_setor as $key => $value) {
                                $nome_funcionario_cadastrado = $value['nome'];
                                $telefone_funcionario= $value['whatsapp'];
                                $result.="<p> <input type='checkbox' id='enviado'>  $nome_funcionario_cadastrado $telefone_funcionario<br></p>";

                            }
                        }
                        */

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
      }
    //PESQUISA SOLICITANTE
      $res_funcionario = id_funcionario($conexao,$pesquisa);
      foreach ($res_funcionario as $key => $value) {
        $id_funcionario = $value['idfuncionario'];
        $res=pesquisar_chamado_solicitante($conexao,$id_funcionario);
        foreach ($res as $key => $value){
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
        $res_nome_setor= buscar_setor_id($conexao,$setor_id);

        foreach ($res_nome_setor as $key => $value) {
            $nome_setor = $value['nome'];
        }

        $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_funcionario as $key => $value) {
            $nome_funcionario = $value['nome'];
        }

        $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
          foreach ($res_nome_funcionario_resposta as $key => $value) {
            $nome_retorno = $value['nome'];
        }

        $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_escola as $key => $value) {
            $id_escola = $value['escola_id'];
            $res_buscar_escola = buscar_escola($conexao,$id_escola);
            foreach ($res_buscar_escola as $key => $value) {
              $nome_escola= $value['nome_escola'];
            }
        }
        if ($nome_escola == '') {
            $nome_escola = "Não Afiliada";
        }
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
        
     
        $res_chat= buscar_chat($conexao,$id_chamada);
        foreach ($res_chat as $key => $value) {
           $descricao = $value['mensagem'];
        }

        $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
        foreach ($res_chat_retorno as $key => $value) {
            $mensagem_retorno = $value['mensagem'];
        }


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
                        <textarea id='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
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
                       /* 
                        $res_funcionario_setor = buscar_funcionario_setor($conexao,$setor_id);
                        foreach ($res_funcionario_setor as $key => $value) {
                            $id_funcionario_cadastado = $value['funcionario_id'];
                            $nome_funcionario_cadastrado = '';
                            $telefone_funcionario= '';
                            $res_nome_funcionario_setor = nome_funcionario($conexao,$id_funcionario_cadastado);
                            foreach ($res_nome_funcionario_setor as $key => $value) {
                                $nome_funcionario_cadastrado = $value['nome'];
                                $telefone_funcionario= $value['whatsapp'];
                                $result.="<p> <input type='checkbox' id='enviado'>  $nome_funcionario_cadastrado $telefone_funcionario<br></p>";

                            }
                        }
                        */

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
    //PESQUISA DATA SOLICITANTE
      if ($data_inicial != '' && $data_final != '')  {
        
        $res_data_solicitante = pesquisar_chamado_data_solicitante($conexao,$data_inicial, $data_final);
        foreach ($res_data_solicitante as $key => $value) {
          $id_chamada_data = $value['chamada_id'];
          $res=pesquisar_chamado($conexao,$id_chamada_data);
          foreach ($res as $key => $value){
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
          $res_nome_setor= buscar_setor_id($conexao,$setor_id);

          foreach ($res_nome_setor as $key => $value) {
              $nome_setor = $value['nome'];
          }

          $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
            foreach ($res_nome_funcionario as $key => $value) {
              $nome_funcionario = $value['nome'];
          }

          $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
            foreach ($res_nome_funcionario_resposta as $key => $value) {
              $nome_retorno = $value['nome'];
          }

          $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
            foreach ($res_nome_escola as $key => $value) {
              $id_escola = $value['escola_id'];
              $res_buscar_escola = buscar_escola($conexao,$id_escola);
              foreach ($res_buscar_escola as $key => $value) {
                $nome_escola= $value['nome_escola'];
              }
          }
          if ($nome_escola == '') {
              $nome_escola = "Não Afiliada";
          }
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
          
       
          $res_chat= buscar_chat($conexao,$id_chamada);
          foreach ($res_chat as $key => $value) {
             $descricao = $value['mensagem'];
          }

          $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
          foreach ($res_chat_retorno as $key => $value) {
              $mensagem_retorno = $value['mensagem'];
          }


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
                          <textarea id='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
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
                         /* 
                          $res_funcionario_setor = buscar_funcionario_setor($conexao,$setor_id);
                          foreach ($res_funcionario_setor as $key => $value) {
                              $id_funcionario_cadastado = $value['funcionario_id'];
                              $nome_funcionario_cadastrado = '';
                              $telefone_funcionario= '';
                              $res_nome_funcionario_setor = nome_funcionario($conexao,$id_funcionario_cadastado);
                              foreach ($res_nome_funcionario_setor as $key => $value) {
                                  $nome_funcionario_cadastrado = $value['nome'];
                                  $telefone_funcionario= $value['whatsapp'];
                                  $result.="<p> <input type='checkbox' id='enviado'>  $nome_funcionario_cadastrado $telefone_funcionario<br></p>";

                              }
                          }
                          */

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
        }
      }
     
    //PESQUISA SETOR
      $res_setor = buscar_setor_nome($conexao,$pesquisa);
      foreach ($res_setor as $key => $value) {
        $id_setor = $value['id'];
        $res=pesquisar_chamado_setor($conexao,$id_setor);
        foreach ($res as $key => $value){
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
        $res_nome_setor= buscar_setor_id($conexao,$setor_id);

        foreach ($res_nome_setor as $key => $value) {
            $nome_setor = $value['nome'];
        }

        $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_funcionario as $key => $value) {
            $nome_funcionario = $value['nome'];
        }

        $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
          foreach ($res_nome_funcionario_resposta as $key => $value) {
            $nome_retorno = $value['nome'];
        }

        $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_escola as $key => $value) {
            $id_escola = $value['escola_id'];
            $res_buscar_escola = buscar_escola($conexao,$id_escola);
            foreach ($res_buscar_escola as $key => $value) {
              $nome_escola= $value['nome_escola'];
            }
        }
        if ($nome_escola == '') {
            $nome_escola = "Não Afiliada";
        }
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
        
     
        $res_chat= buscar_chat($conexao,$id_chamada);
        foreach ($res_chat as $key => $value) {
           $descricao = $value['mensagem'];
        }

        $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
        foreach ($res_chat_retorno as $key => $value) {
            $mensagem_retorno = $value['mensagem'];
        }


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
                        <textarea id='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
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
                       /* 
                        $res_funcionario_setor = buscar_funcionario_setor($conexao,$setor_id);
                        foreach ($res_funcionario_setor as $key => $value) {
                            $id_funcionario_cadastado = $value['funcionario_id'];
                            $nome_funcionario_cadastrado = '';
                            $telefone_funcionario= '';
                            $res_nome_funcionario_setor = nome_funcionario($conexao,$id_funcionario_cadastado);
                            foreach ($res_nome_funcionario_setor as $key => $value) {
                                $nome_funcionario_cadastrado = $value['nome'];
                                $telefone_funcionario= $value['whatsapp'];
                                $result.="<p> <input type='checkbox' id='enviado'>  $nome_funcionario_cadastrado $telefone_funcionario<br></p>";

                            }
                        }
                        */

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
      }
    //PESQUISA RETORNADOR
      $res_funcionario_2 = id_funcionario($conexao,$pesquisa);
      foreach ($res_funcionario_2 as $key => $value) {
        $id_funcionario = $value['idfuncionario'];
        $res=pesquisar_chamado_retorno($conexao,$id_funcionario);
        foreach ($res as $key => $value){
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
        $res_nome_setor= buscar_setor_id($conexao,$setor_id);

        foreach ($res_nome_setor as $key => $value) {
            $nome_setor = $value['nome'];
        }

        $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_funcionario as $key => $value) {
            $nome_funcionario = $value['nome'];
        }

        $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
          foreach ($res_nome_funcionario_resposta as $key => $value) {
            $nome_retorno = $value['nome'];
        }

        $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_escola as $key => $value) {
            $id_escola = $value['escola_id'];
            $res_buscar_escola = buscar_escola($conexao,$id_escola);
            foreach ($res_buscar_escola as $key => $value) {
              $nome_escola= $value['nome_escola'];
            }
        }
        if ($nome_escola == '') {
            $nome_escola = "Não Afiliada";
        }
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
        
     
        $res_chat= buscar_chat($conexao,$id_chamada);
        foreach ($res_chat as $key => $value) {
           $descricao = $value['mensagem'];
        }

        $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
        foreach ($res_chat_retorno as $key => $value) {
            $mensagem_retorno = $value['mensagem'];
        }


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
                        <textarea id='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
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
                       /* 
                        $res_funcionario_setor = buscar_funcionario_setor($conexao,$setor_id);
                        foreach ($res_funcionario_setor as $key => $value) {
                            $id_funcionario_cadastado = $value['funcionario_id'];
                            $nome_funcionario_cadastrado = '';
                            $telefone_funcionario= '';
                            $res_nome_funcionario_setor = nome_funcionario($conexao,$id_funcionario_cadastado);
                            foreach ($res_nome_funcionario_setor as $key => $value) {
                                $nome_funcionario_cadastrado = $value['nome'];
                                $telefone_funcionario= $value['whatsapp'];
                                $result.="<p> <input type='checkbox' id='enviado'>  $nome_funcionario_cadastrado $telefone_funcionario<br></p>";

                            }
                        }
                        */

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
      }
    //PESQUISA DATA RETORNO
      if ($data_inicial != '' && $data_final != '') {
        $res_data_retorno = pesquisar_chamado_data_retorno($conexao,$pesquisa);
        foreach ($res_data_retorno as $key => $value) {
          $id_chamada_data = $value['chamada_id'];
          $res=pesquisar_chamado_data_retorno($conexao,$id_chamada_data);
          foreach ($res as $key => $value){
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
          $res_nome_setor= buscar_setor_id($conexao,$setor_id);

          foreach ($res_nome_setor as $key => $value) {
              $nome_setor = $value['nome'];
          }

          $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
            foreach ($res_nome_funcionario as $key => $value) {
              $nome_funcionario = $value['nome'];
          }

          $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
            foreach ($res_nome_funcionario_resposta as $key => $value) {
              $nome_retorno = $value['nome'];
          }

          $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
            foreach ($res_nome_escola as $key => $value) {
              $id_escola = $value['escola_id'];
              $res_buscar_escola = buscar_escola($conexao,$id_escola);
              foreach ($res_buscar_escola as $key => $value) {
                $nome_escola= $value['nome_escola'];
              }
          }
          if ($nome_escola == '') {
              $nome_escola = "Não Afiliada";
          }
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
          
       
          $res_chat= buscar_chat($conexao,$id_chamada);
          foreach ($res_chat as $key => $value) {
             $descricao = $value['mensagem'];
          }

          $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
          foreach ($res_chat_retorno as $key => $value) {
              $mensagem_retorno = $value['mensagem'];
          }


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
                          <textarea id='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
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
                         /* 
                          $res_funcionario_setor = buscar_funcionario_setor($conexao,$setor_id);
                          foreach ($res_funcionario_setor as $key => $value) {
                              $id_funcionario_cadastado = $value['funcionario_id'];
                              $nome_funcionario_cadastrado = '';
                              $telefone_funcionario= '';
                              $res_nome_funcionario_setor = nome_funcionario($conexao,$id_funcionario_cadastado);
                              foreach ($res_nome_funcionario_setor as $key => $value) {
                                  $nome_funcionario_cadastrado = $value['nome'];
                                  $telefone_funcionario= $value['whatsapp'];
                                  $result.="<p> <input type='checkbox' id='enviado'>  $nome_funcionario_cadastrado $telefone_funcionario<br></p>";

                              }
                          }
                          */

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
        }
      }
     
    // PESQUISA STATUS
      $res_status=pesquisar_chamado_status($conexao,$pesquisa);
      foreach ($res_status as $key => $value){
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
        $res_nome_setor= buscar_setor_id($conexao,$setor_id);

        foreach ($res_nome_setor as $key => $value) {
            $nome_setor = $value['nome'];
        }

          $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
        foreach ($res_nome_funcionario as $key => $value) {
          $nome_funcionario = $value['nome'];
        }

        $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
          foreach ($res_nome_funcionario_resposta as $key => $value) {
            $nome_retorno = $value['nome'];
        }

        $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
          foreach ($res_nome_escola as $key => $value) {
            $id_escola = $value['escola_id'];
            $res_buscar_escola = buscar_escola($conexao,$id_escola);
            foreach ($res_buscar_escola as $key => $value) {
              $nome_escola= $value['nome_escola'];
            }
        }
        if ($nome_escola == '') {
            $nome_escola = "Não Afiliada";
        }
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
        
     
        $res_chat= buscar_chat($conexao,$id_chamada);
        foreach ($res_chat as $key => $value) {
           $descricao = $value['mensagem'];
        }

        $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
        foreach ($res_chat_retorno as $key => $value) {
            $mensagem_retorno = $value['mensagem'];
        }


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
                        <textarea id='mensagem' rows='3' cols='40' placeholder='Escreva mensagem aqui...'></textarea><br><br>
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
    }  
    if ($conta==0) {
        $result.="<tr> <td> NADA ENCONTRADO </td> </tr>";
    }
  
}else{
    $res_todos = pesquisar_todos_chamado($conexao);
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
    $res_nome_setor= buscar_setor_id($conexao,$setor_id);
    foreach ($res_nome_setor as $key => $value) {
        $nome_setor = $value['nome'];
    }

    $res_nome_funcionario = nome_funcionario($conexao,$id_funcionario);
      foreach ($res_nome_funcionario as $key => $value) {
        $nome_funcionario = $value['nome'];
    }

    $res_nome_funcionario_resposta = nome_funcionario($conexao,$id_func_respondeu);
      foreach ($res_nome_funcionario_resposta as $key => $value) {
        $nome_retorno = $value['nome'];
    }


    $res_nome_escola = escola_funcionario($conexao,$id_funcionario);
      foreach ($res_nome_escola as $key => $value) {
        $id_escola = $value['escola_id'];
        $res_buscar_escola = buscar_escola($conexao,$id_escola);
        foreach ($res_buscar_escola as $key => $value) {
          $nome_escola= $value['nome_escola'];
        }
    }
    if ($nome_escola == '') {
        $nome_escola = "Não Afiliada";
    }
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
    
 
    $res_chat= buscar_chat($conexao,$id_chamada);
    foreach ($res_chat as $key => $value) {
       $descricao = $value['mensagem'];
    }

    $res_chat_retorno = buscar_pessoa_retorno($conexao,$id_chamada,$id_func_respondeu);
    foreach ($res_chat_retorno as $key => $value) {
        $mensagem_retorno = $value['mensagem'];
    }


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
                   /* 
                    $res_funcionario_setor = buscar_funcionario_setor($conexao,$setor_id);
                    foreach ($res_funcionario_setor as $key => $value) {
                        $id_funcionario_cadastado = $value['funcionario_id'];
                        $nome_funcionario_cadastrado = '';
                        $telefone_funcionario= '';
                        $res_nome_funcionario_setor = nome_funcionario($conexao,$id_funcionario_cadastado);
                        foreach ($res_nome_funcionario_setor as $key => $value) {
                            $nome_funcionario_cadastrado = $value['nome'];
                            $telefone_funcionario= $value['whatsapp'];
                            $result.="<p> <input type='checkbox' id='enviado'>  $nome_funcionario_cadastrado $telefone_funcionario<br></p>";

                        }
                    }
                    */

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
}
    
    
$result.="</tbody>";
echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>