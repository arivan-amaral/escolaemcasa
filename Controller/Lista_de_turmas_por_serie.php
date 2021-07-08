<?php
    include("../Model/Conexao.php");
    include("../Model/Turma.php");
    

try {

$serie_id = $_GET["serie_id"];
$result=lista_de_turmas($conexao,$serie_id);
$return="

<div class='row'>
     <div class='col-md-1'>
        </div>
         <div class='col-md-10'>

           <div class='card-body'>

            <table class='table table-bordered'>

              <thead>
                <tr>
                  
                  <th>Turmas</th>
                </tr>
              </thead>

              <tbody>

              
";
foreach ($result as $key => $value) {
  $idturma=$value['idturma'];
  $nome_turma=$value['nome_turma'];
  $return.="
    <tr>
      <td>
      <div class='custom-control custom-checkbox'>
          <input class='custom-control-input' name='idturma[]' type='checkbox' id='customCheckbox$idturma' value='$idturma'>
          <label for='customCheckbox$idturma' class='custom-control-label'>$nome_turma</label>
       </div>

      </td>
      
    </tr>
  ";
}

$return.="
              </tbody>

              </table>

            </div>
        
      </div>
</div>

<div class='card-footer'>
  <button type='submit' class='btn btn-block btn-primary'>Associar </button>
</div>
";
echo $return;
  
} catch (Exception $e) {
    echo "Erro ao listar  $e";
}
?>