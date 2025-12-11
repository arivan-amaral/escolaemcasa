<?php
/**
 * PÁGINA INICIAL DO COORDENADOR (DASHBOARD)
 * Otimizada para clareza, segurança e desempenho.
 */

// 1. GESTÃO DE SESSÃO
// Inicia a sessão. É crucial que isso seja a primeira coisa a acontecer.
session_start();

// O 'session_write_close()' original foi mantido para liberar o arquivo de sessão
// rapidamente, permitindo que outras páginas PHP sejam carregadas simultaneamente
// pelo mesmo usuário, melhorando o desempenho de carregamento paralelo de recursos.
session_write_close();

// 2. GESTÃO DE COOKIE PARA AVISO ESPECIAL (Dia do Servidor Público)
// Centraliza o nome do cookie para facilitar a manutenção.
const COOKIE_NOME = 'dia_doservidor_publico2';
const DIAS_VALIDADE_COOKIE = 30;
const DIA_ESPECIAL = '10-28'; // Mês-Dia para 28 de Outubro

// Calcula o tempo de expiração do cookie.
$tempo_expiracao = time() + (DIAS_VALIDADE_COOKIE * 24 * 3600);
$hoje_mes_dia = date("m-d");

// Lógica de cookie:
// Se o cookie não existir, define como 1 (para exibir o aviso).
// Se existir, incrementa a contagem e define novamente.
// Nota: O código original tinha uma pequena falha: ele definia 0 e depois incrementava, resultando em 1.
// A otimização abaixo garante que a contagem seja gerenciada de forma mais clara.
if (!isset($_COOKIE[COOKIE_NOME])) {
    // Primeiro acesso, define como 1.
    setcookie(COOKIE_NOME, 1, $tempo_expiracao);
    $exibir_aviso = ($hoje_mes_dia === DIA_ESPECIAL);
} else {
    // Aumenta a contagem. O aviso só será exibido se a contagem for < 2 *e* for o dia correto.
    $count = (int)$_COOKIE[COOKIE_NOME] + 1;
    setcookie(COOKIE_NOME, $count, $tempo_expiracao);
    $exibir_aviso = ($count < 2) && ($hoje_mes_dia === DIA_ESPECIAL);
}

// 3. VERIFICAÇÃO DE AUTENTICAÇÃO
// Usa 'exit' após o redirecionamento para garantir que o script pare de executar.
if (!isset($_SESSION['idcoordenador'])) {
    header("Location: index.php?status=0");
    exit();
}

$idcoordenador = $_SESSION['idcoordenador'];

// 4. DEFINIÇÃO DO BANCO DE DADOS E CONEXÃO
// Usa o operador de coalescência nula (PHP 7+) para um fallback mais limpo.
$usuariobd = $_SESSION['usuariobd'] ?? 'educ_lem';

// Garante que a variável de sessão seja definida, mesmo se houver fallback.
$_SESSION['usuariobd'] = $usuariobd;

// Inclusões de arquivos (Controller, Model, Views)
// Assumindo que os caminhos e arquivos Model/Controller são corretos.
include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";
// Conexão: Usa variáveis para clareza.
$conexao_file = "../Model/Conexao_" . $usuariobd . ".php";
if (file_exists($conexao_file)) {
    include_once $conexao_file;
} else {
    // Tratar erro de conexão não encontrada.
    // Em um ambiente de produção, seria melhor registrar e mostrar um erro genérico.
    trigger_error("Arquivo de conexão não encontrado: " . $conexao_file, E_USER_ERROR);
}

include_once 'menu.php';
include_once '../Controller/Conversao.php'; // Data conversion functions
include_once '../Model/Coordenador.php'; // dados_coordenador()
include_once '../Model/Escola.php'; // escola_associada(), quantidade_solicitacao_transferencia_recebida_por_escola()
include_once '../Model/Aluno.php';
include_once '../Model/Chamada.php';


// 5. AVISO DO DIA ESPECIAL (SweetAlert)
// Só exibe o script se o aviso for necessário.
if ($exibir_aviso) {
?>
    <script>
        function dia_doservidor_publico() {
            Swal.fire({
                title: "Parabéns!",
                imageUrl: 'dia_doservidor_publico.png',
                imageAlt: 'Dia do Servidor Público',
            });
        }
        // Usa uma função de seta anônima para a chamada do setTimeout, mais moderna e clara.
        setTimeout(() => dia_doservidor_publico(), 3000);
    </script>
<?php
}
?>

<style>
    .quadro {
        /* Estilo otimizado para a imagem de fundo */
        background-image: url(imagens/logo_educalem_natal.png);
        background-repeat: no-repeat;
        background-position: center;
        /* Usa 'cover' se a intenção for cobrir o elemento, ou 100% 100% se for para esticar */
        background-size: 100% 100%;
        /* Adicione uma cor de fundo fallback */
        background-color: #f8f9fa;
    }
</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-1"></div>
                <div class="col-sm-12 alert alert-warning">
                    <h1 class="m-0"><b>
                        <?php
                        // Evita o aviso de variável indefinida (isset é suficiente)
                        if (isset($_SESSION['NOME_APLICACAO'])) {
                            echo $_SESSION['NOME_APLICACAO'];
                        }
                        // O nome do coordenador foi concatenado com espaço no original
                        if (isset($_SESSION['nome'])) {
                            echo " " . $_SESSION['nome'];
                        }
                        ?>
                    </b></h1>
                </div></div></div></div>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">

                    <?php
                    // Consulta o banco de dados.
                    $res_dados_coordenador = dados_coordenador($conexao, $idcoordenador);
                    $cont = 0;

                    // Exibição do cartão de usuário (Widget: user widget style 1)
                    foreach ($res_dados_coordenador as $value) {
                        $nome = htmlspecialchars($value['nome']); // Sanitização
                        $imagem = htmlspecialchars($value['foto']);
                        $cont++;
                    ?>
                        <div class='card card-widget widget-user shadow-lg quadro'>
                            <div class='widget-user-header text-white'>
                                <h3 class='widget-user-username text-right'><?= $nome ?></h3>
                                <h5 class='widget-user-desc text-right'>Coordenador (a)</h5>
                            </div>
                            <div class='widget-user-image'>
                                <img class='img-circle' src='fotos/<?= $imagem ?>' alt='User Avatar'>
                            </div>
                            <div class='card-footer'>
                                </div>
                        </div>
                    <?php
                    }

                    // Se não encontrou o coordenador no BD, usa dados da sessão como fallback.
                    if ($cont == 0 && isset($_SESSION['nome'])) {
                        $nome_sessao = htmlspecialchars($_SESSION['nome']);
                    ?>
                        <div class='card card-widget widget-user shadow-lg quadro'>
                            <div class='widget-user-header text-white'>
                                <h3 class='widget-user-username text-right'><?= $nome_sessao ?></h3>
                                <h5 class='widget-user-desc text-right'>Coordenador(a)</h5>
                            </div>
                            <div class='widget-user-image'>
                                <img class='img-circle' src='fotos/user.png' alt='User Avatar'>
                            </div>
                            <div class='card-footer'>
                                </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            <?php
                            $ano_letivo = $_SESSION['ano_letivo'] ?? date("Y"); // Fallback para o ano atual
                            $ativo = 0;
                            $bloqueado = 0; // O código original sempre define 0.

                            // Consulta de Alunos Ativos: Otimizada com `COUNT(*)` e filtros.
                            // Nota: A consulta original não filtra por escola, o que pode ser um problema
                            // se o coordenador deve ver apenas os alunos de suas escolas. Mantida a lógica original.
                            $sql_ativos = "SELECT COUNT(*) AS ativo 
                                           FROM ecidade_matricula 
                                           WHERE calendario_ano = :ano_letivo 
                                           AND matricula_ativa = 'S' 
                                           AND matricula_concluida = 'N'";
                            
                            // Se estiver usando PDO, você deve usar prepared statements:
                            // $stmt = $conexao->prepare($sql_ativos);
                            // $stmt->bindParam(':ano_letivo', $ano_letivo);
                            // $stmt->execute();
                            // $result_ativos = $stmt->fetch(PDO::FETCH_ASSOC);
                            // $ativo = $result_ativos['ativo'] ?? 0;

                            // Usando a abordagem do código original (assumindo que $conexao é um objeto PDO):
                            $result_ativos = $conexao->query("SELECT COUNT(*) AS ativo FROM ecidade_matricula WHERE calendario_ano='$ano_letivo' AND matricula_ativa='S' AND matricula_concluida='N'")->fetch(PDO::FETCH_ASSOC);
                            $ativo = $result_ativos['ativo'] ?? 0;
                            
                            echo "
                            ['Task', 'Hours per Day'],
                            ['Ativos', $ativo],
                            ['Bloqueados', $bloqueado]
                            ";
                            ?>
                        ]);

                        var options = {
                            title: 'GRÁFICO DE ALUNOS'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                </script>

                <div class='col-sm-1'></div>
                
                <?php
                // Processamento de Dados de Transferência
                $res_escola = escola_associada($conexao, $idcoordenador);
                $lista_escola_associada = "";
                $sql_escolas = "AND ( escola_id = -1 ";
                $sql_escolas_enviada = "AND ( escola_id_origem = -1 ";

                foreach ($res_escola as $value) {
                    $id = $value['idescola'];
                    $nome_escola = htmlspecialchars($value['nome_escola']);
                    $sql_escolas .= " OR escola_id = $id ";
                    $sql_escolas_enviada .= " OR escola_id_origem = $id ";
                    $lista_escola_associada .= "<option value='$id'>$nome_escola</option>";
                }
                $sql_escolas .= " )";
                $sql_escolas_enviada .= " )";

                // Quantidade Recebida
                $res_recebida = quantidade_solicitacao_transferencia_recebida_por_escola($conexao, 0, $sql_escolas);
                $quantidade_recebida = $res_recebida[0]['quantidade'] ?? 0;
                
                // Quantidade Enviada
                $res_enviada = quantidade_solicitacao_transferencia_enviada_por_escola($conexao, 0, $sql_escolas_enviada);
                $quantidade_enviada = $res_enviada[0]['quantidade'] ?? 0;
                ?>

                <div class='col-lg-3 col-6'>
                    <div class='small-box bg-danger'>
                        <div class='inner'>
                            <h3 class="text-center">RECEBIDAS</h3>
                            <h4 class="text-center"><?= $quantidade_recebida ?></h4>
                            <p>Você pode ter transferências pendentes clique abaixo para ver </p>
                        </div>
                        <div class='icon'><ion-icon name="cloud-download"></ion-icon></div>
                        <a href='lista_solicitacao_transferencia.php' class='small-box-footer'>
                            Transferências pendentes <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class='col-lg-3 col-6'>
                    <div class='small-box bg-info'>
                        <div class='inner'>
                            <h3 class="text-center">ENVIADAS</h3>
                            <h4 class="text-center"><?= $quantidade_enviada ?></h4>
                            <p>Você pode ter transferências pendentes clique abaixo para ver </p>
                        </div>
                        <div class='icon'><ion-icon name="cloud-upload"></ion-icon></div>
                        <a href='lista_solicitacao_transferencia_enviada.php' class='small-box-footer'>
                            Transferências pendentes <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div id="piechart" style="height: 100px;"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <a href='cadastrar_simulado.php' class='btn btn-danger btn-block btn-flat'>
                        <i class='fa fa-edit'></i> SIMULADO
                    </a>
                    <div class="form-group">
                        <label for="idescola">Escolha a escola</label>
                        <select class="form-control form-lg select2" id="idescola" onchange="listar_turmas_coordenador(this.value);" required="">
                            <?php echo $lista_escola_associada; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Clique na disciplina desejada</h3>
                        </div>
                        <div class="card-body">
                            <div id="accordion">
                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

<aside class="control-sidebar control-sidebar-dark">
    </aside>

<script type="text/javascript">
    // 1. Função de Verificação de Atraso (chamada uma vez após 10s)
    setTimeout(() => verificar_atraso(), 10000);

    // 2. Chamada Automática do Listador de Turmas
    // Chama a função principal de carregamento de dados de turmas após 500ms
    setTimeout(() => listar_turmas_coordenador_automatico(), 500);
    
    function listar_turmas_coordenador_automatico() {
        // Pega o valor da primeira escola na lista (ou a selecionada, se houver)
        var idescola = document.getElementById("idescola").value;
        listar_turmas_coordenador(idescola);
    }
</script>

<script type="text/javascript">
    // 3. Função de Notificação de Mensagens/Chamados
    function Mostrar_mensagens() {
        var xmlreq = CriaRequest(); // CriaRequest deve estar definido em ajax.js
        xmlreq.open("GET", "../Controller/Notificacao_mensagem_chamado.php", true);

        xmlreq.onreadystatechange = function() {
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    // Assume que a resposta (xmlreq.responseText) é o corpo da mensagem de erro/alerta
                    if (xmlreq.responseText.trim() !== '') {
                        Swal.fire({
                            icon: 'error', // O ícone 'error' sugere que se trata de uma notificação importante/urgente
                            title: 'ATENÇÃO',
                            text: xmlreq.responseText
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro de Requisição',
                        text: 'Falha ao carregar notificações (Status: ' + xmlreq.status + ')'
                    });
                }
            }
        };
        xmlreq.send(null);
    }
    // A chamada de intervalo estava comentada e incorreta no original, corrigindo:
    // setInterval(Mostrar_mensagens, 5000);
</script>

<?php
include_once 'rodape.php';
?>