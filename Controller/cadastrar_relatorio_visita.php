<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['idfuncionario'])) {
    //header("location:index.php?status=0");
} else {
    $idcoordenador = $_SESSION['idfuncionario'];
}

print_r($_SESSION);

include_once '../Controller/Conversao.php';

if (!isset($_SESSION['usuariobd'])) {
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_" . $usuariobd . ".php";
include_once '../Model/Coordenador.php';
include_once '../Model/Setor.php';
include_once '../Model/Chamada.php';
include_once '../Model/Escola.php';

$escola_id = $_POST['escola_id'] ?? null;
$situacao_resolvida = $_POST['situacao_resolvida'] ?? null;
$funcionario_id = $_POST['funcionario_id'] ?? null;
$objetivo_visita = $_POST['objetivo_visita'] ?? null;
$data_hora_visita = $_POST['data_hora_visita'] ?? null;
$relatorio_visita = $_POST['relatorio_visita'] ?? null;
$atendido_por = $_POST['atendido_por'] ?? null;
$id_visita = $_POST['id'] ?? null;

try {
    if (!empty($id_visita)) {
        // Excluir visita se 'id_visita' estiver presente
        excluir_visita($conexao, $id_visita);
        $_SESSION['mensagem'] = 'Relatório de visita excluído com sucesso!';
    } else {
        // Cadastrar visita se 'id_visita' não estiver presente
        if (empty($atendido_por)) {
            $_SESSION['mensagem'] = 'O campo "Atendido por" deve ser preenchido!';
            header("Location: ../View/relatorio_visita.php");
            exit();
        }

        $atendido_por = implode(", ", $atendido_por);

        if (empty($escola_id) || empty($situacao_resolvida) || empty($funcionario_id) || empty($objetivo_visita) || empty($data_hora_visita) || empty($relatorio_visita) || empty($atendido_por)) {
            $_SESSION['mensagem'] = 'Todos os campos com * são obrigatórios!';
            header("Location: ../View/relatorio_visita.php");
            exit();
        }

        cadastrar_visita_escola($conexao, $escola_id, $situacao_resolvida, $funcionario_id, $objetivo_visita, $data_hora_visita, $relatorio_visita, $atendido_por);
        $_SESSION['mensagem'] = 'Relatório de visita cadastrado com sucesso!';
    }
} catch (Exception $e) {
    $_SESSION['status'] = 0;
    $_SESSION['erro'] = $e->getMessage();
}

// Redireciona para a página de relatório
header("Location: ../View/relatorio_visita.php");
exit();
