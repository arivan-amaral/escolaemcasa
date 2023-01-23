<?php 
 session_start();
 include_once '../Model/Conexao.php';
 include '../Model/Aluno.php';
 include 'Conversao.php';
 
try {
    $idfuncionario=$_SESSION['idfuncionario'];

   
     
     $sql_escolas=" ";
      
     $conta=0;
     foreach ($res_escola as $key => $value) {
        if ($conta==0) {
             $sql_escolas.=" AND ( "
        }
         $id=$value['idescola']; 
         $sql_escolas.=" OR escola_id = $id ";
        
        $conta++;
     }
    $sql_escolas.=" ) ";

    $result="";
   $res = pesquisa_lista_espera($conexao,$sql_escolas,2500);
   $conta=1;
   foreach ($res as $key => $value) {
        $id=$value['id'];
        $nome_aluno=$value['nome_aluno'];
        $nome_responsavel=$value['nome_responsavel'];
        $nome_funcionario=$value['nome_funcionario'];
        $nome_serie=$value['nome_serie'];
        $nome_escola=$value['nome_escola'];
        $data_hora=$value['data_hora'];
        $telefone=$value['telefone'];
        $status=$value['status'];
        if ($status==2) {
             $cor_status="class='alert alert-success'";
        }
        $result.="<tr $cor_status>
            <td>
                $conta
            </td> 
            <td>
                $nome_aluno
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
                <div class = 'btn-group text-right'>
                    <button type = 'button' class = 'btn btn-info fs12 dropdown-toggle' data-toggle = 'dropdown' aria-expanded = 'false'> 
                        Opções
                        <span class = 'caret ml5'></span>
                    </button>
                    <ul class = 'dropdown-menu' role = 'menu'>
                    
                        <li>
                            <a  class='dropdown-item' onclick='aceita_lista_espera($id);' >Aceitar</a>
                            <a  class='dropdown-item'  >Recusar</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>";
                $conta++;
   }

echo $result;
 
} catch (Exception $e) {
    echo "errado $e";
}
?>