<?php
  session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Aluno.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_GET['idescola'];
    $idturma=$_GET['idturma'];
    $iddisciplina=$_GET['iddisciplina'];
    $periodo=$_GET['periodo'];
 

      $result="
       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>#</th>
              <th>Aluno</th>
              <th>
              AV
              </th>
            </tr>
          </thead>
          <tbody>";
if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
  $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
}else{
  $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
 }

$conta=1;
 foreach ($res_alunos as $key => $value) {

  $id=$value['idaluno'];
  $nome_aluno=strtoupper($value['nome_aluno']);
  $nome_turma=$value['nome_turma'];
  $matricula_aluno=$value['matricula'];
  $data_matricula=$value['data_matricula'];
  $marcado="";

        

                  $resultado=verificar_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$periodo,$id);
                    foreach ($resultado as $key2 => $value2) {
                      $marcado='checked';
                    }


                  $result.="
                     <tr>
                      <td>$cont</td>

                      <td>
                        <b class='text-success'> $nome_aluno </b> 
                        <input type='hidden' name='aluno_id[]' value='$id'><br>

                      </td>
                     
                      <td> 

                      <div class='col-sm-12'>
                        <div class='form-group'>
                          <label for='exampleInputEmail1'>Nota AV</label>
                          <input type='text' class='form-control' name='nota$id' value='0'>
                        </div>
                      </div>

                      </td>

                    </tr>
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