<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_GET['idescola'];
    $idturma=$_GET['idturma'];
    $iddisciplina=$_GET['iddisciplina'];
    $data=$_GET['data_frequencia'];
 

      $result="
       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>#</th>
              <th>Aluno</th>
              <th>
              <div class='custom-control custom-checkbox' >

                  <input class='custom-control-input'  type='checkbox' id='marcartodos' onclick='marcarDesmarcarChecbox();' >
                  <label for='marcartodos' class='custom-control-label' onclick='marcarDesmarcarChecbox();'></label>
                </div>
              </th>
            </tr>
          </thead>
          <tbody>";

               $result_aluno= listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
               $cont=1;
               
               foreach ($result_aluno as $key => $value) {
                $nome_aluno=utf8_decode($value['nome_aluno']);
                $nome_turma=($value['nome_turma']);
                $id=$value['idaluno'];
                $status_aluno=$value['status_aluno'];
                $email=$value['email'];
                $senha=$value['senha'];
                $marcado="";

                  $resultado=verificar_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$id);
                    foreach ($resultado as $key2 => $value2) {
                      $marcado='checked';
                    }


                  $result.="
                     <tr>
                      <td>$cont</td>

                      <td>
                        <b class='text-success'> $nome_aluno </b> 
                        <input type='hidden' name='aluno_id[]' value='$id'>
                      </td>
                     
                      <td> 
                      <div class='custom-control custom-checkbox'>
                          <input class='custom-control-input checkbox1' name='presenca$id' type='checkbox' id='customCheckbox$id' value='1' $marcado>
                          <label for='customCheckbox$id' class='custom-control-label'>Presença</label>
                        </div>
                      </td>

                    </tr>
                  ";
                  $cont++;
               }

$res_conteu=verificar_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data);

$conteudo_aula="";
foreach ($res_conteu as $key => $value) {
  $conteudo_aula=$value['descricao'];
}

          $result.="</tbody>
          </table>
        </div>
      
      
        <div class='col-sm-12'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Contéudo da aula</label>
            <textarea class='form-control' id='exampleInputEmail1' rows='5' name='descricao' required>$conteudo_aula</textarea>
          </div>
        </div>
        <script type='text/javascript'>
  setTimeout('marcarDesmarcarChecbox()',100);
</script>
      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>