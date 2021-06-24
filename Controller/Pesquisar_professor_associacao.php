<?php
    include("../Model/Conexao.php");
    include("../Model/Professor.php");
    include("../Model/Turma.php");
    

try {

$pesquisa = $_GET["pesquisa"];
$result=pesquisar_professor_associacao($conexao,$pesquisa);
$return="

<div class='row'>
     <div class='col-md-1'>
        </div>
         <div class='col-md-10'>

           <div class='card-body'>

            <table class='table table-bordered'>

              <thead>
                <tr>
                  
                  <th>Professor</th>
                  <th>Opção</th>
                </tr>
              </thead>

              <tbody>

              
";
foreach ($result as $key => $value) {
  $idfuncionario=$value['idfuncionario'];
  $nome_professor=$value['nome'];
  $login=$value['email'];
  $return.="
    <tr style='background-color:#BDB76B'>
      <td>
        <b>$nome_professor</b><br>
        $login

      </td>

      <td>

       <a href='#fica$idfuncionario' onclick='listar_opcao_associacao_professor($idfuncionario);' name='fica$idfuncionario' class='btn btn-primary'>Associar a turmas</a>
       <br>
       <br>
       <a href='alterar_dados_funcionario_administracao.php?idfuncionario=$idfuncionario'  name='fica$idfuncionario' class='btn btn-warning'>Editar dados</a>
      </td>
      
    </tr>
  ";

      $result_pesquisa =lista_minhas_turmas($conexao,$idfuncionario);
       foreach ($result_pesquisa as $key => $value) {
    
          $idministrada = $value['idministrada'];
          $nome_escola = $value['nome_escola'];
          $nome_turma = $value['nome_turma'];
          $nome_disciplina = $value['nome_disciplina'];
          
          $return.="<tr>
                          <td class = ''> 
                          <b class = 'text-danger'>$nome_escola -> </b>
                          <b class = 'text-success'>$nome_turma -></b>
                          <b class = 'text-primary'>$nome_disciplina</b>
                          <br>
                             
                          </td>
                          <td>
                           <a onclick='cancelar_associacao_professor($idministrada);' class='btn btn-danger'> Cancelar </a> 
                          </td>

                    </tr>
                          ";
      } 
}

$return.="
              </tbody>

              </table>

            </div>
        
      </div>
</div>
";
echo $return;
  
} catch (Exception $e) {
    echo "Erro ao pesquisar Professor= $e";
}
?>