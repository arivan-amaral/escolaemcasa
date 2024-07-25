<?php 
 session_start();
 if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
 include_once '../Model/Aluno.php';
 include_once '../Model/Coordenador.php';
 include_once 'Conversao.php';
 
try { 
    $idfuncionario=$_SESSION['idfuncionario'];

   $pesquisa=$_GET['pesquisa'];
    $pesquisa_nome_aluno = $_GET['pesquisa_nome_aluno'];

     $pesquisa_nome_aluno=" AND aluno.nome_aluno LIKE '%$pesquisa_nome_aluno%' ";



    if ($pesquisa=="Todas") {
         $sql_escolas.=" and escola_id != -1 ";
      
     
    }else{
        $sql_escolas.=" and  escola_id = $pesquisa ";
    }
    
    $res_escola= escola_associada($conexao,$idfuncionario);
           $listasid = array();
           foreach ($res_escola as $key => $value) {
               $id=$value['idescola'];
               $listasid[$id]=$id;
           }
  
      

    $result="";
   $res = pesquisa_lista_espera($conexao,$sql_escolas,2500,$pesquisa_nome_aluno);
   $conta=1;
   foreach ($res as $key => $value) {
        $id=$value['id'];
        $escola_id=$value['escola_id'];

        $nome_aluno=$value['nome_aluno'];
        $nome_responsavel=$value['nome_responsavel'];
        $nome_funcionario=$value['nome_funcionario'];
        $nome_serie=$value['nome_serie'];
        $nome_escola=$value['nome_escola'];
        $data_hora=$value['data_hora'];
        $telefone=$value['telefone'];
        $data_nascimento=$value['data_nascimento'];
        $status=$value['status'];
        $observacao=$value['observacao'];
        if ($status==2) {
             $cor_status="class='alert alert-success'";
        }elseif ($status==3){
             $cor_status="class='alert alert-danger'";

        }
        $result.="<tr $cor_status>
            <td>
                $conta
            </td> 
            <td>
                $nome_aluno <br><b>Nascimento: ".
            converte_data($data_nascimento)."</b><br> <b> Idade na  data de corte: ".converte_idade_data_corte($data_nascimento)."  </b>(31/03/".$_SESSION['ano_letivo_vigente'].")
            </td>

            <td>
                $nome_responsavel <br>
               Telefone:  $telefone
            </td>

            <td>
                $nome_escola
            </td>

            <td>
                $nome_serie
            </td>
              <td>
                $observacao
            </td>";

   

            if (in_array($escola_id, $listasid)) {
               $result.="<td>
                   <div class = 'btn-group text-right'>
                       <button type = 'button' class = 'btn btn-info fs12 dropdown-toggle' data-toggle = 'dropdown' aria-expanded = 'false'> 
                           Opções
                           <span class = 'caret ml5'></span>
                       </button>
                       <ul class = 'dropdown-menu' role = 'menu'>
                       
                           <li>
                               <a  class='dropdown-item text-primary' onclick=aceita_recusar_lista_espera($id,2); >Aceitar</a>
                               <a  class='dropdown-item text-danger' onclick=aceita_recusar_lista_espera($id,3); >Recusar</a>
                               <a  class='dropdown-item text-info'  data-toggle='modal' data-target='#modal-lista-espera' onclick='buscar_dados_editar_lista($id);'><b>Editar dados</b></a>
                           </li>
                       </ul>
                   </div>
               </td>";

            }else{
                      $result.="<td></td>";

            }

    $result.="
        </tr>";
                $conta++;
   }

echo $result;
 
} catch (Exception $e) {
    echo "errado $e";
}
?>