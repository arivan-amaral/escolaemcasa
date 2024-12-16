<?php
session_start();

// Configurações
define('CACHE_DURATION', 3600);
define('DEFAULT_DB', 'educ_lem');

// Classe de Cache otimizada
class CacheManager {
    private static $instance = null;
    private $cache = [];
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get($key) {
        if (isset($this->cache[$key]) && $this->cache[$key]['expires'] > time()) {
            return $this->cache[$key]['data'];
        }
        return null;
    }
    
    public function set($key, $value, $duration = CACHE_DURATION) {
        $this->cache[$key] = [
            'data' => $value,
            'expires' => time() + $duration
        ];
    }
}

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

// Cache para disciplinas
$cache = CacheManager::getInstance();
$cache_key = "disciplinas_{$idescola}_{$idturma}_{$idprofessor}";
$resultado_disciplina = $cache->get($cache_key);

if (!$resultado_disciplina) {
    $sql = "SELECT d.* FROM disciplinas d 
            INNER JOIN professor_disciplina pd ON d.id = pd.disciplina_id 
            WHERE pd.professor_id = ? AND d.turma_id = ?
            ORDER BY d.nome";
            
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$idprofessor, $idturma]);
    $resultado_disciplina = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $cache->set($cache_key, $resultado_disciplina, 300); // Cache por 5 minutos
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Notas</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <!-- Formulário de Avaliação -->
            <form id="formAvaliacao" onsubmit="return false;">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="iddisciplina">Disciplina</label>
                            <select class="form-control" id="iddisciplina" required>
                                <option value="">Selecione</option>
                                <?php foreach ($resultado_disciplina as $disc): ?>
                                    <option value="<?= $disc['id'] ?>">
                                        <?= htmlspecialchars($disc['nome']) ?>
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
                                <?php 
                                $periodos = $cache->get('periodos');
                                if (!$periodos) {
                                    $sql = "SELECT * FROM periodos WHERE ano = ? ORDER BY ordem";
                                    $stmt = $conexao->prepare($sql);
                                    $stmt->execute([$ano_letivo]);
                                    $periodos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $cache->set('periodos', $periodos);
                                }
                                foreach ($periodos as $p): 
                                ?>
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

                <!-- Lista de Avaliações -->
                <div id="listaAvaliacoes" class="mt-4"></div>
            </form>
        </div>
    </section>
</div>

<script>
// Variáveis globais
let loadingTimeout;
const DEBOUNCE_DELAY = 300;

// Função principal de busca
async function buscarAvaliacoes() {
    const iddisciplina = document.getElementById('iddisciplina').value;
    const periodo = document.getElementById('periodo').value;
    
    if (!iddisciplina || !periodo) {
        Swal.fire('Atenção', 'Selecione disciplina e período', 'warning');
        return;
    }
    
    // Mostra loading com delay
    loadingTimeout = setTimeout(() => {
        document.getElementById('listaAvaliacoes').innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Carregando...</span>
                </div>
            </div>`;
    }, 200);
    
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
        
        clearTimeout(loadingTimeout);
        
        if (!response.ok) throw new Error('Erro na requisição');
        
        const data = await response.json();
        renderizarAvaliacoes(data);
        
    } catch (error) {
        clearTimeout(loadingTimeout);
        console.error(error);
        Swal.fire('Erro', 'Falha ao carregar avaliações', 'error');
    }
}

// Renderização otimizada
function renderizarAvaliacoes(data) {
    const container = document.getElementById('listaAvaliacoes');
    
    // Usa DocumentFragment para melhor performance
    const fragment = document.createDocumentFragment();
    const table = document.createElement('table');
    table.className = 'table table-striped table-bordered';
    
    // Cabeçalho
    const thead = document.createElement('thead');
    thead.innerHTML = `
        <tr class="bg-primary text-white">
            <th>Aluno</th>
            <th style="width: 150px">Nota</th>
            <th style="width: 200px">Data</th>
        </tr>
    `;
    table.appendChild(thead);
    
    // Corpo da tabela
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
                       onchange="atualizarNota(${aluno.id}, this.value)">
            </td>
            <td>${aluno.data || '-'}</td>
        `;
        tbody.appendChild(tr);
    });
    
    table.appendChild(tbody);
    fragment.appendChild(table);
    
    container.innerHTML = '';
    container.appendChild(fragment);
}

// Atualização de nota com debounce
const debounce = (func, wait) => {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
};

const atualizarNota = debounce(async (idAluno, nota) => {
    try {
        const response = await fetch('ajax_atualizar_nota.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ idAluno, nota })
        });
        
        if (!response.ok) throw new Error('Erro ao atualizar');
        
        // Feedback visual sutil
        const input = document.querySelector(`input[data-aluno="${idAluno}"]`);
        input.classList.add('bg-success');
        setTimeout(() => input.classList.remove('bg-success'), 500);
        
    } catch (error) {
        console.error(error);
        Swal.fire('Erro', 'Falha ao atualizar nota', 'error');
    }
}, DEBOUNCE_DELAY);
</script>

<?php include_once 'rodape.php'; ?>