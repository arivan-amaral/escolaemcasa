<?php
session_start();
include '../Model/Conexao.php';
include '../Model/Turma.php';
include '../Model/Aluno.php';



try {
  $idescola=$_GET['escola'];
  $idserie=$_GET['serie'];

  
$result="<div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>TURMAS NA ESCOLA ESCOLHIDA</h3>

         
              </div>
          
              <div class='card-body table-responsive p-0' style='height: 300px;'>
                <table class='table table-head-fixed text-nowrap'>
                  <thead>
                    <tr>
                      <th>Escola</th>
                      <th>Turma</th>
                      <th>Qnt Alunos na turma</th>
                      
                    </tr>
                  </thead>
                  <tbody>";
                 $res= listar_turmas_escola($conexao,$idescola,$idserie);
                 foreach ($res as $key => $value) {
                    $nome_escola=$value['nome_escola'];
                    $nome_turma=$value['nome_turma'];
                    $idturma=$value['idturma'];
                    $quantidade=0;
                    $res_qnt=quantidade_aluno_turma($conexao,$idturma,$idescola);
                    foreach ($res_qnt as $key2 => $value2) {
                      $quantidade=$value2['quantidade'];
                    }
                    $result.="<tr>
                      <td>$nome_escola</td>
                      <td>$nome_turma</td>
                      <td>$quantidade</td>
                    </tr>";
                 }



                $result.=" 
                </tbody>
                </table>
              </div>
  
            </div>
     
          </div>
        </div>";

echo "$result";
} catch (Exception $e) {
  echo 'Erro ao carregar, verifique sua conexão com a internet';
}

?>

