<?php
session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Coordenador.php");
    include("../Model/Escola.php");
    

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


$result=pesquisar_coordenador($conexao, $pesquisa);
$return="

<div class='row'>
     <div class='col-md-1'>
        </div>
         <div class='col-md-10'>

           <div class='card-body'>

            <table class='table table-bordered'>

              <thead>
                <tr>
                  
                  <th>Dados</th>
                  <th>Opção</th>
                </tr>
              </thead>

              <tbody>

              
";
foreach ($result as $key => $value) {
  $idfuncionario=$value['idfuncionario'];
  $login=$value['email'];
  $descricao_funcao=$value['descricao_funcao'];
  $senha="";

  if ($_SESSION["nivel_acesso_id"]==100) {
    $senha=$value['senha'];
  }
  $nome=$value['nome'];

  $return.="
    <tr style='background-color:#BDB76B'>
      <td>
        <b>$nome</b><br>
        <b><font color='red'>$descricao_funcao (a)</font></b><br>
        Login: $login  <br>
        $senha
      </td>

      <td>
       <a href='#fica$idfuncionario' onclick='listar_opcao_associacao_coordenador($idfuncionario);' name='fica$idfuncionario' class='btn btn-primary'>Associar a escola</a>

       <a href='#excluir$idfuncionario' onclick='excluir_coordenador($idfuncionario);' name='excluir$idfuncionario' class='btn btn-danger'>Excluir</a> 

       <a href='editar_coordenador.php?idfuncionario=$idfuncionario'   class='btn btn-secondary'>Editar</a>
      </td>
      
    </tr>
  ";

      $result_pesquisa =escola_associada($conexao,$idfuncionario);
       foreach ($result_pesquisa as $key => $value) {
    
          $idrelacionamento_funcionario_escola = $value['idrelacionamento_funcionario_escola'];
          $nome_escola = $value['nome_escola'];
          $escola_id = $value['escola_id'];
          
          
          $return.="<tr>
                          <td class = ''> 
                          <b class = 'text-danger'>$nome_escola  </b>
                        
                          <br>
                             
                          </td>

                          <td>
                          ";
                     

                          if (in_array($escola_id, $array_escolas_coordenador)) { 
                         $return.="
                          <a onclick='cancelar_associacao_coordenador($idrelacionamento_funcionario_escola);' class='btn btn-danger'> Cancelar </a>";
                          }


                          $return.="
                     
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