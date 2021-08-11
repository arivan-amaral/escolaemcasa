<?php
session_start();
    include("../Model/Conexao.php");
    include("../Model/Professor.php");
    include("../Model/Coordenador.php");
    include("../Model/Turma.php");
    

try {

$pesquisa = $_GET["pesquisa"];
$idfuncionario = $_SESSION["idfuncionario"];
$res_turma=escola_associada($conexao,$idfuncionario); 
$array_escolas_coordenador=array();
$conta_escolas=0;
foreach ($res_turma as $key => $value) {
  $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
  $conta_escolas++;
}

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
                  
                  <th>#</th>
                  <th>Professor</th>
                  <th>Associações</th>
                  <th>Editar</th>
                  <th>Excluir</th>
                </tr>
              </thead>

              <tbody>

              
"; 
$conta=1;
foreach ($result as $key => $value) {
  $idfuncionario=$value['idfuncionario'];
  $nome_professor=$value['nome'];
  $login=$value['email'];
  $senha="";
  if ($_SESSION["nivel_acesso_id"]==100) {
      $senha=$value['senha'];
  }
  $return.="
    <tr style='background-color:#BDB76B'>
      <td>
        <b>$conta</b><br>
      </td> 

      <td>
        <b>$nome_professor</b><br>
        $login<br>
        $senha

      </td>

      <td>

       <a href='#asso$idfuncionario' onclick='listar_opcao_associacao_professor($idfuncionario);' name='asso$idfuncionario' class='btn btn-primary'>Associar a turmas</a>
       </td>

       <td>
       <a href='alterar_dados_funcionario_administracao.php?idfuncionario=$idfuncionario'  class='btn btn-warning'>Editar dados</a>

       <br>
       <br>
       </td>

       <td>
       <input id='nome_professor$idfuncionario' hidden value='$nome_professor'>
       <a  onclick='excluir_professor($idfuncionario);' name='pro$idfuncionario' class='btn btn-danger'>Excluir professor</a>
      </td>
      
    </tr>
  ";

      $result_pesquisa =lista_minhas_turmas($conexao,$idfuncionario);
       foreach ($result_pesquisa as $key => $value) {
    
          $idministrada = $value['idministrada'];
          $nome_escola = $value['nome_escola'];
          $escola_id = $value['escola_id'];
          $nome_turma = $value['nome_turma'];
          $nome_disciplina = $value['nome_disciplina'];
          
          $return.="<tr id='linha$idministrada'>
                          <td class = ''> 
                          <b class = 'text-danger'>$nome_escola -> </b>
                          <b class = 'text-success'>$nome_turma -></b>
                          <b class = 'text-primary'>$nome_disciplina</b>
                          <br>
                             
                          </td>
                          <td>";
                     

                          if (in_array($escola_id, $array_escolas_coordenador)) { 
                            $return.="<a onclick='cancelar_associacao_professor($idministrada);' class='btn btn-danger'> Cancelar </a> ";      
                          }


                          $return.="</td>

                    </tr> ";
      } 
                    $conta++;
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