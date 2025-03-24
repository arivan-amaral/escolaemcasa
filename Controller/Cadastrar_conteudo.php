<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['usuariobd'])) {
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_" . $usuariobd . ".php";
include("../Model/Aluno.php");
include("../Model/Escola.php");
include("Conversao.php");
include("Liberador.php");

try {
    $idfuncionario = $_SESSION['idfuncionario'];

    if (isset($_POST['idprofessor'])) {
        $professor_id = $_POST['idprofessor'];
    }

    $data = $_POST['data_frequencia'];
    $ano_conteudo = $_SESSION['ano_letivo'];
    $aula = $_POST['aula'];
    $url_get = $_POST['url_get'];

    // Verificação para garantir que o campo excluir_conteudo esteja sendo recebido
    if (isset($_POST['excluir_conteudo']) && $_POST['excluir_conteudo'] == 'true') {
        $excluir_conteudo = true;
    } else {
        $excluir_conteudo = false;  // Valor padrão caso não tenha sido enviado
    }

    foreach ($_POST['escola_turma_disciplina'] as $key => $value) {
        $array_url = explode('-', $_POST['escola_turma_disciplina'][$key]);
        $idescola = $array_url[0];
        $idturma = $array_url[1];
        $iddisciplina = $array_url[2];
        $idserie = $array_url[3];
        $campo_origem_conteudo = $idescola . $idturma . $iddisciplina . $idserie;
        $quantidade_aula = $_POST["quantidade_aula$campo_origem_conteudo"];

        if (isset($_POST["descricao$campo_origem_conteudo"])) {
            $descricao = escape_mimic($_POST["descricao$campo_origem_conteudo"]);
        }

        $res_pes_cont_aluno_trasf = pesquisa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $data, $aula);
        $idconteudo = "";
        foreach ($res_pes_cont_aluno_trasf as $key => $value) {
            $idconteudo = $value['id'];

            // Verifica se a exclusão foi solicitada
            if ($excluir_conteudo) {
                excluir_conteudo_aula($conexao, $idconteudo);

                // Verifica se a exclusão ocorreu e registra o log
                if ($idconteudo) {
                    $acao = "Conteúdo excluído  por usuário de id $idfuncionario";
                    registrarLog($conexao, $idfuncionario, $acao);
                }
            } else { 
                // Edição de conteúdo
                editar_conteudo_aula($conexao, $descricao, $idconteudo, $quantidade_aula);

                // Registrar log de edição
                $acao = "Edição de conteúdo existente por usuário de id $idfuncionario";
                registrarLog($conexao, $idfuncionario, $acao);
               

            }
        }

        if ($idconteudo == "") {
            // Cadastro de novo conteúdo
            cadastro_conteudo_aula($conexao, $descricao, $iddisciplina, $idturma, $idescola, $professor_id, $data, $aula, $ano_conteudo, $quantidade_aula, $idfuncionario);
            $conteudo_aula_id = $conexao->lastInsertId();

            // Registrar log de cadastro
            $acao = "Cadastro de conteúdo por usuário de id $idfuncionario";
            registrarLog($conexao, $idfuncionario, $acao);
        }
    }

    $_SESSION['status'] = 1;
    header("location: ../View/cadastrar_conteudo.php?$url_get");
} catch (Exception $e) {
    $_SESSION['status'] = 0;
    $_SESSION['mensagem'] = 'Alguma coisa deu errado!';
    $_SESSION['erro_sql'] = $e;
    echo $e;
}



// Função para excluir o conteúdo da aula
function excluir_conteudo_aula($conexao, $idconteudo) {
    $sql = "DELETE FROM conteudo_aula WHERE id = :idconteudo";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([':idconteudo' => $idconteudo]);
}
