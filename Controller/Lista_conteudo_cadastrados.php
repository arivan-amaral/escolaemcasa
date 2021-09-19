<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Professor.php");
    include("../Model/Aluno.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];
    $idprofessor=$_SESSION['idfuncionario'];

    $idserie=$_GET['idserie'];
    $idescola=$_GET['idescola'];
    $idescola_get=$_GET['idescola'];

    $idturma=$_GET['idturma'];
    $idturma_get=$_GET['idturma'];
    $iddisciplina=$_GET['iddisciplina'];
    $iddisciplina_get=$_GET['iddisciplina'];
    $data=$_GET['data_frequencia'];
    $aula=$_GET['aula'];
   $result="
   <br>

     <div class='col-sm-12'>

      <div style='background-color:#B0C4DE; padding:10px;border-radius: 1%;''>
      <b> <font color='blue'>Escolha as turma que receberão o mesmo conteúdo cadastrado aqui. </font></b>
  
   ";
    

    // $result_disciplinas=$conexao->query("SELECT * FROM ministrada,escola,turma,disciplina where
    //  ministrada.turma_id=idturma and
    //  ministrada.disciplina_id=iddisciplina and 
    //  ministrada.escola_id=idescola and
    //  ministrada.escola_id=idescola and

    //  idescola=$idescola and
    //  professor_id=$professor_id and
    //  idturma=$idturma 
    //  order by disciplina_id=$iddisciplina
    // ");


      $result_disciplinas=listar_disciplina_professor($conexao,$idprofessor);

      $conta_marcados=0;
      $total=0;
      foreach ($result_disciplinas as $key => $value) {

        $disciplina=($value['nome_disciplina']);
        $nome_escola=($value['nome_escola']);
        $turma=($value['nome_turma']);


        $idescola=($value['idescola']);
        $iddisciplina=$value['iddisciplina'];
        $idturma=$value['idturma'];
        $idserie=$value['serie_id']; 

        $escola_id=($value['idescola']);
        $disciplina_id=$value['iddisciplina'];
        $turma_id=$value['idturma'];
        $serie_id=$value['serie_id'];
         //if ($idturma==$idturma_get && $idescola==$idescola_get && $iddisciplina=$iddisciplina_get) {
            // $result.="
            // <div class='custom-control custom-checkbox'>
            // <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$idturma$idescola$iddisciplina' value='$idescola+$idturma+$iddisciplina+$idserie' required >
            // <label for='customCheckbox$idturma$idescola$iddisciplina' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
            // </div>";
         // }else{
             $resultado=verificar_conteudo_aula_cadastrado_por_data($conexao, $iddisciplina, $idturma, $idescola, $data);
              $marca_disciplina='';
              foreach ($resultado as $key => $value) {
                $idturma_verifc=$value['turma_id'];
                $idescola_verifc=$value['escola_id'];
                $iddisciplina_verifc=$value['disciplina_id'];
                  $marca_disciplina='checked';

                if ($idturma_verifc==$idturma_get && $idescola_verifc==$idescola_get && $iddisciplina_verifc=$iddisciplina_get) {
                  $conta_marcados++;
                }
              }

             if ($idturma==$idturma_get && $idescola==$idescola_get && $iddisciplina=$iddisciplina_get && $marca_disciplina=='') {

                $result.="
                <div class='custom-control custom-checkbox'>
                <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' value='$escola_id+$turma_id+$disciplina_id+$serie_id' $marca_disciplina required> 
                <label for='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
                </div>";
            }else if ($idturma==$idturma_get && $idescola==$idescola_get && $iddisciplina=$iddisciplina_get && $marca_disciplina!='') {

                $result.="
                <div class='custom-control custom-checkbox'>
                <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' value='$escola_id+$turma_id+$disciplina_id+$serie_id' $marca_disciplina required>
                <label for='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
                </div>";
            }else {

                $result.="
                <div class='custom-control custom-checkbox'>
                <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' value='$escola_id+$turma_id+$disciplina_id+$serie_id' $marca_disciplina> 
                <label for='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
                </div>";
            }





          }

    // }


  //   foreach ($result_disciplinas as $key => $value) {
  //      $disciplina_id=$value['iddisciplina'];
  //      $nome_disciplina=$value['nome_disciplina'];
    
  //      if ($iddisciplina==$disciplina_id) {
  //         $result.="
  //         <div class='custom-control custom-checkbox'>
  //             <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' required checked>
  //             <label for='customCheckbox$disciplina_id' class='custom-control-label'>$nome_disciplina</label>
  //         </div>";

  //      } else if ($idserie< 8) {
  //        $resultado=verificar_conteudo_aula_cadastrado_por_data($conexao, $disciplina_id, $idturma, $idescola, $data);
  //        $marca_disciplina='';

  //         foreach ($resultado as $key => $value) {
  //           $marca_disciplina='checked';
  //         }

  //       $result.="
  //       <div class='custom-control custom-checkbox'>
  //           <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' $marca_disciplina >
  //           <label for='customCheckbox$disciplina_id' class='custom-control-label'>$nome_disciplina</label>
  //       </div>";

        
  //     }
  // }
 

 

    $result.="
    </div>
        <br>
        <br>
   
  
   ";

      $result.="
        

        <div class='col-sm-12'>
            <label for='exampleInputEmail1' style='color:red;'>Escolha um conteúdo ou digite outro no campo abaixo das frequências</label>

            <select multiple='multiple' id='lista_conteudo' class='form-control' style='height: 180px;'>
            ";
            $res_cont=$conexao->query("SELECT * FROM conteudo_aula, turma where turma_id=idturma AND escola_id=$idescola and disciplina_id=$iddisciplina and turma.serie_id=$idserie order by conteudo_aula.id desc limit 20");
                $conta_cor=1;
                foreach ($res_cont as $key_conteudo=> $value_conteudo) {
                  $descricao_conteudo=$value_conteudo['descricao'];
                  if ($conta_cor%2==0) {
                    $result.="<option value='$descricao_conteudo' onclick='colar_conteudo_ja_cadastrados(this.value);'  style='color: white; background-color:#A9A9A9;'> $descricao_conteudo</option>";
                  }else{
                    $result.="<option value='$descricao_conteudo' onclick='colar_conteudo_ja_cadastrados(this.value);'  style='color: white; background-color:#6495ED;'> $descricao_conteudo</option>";
                  }
                  $conta_cor++;
                }



            $result.="
            </select> 
          </div>
     
<br>
<br>
<br>
        ";
          // $result.="
       // <div class='card-body'>
       //  <table class='table table-bordered'>
       //    <thead>
       //      <tr>
       //        <th style='width: 10px'>#</th>
       //        <th>Aluno</th>
       //        <th>
       //        <p><input type='checkbox' id='checkTodos' class='checkbox' name='checkTodos' onclick='seleciona_tudo();'> Selecionar Todos</p>
       //        </th>
       //      </tr>
       //    </thead>
       //    <tbody>";

              //  $result_aluno= listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
              //  $cont=1;
               
              //  foreach ($result_aluno as $key => $value) {
              //   $nome_aluno=utf8_decode($value['nome_aluno']);
              //   $nome_turma=($value['nome_turma']);
              //   $id=$value['idaluno'];
              //   $status_aluno=$value['status_aluno'];
              //   $email=$value['email'];
              //   $senha=$value['senha'];
              //   $marcado="";

              //     $resultado=verificar_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$id,$aula);
              //       foreach ($resultado as $key2 => $value2) {
              //         $marcado='checked';
              //       }


              //     $result.=" 
              //        <tr>
              //         <td>$cont</td>

              //         <td>
              //           <b class='text-success'> $nome_aluno </b> 
              //           <input type='hidden' name='aluno_id[]' value='$id'>
              //         </td>
                     
              //         <td> 
              // <p><input type='checkbox' class='checkbox' name='presenca$id'  value='1' $marcado> Presença ( $aula ) </p>



              //         </td>

              //       </tr>
              //     ";
              //     $cont++;
              //  }

$res_conteu=verificar_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula);

$conteudo_aula="";
foreach ($res_conteu as $key => $value) {
  $conteudo_aula=$value['descricao'];
}

          // $result.="</tbody>
          // </table>";
// if ($conta_marcados==0) {
//   $conteudo_aula="";
// }
          $result.="
   <BR>
       </div>

        <div class='col-sm-12'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Conteúdo da aula</label>
            <textarea class='form-control' id='descricao_conteudo' rows='5' name='descricao' required>$conteudo_aula</textarea>
          </div>
        </div>

        </div>



      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>