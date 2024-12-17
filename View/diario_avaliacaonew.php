<?php
session_start();

// Configurações
define('CACHE_DURATION', 3600);
define('DEFAULT_DB', 'educ_lem');

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

// Buscar disciplinas
$sql = "SELECT d.* FROM disciplinas d 
        INNER JOIN professor_disciplina pd ON d.id = pd.disciplina_id 
        WHERE pd.professor_id = ? AND d.turma_id = ?
        ORDER BY d.nome";
        
$stmt = $conexao->prepare($sql);
$stmt->execute([$idprofessor, $idturma]);
$resultado_disciplina = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar períodos
$sql = "SELECT * FROM periodos WHERE ano = ? ORDER BY ordem";
$stmt = $conexao->prepare($sql);
$stmt->execute([$ano_letivo]);
$periodos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Notas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    // Inicialização do formulário
    const form = document.getElementById('formAvaliacao');
    const listaAvaliacoes = document.getElementById('listaAvaliacoes');

    // Função para buscar avaliações
    window.buscarAvaliacoes = async function() {
        const iddisciplina = document.getElementById('iddisciplina').value;
        const periodo = document.getElementById('periodo').value;
        
        if (!iddisciplina || !periodo) {
            Swal.fire('Atenção', 'Selecione disciplina e período', 'warning');
            return;
        }
        
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
            renderizarAvaliacoes(data);
            
        } catch (error) {
            console.error(error);
            Swal.fire('Erro', 'Falha ao carregar avaliações', 'error');
            listaAvaliacoes.innerHTML = '';
        }
    }

    // Função para renderizar a tabela de avaliações
    function renderizarAvaliacoes(data) {
        const table = document.createElement('table');
        table.className = 'table table-striped table-bordered';
        
        table.innerHTML = `
            <thead>
                <tr class="bg-primary text-white">
                    <th>Aluno</th>
                    <th style="width: 150px">Nota</th>
                    <th style="width: 200px">Data</th>
                </tr>
            </thead>
            <tbody>
                ${data.map(aluno => `
                    <tr>
                        <td>${aluno.nome}</td>
                        <td>
                            <input type="number" 
                                class="form-control nota-input" 
                                value="${aluno.nota || ''}"
                                min="0" 
                                max="10" 
                                step="0.1"
                                data-aluno="${aluno.id}"
                                onchange="atualizarNota(${aluno.id}, this.value)">
                        </td>
                        <td>${aluno.data || '-'}</td>
                    </tr>
                `).join('')}
            </tbody>
        `;
        
        listaAvaliacoes.innerHTML = '';
        listaAvaliacoes.appendChild(table);
    }

    // Função para atualizar nota com debounce
    let timeout;
    window.atualizarNota = function(idAluno, nota) {
        clearTimeout(timeout);
        timeout = setTimeout(async () => {
            try {
                const response = await fetch('ajax_atualizar_nota.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ idAluno, nota })
                });
                
                if (!response.ok) throw new Error('Erro ao atualizar');
                
                const input = document.querySelector(`input[data-aluno="${idAluno}"]`);
                input.classList.add('bg-success');
                setTimeout(() => input.classList.remove('bg-success'), 500);
                
            } catch (error) {
                console.error(error);
                Swal.fire('Erro', 'Falha ao atualizar nota', 'error');
            }
        }, 300);
    }
});
</script>

<?php include_once 'rodape.php'; ?>