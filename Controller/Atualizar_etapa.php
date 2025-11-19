<?php
// Crie este arquivo em: ../Controller/Atualizar_etapa.php
header('Content-Type: application/json');

// Configuração mínima de erro 
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

session_start();
include_once "../Model/Conexao.php"; // Ajuste o caminho conforme sua estrutura

// Retorna erro se a sessão de BD não puder ser estabelecida
if (!isset($_SESSION['usuariobd'])) {
    echo json_encode(['success' => false, 'message' => 'Sessão BD não definida.']);
    exit();
}

// Inclui o arquivo de conexão PDO (variável $conexao)
$usuariobd = $_SESSION['usuariobd'];

// Verifica a variável $conexao (PDO)
if (!isset($conexao) || !($conexao instanceof PDO)) {
    error_log("Erro no AJAX: Conexão PDO \$conexao não disponível.");
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados.']);
    exit();
}

// 1. Recebe e sanitiza os dados (usando $_POST)
$matricula_codigo = $_POST['matricula_codigo'] ?? null;
$nova_etapa = $_POST['nova_etapa'] ?? null;

// 2. Validação dos dados
if (empty($matricula_codigo) || !is_numeric($nova_etapa)) {
    // Mensagem dinâmica para o erro de validação (exibida por aluno)
    $msg_erro = "Dados inválidos. Verifique Matrícula ou Etapa.";
    
    error_log("Erro de validação no AJAX: " . $msg_erro . " Dados: M=" . $matricula_codigo . ", E=" . $nova_etapa);
    
    // Retorna a mensagem de erro para o AJAX
    echo json_encode(['success' => false, 'message' => $msg_erro]);
    exit();
}

// 3. Executa o UPDATE usando Prepared Statement (PDO)
try {
    $sql_update = "UPDATE `ecidade_matricula` SET `etapa` = :nova_etapa WHERE `matricula_codigo` = :matricula_codigo";
    
    $stmt_update = $conexao->prepare($sql_update);
    
    // Bind dos parâmetros
    $stmt_update->bindParam(':nova_etapa', $nova_etapa, PDO::PARAM_INT);
    // Assumindo que matricula_codigo é a chave primária/código
    $stmt_update->bindParam(':matricula_codigo', $matricula_codigo, PDO::PARAM_STR); 
    
    $stmt_update->execute();
    
    // 4. Retorno de sucesso
    if ($stmt_update->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Atualização realizada com sucesso!']);
    } else {
        // Matrícula não encontrada ou etapa não mudou
        echo json_encode(['success' => true, 'message' => 'Nenhuma alteração realizada (Etapa já estava definida).']);
    }

} catch (PDOException $e) {
    // Em caso de erro de SQL
    error_log("Erro SQL ao atualizar etapa: " . $e->getMessage() . " - Dados: Matricula=" . $matricula_codigo);
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor ao tentar salvar a etapa.']);
}
?>