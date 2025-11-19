<?php
include_once"../Model/Conexao.php";
header('Content-Type: application/json');

// Configuração mínima de erro (pode ser ajustada)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

session_start();

// Retorna erro se a conexão não puder ser estabelecida ou dados estiverem faltando
if (!isset($_SESSION['usuariobd'])) {
    echo json_encode(['success' => false, 'message' => 'Sessão BD não definida.']);
    exit();
}

// Inclui o arquivo de conexão PDO (variável $conexao)
$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_" . $usuariobd . ".php";

// Verifica a variável $conexao (PDO)
if (!isset($conexao) || !($conexao instanceof PDO)) {
    // Registra o erro antes de retornar
    error_log("Erro no AJAX: Conexão PDO \$conexao não disponível.");
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados.']);
    exit();
}

// 1. Recebe e sanitiza os dados
$matricula_codigo = $_POST['matricula_codigo'] ?? null;
$nova_etapa = $_POST['nova_etapa'] ?? null;

// Validação dos dados
if (empty($matricula_codigo) || !is_numeric($nova_etapa)) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos ou incompletos.']);
    exit();
}

// 2. Executa o UPDATE usando Prepared Statement (PDO)
try {
    $sql_update = "UPDATE `ecidade_matricula` SET `etapa` = :nova_etapa WHERE `matricula_codigo` = :matricula_codigo";
    
    $stmt_update = $conexao->prepare($sql_update);
    
    // Bind dos parâmetros
    $stmt_update->bindParam(':nova_etapa', $nova_etapa, PDO::PARAM_INT);
    $stmt_update->bindParam(':matricula_codigo', $matricula_codigo, PDO::PARAM_STR); // Assumindo que matricula_codigo é string
    
    $stmt_update->execute();
    
    // Verifica se alguma linha foi afetada
    if ($stmt_update->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Atualização realizada com sucesso!']);
    } else {
        // Se 0 linhas afetadas, pode ser que já estivesse com aquela etapa ou matrícula não encontrada
        echo json_encode(['success' => true, 'message' => 'Nenhuma alteração realizada (Etapa já estava definida ou Matrícula não encontrada).']);
    }

} catch (PDOException $e) {
    // Em caso de erro de SQL, registra e retorna uma mensagem genérica para o frontend
    error_log("Erro SQL ao atualizar etapa: " . $e->getMessage() . " - Dados: Matricula=" . $matricula_codigo . ", Etapa=" . $nova_etapa);
    echo json_encode(['success' => false, 'message' => 'Erro interno ao tentar salvar a etapa.']);
}
?>