<?php
// Configurações de exibição e log de erros
ini_set('display_errors', 0); // Não exibe erros no navegador (Bom para Produção)
ini_set('log_errors', 1);     // Garante que os erros sejam registrados em um arquivo de log
error_reporting(E_ALL);

session_start();

// --- 1. VERIFICAÇÃO DE SESSÃO E VARIÁVEIS INICIAIS ---
if (!isset($_SESSION['idcoordenador'])) {
    header("location:index.php?status=0");
    exit(); // É importante encerrar a execução após o redirecionamento
} else {
    $idcoordenador = $_SESSION['idcoordenador'];
}

// Inclusões de arquivos do template (Cabeçalho, Menu, etc.)
include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";
include_once 'menu.php';
include_once '../Controller/Conversao.php'; // Incluindo a classe de conversão

// Define o usuário do banco de dados e inclui a conexão PDO
$usuariobd = $_SESSION['usuariobd'] ?? 'educ_lem';
$_SESSION['usuariobd'] = $usuariobd;

// AQUI: Assumimos que este arquivo agora retorna o objeto $pdo
include_once "../Model/Conexao_" . $usuariobd . ".php"; 

// Assumindo que a classe Aluno ou a função de listagem está neste arquivo
// IMPORTANTE: Verifique se as funções listadas abaixo foram atualizadas para PDO!
include_once '../Model/Aluno.php'; 

// Pega e sanitiza os parâmetros da URL
$idturma = (int)($_GET['idturma'] ?? 0);
$idescola = (int)($_GET['idescola'] ?? 0);

// Conexão PDO deve estar disponível através da variável $pdo
// Se o seu arquivo de Conexão não a definir globalmente, você deve ajustá-lo ou passá-la.
if (!isset($pdo)) {
    // Tratar erro se a conexão PDO não foi estabelecida
    error_log("Erro: Conexão PDO não definida após a inclusão.");
    // Opcional: Redirecionar ou exibir uma mensagem de erro
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
                        // Exibe o nome da aplicação e o nome do usuário/coordenador
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
                                <th style="width: 10%">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // --- 2. LÓGICA DE EXECUÇÃO DE CONSULTA (AJUSTADA PARA PDO) ---
                            $ano_letivo = $_SESSION['ano_letivo'] ?? date('Y'); // Assume ano atual se não estiver setado

                            // Chama a função de listagem, passando o objeto PDO ($pdo)
                            if (isset($_SESSION['ano_letivo_vigente']) && $ano_letivo == $_SESSION['ano_letivo_vigente']) {
                                // Assume que a função foi atualizada para receber $pdo e retornar um PDOStatement
                                $stmt = listar_aluno_da_turma_ata_resultado_final($pdo, $idturma, $idescola, $ano_letivo);
                            } else {
                                // Assume que a função foi atualizada para receber $pdo e retornar um PDOStatement
                                $stmt = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($pdo, $idturma, $idescola, $ano_letivo);
                            }

                            // Verifica se o resultado é um objeto PDOStatement
                            if ($stmt && $stmt instanceof PDOStatement) {
                                // AQUI: Itera sobre os resultados usando PDO::FETCH_ASSOC
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    // Utiliza a classe Conversao para formatar a data
                                    $data_nasc_formatada = class_exists('Conversao') && method_exists('Conversao', 'data_d_m_a') 
                                        ? Conversao::data_d_m_a($row['data_nascimento']) 
                                        : $row['data_nascimento'];
                                ?>
                                <tr>
                                    <td style="width: 10px"><?php echo $row['idaluno']; ?></td>
                                    <td>
                                        <strong><?php echo $row['nome_aluno']; ?></strong>
                                        <?php 
                                        // Exibe Nome Social se existir
                                        if (!empty($row['nome_identificacao_social'])) {
                                            echo " <br><small>(". $row['nome_identificacao_social'] . ")</small>";
                                        } 
                                        ?>
                                    </td>
                                    <td><?php echo $row['matricula']; ?></td>
                                    <td class="d-none d-md-table-cell"><?php echo $data_nasc_formatada; ?></td>
                                    <td><span class="badge bg-primary"><?php echo $row['status_aluno']; ?></span></td>
                                </tr>
                                <?php
                                } // Fim do while
                            } else {
                                // Mensagem caso não encontre alunos (ou se a consulta falhar/retornar false)
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum aluno encontrado para esta turma no ano letivo.</td>
                                </tr>
                            <?php
                            } // Fim do if ($stmt)
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
    /* Funções de máscara de telefone (mantidas do seu código original) */
    function mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }
    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }
    function mtel(v){
        v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
        v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
        return v;
    }
</script>

<?php
include_once 'rodape.php';
?>