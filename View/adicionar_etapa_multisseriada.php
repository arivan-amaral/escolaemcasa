<?php
// Configurações de exibição e log de erros (Desenvolvimento)
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

$usuariobd = $_SESSION['usuariobd'] ?? 'educ_lem';
$_SESSION['usuariobd'] = $usuariobd;

// Inclui a conexão PDO na variável $conexao
include_once "../Model/Conexao_" . $usuariobd . ".php"; 

include_once '../Model/Aluno.php'; 

$idturma = (int)($_GET['idturma'] ?? 0);
$idescola = (int)($_GET['idescola'] ?? 0);

if (!isset($conexao) || !($conexao instanceof PDO)) {
    die("Erro Crítico: Conexão PDO não definida como \$conexao.");
}

// --- 2. PREPARAÇÃO: BUSCA DE ETAPAS DISPONÍVEIS (PDO) ---
$etapas = [];
try {
    $sql_etapas = "SELECT `id`, `etapa` FROM `etapa_multissereada` WHERE turma_id = :idturma ORDER BY id ASC";
    $stmt_etapas = $conexao->prepare($sql_etapas);
    $stmt_etapas->bindParam(':idturma', $idturma, PDO::PARAM_INT);
    $stmt_etapas->execute();
    $etapas = $stmt_etapas->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("Erro ao buscar etapas: " . $e->getMessage());
}

?>

<script src="ajax.js"></script>

<div class="content-wrapper" style="min-height: 529px;">
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
                                <th>Etapa Atual</th> 
                                <th style="width: 10%">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // ... (Lógica de listagem e $stmt) ...

                            $alunos_encontrados = false;
                            
                            if (isset($stmt) && $stmt instanceof PDOStatement) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $alunos_encontrados = true;
                                    $data_nasc_formatada = class_exists('Conversao') && method_exists('Conversao', 'data_d_m_a') 
                                        ? Conversao::data_d_m_a($row['data_nascimento']) 
                                        : $row['data_nascimento'];
                                    
                                    // 🚨 PONTO DE VERIFICAÇÃO 1: 
                                    // Confirme se 'matricula_codigo' é o nome correto do campo no resultado da consulta.
                                    $matricula_codigo = $row['matricula_codigo'] ?? ''; // Usando ?? '' para garantir que a variável não seja null
                                    
                                    // Opcional: Para debugar, você pode colocar: echo "";
                                    
                                    if (empty($matricula_codigo)) {
                                        error_log("Atenção: matricula_codigo vazio para o aluno: " . $row['nome_aluno']);
                                    }

                                ?>
                                <tr>
                                    <td style="width: 10px"><?php echo $row['idaluno']; ?></td>
                                    <td>
                                        <strong><?php echo $row['nome_aluno']; ?></strong>
                                        <?php if (!empty($row['nome_identificacao_social'])) { echo " <br><small>(". $row['nome_identificacao_social'] . ")</small>"; } ?>
                                    </td>
                                    <td><?php echo $row['matricula']; ?></td>
                                    <td class="d-none d-md-table-cell"><?php echo $data_nasc_formatada; ?></td>
                                    
                                    <td>
                                        <select 
                                            class="form-control select-etapa" 
                                            data-matricula="<?php echo htmlspecialchars($matricula_codigo); ?>"
                                            onchange="atualizarEtapa(this)"
                                        >
                                            <option value="">Selecione a Etapa</option>
                                            <?php foreach ($etapas as $etapa_opt): ?>
                                                <option 
                                                    value="<?php echo $etapa_opt['id']; ?>"
                                                    <?php echo (isset($row['etapa']) && $row['etapa'] == $etapa_opt['id']) ? 'selected' : ''; ?>
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

                            if (!$alunos_encontrados) { /* ... */ } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>
<script type="text/javascript">
    
    // --- FUNÇÃO JAVASCRIPT/AJAX PARA ATUALIZAR A ETAPA ---
    function atualizarEtapa(selectElement) {
        const novaEtapa = selectElement.value;
        const matriculaCodigo = selectElement.getAttribute('data-matricula');
        const statusElement = document.querySelector(`.status-msg-${matriculaCodigo}`);
        
        if (novaEtapa === "") {
            statusElement.innerHTML = '<span class="text-danger">Selecione uma etapa válida.</span>';
            return;
        }
        
        // 🚨 PONTO DE VERIFICAÇÃO 3: DEBUG JAVASCRIPT
        // Se esta mensagem estiver vazia, o problema é no PHP (Ponto 1 ou 2)
        console.log("Matrícula a ser enviada:", matriculaCodigo); 

        if (!matriculaCodigo) {
             statusElement.innerHTML = '<span class="text-danger">Erro JS: Código da matrícula não encontrado.</span>';
             return;
        }


        statusElement.innerHTML = '<span class="text-info">Atualizando...</span>';
        
        // Usando URLSearchParams para codificar os dados corretamente para o $_POST
        const formData = new URLSearchParams();
        formData.append('matricula_codigo', matriculaCodigo);
        formData.append('nova_etapa', novaEtapa);
        
        fetch('../Controller/Atualizar_etapa.php', {
            method: 'POST',
            headers: {
                // ESSENCIAL para o PHP popular o $_POST corretamente
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData 
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Falha na resposta do servidor (' + response.status + ').');
            }
            return response.json(); 
        })
        .then(data => {
            if (data.success) {
                statusElement.innerHTML = '<span class="text-success">✔ Etapa atualizada!</span>';
                setTimeout(() => statusElement.innerHTML = '', 3000);
            } else {
                statusElement.innerHTML = `<span class="text-danger">❌ Erro: ${data.message || 'Falha ao atualizar.'}</span>`;
            }
        })
        .catch(error => {
            console.error('Erro AJAX:', error);
            statusElement.innerHTML = `<span class="text-danger">❌ Erro de conexão ou servidor: ${error.message}</span>`;
        });
    }

    // ... (Funções de máscara) ...
</script>

<?php
include_once 'rodape.php';
?>