<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['idfuncionario'])) {
  //header("location:index.php?status=0");
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
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-1"></div>
        <div class="col-sm-12 alert alert-info">
          <h1 class="m-0"><b>RELATÓRIO DE VISITAS NAS ESCOLAS</b></h1>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Formulário para cadastro de relatório -->
  <div class="container">
    <form action="../Controller/cadastrar_relatorio_visita.php" method="post">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label class="text-danger" for="escola">Escola Visitada</label>
            <select class="form-control" id="escola_visitada" name="escola_visitada" required>
              <?php
              $res_escola = escola_associada($conexao, $idcoordenador);
              $lista_escola_associada = "";
              foreach ($res_escola as $key => $value) {
                $id = $value['idescola'];
                $nome_escola = $value['nome_escola'];
                $lista_escola_associada .= "<option value='$id'>$nome_escola</option>";
              }
              echo "$lista_escola_associada";
              ?>
            </select>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <label class="text-danger" for="situacao_resolvida">Situação Resolvida *</label>
            <select class="form-control" id="situacao_resolvida" name="situacao_resolvida" required>
              <option value="">Selecione</option>
              <option value="sim">Sim</option>
              <option value="nao">Não</option>
            </select>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <label class="text-danger" for="nome_visitante">Atendido por *</label>
            <input type="text" class="form-control" id="nome_visitante" name="nome_visitante" required>
          </div>
        </div>

        <div class="col-sm-5">
          <div class="form-group">
            <label class="text-danger" for="objetivo_visita">Objetivo da Visita *</label>
            <input type="text" class="form-control" id="objetivo_visita" name="objetivo_visita" required>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            <label class="text-danger" for="data_hora_visita">Data e Hora da Visita *</label>
            <input type="datetime-local" class="form-control" id="data_hora_visita" name="data_hora_visita" required>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label class="text-danger" for="relatorio_visita">Relatório *</label>
            <textarea class="form-control" id="relatorio_visita" name="relatorio_visita" required></textarea>
          </div>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Cadastrar Relatório</button>
      </div>
    </form>
  </div>

  <br>
  <div class="table-responsive" id="resultado"></div>
</div>


<?php include_once 'rodape.php'; ?>
