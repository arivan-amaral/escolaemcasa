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

// Define o usuário do banco de dados e inclui a conexão PDO
$usuariobd = $_SESSION['usuariobd'] ?? 'educ_lem';
$_SESSION['usuariobd'] = $usuariobd;

// AQUI: Este arquivo DEVE agora retornar o objeto PDO na variável $conexao
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
  // Consulta para listar as etapas da turma
  $sql_etapas = "SELECT `id`, `etapa` FROM `etapa_multissereada` WHERE turma_id = :idturma ORDER BY id ASC";
  $stmt_etapas = $conexao->prepare($sql_etapas);
  $stmt_etapas->bindParam(':idturma', $idturma, PDO::PARAM_INT);
  $stmt_etapas->execute();
 
  // Pega todas as etapas para usar no <select>
  $etapas = $stmt_etapas->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  error_log("Erro ao buscar etapas: " . $e->getMessage());
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
                <th>Etapa Atual</th>
                <th style="width: 10%">Status</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $ano_letivo = $_SESSION['ano_letivo'] ?? date('Y');

              if (isset($_SESSION['ano_letivo_vigente']) && $ano_letivo == $_SESSION['ano_letivo_vigente']) {
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
                 
                  // Chave primária da matrícula para o UPDATE
                  $matricula = $row['matricula'];

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
                      data-matricula="<?php echo $matricula; ?>"
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
                                        <span class="status-msg-<?php echo $matricula; ?>"></span>
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
 
  // --- FUNÇÃO JAVASCRIPT/AJAX PARA ATUALIZAR A ETAPA (REVISADA COM FETCH API) ---
  function atualizarEtapa(selectElement) {
    // 1. Coleta os dados dinâmicos da linha
    const novaEtapa = selectElement.value;
    // O 'data-matricula' está sendo pego corretamente!
    const matriculaCodigo = selectElement.getAttribute('data-matricula'); 
    // Seleciona a span de status exata da linha atual.
    const statusElement = document.querySelector(`.status-msg-${matriculaCodigo}`);
   
    if (novaEtapa === "" || matriculaCodigo === null) {
      statusElement.innerHTML = '<span class="text-danger">Selecione uma etapa válida.</span>';
      return;
    }

    statusElement.innerHTML = '<span class="text-info">Atualizando...</span>';
   
    // 2. Prepara os dados para o envio
    const formData = new URLSearchParams();
    formData.append('matricula', matriculaCodigo);
    formData.append('nova_etapa', novaEtapa);
   
    // 3. Executa a requisição AJAX usando Fetch API
    fetch('../Controller/Atualizar_etapa.php', {
      method: 'POST',
      headers: {
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
      // 4. Trata a resposta do PHP de forma dinâmica
      if (data.success) {
        statusElement.innerHTML = '<span class="text-success">✔ Etapa atualizada!</span>';
        // Limpa a mensagem após 3 segundos
        setTimeout(() => statusElement.innerHTML = '', 3000);
      } else {
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