<?php
session_start();

// Configurações
define('CACHE_DURATION', 3600); // 1 hora
define('DEFAULT_DB', 'educ_lem');

// Classe de Cache simples
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
        return isset($this->cache[$key]) ? $this->cache[$key] : null;
    }
    
    public function set($key, $value) {
        $this->cache[$key] = $value;
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

// Buscar disciplinas
$sql = "SELECT DISTINCT 
            d.id as iddisciplina,
            d.nome as nome_disciplina
        FROM disciplinas d
        INNER JOIN professor_disciplina pd ON d.id = pd.disciplina_id 
        WHERE pd.professor_id = ? 
        AND d.turma_id = ?
        ORDER BY d.nome";
        
$stmt = $conexao->prepare($sql);
$stmt->execute([$idprofessor, $idturma]);
$resultado_disciplina = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<div class="content-wrapper" style="min-height: 529px;">
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
            <!-- Cabeçalho da Turma -->
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <button class="btn btn-block btn-lg btn-secondary">
                        <?php 
                        $nome_turma = $_GET['turma'] ?? '';
                        $nome_disciplina = $_GET['disciplina'] ?? '';
                        echo htmlspecialchars($nome_turma . " - " . $nome_disciplina); 
                        ?>
                    </button>
                </div>
            </div>
            <br>

            <!-- Menu de Navegação -->
            <div class="row">
                <!-- Conteúdo -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>
                            <p></p>
                        </div>
                        <div class="icon"></div>
                        <a href="cadastrar_conteudo.php?disc=<?= $iddisciplina ?>&turm=<?= $idturma ?>&turma=<?= urlencode($nome_turma) ?>&disciplina=<?= urlencode($nome_disciplina) ?>&idescola=<?= $idescola ?>&idserie=<?= $idserie ?>" 
                           class="small-box-footer" target="_blank">
                            Conteúdo <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                </div>

                <!-- Frequência -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>
                            <p></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="diario_frequencia.php?disc=<?= $iddisciplina ?>&turm=<?= $idturma ?>&turma=<?= urlencode($nome_turma) ?>&disciplina=<?= urlencode($nome_disciplina) ?>&idescola=<?= $idescola ?>&idserie=<?= $idserie ?>" 
                           class="small-box-footer" target="_blank">
                            Frequência <i class="fa fa-calendar"></i>
                        </a>
                    </div>
                </div>

                <!-- Ocorrência -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3></h3>
                            <p></p>
                        </div>
                        <div class="icon"></div>
                        <a href="acompanhamento_pedagogico.php?disc=<?= $iddisciplina ?>&turm=<?= $idturma ?>&turma=<?= urlencode($nome_turma) ?>&disciplina=<?= urlencode($nome_disciplina) ?>&idescola=<?= $idescola ?>&idserie=<?= $idserie ?>" 
                           class="small-box-footer" target="_blank">
                            Ocorrência <ion-icon name="bookmark-outline"></ion-icon>
                        </a>
                    </div>
                </div>

                <!-- Avaliação -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3></h3>
                            <p></p>
                        </div>
                        <div class="icon"></div>
                        <a href="diario_avaliacao.php?disc=<?= $iddisciplina ?>&turm=<?= $idturma ?>&turma=<?= urlencode($nome_turma) ?>&disciplina=<?= urlencode($nome_disciplina) ?>&idescola=<?= $idescola ?>&idserie=<?= $idserie ?>" 
                           class="small-box-footer" target="_blank">
                            Avaliação <i class="fas fa-chart-pie"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Formulário de Avaliação -->
            <form action="../Controller/Cadastrar_diario_avaliacao_aluno.php" method="post">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <?php if (!isset($_GET['funcionario'])): ?>
                            <div class="form-group">
                                <label for="iddisciplina" class="text-danger">
                                    Disciplina da turma <?= htmlspecialchars($nome_turma) ?>
                                </label>
                                <select class="form-control" id="iddisciplina" name="iddisciplina" required onchange="limpa_avaliacao();">
                                    <option value="">Selecione</option>
                                    <?php foreach ($resultado_disciplina as $disc): ?>
                                        <option value="<?= $disc['iddisciplina'] ?>">
                                            <?= htmlspecialchars($disc['nome_disciplina']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <label class="text-danger">
                                Disciplina da turma <?= htmlspecialchars($nome_turma) ?>
                            </label>
                            <input type="text" class="form-control" name="iddisciplina" 
                                   id="iddisciplina" value="<?= $iddisciplina ?>" readonly>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="periodo">Período</label>
                            <select class="form-control" id="periodo" name="periodo" required onchange="limpa_avaliacao();">
                                <option value="">Selecione</option>
                                <?php 
                                $resultado = listar_trimestre($conexao, $ano_letivo);
                                foreach ($resultado as $periodo):
                                    if (($idserie < 3 && $periodo['id'] == 6) || 
                                        ($periodo['id'] != 6)):
                                ?>
                                    <option value="<?= $periodo['id'] ?>">
                                        <?= htmlspecialchars($periodo['descricao']) ?>
                                    </option>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <br>
                            <label><br></label>
                            <a class="btn btn-primary" onclick="lista_avaliacao_aluno_por_data();">
                                BUSCAR
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campos Hidden -->
                <input type="hidden" name="url_get" id="url_get" value="<?= htmlspecialchars($url_get) ?>">
                <input type="hidden" name="idserie" id="idserie" value="<?= $idserie ?>">
                <input type="hidden" name="idescola" id="idescola" value="<?= $idescola ?>">
                <input type="hidden" name="idturma" id="idturma" value="<?= $idturma ?>">

                <!-- Lista de Avaliações -->
                <a name="listaAlunos"></a>
                <div id="listagem_avaliacao"></div>

                <div class="row" id="botao_continuar"></div>
            </form>
        </div>
    </section>
</div>

<!-- Scripts -->
<script>
function somenteNumeros(num, tamanho) {
    const er = /[^0-9.]/;
    const campo = num;
    let valor = campo.value;
    
    valor = valor.replace(",", ".");
    campo.value = valor;

    if (er.test(valor)) {
        campo.value = "";
        Swal.fire('Esse campo aceita apenas números.', '', 'info');
        return;
    }

    if (parseFloat(valor) > tamanho) {
        campo.value = "";
        Swal.fire(`A nota não pode ser maior que ${tamanho}.`, '', 'info');
    }
}

function aguardando() {
    Swal.fire({
        title: 'Aguarde, processando...',
        html: '',
        timer: 60000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function limpa_avaliacao() {
    document.getElementById('listagem_avaliacao').innerHTML = '';
    document.getElementById('botao_continuar').innerHTML = '';
}
</script>

<?php include_once 'rodape.php'; ?>