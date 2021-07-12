<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idserie=$_GET['idserie'];
    $idescola=$_GET['idescola'];

    $idturma=$_GET['idturma'];
    $iddisciplina=$_GET['iddisciplina'];
    $data=$_GET['data_frequencia'];
    $aula=$_GET['aula'];
   $result="
   <br>
   <div class='row'>
     <div class='col-sm-1'></div>
     <div class='col-sm-10'>

   ";
    

    $result_disciplinas=$conexao->query("SELECT * FROM ministrada,escola,turma,disciplina where
     ministrada.turma_id=idturma and
     ministrada.disciplina_id=iddisciplina and 
     ministrada.escola_id=idescola and
     ministrada.escola_id=idescola and

     idescola=$idescola and
     professor_id=$professor_id and
     idturma=$idturma 
     order by disciplina_id=$iddisciplina
    ");

    foreach ($result_disciplinas as $key => $value) {
       $disciplina_id=$value['iddisciplina'];
       $nome_disciplina=$value['nome_disciplina'];
    
       if ($iddisciplina==$disciplina_id) {
          $result.="
          <div class='custom-control custom-checkbox'>
              <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' required checked>
              <label for='customCheckbox$disciplina_id' class='custom-control-label'>$nome_disciplina</label>
          </div>";

       } else if ($idserie< 8) {
       

         $resultado=verificar_conteudo_aula_cadastrado_por_data($conexao, $disciplina_id, $idturma, $idescola, $data);
         $marca_disciplina='';

          foreach ($resultado as $key => $value) {
            $marca_disciplina='checked';
          }

        $result.="
        <div class='custom-control custom-checkbox'>
            <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' $marca_disciplina >
            <label for='customCheckbox$disciplina_id' class='custom-control-label'>$nome_disciplina</label>
        </div>";

        
      }
  }
 

 

    $result.="
   </div>
   ";

      $result.="
       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>#</th>
              <th>Aluno</th>
              <th>
              <p><input type='checkbox' id='checkTodos' class='checkbox' name='checkTodos' onclick='seleciona_tudo();'> Selecionar Todos</p>
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

                  $resultado=verificar_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$id,$aula);
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
              <p><input type='checkbox' class='checkbox' name='presenca$id'  value='1' $marcado> Presença ( $aula ) </p>



                      </td>

                    </tr>
                  ";
                  $cont++;
               }

$res_conteu=verificar_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula);

$conteudo_aula="";
foreach ($res_conteu as $key => $value) {
  $conteudo_aula=$value['descricao'];
}

          $result.="</tbody>
          </table>
        </div>
      
      
        <div class='col-sm-12'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Conteúdo da aula</label>
            <textarea class='form-control' id='exampleInputEmail1' rows='5' name='descricao' required>$conteudo_aula</textarea>
          </div>
        </div>



      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>