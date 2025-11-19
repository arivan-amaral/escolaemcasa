<?php
// Configurações de exibição e log de erros (Desenvolvimento)
// Para o AJAX funcionar sem mostrar erros, mantenha display_errors = 0 ou use try/catch no PHP de processamento.
ini_set('display_errors', 0); 
ini_set('log_errors', 1);     
error_reporting(E_ALL);

session_start();

// --- 1. VERIFICAÇÃO DE SESSÃO E VARIÁVEIS INICIAIS ---
if (!isset($_SESSION['idcoordenador'])) {
    header("location:index.php?status=0");
    exit();
} else {
    $idcoordenador = $_SESSION['idcoordenador'];
}

include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";
include_once 'menu.php';
include_once '../Controller/Conversao.php';

// Define o usuário do banco de dados e inclui a conexão PDO
$usuariobd = $_SESSION['usuariobd'] ?? 'educ_lem';
$_SESSION['usuariobd'] = $usuariobd;

// AQUI: Este arquivo DEVE agora retornar o objeto PDO na variável $conexao
// Ex: global $conexao; $conexao = new PDO(...);
include_once "../Model/Conexao_" . $usuariobd . ".php"; 

include_once '../Model/Aluno.php'; 

$idturma = (int)($_GET['idturma'] ?? 0);
$idescola = (int)($_GET['idescola'] ?? 0);

if (!isset($conexao) || !($conexao instanceof PDO)) {
    die("Erro Crítico: Conexão PDO não definida como \$conexao.");
}

// --- 2. PREPARAÇÃO: BUSCA DE ETAPAS DISPONÍVEIS ---
$etapas = [];
try {
    // A consulta foi adaptada para usar um placeholder seguro, se necessário
    $sql_etapas = "SELECT `id`, `etapa` FROM `etapa_multissereada` WHERE turma_id = :idturma ORDER BY id ASC";
    $stmt_etapas = $conexao->prepare($sql_etapas);
    $stmt_etapas->bindParam(':idturma', $idturma, PDO::PARAM_INT);
    $stmt_etapas->execute();
    
    // Pega todas as etapas para usar no <select>
    $etapas = $stmt_etapas->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Registra o erro em vez de exibi-lo
    error_log("Erro ao buscar etapas: " . $e->getMessage());
    // Se estiver em modo de desenvolvimento, exiba:
    // echo "Erro ao buscar etapas: " . $e->getMessage();
}

?>

<script src="ajax.js"></script>

<div class="content-wrapper" style="min-height: 529px;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 alert alert-warning">
                    <h1 class="m-0"><b>
                        <?php
                        if (isset($_SESSION['NOME_APLICACAO'])) {
                            echo $_SESSION['NOME_APLICACAO'];
                        }
                        if (isset($_SESSION['nome'])) {
                            echo " " . $_SESSION['nome'];
                        }
                        ?>
                    </b></h1>
                </div></div></div></div>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover responsive-table">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Nome do Aluno</th>
                                <th>Matrícula</th>
                                <th class="d-none d-md-table-cell">Nascimento</th>
                                <th>Etapa Atual</th> <th style="width: 10%">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // Lógica para determinar qual função de listagem usar
                            $ano_letivo = $_SESSION['ano_letivo'] ?? date('Y');

                            if (isset($_SESSION['ano_letivo_vigente']) && $ano_letivo == $_SESSION['ano_letivo_vigente']) {
                                // Importante: estas funções devem ser atualizadas para PDO e retornar PDOStatement
                                $stmt = listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $ano_letivo);
                            } else {
                                $stmt = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $ano_letivo);
                            }

                            $alunos_encontrados = false;
                            
                            if (isset($stmt) && $stmt instanceof PDOStatement) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $alunos_encontrados = true;
                                    $data_nasc_formatada = class_exists('Conversao') && method_exists('Conversao', 'data_d_m_a') 
                                        ? Conversao::data_d_m_a($row['data_nascimento']) 
                                        : $row['data_nascimento'];
                                    
                                    // A matrícula é a chave para o UPDATE
                                    $matricula_codigo = $row['matricula_codigo']; // Assumindo que o campo com o código da matricula se chama 'matricula_codigo'

                                ?>
                                <tr>
                                    <td style="width: 10px"><?php echo $row['idaluno']; ?></td>
                                    <td>
                                        <strong><?php echo $row['nome_aluno']; ?></strong>
                                        <?php 
                                        if (!empty($row['nome_identificacao_social'])) {
                                            echo " <br><small>(". $row['nome_identificacao_social'] . ")</small>";
                                        } 
                                        ?>
                                    </td>
                                    <td><?php echo $row['matricula']; ?></td>
                                    <td class="d-none d-md-table-cell"><?php echo $data_nasc_formatada; ?></td>
                                    
                                    <td>
                                        <select 
                                            class="form-control select-etapa" 
                                            data-matricula="<?php echo $matricula_codigo; ?>"
                                            onchange="atualizarEtapa(this)"
                                        >
                                            <option value="">Selecione a Etapa</option>
                                            <?php foreach ($etapas as $etapa_opt): ?>
                                                <option 
                                                    value="<?php echo $etapa_opt['id']; ?>"
                                                    <?php echo ($row['etapa'] == $etapa_opt['id']) ? 'selected' : ''; ?>
                                                >
                                                    <?php echo $etapa_opt['etapa']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="status-msg-<?php echo $matricula_codigo; ?>"></span>
                                    </td>
                                    
                                    <td><span class="badge bg-primary"><?php echo $row['status_aluno']; ?></span></td>
                                </tr>
                                <?php
                                } // Fim do while
                            } 

                            if (!$alunos_encontrados) {
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center">Nenhum aluno encontrado para esta turma no ano letivo.</td>
                                </tr>
                            <?php
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>

    </section>

</div>

<aside class="control-sidebar control-sidebar-dark">
    </aside>
<script type="text/javascript">
    
    // --- FUNÇÃO JAVASCRIPT/AJAX PARA ATUALIZAR A ETAPA ---
    function atualizarEtapa(selectElement) {
        // Pega os valores necessários do elemento <select>
        const novaEtapa = selectElement.value;
        const matriculaCodigo = selectElement.getAttribute('data-matricula');
        const statusElement = document.querySelector(`.status-msg-${matriculaCodigo}`);
        
        // Verifica se uma etapa foi realmente selecionada (ou se voltou para "Selecione a Etapa")
        if (novaEtapa === "") {
            statusElement.innerHTML = '<span class="text-danger">Selecione uma etapa válida.</span>';
            return;
        }

        // Limpa a mensagem anterior e mostra que está processando
        statusElement.innerHTML = '<span class="text-info">Atualizando...</span>';
        
        // Requisição AJAX (usando Fetch API, mais moderno que o AJAX antigo)
        fetch('../Controller/Atualizar_etapa.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            // Envia os dados no formato URL-encoded
            body: `matricula_codigo=${matriculaCodigo}&nova_etapa=${novaEtapa}`
        })
        .then(response => {
            // Verifica se a resposta HTTP foi OK
            if (!response.ok) {
                throw new Error('Falha na resposta do servidor.');
            }
            return response.json(); // Assume que o PHP retorna JSON
        })
        .then(data => {
            if (data.success) {
                statusElement.innerHTML = '<span class="text-success">✔ Etapa atualizada!</span>';
                // Opcional: Remover a mensagem após alguns segundos
                setTimeout(() => statusElement.innerHTML = '', 3000);
            } else {
                // Se a operação falhou (erro de SQL, etc.)
                statusElement.innerHTML = `<span class="text-danger">❌ Erro: ${data.message || 'Falha ao atualizar.'}</span>`;
            }
        })
        .catch(error => {
            console.error('Erro AJAX:', error);
            statusElement.innerHTML = `<span class="text-danger">❌ Erro de conexão: ${error.message}</span>`;
        });
    }

    // Funções de máscara de telefone (mantidas do seu código original)
    function mascara(o,f){ /* ... código ... */ }
    function execmascara(){ /* ... código ... */ }
    function mtel(v){ /* ... código ... */ }
</script>

<?php
include_once 'rodape.php';
?>