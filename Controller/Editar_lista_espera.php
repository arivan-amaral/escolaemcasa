<?php 
 session_start();
 if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
 include_once '../Model/Aluno.php';
 include_once 'Conversao.php';
 
try {
    $idfuncionario=$_SESSION['idfuncionario'];

    $nome_aluno=$_POST['nome_aluno'];
    $cpf_aluno=converte_telefone($_POST['cpf_aluno']);
    $data_nascimento=$_POST['data_nascimento'];
    $nome_responsavel=$_POST['nome_responsavel'];
    $cpf_responsavel=converte_telefone($_POST['cpf_responsavel']);
    $telefone=converte_telefone($_POST['telefone']);
    $endereco=$_POST['endereco'];
    $escola_id=$_POST['escola_id'];
    $serie_id=$_POST['serie_id'];

    if (empty($_POST['observacao'])) {
        $observacao=NULL;
    }else{
        $observacao=$_POST['observacao'];

    }
    $id=$_POST['id'];
     
 
        // code...
        editar_lista_espera($conexao,$nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$idfuncionario,$observacao,$id);
        echo "certo";

    


} catch (Exception $e) {
    echo "errado $e";
    echo "$nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$idfuncionario,$observacao,$id";
}
?>