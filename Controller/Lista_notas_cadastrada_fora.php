<?php
session_start();
  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
  include_once '../Model/Aluno.php';
  $idaluno=$_GET['idaluno'];

  $result="<div class='col-12'>
                                <div class='card'>
                                  <div class='card-header'>
                                    <h3 class='card-title'><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Registros de notas fora da rede</font></font></h3>

                                    <div class='card-tools'>
                                   
                                    </div>
                                  </div>
                                
                                  <div class='card-body''>
                                    <table class='table'>
                                      <thead>
                                        <tr>
                                          <th>Disciplina</th>
                                          <th>Escola origem</th>
                                      
                                          <th>Escola atual</th>
 
                                          <th>Nota/Média/NF</th>
                                          <th>Opções</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>";
                                        

                                  $res_nota_fora=listar_nota_aluno_fora($conexao,$idaluno);
                                  foreach ($res_nota_fora as $key => $value) {
                                          
                                          $idnota=$value['idnota'];
                                          $nome_aluno=strtoupper($value['nome_aluno']);
                                          $escola_origem=$value['escola_origem'];
                                          $nome_serie=$value['nome_serie'];
                                          $escola_atual=$value['escola_atual'];
                                          $periodo=$value['periodo'];
                                          $tipo_avaliacao=$value['tipo_avaliacao'];
                                          $nome_disciplina=$value['nome_disciplina'];
                                          $nota=$value['nota'];

                                          $result.="
                                            <tr id='$idnota'>
                                              <td> <b> $nome_disciplina </b> </td>
                                              <td> $escola_origem <br>
                                                <b>Ano/Série: $nome_serie</b>
                                               </td>
                                              <td> 
                                                $escola_atual<br>
                                                <b>Périodo: $periodo 
                                              <br>
                                              Tipo avaliacao: $tipo_avaliacao</b> 
                                              </td>

                                              <td><b> $nota </b></td>
                                              <td> <a class='btn btn-danger' onclick='excluir_notas_cadastrada_fora($idnota)';> CANCELAR</A>
                                              </td>
                                              
                                            </tr>";

                                          }
                                         
                                    
                                        
                                      $result.="</tbody>
                                    </table>
                                  </div> 
                             
                                </div>
                               
                              </div>";

                  echo"$result";
?>