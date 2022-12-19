<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    include("../Model/Coordenador.php");
    include("../Model/Serie.php");
    include("Conversao.php");
    

try {
 
    if(isset($_GET['valor_paginacao'])){

      $valor_paginacao=$_GET['valor_paginacao'];
      $limite_antigo =$valor_paginacao-25;
       $limite_novo=$valor_paginacao;
    }else{
      $limite_antigo =0;
       $limite_novo=25;
    }

    $professor_id=$_SESSION['idfuncionario'];
    $idfuncionario=$_SESSION['idfuncionario'];
 
    $res_turma=escola_associada($conexao,$idfuncionario); 
    $array_escolas_coordenador=array();
    $conta_escolas=0;
    $lista_escolas="";
    foreach ($res_turma as $key => $value) {
      $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
      $idescola_ass=$value['idescola'];
      $nome_escola_ass=$value['nome_escola'];
      $lista_escolas.="<option value='$idescola_ass'>$nome_escola_ass</option>";
      $conta_escolas++;
    }

    $escola=$_GET['escola'];
    $pesquisa=$_GET['pesquisa'];

    if ($escola =="Todas") {
      $codigo_sql=" escola.nome_escola IS NOT NULL ";
    }else{
      $codigo_sql=" escola.idescola= $escola ";

    }

      $result="
       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>Códido Aluno</th>
              <th>Aluno</th>
              <th>
              Opções
              </th>
            </tr>
          </thead>
          <tbody>

          ";
// ecidade_matricula.calendario_ano ='$ano_letivo_vigente' and 
$result_aluno=$conexao->query("SELECT 
aluno.nome as 'nome_aluno',
aluno.sexo,
aluno.data_nascimento,
aluno.idaluno,
aluno.email,
aluno.status as 'status_aluno',
aluno.whatsapp,
aluno.whatsapp_responsavel,
aluno.senha


FROM
 
aluno 

where
  aluno.nome LIKE '%$pesquisa%'   OR idaluno='$pesquisa'
  ORDER by  aluno.nome asc limit $limite_antigo , $limite_novo");


               // $result_aluno= pesquisar_aluno($conexao,$pesquisa,$codigo_sql );
               $cont=1;
               
               foreach ($result_aluno as $key => $value) {
                $nome_aluno=($value['nome_aluno']);
                $idaluno=$value['idaluno'];
                $data_nascimento=converte_data($value['data_nascimento']);
                $whatsapp=($value['whatsapp']);
                $whatsapp_responsavel=($value['whatsapp_responsavel']);
                $numero="";
                $result.="<tr id='linha$idaluno'>
                      <td>$idaluno</td>
                      <td>
                        <b class='text-success'> $nome_aluno </b> <br> 
                        <b class='text-success'> Data nascimento: $data_nascimento </b> <br> 
                        <b class='text-info'> Contato: $whatsapp | $whatsapp_responsavel </b> <br>  
                      ";
     ############################################################
     #
     #
     
     #
     #
     #
     ############################################################
                  $result.="
                </td>





                <td class = 'text-right'>
                    <div class = 'btn-group text-right'>
                        <button type = 'button' class = 'btn btn-info fs12 dropdown-toggle' data-toggle = 'dropdown' aria-expanded = 'false'> 
                            Declarações
                            <span class = 'caret ml5'></span>
                        </button>
                        <ul class = 'dropdown-menu' role = 'menu'>";
                            
                 
                          
                        if (in_array($idescola, $array_escolas_coordenador) ) { 

                     
                


                          $result.="
                            <li>
                            <form name='declaracao$idaluno' action='declaracao_auxilio_brasil.php' method='post' target='_blank'>
                                <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                <input type='hidden' name='aluno_id' value='$idaluno'>
                                <input type='hidden' name='escola_id' value='$idescola'>
                                <input type='hidden' name='turma_id' value='$idturma'>
                                <input type='hidden' name='serie_id' value='$idserie'>
                                <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                <input type='hidden' name='tipo_declaracao' value='Declarações Auxílio Brasil'>
                                
                                <button type='submit' class='dropdown-item'  >Declarações Auxílio Brasil</button>
                         
                            </form>
                            </li>";         

                            if ($idserie<3 || $idserie==7 || $idserie ==11 || $idserie==15) {
                              // code...
                               $result.="
                              <li>
                              <form name='declaracao$idaluno' action='imprimir_declaracao_terminalidade.php' method='post' target='_blank'>
                                  <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                  <input type='hidden' name='idaluno[]' value='$idaluno'>
                                  <input type='hidden' name='escola_id' value='$idescola'>
                                  <input type='hidden' name='turma_id' value='$idturma'>
                                  <input type='hidden' name='serie_id' value='$idserie'>
                                  <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                  
                                  
                                  <button type='submit' class='dropdown-item'  >Declaração de terminalidade </button>
                           
                              </form>
                              </li>";

                            }

                          $result.="
                            <li>
                            <form name='declaracao$idaluno' action='declaracao.php' method='post' target='_blank'>
                                <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                <input type='hidden' name='aluno_id' value='$idaluno'>
                                <input type='hidden' name='escola_id' value='$idescola'>
                                <input type='hidden' name='turma_id' value='$idturma'>
                                <input type='hidden' name='serie_id' value='$idserie'>
                                <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                <input type='hidden' name='tipo_declaracao' value='Atestado de Frequência'>
                                <button type='submit' class='dropdown-item'  >Declaração Frequência</button>
                         
                            </form>
                            </li>";                        

                            // $result.="
                            // <li>
                            // <form name='declaracao$idaluno' action='declaracao.php' method='post' target='_blank'>
                            //     <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                            //     <input type='hidden' name='aluno_id' value='$idaluno'>
                            //     <input type='hidden' name='escola_id' value='$idescola'>
                            //     <input type='hidden' name='turma_id' value='$idturma'>
                            //     <input type='hidden' name='serie_id' value='$idserie'>
                            //     <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                            //     <button type='submit' class='dropdown-item'  >Declarações Bolsa Família</button>
                         
                            // </form>
                            // </li>";
                          
                           
                          }
                            
                           $result.="
                        </ul>
                    </div>
                </td>";
                
                
                // **************************************************************
                  $result.="
                      <td class = 'text-right'>
                          <div class = 'btn-group text-right'>
                              <button type = 'button' class = 'btn btn-primary fs12 dropdown-toggle' data-toggle = 'dropdown' aria-expanded = 'false'> 
                                  Opções
                                  <span class = 'caret ml5'></span>
                              </button>
                              <ul class = 'dropdown-menu' role = 'menu'>
                                  
                                  <li>
                                    <a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma'  target='_blank' class='dropdown-item'  > Boletim atual </a> </b>
                                  </li>";

                                  if ($detectar_ultimo==0) {
                                   $result.= "
                                   <li>
                                    <a class='dropdown-item' onclick='excluir_aluno($idaluno);'> Excluir </a> </b>
                                  </li>";
                                  }

                                // if ($calendario_ano2 !='2021') {
                                 if ($calendario_ano !=$_SESSION['ano_letivo_vigente'] || ($calendario_ano ==$_SESSION['ano_letivo_vigente'] && $matricula_situacao !="MATRICULADO")) {

                                  $result.="
                                    <li>
                                    <!-- form name='form$idaluno' action='rematricular_aluno.php' method='post' target='_blank'>
                                        <input type='hidden' name='aluno_id' value='$idaluno'>
                                        <input type='hidden' name='escola_id' value='$idescola'>
                                        <input type='hidden' name='turma_id' value='$idturma'>
                                        <input type='hidden' name='serie_id' value='$idserie'>
                                        <input type='hidden' name='nome_aluno' value='$nome_aluno' -->

                                        <!-- button type='submit' class='dropdown-item'  >Rematricular </button -->
                                        <a   class='dropdown-item' data-toggle='modal' data-target='#modal_rematricula$idaluno' >Rematricular </a>
                                  
                                    <!--/form>
                                    </li -->";
                                }
                                
                              if (in_array($idescola, $array_escolas_coordenador) ) { 

                                
                                $result.="
                                  <li>
                                  <form name='editar$idaluno' action='editar-aluno.php' method='post' >
                                      <input type='hidden' name='aluno_id' value='$idaluno'>
                                      <input type='hidden' name='escola_id' value='$idescola'>
                                      <input type='hidden' name='turma_id' value='$idturma'>
                                      <input type='hidden' name='serie_id' value='$idserie'>
                                      <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                      <button type='submit' class='dropdown-item'  >Editar dados</button>
                               
                                  </form>
                                  </li>";        

                                  $result.="
                                  <li>
                                  <form name='form$idaluno' action='registra_nota_fora_rede.php' method='post' target='_blank'>
                                      <input type='hidden' name='aluno_id' value='$idaluno'>
                                      <input type='hidden' name='escola_id' value='$idescola'>
                                      <input type='hidden' name='turma_id' value='$idturma'>
                                      <input type='hidden' name='serie_id' value='$idserie'>
                                      <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                      <button type='submit' class='dropdown-item'  >Notas fora da rede</button>
                               
                                  </form>
                                  </li>";


                                $result.="
                                  <li>
                                  <form name='declaracao$idaluno' action='declaracao.php' method='post' target='_blank'>
                                      <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                      <input type='hidden' name='aluno_id' value='$idaluno'>
                                      <input type='hidden' name='escola_id' value='$idescola'>
                                      <input type='hidden' name='turma_id' value='$idturma'>
                                      <input type='hidden' name='serie_id' value='$idserie'>
                                      <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                      <button type='submit' class='dropdown-item'  >Declarações</button>
                               
                                  </form>
                                  </li>";
                                  if ($idserie>2) {

                                      
                                      $result.="
                                        <li>
                                            <a href ='historico_aluno.php?idaluno=$idaluno&idserie=$idserie&idescola=$idescola' class='dropdown-item' target='_blank' >Histórico</a>
                                        </li>";
                                  }
                                }
                                  
                                 $result.="
                              </ul>
                          </div>
                      </td>";
            
                     
                      

                    $result.="</tr>";
                  $cont++;
               }


          $result.="</tbody>
          </table>
        </div>
      ";



      echo $result;

  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET $e<br>";
  }
