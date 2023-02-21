<?php 
session_start();
  include_once '../Model/Conexao.php';
  include_once '../Model/Escola.php';
  include_once '../Model/Turma.php';
  include_once '../Model/Disciplina.php';
  include_once '../Model/Professor.php';
  include_once '../Model/Coordenador.php';
  $idprofessor=$_GET['idprofessor'];
  $res=pesquisar_professor_por_id($conexao,$idprofessor);
  foreach ($res as $key => $value) {
    $idprofessor=$value['idfuncionario'];
    $professor=$value['nome'];
  }
  $idcoordenador=$_SESSION['idfuncionario'];
?>
<br>
<br>
      <div class="row">

        <div class="col-md-1">

        </div>

         <div class="col-md-10">

            <div class="card card-primary">

                  <div class="card-header">

                    <h3 class="card-title">ASSOCIAÇÕES DO FUNCIONÁRIO: <span class="text-warning"><?=$professor?></span></h3>

                  </div>

                  

                  <form action="../Controller/Associar_professor__turma_disciplina.php" method="post">
                    <input type="hidden" name="professor_id" value="<?php echo $idprofessor; ?>">
                    <div class='card-body'>

                
                      
                      <div class='form-group'>
                        <div class='custom-control custom-checkbox'>
                          <input class='custom-control-input' name='mesma_disciplpina' type='checkbox' id='customCheckboxMesmaTurma' value='sim' >
                          <label for='customCheckboxMesmaTurma' class='custom-control-label'>ASSOCIAR MAIS DE 1 PROFESSOR(A) NA MESMA ESCOLA,TURMA E MESMA DISCIPLINA?</label>
                        </div>
                      </div>

                      <label>Selecione a escola</label>

                      <select name='escola'  class="custom-select rounded-0" required>

                        <option></option>

                        <?php 

                        $res_turma=escola_associada($conexao,$idcoordenador); 

                        foreach ($res_turma as $key => $value) {

                            $idescola= $value['idescola'];

                            $nome = ($value['nome_escola']);

                            echo "<option value='$idescola' class='text-black'>$nome</option>";

                          

                        }



                        ?>

                      </select>


                      



                     <label>Selecione a Disciplina </label>

                      <select name='disciplina'  class="custom-select rounded-0" required>

                        <option></option>

                        <?php

                        $res_disciplina=lista_disciplina($conexao); 

                        foreach ($res_disciplina as $key => $value) {

                            $iddisciplina = $value['iddisciplina'];

                            $disciplina = ($value['nome_disciplina']);

                            echo "<option value='$iddisciplina' class='text-black'>$disciplina</option>";

                          

                        }



                        ?>

                      </select>

                       


                      <label>Selecione a série</label>

                      <select name='serie'  class="custom-select rounded-0" onchange="lista_de_turmas(this.value);" required>

                        <option></option>

                        <?php

                        $res_serie=lista_serie($conexao); 

                        foreach ($res_serie as $key => $value) {

                            $id = $value['id'];

                            $nome_serie = ($value['nome']);

                            echo "<option value='$id' class='text-black'>$nome_serie</option>";

                          

                        }



                        ?>

                      </select>

                                
                      <div id="lista_de_turmas">
                        
                      </div>

                      



                    </div>

                </form>



                </div>

             </div> <!-- </div> class=col- 10 -->

      </div> <!-- </div> row  -->
