<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    include("Conversao.php");
    
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_GET['idescola'];
    $idturma=$_GET['idturma'];
    $iddisciplina=$_GET['iddisciplina'];
    $data=$_GET['data_ocorrencia'];
 

      $result="
       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>#</th>
              <th>Aluno</th>
              <th>
              Descrição
              </th>
            </tr>
          </thead>
          <tbody>";

               // $res_alunos= listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
               $cont=1;
                 if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
                  $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
                }else{
                  $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
                 }

               
               foreach ($res_alunos as $key => $value) {
                  $idaluno=$value['idaluno'];
                  $nome_aluno=utf8_decode($value['nome_aluno']);
                  $nome_turma=($value['nome_turma']);
                  $id=$value['idaluno'];
                  $status_aluno=$value['status_aluno'];
                  $email=$value['email'];
                  $senha=$value['senha'];
                  $data_matricula=$value['data_matricula'];

                  $marcado="";

                  $resultado=verifica_ocorrencia_cadastrada($conexao, $iddisciplina, $idturma, $idescola, $professor_id,$data,$idaluno);
                    $descricao="";
                  foreach ($resultado as $key2 => $value2) {
                      $descricao=$value2['descricao'];
                  }


                  $result.="
                     <tr>
                      <td>$cont</td>

                      <td>
                        <b class='text-success'> $nome_aluno </b> 
                        <input type='hidden' name='aluno_id[]' value='$idaluno'>
                      </td>";



                      if(strtotime($data_matricula) <= strtotime($data)){
                        $result.="
                                     <td> 
                                     <input type='hidden' name='aluno_id[]' value='$idaluno'>
                                     <label>Ocorrência</label>
                                         <textarea class='form-control' name='ocorrencia$idaluno'>$descricao</textarea>

                                    <div class='form-group'>
                                        <label for='comportamento'>Escolha opção da ocorrência :</label>
                                        <div class='form-check'>
                                            <input type='radio' class='form-check-input' id='bomComportamento' name='comportamento' value='justificativa' checked>
                                            <label class='form-check-label' for='bomComportamento'>Justificativa de Falta</label>
                                        </div>
                                        <div class='form-check'>
                                            <input type='radio' class='form-check-input' id='mauComportamento' name='comportamento' value='comportamento'>
                                            <label class='form-check-label' for='mauComportamento'>Comportamento</label>
                                        </div>
                                    </div>

                                      
                                     </td>    
                                    ";
                      }else{
                        $result.="
                        <td>
                        <b class='text-danger'>Nessa data o aluno não estava na turma. Data matrícula: ".converte_data($data_matricula)."</b>
                        </td>
                                       ";
                      }
                     
                   

                    $result.="</tr>
                  ";
                  $cont++;
               }


          $result.="</tbody>
          </table>
        </div>

      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>