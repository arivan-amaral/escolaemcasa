<?php
session_start();
header('Content-Type: application/json');

// Verifica autenticação
if (!isset($_SESSION['idfuncionario'])) {
    http_response_code(401);
    die(json_encode(['erro' => 'Não autorizado']));
}

// Configurações
define('CACHE_DURATION', 300); // 5 minutos
define('DEFAULT_DB', 'educ_lem');

// Obtém dados da requisição
$data = json_decode(file_get_contents('php://input'), true);

// Validação dos parâmetros
$iddisciplina = filter_var($data['iddisciplina'] ?? null, FILTER_VALIDATE_INT);
$periodo = filter_var($data['periodo'] ?? null, FILTER_VALIDATE_INT);
$idturma = filter_var($data['idturma'] ?? null, FILTER_VALIDATE_INT);
$idescola = filter_var($data['idescola'] ?? null, FILTER_VALIDATE_INT);

if (!$iddisciplina || !$periodo || !$idturma || !$idescola) {
    http_response_code(400);
    die(json_encode(['erro' => 'Parâmetros inválidos']));
}

try {
    // Conexão com o banco
    $_SESSION['usuariobd'] = $_SESSION['usuariobd'] ?? DEFAULT_DB;
    require_once "../Model/Conexao_".$_SESSION['usuariobd'].".php";
    
    // Classe de Cache
    class Cache {
        private static $instance = null;
        private $data = [];
        
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        
        public function get($key) {
            if (isset($this->data[$key]) && $this->data[$key]['expires'] > time()) {
                return $this->data[$key]['value'];
            }
            return null;
        }
        
        public function set($key, $value, $duration = CACHE_DURATION) {
            $this->data[$key] = [
                'value' => $value,
                'expires' => time() + $duration
            ];
        }
    }

    // Classe para manipular avaliações
    class AvaliacaoService {
        private $conexao;
        private $cache;
        
        public function __construct($conexao) {
            $this->conexao = $conexao;
            $this->cache = Cache::getInstance();
        }
        
        public function buscarAvaliacoes($idturma, $iddisciplina, $periodo, $idescola) {
            $cache_key = "avaliacoes_{$idturma}_{$iddisciplina}_{$periodo}";
            $resultado = $this->cache->get($cache_key);
            
            if ($resultado !== null) {
                return $resultado;
            }
            
            // Query otimizada usando índices
            $sql = "SELECT 
                        a.id,
                        a.nome,
                        COALESCE(n.nota, 0) as nota,
                        DATE_FORMAT(n.data_avaliacao, '%d/%m/%Y') as data
                    FROM alunos a
                    LEFT JOIN (
                        SELECT aluno_id, nota, data_avaliacao
                        FROM notas 
                        WHERE disciplina_id = ? 
                        AND periodo_id = ?
                        AND ano_letivo = ?
                    ) n ON a.id = n.aluno_id
                    WHERE a.turma_id = ?
                    AND a.escola_id = ?
                    AND a.status = 1
                    ORDER BY a.nome";

            $stmt = $this->conexao->prepare($sql);
            $stmt->execute([
                $iddisciplina,
                $periodo,
                date('Y'),
                $idturma,
                $idescola
            ]);
            
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Armazena no cache
            $this->cache->set($cache_key, $resultado);
            
            return $resultado;
        }
    }

    // Executa a busca
    $service = new AvaliacaoService($conexao);
    $avaliacoes = $service->buscarAvaliacoes($idturma, $iddisciplina, $periodo, $idescola);
    
    // Retorna os resultados
    echo json_encode([
        'success' => true,
        'data' => $avaliacoes
    ]);

} catch (Exception $e) {
    // Log do erro
    error_log("Erro na busca de avaliações: " . $e->getMessage());
    
    // Retorna erro genérico para o cliente
    http_response_code(500);
    echo json_encode([
        'erro' => 'Erro interno do servidor',
        'message' => $e->getMessage()
    ]);
}

// Arquivo para atualizar notas
// ajax_atualizar_nota.php
<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['idfuncionario'])) {
    http_response_code(401);
    die(json_encode(['erro' => 'Não autorizado']));
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $idAluno = filter_var($data['idAluno'] ?? null, FILTER_VALIDATE_INT);
    $nota = filter_var($data['nota'] ?? null, FILTER_VALIDATE_FLOAT);
    
    if ($idAluno === false || $nota === false || $nota < 0 || $nota > 10) {
        throw new Exception('Dados inválidos');
    }
    
    require_once "../Model/Conexao_".$_SESSION['usuariobd'].".php";
    
    // Inicia transação
    $conexao->beginTransaction();
    
    // Verifica se já existe nota
    $sql = "SELECT id FROM notas 
            WHERE aluno_id = ? 
            AND disciplina_id = ? 
            AND periodo_id = ?
            AND ano_letivo = ?";
            
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        $idAluno,
        $data['iddisciplina'],
        $data['periodo'],
        date('Y')
    ]);
    
    if ($stmt->rowCount() > 0) {
        // Atualiza nota existente
        $sql = "UPDATE notas SET 
                nota = ?,
                data_modificacao = NOW(),
                usuario_modificacao = ?
                WHERE aluno_id = ? 
                AND disciplina_id = ?
                AND periodo_id = ?
                AND ano_letivo = ?";
    } else {
        // Insere nova nota
        $sql = "INSERT INTO notas (
                    aluno_id, 
                    disciplina_id,
                    periodo_id,
                    ano_letivo,
                    nota,
                    data_avaliacao,
                    usuario_cadastro
                ) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
    }
    
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        $nota,
        $_SESSION['idfuncionario'],
        $idAluno,
        $data['iddisciplina'],
        $data['periodo'],
        date('Y')
    ]);
    
    // Commit da transação
    $conexao->commit();
    
    // Limpa o cache
    $cache = Cache::getInstance();
    $cache_key = "avaliacoes_{$data['idturma']}_{$data['iddisciplina']}_{$data['periodo']}";
    $cache->set($cache_key, null);
    
    echo json_encode(['success' => true]);
    
} catch (Exception $e) {
    if (isset($conexao)) {
        $conexao->rollBack();
    }
    
    error_log("Erro ao atualizar nota: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'erro' => 'Erro ao atualizar nota',
        'message' => $e->getMessage()
    ]);
}