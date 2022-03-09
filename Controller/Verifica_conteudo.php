<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Professor.php");
    include("../Model/Aluno.php");
    include("../Model/Disciplina.php");
    include("../Model/Turma.php");
  
try {

$professor_id=$_SESSION['idfuncionario'];
$idprofessor=$_SESSION['idfuncionario'];

$data=$_GET['data'];
$aula=$_GET['aula'];
$array_url=explode('-',$_GET['valor_input']);
$idescola=$array_url[0];
$idturma=$array_url[1];
$iddisciplina=$array_url[2];
$idserie=$array_url[3];
$result="";
$res=pesquisar_disciplina_id($conexao,$iddisciplina);
$disciplina="";
foreach ($res as $key => $value) {
  $disciplina=$value['nome_disciplina'];
  // code...
}

$res2=lista_de_turmas_por_id($conexao,$idturma);
$turma="";
foreach ($res2 as $key => $value) {
  $turma=$value['nome_turma'];
  // code...
}

       $resultado=verificar_conteudo_aula_cadastrado_por_data_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula);
        $marca_disciplina='';
          $campo_origem_conteudo=$idescola."".$idturma."".$iddisciplina."".$idserie;
          $conteudo_aula="";
          $quantidade_aula="";
        foreach ($resultado as $key => $value) {
          $conteudo_aula=$value['descricao'];
          $quantidade_aula=$value['quantidade_aula'];
            
        }

        if ($idserie>2 && $idserie<8) {
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
                <textarea class='form-control mesmo_conteudo_regente' id='descricao_conteudo$idescola$idturma$idserie$iddisciplina' 

                  onkeyup=duplica_texto_em_capos_selecionados('descricao_conteudo$idescola$idturma$idserie$iddisciplina');
          

                  onBlur=duplica_texto_em_capos_selecionados('descricao_conteudo$idescola$idturma$idserie$iddisciplina');


                rows='5' name='descricao$campo_origem_conteudo' required>$conteudo_aula</textarea>

               
              </div>
            </div>";
        }else{


           // id='descricao_conteudo$idescola$idturma$idserie$iddisciplina' 

           //        onkeyup=duplica_texto_em_capos_selecionados('descricao_conteudo$idescola$idturma$idserie$iddisciplina');
          

           //        onBlur=duplica_texto_em_capos_selecionados('descricao_conteudo$idescola$idturma$idserie$iddisciplina');
           //        
           //        
          $result.="
            <div class='col-sm-12' id='campo_inputs$campo_origem_conteudo'>
              <div class='form-group'>
                <label for='exampleInputEmail1'>Conteúdo da aula $turma <font style='color:#8B0000'> => $disciplina </font></label>

                 <!-- b class='text-primary'> Quantidade de aula </b -->
                <select hidden   name='quantidade_aula$campo_origem_conteudo' required>
                    <option value='1'>1</option>
                </select>
                <textarea class='form-control mesmo_conteudo_regente' 




                rows='5' name='descricao$campo_origem_conteudo' required>$conteudo_aula</textarea>

               
              </div>
            </div>";
        }

      echo "$result";
 

  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>