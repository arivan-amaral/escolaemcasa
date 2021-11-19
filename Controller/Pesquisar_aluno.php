<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $pesquisa=$_GET['pesquisa'];

      $result="
       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>Matrícula</th>
              <th>Aluno</th>
              <th>
              Opções
              </th>
            </tr>
          </thead>
          <tbody>";

               $result_aluno= pesquisar_aluno($conexao,$pesquisa );
               $cont=1;
               
               foreach ($result_aluno as $key => $value) {
                $nome_aluno=utf8_decode($value['nome']);
                $nome_turma=($value['nome_turma']);
                $idaluno=$value['idaluno'];
                $matricula=$value['matricula'];
                $nome_escola=$value['nome_escola'];
				$numero="";

				$idescola=$value['idescola'];
				$idturma=$value['idturma'];

				$idserie=$value['idserie'];


                  $result.="
                     <tr>
                      <td>$matricula</td>

                      <td>
                        <b class='text-success'> $nome_aluno </b> <br> 
                        <b class='text-danger'> $nome_escola -</b> <b class='text-primary'>$nome_turma </b> 
                      </td>
                      
                      <td>
                        <a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma' class='d-block w-100 collapsed' > BOLETIM </a> </b> 
                      </td>
                     
                      

                    </tr>";
                  $cont++;
               }


          $result.="</tbody>
          </table>
        </div>
      ";

      echo $result;

  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET $e";
  }

?>