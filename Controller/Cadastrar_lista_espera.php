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
     
    $res=verificar_cadastro_lista_espera($conexao,$cpf_aluno);
    $conta=0;
    foreach ($res as $key => $value) {
        $conta++;

    }
    if ($conta==0) {
        // code...
        cadastrar_lista_espera($conexao,$nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$idfuncionario);
        echo "certo";
    }else{
        echo "Aluno já possui cadastro de espera na rede municipal! $conta";
    }



} catch (Exception $e) {
    echo "errado $e";
}
?>