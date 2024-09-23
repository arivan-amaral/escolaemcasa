<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['idfuncionario'])) {
    // header("location:index.php?status=0");
} else {
    $idcoordenador = $_SESSION['idfuncionario'];
}

include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";
include_once 'menu.php';
include_once '../Controller/Conversao.php';

if (!isset($_SESSION['usuariobd'])) {
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_" . $usuariobd . ".php";
include_once '../Model/Coordenador.php';
include_once '../Model/Setor.php';
include_once '../Model/Chamada.php';
include_once '../Model/Escola.php';

if (isset($_SESSION['mensagem'])) {
    echo '<div class="alert alert-info">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['mensagem']);
}

$filtro_nome = isset($_POST['filtro_nome']) ? $_POST['filtro_nome'] : '';
$filtro_data = isset($_POST['filtro_data']) ? $_POST['filtro_data'] : '';
$filtro_resolvido = isset($_POST['filtro_resolvido']) ? $_POST['filtro_resolvido'] : '';
$registros = buscar_registros_visitas($conexao, $filtro_nome, $filtro_data, $filtro_resolvido);
?>

<style>
.table {
    table-layout: auto;
    width: 100%;
}

.table td {
    word-wrap: break-word;
    white-space: normal;
    max-width: 150px;
}

</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 alert alert-info">
                    <h1 class="m-0"><b>RELATÓRIO DE VISITAS NAS ESCOLAS</b></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <form action="../Controller/cadastrar_relatorio_visita.php" method="post">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="escola_id" class="text-danger">Escola Visitada</label>
                        <select class="form-control" id="escola_id" name="escola_id" required>
                            <?php
                            $res_escola = escola_associada($conexao, $idcoordenador);
                            foreach ($res_escola as $value) {
                                $id = $value['idescola'];
                                $nome_escola = $value['nome_escola'];
                                echo "<option value='$id'>$nome_escola</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="situacao_resolvida" class="text-danger">Situação Resolvida *</label>
                        <select class="form-control" id="situacao_resolvida" name="situacao_resolvida" required>
                            <option value="">Selecione</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="funcionario_id" class="text-danger">Visitante *</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['nome']; ?>" readonly>
                        <input type="hidden" id="funcionario_id" name="funcionario_id" value="<?php echo $_SESSION['idfuncionario']; ?>" required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="objetivo_visita" class="text-danger">Objetivo da Visita *</label>
                        <input type="text" class="form-control" id="objetivo_visita" name="objetivo_visita" required>
                    </div>
                </div>

                
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="data_hora_visita" class="text-danger">Data e Hora da Visita *</label>
                        <input type="datetime-local" class="form-control" id="data_hora_visita" name="data_hora_visita" required>
                    </div>
                </div>
                
                <div class="col-sm-4">
                  <div class="form-group">
                      <label for="atendido_por" class="text-danger">Atendido por *</label>
                      <div id="atendido-container" style="display: flex; flex-wrap: wrap;">
                          <input type="text" class="form-control" name="atendido_por[]" required style="flex: 1; margin-right: 5px;">
                      </div>
                      <button type="button" class="btn btn-secondary mt-2" onclick="addAtendido()">Adicionar</button>
                  </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="relatorio_visita" class="text-danger">Relatório *</label>
                        <textarea class="form-control" id="relatorio_visita" name="relatorio_visita" required></textarea>
                      </div>
                    </div>
                  </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cadastrar Relatório</button>
            </div>
        </form>

        <div class="mt-5">
            <h2 class="alert alert-info text-center">VISUALIZAÇÃO DE RELATÓRIOS DE VISITAS</h2>
            <form method="post" class="mb-4">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="filtro_nome">Nome do Funcionário:</label>
                            <input type="text" class="form-control" name="filtro_nome" value="<?php echo $filtro_nome; ?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="filtro_data">Data:</label>
                            <input type="date" class="form-control" name="filtro_data" value="<?php echo $filtro_data; ?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="filtro_resolvido">Situação Resolvida:</label>
                            <select class="form-control" name="filtro_resolvido">
                                <option value="">Selecione</option>
                                <option value="sim" <?php if ($filtro_resolvido == 'sim') echo 'selected'; ?>>Sim</option>
                                <option value="nao" <?php if ($filtro_resolvido == 'nao') echo 'selected'; ?>>Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mt-4">Filtrar</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-striped">
            <thead>
                  <tr>
                      <th>Nome do Funcionário</th>
                      <th>Data e Hora</th>
                      <th>Objetivo da Visita</th>
                      <th>Relatório</th>
                      <th>Situação Resolvida</th>
                      <th>Nome do Atendente</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($registros as $registro): ?>
                  <tr>
                      <td><?php echo $registro['nome_funcionario']; ?></td>
                      <td><?php echo $registro['data_hora_visita']; ?></td>
                      <td><?php echo $registro['objetivo_visita']; ?></td>
                      <td><?php echo $registro['relatorio_visita']; ?></td>
                      <td><?php echo $registro['situacao_resolvida']; ?></td>
                      <td><?php echo $registro['atendido_por']; ?></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'rodape.php'; ?>

<script>
function addAtendido() {
    var container = document.getElementById("atendido-container");
    var newInput = document.createElement("input");
    newInput.type = "text";
    newInput.className = "form-control mt-1";
    newInput.name = "atendido_por[]";
    container.appendChild(newInput);
}
</script>


