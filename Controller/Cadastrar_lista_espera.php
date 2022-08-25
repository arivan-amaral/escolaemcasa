<?php 
 session_start();
 include '../Model/Conexao.php';
 include '../Model/Aluno.php';
 include 'Conversao.php';
 
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
     

    cadastrar_lista_espera($conexao,$nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$funcionario_id);

    echo "certo";
} catch (Exception $e) {
    echo "errado $e";
}
?>