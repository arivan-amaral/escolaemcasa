<?php
  session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Aluno.php");
    include("Conversao.php");
    

try {
 

 if (isset($_GET['idprofessor'])) {
   $professor_id= $_GET['idprofessor'];
   // code...
 }else{
  
    $professor_id=$_SESSION['idfuncionario'];
 }




    $ano_letivo=$_SESSION['ano_letivo'];

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
    

    // $result_disciplinas=$conexao->query("SELECT *
    //   FROM ministrada
    //   INNER JOIN escola ON ministrada.escola_id = escola.idescola
    //   INNER JOIN turma ON ministrada.turma_id = turma.idturma
    //   INNER JOIN disciplina ON ministrada.disciplina_id = disciplina.iddisciplina
    //   WHERE ministrada.ano = $ano_letivo
    //   AND escola.idescola = $idescola
    //   AND ministrada.professor_id = $professor_id
    //   AND turma.idturma = $idturma
    //   AND disciplina.iddisciplina = $iddisciplina
    //   ORDER BY disciplina.iddisciplina ");

    
    $result_disciplinas=$conexao->query("SELECT * FROM ministrada,escola,turma,disciplina where
     ministrada.turma_id=idturma and
     ministrada.disciplina_id=iddisciplina and 
     ministrada.escola_id=idescola and
     ministrada.escola_id=idescola and
     ministrada.ano=$ano_letivo and

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

        $resultado2=verificar_conteudo_na_data($conexao,$escola_id_bd,$turma_id_bd,$disciplina_id,$professor_id,$data,$aula);
        // 10/03/2022
        // $resultado2=verificar_frequencia_na_data($conexao,$escola_id_bd,$turma_id_bd,$disciplina_id,$professor_id,$data,$aula);
          $marcado2='';
          foreach ($resultado2 as $key22 => $value22) {
            $marcado2='checked';
          }
// $result.=" SELECT * FROM frequencia WHERE

//       data_frequencia='$data' and 
//       disciplina_id=$disciplina_id and 
//       escola_id=$idescola and 
//       aula='$aula' and 
//       turma_id=$idturma group by data_frequencia";

          if ($iddisciplina==$disciplina_id) {
            $result.="
            <div class='custom-control custom-checkbox'>
                <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' required $marcado2>
                <label for='customCheckbox$disciplina_id' class='custom-control-label'>$nome_escola - $nome_turma - $nome_disciplina </label>
            </div>";
          }else{
            $result.="
            <div class='custom-control custom-checkbox'>
                <input class='custom-control-input' name='iddisciplina[]' type='checkbox' id='customCheckbox$disciplina_id' value='$disciplina_id' $marcado2>
                <label for='customCheckbox$disciplina_id' class='custom-control-label'> $nome_escola - $nome_turma - $nome_disciplina .</label>
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

if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
  $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
}else{
  $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
 } 

$cont=1;
 foreach ($res_alunos as $key => $value) {

  $id=$value['idaluno'];
  $nome_aluno=strtoupper($value['nome_aluno']);
  $nome_identificacao_social=strtoupper($value['nome_identificacao_social']);
  $nome_turma=$value['nome_turma'];
  $matricula_aluno=$value['matricula'];
  $data_matricula=$value['data_matricula'];
 
  $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

  
   
  $procedimento="";
   $datasaida="";

  foreach ($res_movimentacao as $key => $value) {
      $datasaida=($value['datasaida']);
      $procedimento=$value['procedimento'];
      if ($datasaida!="") {
        $datasaida=converte_data($datasaida);
      }
  }


                $marcado="";
                if ($idserie<8) {
               
                    $resultado_fre=verificar_frequencia_infantil_fund1($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$id,$aula);

                }else{
                   $resultado_fre=verificar_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$id,$aula);
                }

                    foreach ($resultado_fre as $key2 => $value2) {
                      $marcado='checked';
                    }


                  $result.=" 
                     <tr>
                      <td>$cont</td>

                      <td>
                        <b class='text-success'>$id - $nome_aluno</b> <br>
                        <b class='text-primary'>Nome social:$nome_identificacao_social</b> <br>
                      </td>
                     
                      <td> 
              <p>";
                
 
 
  // Comparando as Datas
  if(strtotime($data_matricula) <= strtotime($data)){
   
    if ($procedimento !="") {
        $result.="<b class='text-danger'>$procedimento | $datasaida </b>";
    }else{
        $result.="<input type='hidden' name='aluno_id[]' value='$id'>
        <input type='checkbox' class='checkbox' name='presenca$id'  value='1' $marcado> Presença </p>
                       ";
    }


  }else{
      $result.="<b class='text-danger'>Nessa data o aluno não estava na turma. Data matrícula: ".converte_data($data_matricula)."</b>
                   ";
  }   


                $result.="
                      </td>

                    </tr>
                  ";
                  $cont++;
               }

$res_conteu=verificar_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula);

$conteudo_aula=" ";
foreach ($res_conteu as $key_con => $value_con) {
  $conteudo_aula=$value_con['descricao'];
}
// $conteudo_aula="$iddisciplina, $idturma, $idescola, $professor_id, $data,$aula";
          $result.="</tbody>
          </table>
        </div>";
      
      
   

        $result.="<div class='col-sm-12'>
          <div class='form-group'>
    
            <textarea class='form-control' id='descricao_conteudo' rows='5' name='descricao' hidden>$conteudo_aula</textarea>
          </div>
        </div>";      
   

        $result.="<div class='col-sm-12'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Conteúdo da aula</label>
            <p>$conteudo_aula</p>
          </div>
        </div>";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET". $e;
  }

?>