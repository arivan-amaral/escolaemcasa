<?php 
session_start();
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

// Variáveis para filtros
$nome_usuario = isset($_POST['nome_usuario']) ? $_POST['nome_usuario'] : '';
$data = isset($_POST['data']) ? $_POST['data'] : ''; // Campo único para data
$tipo_acao = isset($_POST['tipo_acao']) ? $_POST['tipo_acao'] : ''; // Filtro agora será um select

// Definir o número de logs por página (30)
$logs_por_pagina = 30;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $logs_por_pagina;

try {
    // Consulta para contar o número total de logs para a paginação
    $count_query = "SELECT COUNT(*) FROM logs l 
                    JOIN funcionario f ON l.funcionario_id = f.idfuncionario";

    $query = "SELECT l.data_hora, l.acao, f.nome 
              FROM logs l 
              JOIN funcionario f ON l.funcionario_id = f.idfuncionario"; 

    // Filtros
    $filters = [];
    if ($nome_usuario) {
        $filters[] = "f.nome LIKE :nome_usuario";
    }
    if ($data) {
        $filters[] = "DATE(l.data_hora) = :data"; // Filtro apenas por data
    }
    if ($tipo_acao) {
        $filters[] = "l.acao = :tipo_acao"; // Filtro pelo tipo de ação
    }

    // Adicionar filtros à consulta
    if (count($filters) > 0) {
        $query .= " WHERE " . implode(" AND ", $filters);
        $count_query .= " WHERE " . implode(" AND ", $filters);
    }

    $query .= " LIMIT :limit OFFSET :offset"; // Adicionar limites para paginação

    // Preparar e executar consulta de contagem
    $stmt_count = $conexao->prepare($count_query);
    if ($nome_usuario) {
        $stmt_count->bindValue(':nome_usuario', '%' . $nome_usuario . '%');
    }
    if ($data) {
        $stmt_count->bindValue(':data', $data); 
    }
    if ($tipo_acao) {
        $stmt_count->bindValue(':tipo_acao', $tipo_acao); // Usar o valor do select
    }
    $stmt_count->execute();
    $total_logs = $stmt_count->fetchColumn(); // Total de logs

    // Calcular total de páginas
    $total_paginas = ceil($total_logs / $logs_por_pagina);

    // Preparar e executar consulta de logs
    $stmt = $conexao->prepare($query);
    if ($nome_usuario) {
        $stmt->bindValue(':nome_usuario', '%' . $nome_usuario . '%');
    }
    if ($data) {
        $stmt->bindValue(':data', $data);
    }
    if ($tipo_acao) {
        $stmt->bindValue(':tipo_acao', $tipo_acao); // Usar o valor do select
    }
    $stmt->bindValue(':limit', $logs_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para buscar ações distintas
    $acao_query = "SELECT DISTINCT acao FROM logs";
    $stmt_acoes = $conexao->prepare($acao_query);
    $stmt_acoes->execute();
    $acoes = $stmt_acoes->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    $_SESSION['status'] = 0;
    $_SESSION['mensagem'] = 'Erro ao recuperar os logs!';
    echo $e->getMessage();
}
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Visualizar Logs</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="mb-4">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="nome_usuario">Nome do Usuário</label>
                                    <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" value="<?php echo htmlspecialchars($nome_usuario); ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="data">Data</label>
                                    <input type="date" class="form-control" id="data" name="data" value="<?php echo htmlspecialchars($data); ?>"> <!-- Campo único para data -->
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipo_acao">Tipo de Ação</label>
                                    <select class="form-control" id="tipo_acao" name="tipo_acao">
                                        <option value="">Selecione uma ação</option>
                                        <?php foreach ($acoes as $acao): ?>
                                            <option value="<?php echo htmlspecialchars($acao['acao']); ?>" 
                                                <?php echo ($acao['acao'] == $tipo_acao) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($acao['acao']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary form-control">Filtrar</button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Data e Hora</th>
                                    <th>Ação</th>
                                    <th>Usuário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($logs): ?>
                                    <?php foreach ($logs as $log): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($log['data_hora']); ?></td>
                                            <td><?php echo htmlspecialchars($log['acao']); ?></td>
                                            <td><?php echo htmlspecialchars($log['nome']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Nenhum log encontrado.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>


                       <!-- Paginação -->
<?php if ($total_paginas > 1): ?>
    <nav aria-label="Navegação de página">
        <ul class="pagination justify-content-center">
            <?php
            $paginas_a_mostrar = 5; // Número máximo de páginas a serem exibidas na navegação
            $inicio = max(1, $pagina_atual - floor($paginas_a_mostrar / 2));
            $fim = min($total_paginas, $inicio + $paginas_a_mostrar - 1);

            if ($pagina_atual > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina_atual - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = $inicio; $i <= $fim; $i++): ?>
                <li class="page-item <?php echo ($i == $pagina_atual) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($pagina_atual < $total_paginas): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina_atual + 1; ?>" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
                    </div>
                </div> <!-- </div> class=col-12 -->
            </div> <!-- </div> row -->
        </div>
    </div> <!-- /.container-fluid -->
</div> <!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark"></aside>
<!-- /.control-sidebar -->

<?php include_once 'rodape.php'; ?>
