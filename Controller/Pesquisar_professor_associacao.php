<?php
session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Professor.php");
    include("../Model/Coordenador.php");
    include("../Model/Turma.php");
    include("../Model/Escola.php");
    include("Conversao.php");
    

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

// $res_calendario=listar_calendario_letivo($conexao);


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
                  <th>Opções</th>
                   
                </tr>
              </thead>

              <tbody>

              
"; 
$conta=1;
foreach ($result as $key => $value) {
  $idfuncionario=$value['idfuncionario'];
  $nome_professor=$value['nome'];
  $whatsapp=$value['whatsapp'];
  $login=$value['email'];
  $senha="";
  if ($_SESSION["nivel_acesso_id"]==100) {
      $senha=$value['senha'];
  }
  $return.="
    <tr style='background-color:#BDB76B'>
      <td>
        <b>$conta</b><br>
        <b>id: $idfuncionario</b><br>
      </td> 

      <td> 
        <b>$nome_professor</b><br>
        <a href='https://api.whatsapp.com/send?phone=$whatsapp&text=Ol%C3%A1%2C%20sou%20do%20suporte%20da%20EDUCA%20LEM%20estou%20entrando%20em%20contato%2C%20pois%20preciso%20tirar%20uma%20d%C3%BAvida%20com%20voc%C3%AA%20sobre%20as%20notas%20lan%C3%A7adas.' >$whatsapp</a><br>
        $login<br>
        $senha

      </td>
      <td>
        <div class = 'btn-group text-right'>
          <button type = 'button' class = 'btn btn-primary fs12 dropdown-toggle' data-toggle = 'dropdown' aria-expanded = 'false'> 
               Mais opções
                <span class = 'caret ml5'></span>
            </button>
            <ul class = 'dropdown-menu' role = 'menu'>
                
                <li>

                <a href='#asso$idfuncionario' onclick='listar_opcao_associacao_professor($idfuncionario);' name='asso$idfuncionario' class='btn btn-block btn-primary'>Associar a turmas</a>
                  
                </li>
<br>
                <li>
                <a href='alterar_dados_funcionario_administracao.php?idfuncionario=$idfuncionario'  class='btn btn-block btn-warning'>Editar dados</a>
                </li>
                <br>
                <li>";
              if ($_SESSION['nivel_acesso_id']>=100) { 
               $return.="
                 <input id='nome_professor$idfuncionario' hidden value='$nome_professor'>
                 <a  onclick='excluir_professor($idfuncionario);' name='pro$idfuncionario' class='btn btn-block btn-danger'>Excluir professor</a>
               ";
              }
              $return.="
              </li> 
              <br>
                <li>";
              if ($_SESSION['nivel_acesso_id']>=100) { 
               $return.="
                
                 <a data-toggle='modal' data-target='#modal-bloquear-funcionario$idfuncionario' class='btn btn-block btn-secondary'>Bloquear acessos</a>
               ";
              }
              $return.="
              </li>
            </ul>
        </div>
      </td>


        <div class='modal fade' id='modal-bloquear-funcionario$idfuncionario'>
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class='modal-header alert alert-danger'>
                <h4 class='modal-title'>BLOQUEAR ACESSOS: $nome_professor!</h4>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>
               <div class='modal-body'>
          ";
            


            // Defina o ano selecionado (você pode ajustar isso de acordo com sua lógica)
            $anoSelecionado = $_SESSION['ano_letivo'];

            // Array com os nomes dos meses
            $meses = [
                1 => 'Janeiro',
                2 => 'Fevereiro',
                3 => 'Março',
                4 => 'Abril',
                5 => 'Maio',
                6 => 'Junho',
                7 => 'Julho',
                8 => 'Agosto',
                9 => 'Setembro',
                10 => 'Outubro',
                11 => 'Novembro',
                12 => 'Dezembro',
            ];

            // Loop para criar checkboxes para cada mês
            foreach ($meses as $numeroMes => $nomeMes) {
                $mesAno = sprintf("%02d/%d", $numeroMes, $anoSelecionado);
                $return.='<input type="checkbox" name="mesesSelecionados[]" value="' . $mesAno . '" id="' . $mesAno . '">';
                $return.= '<label for="' . $mesAno . '">' . $nomeMes . '</label><br>';
            }


         
               $return.=" </div>
            <button type='button' class='btn btn-default' data-dismiss='modal'><font style='vertical-align: inherit;'><font style='vertical-align: inherit;'>Fechar</font></font></button>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

";

 


      
  $return.="
   </tr>
  ";

      $result_pesquisa =lista_minhas_turmas($conexao,$idfuncionario,$_SESSION['ano_letivo']);
       foreach ($result_pesquisa as $key => $value) {
    
          $idministrada = $value['idministrada'];
          $nome_escola = $value['nome_escola'];
          $escola_id = $value['escola_id'];
          $nome_turma = $value['nome_turma'];
          $nome_disciplina = $value['nome_disciplina'];
          
          $return.="<tr id='linha$idministrada'>
                          <td class = ''>
                          </td> 
                          <td> 
                          <b class = 'text-danger'>$nome_escola -> </b>
                          <b class = 'text-success'>$nome_turma -></b>
                          <b class = 'text-primary'>$nome_disciplina</b>
                          <br>
                             
                          </td>
                          <td>";
                     
 
                          if (in_array($escola_id, $array_escolas_coordenador) && ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente'] )) { 
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