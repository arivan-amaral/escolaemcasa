<?php
  session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Professor.php");
    include("../Model/Aluno.php");
    
 
try {

    $professor_id=$_SESSION['idfuncionario'];
    $idprofessor=$_SESSION['idfuncionario'];


    if (isset($_GET['idprofessor'])) {
      // code...
       $professor_id= $_GET['idprofessor'];
       $idprofessor= $_GET['idprofessor'];
    }else{ 

      $professor_id=$_SESSION['idfuncionario'];
      $idprofessor=$_SESSION['idfuncionario'];


    }

    
    $idserie=$_GET['idserie'];
    $idserie_get=$_GET['idserie'];

    $idescola=$_GET['idescola'];
    $idescola_get=$_GET['idescola'];

    $idturma=$_GET['idturma'];
    $idturma_get=$_GET['idturma'];

    $iddisciplina=$_GET['iddisciplina'];
    $iddisciplina_get=$_GET['iddisciplina'];
    $descricao_escola_turma=$_GET['descricao_escola_turma'];

    $data=$_GET['data_frequencia'];
    $aula=$_GET['aula'];
   $result="
   <br>

     <div class='col-sm-12'>

      <div style='background-color:#B0C4DE; padding:10px;border-radius: 1%;'>
      <b> <font color='blue'>Escolha as turmas que receberão o mesmo conteúdo cadastrado aqui. </font></b>
  
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


      $result_disciplinas=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);

      $conta_marcados=0;
      $total=0;
      $iddisciplina_array=array(); 
      $idturma_array=array(); 
      $idescola_array=array(); 

// if($iddisciplina_get==1000){
//  $result.="
//                 <div class='custom-control custom-checkbox'>
//                 <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$idescola_get$idturma_get$iddisciplina_get$idserie_get' value='$idescola_get-$idturma_get-$iddisciplina_get-$idserie_get'  required onclick='adicinar_campo_conteudo($idescola$idturma_get$iddisciplina_get$idserie_get
//                 )'> 
                
//                 <label for='customCheckbox$idescola_get$idturma_get$iddisciplina_get$idserie_get' class='custom-control-label'  id='label$idescola_get$idturma_get$iddisciplina_get$idserie_get'>
//                  $descricao_escola_turma <font style='color:#8B0000' > - DISCIPLINAS REGENTES </font> </label>
//                 </div>";

// }else{

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
             $resultado=verificar_conteudo_aula_cadastrado_por_data_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula);
              $marca_disciplina='';

              foreach ($resultado as $key => $value) {
                $idturma_verifc=$value['turma_id'];
                $idescola_verifc=$value['escola_id'];
                $iddisciplina_verifc=$value['disciplina_id'];
                  $marca_disciplina='checked';

                if ($idturma_verifc==$idturma_get && $idescola_verifc==$idescola_get && $iddisciplina_verifc==$iddisciplina_get) {
                  $conta_marcados++;
                }
              }

             if ($turma_id==$idturma_get && $escola_id==$idescola_get && $disciplina_id==$iddisciplina_get && $marca_disciplina=='') {

                $result.="
                <div class='custom-control custom-checkbox'>
                <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' value='$escola_id-$turma_id-$disciplina_id-$serie_id' $marca_disciplina  onclick='adicinar_campo_conteudo($escola_id$turma_id$disciplina_id$serie_id)'> 

                <label for='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' class='custom-control-label'  id='label$escola_id$turma_id$disciplina_id$serie_id'> $nome_escola - <font style='color:#8B0000' >$turma -$disciplina</font> </label>
                </div>";

            }else if ($turma_id==$idturma_get && $escola_id==$idescola_get && $disciplina_id==$iddisciplina_get && $marca_disciplina!='') {

                $result.="
                <div class='custom-control custom-checkbox'>
                <input class='custom-control-input check' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' value='$escola_id-$turma_id-$disciplina_id-$serie_id' $marca_disciplina  onclick='adicinar_campo_conteudo($escola_id$turma_id$disciplina_id$serie_id)'>

                <label for='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' id='label$escola_id$turma_id$disciplina_id$serie_id' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
                </div>";

              
            }else {

                $result.="
                <div class='custom-control custom-checkbox'>
                <input class='custom-control-input checkbox ' name='escola_turma_disciplina[]' type='checkbox' id='customCheckbox$escola_id$turma_id$disciplina_id$serie_id' value='$escola_id-$turma_id-$disciplina_id-$serie_id' $marca_disciplina onclick='adicinar_campo_conteudo($escola_id$turma_id$disciplina_id$serie_id)'> 
                <label for='customCheckbox$escola_id$turma_id$disciplina_id$serie_id'   id='label$escola_id$turma_id$disciplina_id$serie_id' class='custom-control-label'> $nome_escola - <font style='color:#8B0000'>$turma -$disciplina</font> </label>
                </div>";
            }





          }
//}//else se disciplina não fr regente



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
            <label for='exampleInputEmail1' style='color:red;'>Escolha um conteúdo ou digite outro no(s) campo(s) abaixo.</label>

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
        


$result.="<div id='conteudos'>  
             <BR>
       ";
      $result_disciplinas2=listar_disciplina_professor($conexao,$idprofessor,$_SESSION['ano_letivo']);

    
    foreach ($result_disciplinas2 as $key => $value) {
        $nome_escola=($value['nome_escola']);
        $turma=($value['nome_turma']);
        $disciplina=($value['nome_disciplina']);
        $iddisciplina=$value['disciplina_id'];
        $idturma=$value['turma_id'];
        $idescola=$value['escola_id'];
        $serie_id=$value['serie_id'];
        $seguimento=$value['seguimento'];

       $resultado=verificar_conteudo_aula_cadastrado_por_data_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula);
        $marca_disciplina='';
          $campo_origem_conteudo=$value['escola_id']."".$value['turma_id']."".$value['disciplina_id']."".$serie_id;
          $conteudo_aula="";
          $quantidade_aula="";
          $conta_conteudo=0;
          $idconteudo='';
        foreach ($resultado as $key => $value) {
          $idconteudo=$value['id'];
          $conteudo_aula=$value['descricao'];
          $quantidade_aula=$value['quantidade_aula'];
          $conta_conteudo++;
        }

        if ($conta_conteudo>0) {
            
          if ($serie_id>2 && $serie_id<8 || ($serie_id==16 && $seguimento <3) ) {
            $result.="
              <div class='col-sm-12' id='campo_inputs$campo_origem_conteudo'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Conteúdo da aula $turma <font style='color:#8B0000'> => $disciplina </font></label>

                   <b class='text-primary'> Quantidade de aula </b>
                  <select    name='quantidade_aula$campo_origem_conteudo' required>
                      <option value='$quantidade_aula'>$quantidade_aula</option>
                      <option value='1'>1</option>
                      <option value='2'>2</option>
                      <option value='3'>3</option>
                      <option value='4'>4</option>

                  </select>
                  
                  <a class='btn btn-danger' onclick='excluir_conteudo($campo_origem_conteudo,$idconteudo);';> Deseja Excluir ?</a>


                  <textarea class='form-control' id='descricao_conteudo' rows='5' name='descricao$campo_origem_conteudo' required>$conteudo_aula</textarea>  

                 
                </div>
              </div>";
          }else if($idserie<3){
            $result.="
              <div class='col-sm-12' id='campo_inputs$campo_origem_conteudo'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Conteúdo da aula $turma <font style='color:#8B0000'> => $disciplina </font></label>

                   <!-- b class='text-primary'> Quantidade de aula </b -->
                  <select hidden   name='quantidade_aula$campo_origem_conteudo' required>
                      <option value='1'>1</option>
                  </select>
                  
                  <a class='btn btn-danger' onclick='excluir_conteudo($campo_origem_conteudo,$idconteudo);';> Deseja Excluir ?</a>


                  <textarea class='form-control mesmo_conteudo_regente' id='descricao_conteudo$idescola$idturma$idserie$iddisciplina' rows='5' name='descricao$campo_origem_conteudo' 

            
               
            
                   required>$conteudo_aula</textarea>   

                 
                </div>
              </div>";


                  // onkeyup=duplica_texto_em_capos_selecionados('descricao_conteudo$idescola$idturma$idserie$iddisciplina');
          

                  // onBlur=duplica_texto_em_capos_selecionados('descricao_conteudo$idescola$idturma$idserie$iddisciplina');

          }else{
            $result.="
              <div class='col-sm-12' id='campo_inputs$campo_origem_conteudo'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Conteúdo da aula $turma <font style='color:#8B0000'> => $disciplina </font></label>

                   <!-- b class='text-primary'> Quantidade de aula </b -->
                  <select hidden   name='quantidade_aula$campo_origem_conteudo' required>
                      <option value='1'>1</option>
                  </select>

                  <input type='hidden' id='mesma_descricao_conteudo$idescola$idturma$serie_id$iddisciplina' value='$serie_id$iddisciplina'>

                  <a class='btn btn-danger' onclick='excluir_conteudo($campo_origem_conteudo,$idconteudo);';> Deseja Excluir ?</a>

                  <textarea class='form-control mesmo_conteudo$serie_id$iddisciplina' 

                  id='descricao_conteudo$idescola$idturma$serie_id$iddisciplina' 

                  name='descricao$campo_origem_conteudo' required>$conteudo_aula</textarea>  
                 
                </div>
              </div>";

               // onkeyup=duplica_texto_em_campos_selecionados_mesmo_conteudo_acima_inicias('descricao_conteudo$idescola$idturma$serie_id$iddisciplina');

               //    onBlur=duplica_texto_em_campos_selecionados_mesmo_conteudo_acima_inicias('descricao_conteudo$idescola$idturma$serie_id$iddisciplina');
          }


            
        }
        
          $conteudo_aula="";
          $conta_conteudo=0;

          
    }

  
 
 



$result.="
  </div>

  </div>



      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>