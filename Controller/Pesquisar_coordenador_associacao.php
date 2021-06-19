<?php
    include("../Model/Conexao.php");
    include("../Model/Coordenador.php");
    include("../Model/Escola.php");
    

try {

$pesquisa = $_GET["pesquisa"];
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
  $nome=$value['nome'];
  $return.="
    <tr style='background-color:#BDB76B'>
      <td>
        <b>$nome</b><br>
        Login: $login
      </td>

      <td>
       <a href='#fica$idfuncionario' onclick='listar_opcao_associacao_coordenador($idfuncionario);' name='fica$idfuncionario' class='btn btn-primary'>Associar a escola</a>

       <a href='#excluir$idfuncionario' onclick='excluir_coordenador($idfuncionario);' name='excluir$idfuncionario' class='btn btn-danger'>Excluir coordenador</a>
      </td>
      
    </tr>
  ";

      $result_pesquisa =escola_associada($conexao,$idfuncionario);
       foreach ($result_pesquisa as $key => $value) {
    
          $nome_escola = $value['nome_escola'];
          
          
          $return.="<tr>
                          <td class = ''> 
                          <b class = 'text-danger'>$nome_escola  </b>
                        
                          <br>
                             
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