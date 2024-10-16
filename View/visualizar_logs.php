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
$data_inicio = isset($_POST['data_inicio']) ? $_POST['data_inicio'] : '';
$data_fim = isset($_POST['data_fim']) ? $_POST['data_fim'] : '';

try {
    // Consulta para obter logs
    $query = "SELECT l.data_hora, l.acao, f.nome 
              FROM logs l 
              JOIN funcionario f ON l.funcionario_id = f.idfuncionario"; // Aqui usamos idfuncionario

    // Filtros
    $filters = [];
    if ($nome_usuario) {
        $filters[] = "f.nome LIKE :nome_usuario";
    }
    if ($data_inicio) {
        $filters[] = "l.data_hora >= :data_inicio";
    }
    if ($data_fim) {
        $filters[] = "l.data_hora <= :data_fim";
    }

    // Adicionar filtros à consulta
    if (count($filters) > 0) {
        $query .= " WHERE " . implode(" AND ", $filters);
    }

    $stmt = $conexao->prepare($query);

    // Bind dos parâmetros
    if ($nome_usuario) {
        $stmt->bindValue(':nome_usuario', '%' . $nome_usuario . '%');
    }
    if ($data_inicio) {
        $stmt->bindValue(':data_inicio', $data_inicio . ' 00:00:00');
    }
    if ($data_fim) {
        $stmt->bindValue(':data_fim', $data_fim . ' 23:59:59');
    }

    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                                    <label for="data_inicio">Data Início</label>
                                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo htmlspecialchars($data_inicio); ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="data_fim">Data Fim</label>
                                    <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo htmlspecialchars($data_fim); ?>">
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
                    </div>
                </div> <!-- </div> class=col- 12 -->
            </div> <!-- </div> row  -->
        </div>
    </div> <!-- /.container-fluid -->
</div> <!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<?php include_once 'rodape.php'; ?>
