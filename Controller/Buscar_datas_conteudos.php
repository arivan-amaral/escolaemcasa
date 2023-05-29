<?php 
session_start();
include_once"../Model/Conexao.php";
include_once"../Model/Aluno.php";
include_once"../Model/Professor.php";
include_once"Conversao.php";
try {
	
	
	$ano_letivo=$_SESSION['ano_letivo'];
	$idprofessor=$_SESSION['idprofessor'];

	$idserie=$_GET['idserie'];
	$seguimento=$_GET['seguimento'];
	$iddisciplina=$_GET['iddisciplina'];
	$idturma=$_GET['idturma'];
	$idescola=$_GET['idescola'];
	$inicio=$_GET['inicio'];
	$fim=$_GET['fim'];

 $result.= "<table class='table table-primary'>
                                        <thead>
                                          <tr>
                                            <th style='width: 10px'>#</th>
                                            <th>Conteúdo</th>
                                            <th>
                                            Opções
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody>";
                                          

                                          if ($idserie<3 || ( $idserie==16 && $seguimento<2 )) {
                                            $iddisciplina="";
                                        
                                            $resultado=listar_conteudo_aula_cadastrado_regente_por_data($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo,$inicio,$fim);
                                          }else{

                                            $resultado=listar_conteudo_aula_cadastrado_por_data($conexao, $iddisciplina, $idturma, $idescola, $idprofessor,$ano_letivo,$inicio,$fim);
                                          }
                                                $conta=1;
                                            foreach ($resultado as $key => $value) {
                                                $professor_id=$value['professor_id'];
                                                
                                                $conteudo_aula_id=$value['id'];
                                               $nome_disciplina="";
                                                if (isset($value['nome_disciplina'])) {
                                                  $nome_disciplina=$value['nome_disciplina'];
                                                }
                                                $data=$value['data'];
                                                $aula=$value['aula'];
                                                $result.="
                                                <tr>
                                                <td>
                                                $conta
                                                <input type='hidden' id='conteudo_aula_id$conta' value='$conteudo_aula_id'>
                                                </td>
                                                  <td>$nome_disciplina $aula - ".converte_data($data)."<br>
                                                  ";
                                                  $res_prof=pesquisar_professor_por_id_status($conexao,$idprofessor);
                                                  foreach ($res_prof as $key => $value) {
                                                    $nome_funcionario=$value['nome'];
                                                    
                                                    $result.="<b>Professor: $idprofessor - $nome_funcionario </b>";
                                                  }

                                                  $result.= "
                                                  </td>
                                                  <td><a onclick='excluir_frequencia($conta);' class='btn btn-danger'>EXCLUIR</a></td>
                                                </tr>";
                                                $conta++;
                                              }



                                       $result.= "  </tbody>
                                  </table>";
     echo "$result";

     } catch (Exception $e) {
     	echo "$e";
     }

?>