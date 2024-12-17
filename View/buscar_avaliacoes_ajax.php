<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['idfuncionario'])) {
    http_response_code(401);
    die(json_encode(['error' => 'Não autorizado']));
}

// Includes necessários
include_once "../Model/Conexao_".$_SESSION['usuariobd'].".php";

// Validação dos parâmetros
$iddisciplina = filter_input(INPUT_POST, 'iddisciplina', FILTER_VALIDATE_INT);
$periodo = filter_input(INPUT_POST, 'periodo', FILTER_VALIDATE_INT);
$idturma = filter_input(INPUT_POST, 'idturma', FILTER_VALIDATE_INT);

if (!$iddisciplina || !$periodo || !$idturma) {
    http_response_code(400);
    die(json_encode(['error' => 'Parâmetros inválidos']));
}

try {
    // Buscar avaliações
    $sql = "SELECT a.*, al.nome as nome_aluno
            FROM avaliacoes a
            INNER JOIN alunos al ON a.aluno_id = al.id
            WHERE a.turma_id = ? 
            AND a.disciplina_id = ? 
            AND a.periodo_id = ?
            ORDER BY al.nome, a.data_avaliacao";
            
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$idturma, $iddisciplina, $periodo]);
    $avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Preparar HTML da tabela
    $html = '<div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Data</th>
                            <th>Nota</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                    <tbody>';
    
    foreach ($avaliacoes as $avaliacao) {
        $html .= sprintf(
            '<tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
            </tr>',
            htmlspecialchars($avaliacao['nome_aluno']),
            htmlspecialchars(date('d/m/Y', strtotime($avaliacao['data_avaliacao']))),
            htmlspecialchars($avaliacao['nota']),
            htmlspecialchars($avaliacao['observacao'])
        );
    }
    
    $html .= '</tbody></table></div>';
    
    if (empty($avaliacoes)) {
        $html = '<div class="alert alert-info">Nenhuma avaliação encontrada para os critérios selecionados.</div>';
    }
    
    echo json_encode(['html' => $html]);
    
} catch (PDOException $e) {
    error_log("Erro ao buscar avaliações: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar avaliações']);
}
