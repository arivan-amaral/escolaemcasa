<?php session_start();
include'../Model/Conexao.php';
include'../Model/Coordenador.php';
try {
  

$idescola=$_GET['idescola'];

$res=$conexao->query("SELECT 
   idturma,
   serie.id as 'idserie',
   serie.nome as 'nome_serie',
   nome_turma,
   idescola
  FROM ministrada,escola,turma,funcionario,serie WHERE

serie.id= turma.serie_id AND
ministrada.escola_id= escola.idescola AND
ministrada.professor_id= funcionario.idfuncionario and
ministrada.turma_id = turma.idturma AND
escola_id=$idescola GROUP BY turma.idturma
ORDER BY turma.nome_turma
");

$result="";
                        foreach ($res as $key => $value) {

                              $idturma=$value['idturma'];
                              $idserie=$value['idserie'];

                              $nome_serie=$value['nome_serie'];
                              $nome_turma=($value['nome_turma']);
                              $idescola=($value['idescola']);
                              
                              if (isset($_SESSION['idfuncionario']))  {
                              // if (isset($_SESSION['idcoordenador']))  {
                                $result.= "
                                <div class='card card-primary'>

                                 <div class='card-header'>
                                   <h4 class='card-title w-100'>
                                     <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$idturma' aria-expanded='false'> ". $nome_turma ."  <i class='right fas fa-angle-left'></i>
                                     </a>
                                     </h4>
                                 </div>
                                <div id='collapseOne$idturma' class='collapse' data-parent='#accordion' style=''>
                                <div class='card-body'>
                                        <a   href='coordenador_relatorio_video_aluno.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-warning btn-block btn-flat'>
                                          <i class='fa fa-play'></i> 
                                            VER RELATÓRIO DE VÍDEOS DE ALUNO
                                          </a>      
                           
                                        <a   href='listar_alunos_da_turma.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
                                          <i class='fa fa-users'></i> 
                                            LISTAR ALUNOS DA TURMA
                                          </a> 

                                          <a   href='boletim.php?idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-danger btn-block btn-flat'>
                                          <i class='fa fa-calendar'></i> 
                                          BOLETIM
                                          </a>      
                                    ";
                                $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola);

                                foreach ($pes as $chave => $linha) {
                                  $nome_disciplina=($linha['nome_disciplina']);
                                  $iddisciplina=$linha['iddisciplina'];
                                  $nome=$linha['nome'];

                                  $result.= "
                                  
                                        <a   href='ver_conteudo_disciplina.php?iddisciplina=$iddisciplina&idturma=$idturma&nome_disciplina=$nome_disciplina&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat'>
                                          <i class='fa fa-book'></i> 
                                            $nome_disciplina -> $nome
                                          </a>      
                                   
                                  ";
                                } 

                              $result.="
                                  </div>
                                </div>
                              </div>";                  
                              }
                            }
echo "$result";
} catch (Exception $e) {
  
}
?>