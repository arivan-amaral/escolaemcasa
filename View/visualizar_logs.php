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
$tipo_acao = isset($_POST['tipo_acao']) ? $_POST['tipo_acao'] : ''; // Novo filtro

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
    if ($data) {
        $filters[] = "DATE(l.data_hora) = :data"; // Filtro apenas por data
    }
    if ($tipo_acao) {
        $filters[] = "l.acao LIKE :tipo_acao"; // Filtro pelo tipo de ação
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
    if ($data) {
        $stmt->bindValue(':data', $data); // Bind do novo filtro de data
    }
    if ($tipo_acao) {
        $stmt->bindValue(':tipo_acao', '%' . $tipo_acao . '%'); // Bind do novo filtro
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
                                    <label for="data">Data</label>
                                    <input type="date" class="form-control" id="data" name="data" value="<?php echo htmlspecialchars($data); ?>"> <!-- Campo único para data -->
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipo_acao">Tipo de Ação</label>
                                    <input type="text" class="form-control" id="tipo_acao" name="tipo_acao" value="<?php echo htmlspecialchars($tipo_acao); ?>">
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
    <!-- Control sidebar content goes aqui -->
</aside>
<!-- /.control-sidebar -->

<?php include_once 'rodape.php'; ?>
