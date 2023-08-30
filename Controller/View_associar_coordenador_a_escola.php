<?php 
  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
  include_once '../Model/Escola.php';
  include_once '../Model/Coordenador.php';
  include_once '../Model/Professor.php';
  $idcoordenador=$_GET['idcoordenador'];
  $res=pesquisar_professor_por_id($conexao,$idcoordenador);
  foreach ($res as $key => $value) {
    $coordenador_id=$value['idfuncionario'];
    $coordenador=$value['nome'];
  }
?>
<br>
<br>
      <div class="row">

        <div class="col-md-1">

        </div>

         <div class="col-md-10">

            <div class="card card-primary">

                  <div class="card-header">

                    <h3 class="card-title">ASSOCIAÇÕES DE COORDENADOR: <span class="text-warning"><?=$coordenador?></span></h3>

                  </div>

                  

                  <form action="../Controller/Associar_coordenador_a_escola.php" method="post">
                    <input type="hidden" name="coordenador_id" value="<?php echo $coordenador_id; ?>">
                    <div class='card-body'>

                      <label>Selecione a escola</label>

                     

                        <?php

                        $res_turma=lista_escola($conexao); 

                        foreach ($res_turma as $key => $value) {

                            $idescola= $value['idescola'];

                            $nome = ($value['nome_escola']);
                            $res_ass=verificacao_de_associacao($conexao,$coordenador_id,$idescola);
                            $associada='';
                            foreach ($res_ass as $key => $value) {
                              $associada='checked';    
                            }
                            echo "
                              <div class='form-group'>
                                <div class='custom-control custom-checkbox'>
                                  <input class='custom-control-input' name='escola_id[]' type='checkbox' id='customCheckbox$idescola' value='$idescola' $associada>
                                  <label for='customCheckbox$idescola' class='custom-control-label'>$nome</label>
                                </div>
                              </div>

                            ";

                          

                        }



                        ?>

                     
<br>
<br>

         <button type="submit" class="btn btn-block btn-primary">CONCLUIR</button>
        


                    </div>

                </form>



                </div>

             </div> <!-- </div> class=col- 10 -->

      </div> <!-- </div> row  -->
