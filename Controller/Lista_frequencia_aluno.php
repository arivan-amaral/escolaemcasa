<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idserie=$_GET['idserie'];
    $idescola=$_GET['idescola'];
    $idescola_get=$_GET['idescola'];

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
       $nome_turma=$value['nome_turma'];
       $nome_escola=$value['nome_escola'];
       $escola_id_bd=$value['escola_id'];
       $turma_id_bd=$value['turma_id'];
    
       if ($escola_id_bd==$idescola_get) {

        $resultado2=verificar_frequencia_na_data($conexao,$escola_id_bd,$turma_id_bd,$disciplina_id,$professor_id,$data,$aula);
          $marcado2='';
          foreach ($resultado2 as $key22 => $value22) {
            $marcado2='checked';
          }

          if ($iddisciplina==$disciplina_id) {
            $result.="
            <div class='custom-control custom-checkbox'>
                <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' required $marcado2>
                <label for='customCheckbox$disciplina_id' class='custom-control-label'>$nome_escola - $nome_turma - $nome_disciplina</label>
            </div>";
          }else{
            $result.="
            <div class='custom-control custom-checkbox'>
                <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' $marcado2>
                <label for='customCheckbox$disciplina_id' class='custom-control-label'> $nome_escola - $nome_turma - $nome_disciplina</label>
            </div>";
          }

       } else if ($idserie< 8) {
       

         // $resultado=verificar_conteudo_aula_cadastrado_por_data($conexao, $disciplina_id, $idturma, $idescola, $data);
         // $marca_disciplina='';

         //  foreach ($resultado as $key => $value) {
         //    $marca_disciplina='checked';
         //  }

        // $result.="
        // <div class='custom-control custom-checkbox'>
        //     <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' $marca_disciplina >
        //     <label for='customCheckbox$disciplina_id' class='custom-control-label'>$nome_disciplina</label>
        // </div>";

        
      }
  }
 

 

    $result.="
   </div>
   ";

      // $result.="
      //   <div class='col-sm-12'>
      //     <div class='col-12'>
      //       <label for='exampleInputEmail1' style='color:red;'>Escolha um conteúdo ou digite outro no campo abaixo das frequências</label>

      //       <select multiple='multiple' id='lista_conteudo' class='form-control' style='height: 180px;'>
      //       ";
      //       $res_cont=$conexao->query("SELECT * FROM conteudo_aula, turma where turma_id=idturma AND escola_id=$idescola and disciplina_id=$iddisciplina and turma.serie_id=$idserie order by conteudo_aula.id desc limit 20");
      //           $conta_cor=1;
      //           foreach ($res_cont as $key_conteudo=> $value_conteudo) {
      //             $descricao_conteudo=$value_conteudo['descricao'];
      //             if ($conta_cor%2==0) {
      //               $result.="<option value='$descricao_conteudo' onclick='colar_conteudo_ja_cadastrados(this.value);'  style='color: white; background-color:#A9A9A9;'> $descricao_conteudo</option>";
      //             }else{
      //               $result.="<option value='$descricao_conteudo' onclick='colar_conteudo_ja_cadastrados(this.value);'  style='color: white; background-color:#6495ED;'> $descricao_conteudo</option>";
      //             }
      //             $conta_cor++;
      //           }

      //       $result.="
      //       </select> 
      //     </div>
      //   </div>";

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
foreach ($res_conteu as $key_con => $value_con) {
  $conteudo_aula=$value_con['descricao'];
}
// $conteudo_aula="$iddisciplina, $idturma, $idescola, $professor_id, $data,$aula";
          $result.="</tbody>
          </table>
        </div>";
      
      
   

        // $result.="<div class='col-sm-12'>
        //   <div class='form-group'>
        //     <label for='exampleInputEmail1'>Conteúdo da aula</label>
        //     <textarea class='form-control' id='descricao_conteudo' rows='5' name='descricao' required>$conteudo_aula</textarea>
        //   </div>
        // </div>";      
   

        $result.="<div class='col-sm-12'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Conteúdo da aula</label>
            <p>$conteudo_aula</p>
          </div>
        </div>";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>