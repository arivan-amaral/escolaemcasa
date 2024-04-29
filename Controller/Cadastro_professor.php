<?php 
session_start();

if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}

$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Professor.php';
include_once 'Conversao.php';

try {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $whatsapp = "55" . $_POST['whatsapp'];
    $whatsapp = str_replace(' ', '', $whatsapp);
    $whatsapp = str_replace('(', '', $whatsapp);
    $whatsapp = str_replace(')', '', $whatsapp);
    $whatsapp = str_replace('-', '', $whatsapp);
    $cpf = converte_telefone($_POST['cpf']);

    $sql = "SELECT cpf FROM funcionario WHERE cpf = :cpf";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':cpf', $cpf);
    $stmt->execute();
    $resultado = $stmt->fetch();

    if ($resultado) {
        $_SESSION['status'] = 0;
        header("location:../View/cadastro_professor.php?status=cpf_existente");
        exit(); 
    }

    $funcao = ($_POST['sexo'] == "Masculino") ? 'Professor' : 'Professora';
    cadastro_professor($conexao, $nome, $email, $funcao, $whatsapp, $senha, $cpf);
    $_SESSION['status'] = 1;
    header("location:../View/cadastro_professor.php?status=1");
} catch (Exception $e) {
    $_SESSION['status'] = 0;
    header("location:../View/cadastro_professor.php?status=0");
}
?>
