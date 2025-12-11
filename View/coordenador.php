<?php
/**
 * Otimização de index_coordenador.php
 *
 * Objetivo: Melhorar a legibilidade, a segurança e a gestão de sessão/cookies.
 */

// 1. Início da Sessão e Verificação de Coordenador
// session_write_close() foi movido para o final do bloco inicial de lógica para não fechar a sessão 
// antes que todas as variáveis necessárias tenham sido lidas/escritas.

session_start();

// Redireciona se o coordenador não estiver logado
if (!isset($_SESSION['idcoordenador'])) {
    header("location: index.php?status=0");
    exit; // Termina o script após o redirecionamento
}

$idcoordenador = $_SESSION['idcoordenador'];
$usuariobd = $_SESSION['usuariobd'] ?? 'educ_lem'; // Usa o operador de coalescência nula (PHP 7+)
$ano_letivo = $_SESSION['ano_letivo'] ?? date('Y'); // Garantir que $ano_letivo tem um valor

session_write_close(); // Fecha a sessão somente após ler todos os dados necessários

// 2. Lógica de Cookie (Dia do Servidor Público)
$cookie_name = 'dia_doservidor_publico2';
$cookie_expiry = time() + (30 * 24 * 3600); // 30 dias
$cookie_current_value = (int)($_COOKIE[$cookie_name] ?? 0);

if ($cookie_current_value < 1) {
    // Primeira visita no período de 30 dias (ou se o cookie expirou)
    setcookie($cookie_name, 1, $cookie_expiry);
} else {
    // Incrementa o valor do cookie
    // Otimização: A expiração deve ser definida em todos os sets para garantir que o cookie persista
    setcookie($cookie_name, $cookie_current_value + 1, $cookie_expiry);
}

// Verifica se o alerta deve ser exibido (primeira ou segunda vez no dia 28/10)
$show_servidor_publico_alert = ($cookie_current_value < 2 && date("m-d") === "10-28");

// 3. Includes
// Reduzir o número de include_once separando em blocos
include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";
include_once 'menu.php';

// Modelos e Conexão
include_once "../Model/Conexao_{$usuariobd}.php"; // Usa interpolação de string
include_once '../Controller/Conversao.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Escola.php';
include_once '../Model/Aluno.php';
include_once '../Model/Chamada.php';

// 4. Prepara Dados para a Seção de Transferências
$res_escola = escola_associada($conexao, $idcoordenador);
$lista_escola_associada = "";
$sql_escolas = "AND ( escola_id = -1 ";
$sql_escolas_enviada = "AND ( escola_id_origem = -1 ";

foreach ($res_escola as $value) {
    $id = $value['idescola'];
    $nome_escola = htmlspecialchars($value['nome_escola']); // Adicionado htmlspecialchars para segurança

    $sql_escolas .= " OR escola_id = $id ";
    $sql_escolas_enviada .= " OR escola_id_origem = $id ";
    
    $lista_escola_associada .= "<option value='{$id}'>{$nome_escola}</option>";
}
$sql_escolas .= " )";
$sql_escolas_enviada .= " )";

// Busca Quantidade Recebida
$res_recebida = quantidade_solicitacao_transferencia_recebida_por_escola($conexao, 0, $sql_escolas);
$quantidade_recebida = $res_recebida[0]['quantidade'] ?? 0;

// Busca Quantidade Enviada
$res_enviada = quantidade_solicitacao_transferencia_enviada_por_escola($conexao, 0, $sql_escolas_enviada);
$quantidade_enviada = $res_enviada[0]['quantidade'] ?? 0;

// 5. Busca Dados do Coordenador para o Card
$res_dados_coordenador = dados_coordenador($conexao, $idcoordenador);
$dados_coordenador = $res_dados_coordenador[0] ?? ['nome' => $_SESSION['nome'] ?? 'Coordenador', 'foto' => 'user.png']; // Usa array de fallback

$nome_coordenador = htmlspecialchars($dados_coordenador['nome']);
$imagem_coordenador = htmlspecialchars($dados_coordenador['foto']);

// 6. Busca Dados para o Gráfico (Pie Chart)
$result_ativos = $conexao->query("
    SELECT 
        COUNT(*) AS ativo 
    FROM 
        ecidade_matricula 
    WHERE
        calendario_ano = '{$ano_letivo}' AND
        matricula_ativa = 'S' AND
        matricula_concluida = 'N'
");
$ativo = $result_ativos->fetch(PDO::FETCH_ASSOC)['ativo'] ?? 0;
$bloqueado = 0; // Valor fixo

?>

<style>
    /* Estilo CSS otimizado e simplificado */
    .quadro {
        background-image: url(imagens/logo_educalem_natal.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% 100%;
    }
</style>

<?php if ($show_servidor_publico_alert): ?>
    <script>
        function dia_doservidor_publico() {
            Swal.fire({
                title: "Parabéns!",
                imageUrl: 'dia_doservidor_publico.png',
                imageAlt: 'dia_doservidor_publico',
            });
        }
        setTimeout(dia_doservidor_publico, 3000);
    </script>
<?php endif; ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="ajax.js?v=<?php echo rand(); ?>"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Ativos', <?php echo (int)$ativo; ?>],
            ['Bloqueados', <?php echo (int)$bloqueado; ?>]
        ]);

        var options = {
            title: 'GRÁFICO DE ALUNOS',
            backgroundColor: 'transparent' // Adicionei transparência para melhor integração
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>

<div class="content-wrapper" style="min-height: 529px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-1"></div>
                <div class="col-sm-12 alert alert-warning">
                    <h1 class="m-0">
                        <b>
                            <?php 
                            // Exibe o nome da aplicação apenas se estiver definido
                            echo htmlspecialchars($_SESSION['NOME_APLICACAO'] ?? '');
                            // Exibe o nome do coordenador logado
                            echo " " . $nome_coordenador;
                            ?>
                        </b>
                    </h1>
                </div></div></div></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class='card card-widget widget-user shadow-lg quadro'>
                        <div class='widget-user-header text-white'>
                            <h3 class='widget-user-username text-right'><?php echo $nome_coordenador; ?></h3>
                            <h5 class='widget-user-desc text-right'>Coordenador (a)</h5>
                        </div>
                        <div class='widget-user-image'>
                            <img class='img-circle' src='fotos/<?php echo $imagem_coordenador; ?>' alt='User Avatar'>
                        </div>
                        <div class='card-footer'>
                            </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class='col-sm-1'></div>
                
                <div class='col-lg-3 col-6'>
                    <div class='small-box bg-danger'>
                        <div class='inner'>
                            <h3 class="text-center">RECEBIDAS</h3>
                            <h4 class="text-center"><?php echo $quantidade_recebida; ?></h4>
                            <p>Você pode ter transferências pendentes clique abaixo para ver</p>
                        </div>
                        <div class='icon'></div>
                        <a href='lista_solicitacao_transferencia.php' class='small-box-footer'>
                            Transferências pendentes <ion-icon name="cloud-upload"></ion-icon>
                        </a>
                    </div>
                </div>

                <div class='col-lg-3 col-6'>
                    <div class='small-box bg-info'>
                        <div class='inner'>
                            <h3 class="text-center">ENVIADAS</h3>
                            <h4 class="text-center"><?php echo $quantidade_enviada; ?></h4>
                            <p>Você pode ter transferências pendentes clique abaixo para ver</p>
                        </div>
                        <div class='icon'></div>
                        <a href='lista_solicitacao_transferencia_enviada.php' class='small-box-footer'>
                            Transferências pendentes <ion-icon name="cloud-download"></ion-icon>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-12" style="min-height: 200px;">
                    <div id="piechart" style="height: 100%;"></div> 
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
    // Chamadas de funções JavaScript após o carregamento da página

    // 1. Verificação de Atraso (Assumindo que verificar_atraso está em ajax.js)
    setTimeout(verificar_atraso, 10000); // Removida a chamada imediata '()'

    // 2. Carregamento Automático da primeira escola na listagem de turmas
    setTimeout(listar_turmas_coordenador_automatico, 500);

    function listar_turmas_coordenador_automatico() {
        // Pega o valor da escola selecionada (a primeira, por padrão)
        var idescola = document.getElementById("idescola").value;
        // Chama a função AJAX para listar turmas (definida em ajax.js)
        listar_turmas_coordenador(idescola);
    }

    // 3. Função de Notificação (Melhorado o tratamento de erro e status)
    function Mostrar_mensagens() {
        var xmlreq = CriaRequest(); // CriaRequest deve estar definido em ajax.js
        xmlreq.open("GET", "../Controller/Notificacao_mensagem_chamado.php", true);

        xmlreq.onreadystatechange = function() {
            if (xmlreq.readyState === 4) {
                if (xmlreq.status === 200) {
                    var response = xmlreq.responseText.trim();
                    if (response) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'NOVA NOTIFICAÇÃO',
                            text: response
                        });
                    }
                } else {
                    console.error("Erro na requisição de Notificações: Status " + xmlreq.status);
                }
            }
        };
        xmlreq.send(null);
    }
    
    // Deixei o setInterval comentado, pois a função estava sendo chamada imediatamente:
    // setInterval(Mostrar_mensagens, 5000); // Chamar a cada 5 segundos
</script>

<?php 
    include_once 'rodape.php';
?>