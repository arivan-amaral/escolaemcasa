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
    $escola_id=$_POST['escola_associada'];
    $serie_id=$_POST['serie_id'];
    $observacao=$_POST['observacao'];
    $nec_especial=$_POST['nec_especial'];
    $tipo_nec=$_POST['tipo_nec'];

     
    $res=verificar_cadastro_lista_espera($conexao,$cpf_aluno);
    $conta=0;
    foreach ($res as $key => $value) {
        $conta++;

    }
    if ($conta==0) {
        // code...
        cadastrar_lista_espera($conexao,$nome_aluno,$cpf_aluno,$data_nascimento,$nome_responsavel,$cpf_responsavel,$telefone,$endereco,$escola_id,$serie_id,$idfuncionario,$observacao, $nec_especial, $tipo_nec);
        echo "certo";
    }else{
        echo "Aluno já possui cadastro de espera na rede municipal! $conta";
    }



} catch (Exception $e) {
    echo "errado $e";
}
?>