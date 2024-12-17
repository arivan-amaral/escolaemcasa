<?php
session_start();

// Configurações
define('CACHE_DURATION', 3600); // 1 hora
define('DEFAULT_DB', 'educ_lem');

// Classe de Cache Otimizada
class CacheManager {
    private static $instance = null;
    private $cache = [];
    private $expires = [];
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get($key) {
        if (isset($this->cache[$key]) && isset($this->expires[$key]) && $this->expires[$key] > time()) {
            return $this->cache[$key];
        }
        return null;
    }
    
    public function set($key, $value, $duration = CACHE_DURATION) {
        $this->cache[$key] = $value;
        $this->expires[$key] = time() + $duration;
    }

    public function clear($pattern = null) {
        if ($pattern) {
            foreach ($this->cache as $key => $value) {
                if (strpos($key, $pattern) === 0) {
                    unset($this->cache[$key]);
                    unset($this->expires[$key]);
                }
            }
        } else {
            $this->cache = [];
            $this->expires = [];
        }
    }
}

// Funções de consulta otimizadas
function listar_disciplina_professor_na_turma($conexao, $idescola, $idturma, $idprofessor, $ano_letivo) {
    $cache = CacheManager::getInstance();
    $cache_key = "disc_prof_{$idescola}_{$idturma}_{$idprofessor}_{$ano_letivo}";
    
    $result = $cache->get($cache_key);
    if ($result) return $result;

    // Consulta otimizada com ÍNDICES e JOIN específicos
    $sql = "SELECT DISTINCT 
                d.id as iddisciplina,
                d.nome as nome_disciplina
            FROM disciplinas d
            INNER JOIN professor_disciplina pd ON d.id = pd.disciplina_id 
                AND pd.professor_id = :professor_id
            INNER JOIN turmas t ON d.turma_id = t.id 
                AND t.id = :turma_id 
                AND t.escola_id = :escola_id
                AND t.ano_letivo = :ano_letivo
            WHERE d.status = 1
            ORDER BY d.nome";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':professor_id', $idprofessor, PDO::PARAM_INT);
        $stmt->bindValue(':turma_id', $idturma, PDO::PARAM_INT);
        $stmt->bindValue(':escola_id', $idescola, PDO::PARAM_INT);
        $stmt->bindValue(':ano_letivo', $ano_letivo, PDO::PARAM_INT);
        
        // Configurações de performance do PDO
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        $cache->set($cache_key, $result, 300); // Cache por 5 minutos
        
        return $result;
    } catch (PDOException $e) {
        error_log("Erro na consulta de disciplinas: " . $e->getMessage());
        return [];
    }
}

function listar_trimestre($conexao, $ano_letivo) {
    $cache = CacheManager::getInstance();
    $cache_key = "trimestres_{$ano_letivo}";
    
    $result = $cache->get($cache_key);
    if ($result) return $result;

    $sql = "SELECT id, descricao 
            FROM periodos 
            WHERE ano = :ano_letivo 
            AND status = 1
            ORDER BY ordem
            LIMIT 4";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':ano_letivo', $ano_letivo, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cache->set($cache_key, $result, 3600); // Cache por 1 hora
        
        return $result;
    } catch (PDOException $e) {
        error_log("Erro na consulta de trimestres: " . $e->getMessage());
        return [];
    }
}

// Configurações do PDO para melhor performance
$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conexao->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

// Verificação de autenticação
if (!isset($_SESSION['idfuncionario'])) {
    header("location:index.php?status=0");
    exit;
}

$idprofessor = $_SESSION['idfuncionario'];

// Includes necessários
include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";
include_once "menu.php";
include_once '../Controller/Conversao.php';
include_once '../Model/Aluno.php';
include_once '../Model/Professor.php';

// Configuração do banco de dados
$_SESSION['usuariobd'] = $_SESSION['usuariobd'] ?? DEFAULT_DB;
$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";

// Validação de parâmetros
$idserie = filter_input(INPUT_GET, 'idserie', FILTER_VALIDATE_INT);
$idescola = filter_input(INPUT_GET, 'idescola', FILTER_VALIDATE_INT);
$idturma = filter_input(INPUT_GET, 'turm', FILTER_VALIDATE_INT);
$iddisciplina = filter_input(INPUT_GET, 'disc', FILTER_VALIDATE_INT);
$ano_letivo = $_SESSION['ano_letivo'];

if (!$idserie || !$idescola || !$idturma || !$iddisciplina) {
    die('Parâmetros inválidos');
}

// Processamento da URL
$array_url = explode('p?', $_SERVER["REQUEST_URI"]);
$url_get = $array_url[1] ?? '';

// Processamento do funcionário
$funcionario = $_GET['funcionario'] ?? '';

// Buscar disciplinas com cache
$cache = CacheManager::getInstance();
$cache_key = "disciplinas_{$idescola}_{$idturma}_{$idprofessor}";
$resultado_disciplina = $cache->get($cache_key);

if (!$resultado_disciplina) {
    $resultado_disciplina = listar_disciplina_professor_na_turma(
        $conexao, 
        $idescola, 
        $idturma, 
        $idprofessor, 
        $ano_letivo
    );
    $cache->set($cache_key, $resultado_disciplina);
}

// Buscar trimestres com cache
$periodos_key = "periodos_{$ano_letivo}";
$periodos = $cache->get($periodos_key);

if (!$periodos) {
    $periodos = listar_trimestre($conexao, $ano_letivo);
    $cache->set($periodos_key, $periodos);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Notas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="ajax.js?<?= time() ?>"></script>
</head>
<body>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 alert alert-danger text-center">
                    <h1 class="m-0"><b>ÁREA DE REGISTRO DE NOTAS</b></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form id="formAvaliacao" onsubmit="return false;">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="iddisciplina">Disciplina</label>
                            <select class="form-control" id="iddisciplina" required>
                                <option value="">Selecione</option>
                                <?php foreach ($resultado_disciplina as $disc): ?>
                                    <option value="<?= $disc['iddisciplina'] ?>">
                                        <?= htmlspecialchars($disc['nome_disciplina']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="periodo">Período</label>
                            <select class="form-control" id="periodo" required>
                                <option value="">Selecione</option>
                                <?php foreach ($periodos as $p): ?>
                                    <option value="<?= $p['id'] ?>">
                                        <?= htmlspecialchars($p['descricao']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-primary btn-block" onclick="buscarAvaliacoes()">
                                BUSCAR
                            </button>
                        </div>
                    </div>
                </div>

                <div id="listaAvaliacoes" class="mt-4"></div>
            </form>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const listaAvaliacoes = document.getElementById('listaAvaliacoes');
    let loadingTimeout;

    // Cache local para dados já carregados
    const dadosCache = new Map();

    // Função para buscar avaliações com cache local
    window.buscarAvaliacoes = async function() {
        const iddisciplina = document.getElementById('iddisciplina').value;
        const periodo = document.getElementById('periodo').value;
        
        if (!iddisciplina || !periodo) {
            Swal.fire('Atenção', 'Selecione disciplina e período', 'warning');
            return;
        }

        const cacheKey = `${iddisciplina}_${periodo}`;
        
        // Verifica cache local primeiro
        if (dadosCache.has(cacheKey)) {
            renderizarAvaliacoes(dadosCache.get(cacheKey));
            return;
        }
        
        // Mostra loading
        listaAvaliacoes.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Carregando...</span>
                </div>
            </div>`;
        
        try {
            const response = await fetch('ajax_avaliacoes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    iddisciplina,
                    periodo,
                    idturma: <?= $idturma ?>,
                    idescola: <?= $idescola ?>
                })
            });
            
            if (!response.ok) throw new Error('Erro na requisição');
            
            const data = await response.json();
            
            // Salva no cache local
            dadosCache.set(cacheKey, data);
            
            renderizarAvaliacoes(data);
            
        } catch (error) {
            console.error(error);
            Swal.fire('Erro', 'Falha ao carregar avaliações', 'error');
            listaAvaliacoes.innerHTML = '';
        }
    }

    // Renderização otimizada com DocumentFragment
    function renderizarAvaliacoes(data) {
        const fragment = document.createDocumentFragment();
        const table = document.createElement('table');
        table.className = 'table table-striped table-bordered';
        
        const thead = document.createElement('thead');
        thead.innerHTML = `
            <tr class="bg-primary text-white">
                <th>Aluno</th>
                <th style="width: 150px">Nota</th>
                <th style="width: 200px">Data</th>
            </tr>
        `;
        table.appendChild(thead);
        
        const tbody = document.createElement('tbody');
        data.forEach(aluno => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${aluno.nome}</td>
                <td>
                    <input type="number" 
                        class="form-control nota-input" 
                        value="${aluno.nota || ''}"
                        min="0" 
                        max="10" 
                        step="0.1"
                        data-aluno="${aluno.id}"
                        onchange="atualizarNota(this)">
                </td>
                <td>${aluno.data || '-'}</td>
            `;
            tbody.appendChild(tr);
        });
        
        table.appendChild(tbody);
        fragment.appendChild(table);
        
        listaAvaliacoes.innerHTML = '';
        listaAvaliacoes.appendChild(fragment);
    }

    // Atualização de nota otimizada
    let updateTimeout;
    const pendingUpdates = new Map();

    window.atualizarNota = function(input) {
        const idAluno = input.dataset.aluno;
        const nota = input.value;
        
        // Cancela atualização pendente anterior
        if (pendingUpdates.has(idAluno)) {
            clearTimeout(pendingUpdates.get(idAluno));
        }
        
        // Agenda nova atualização
        const timeoutId = setTimeout(async () => {
            try {
                const response = await fetch('ajax_atualizar_nota.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ idAluno, nota })
                });
                
                if (!response.ok) throw new Error('Erro ao atualizar');
                
                input.classList.add('bg-success');
                setTimeout(() => input.classList.remove('bg-success'), 500);
                
                pendingUpdates.delete(idAluno);
                
            } catch (error) {
                console.error(error);
                Swal.fire('Erro', 'Falha ao atualizar nota', 'error');
            }
        }, 300);
        
        pendingUpdates.set(idAluno, timeoutId);
    }
});
</script>

<?php include_once 'rodape.php'; ?>