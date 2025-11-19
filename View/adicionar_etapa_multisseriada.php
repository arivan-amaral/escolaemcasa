<?php

session_start();
// Redireciona se a sessão do coordenador não estiver definida
if (!isset($_SESSION['idcoordenador'])) {
    header("location:index.php?status=0");
    exit(); // É importante encerrar a execução após o redirecionamento
} else {
    $idcoordenador = $_SESSION['idcoordenador'];
}

include_once "cabecalho.php";
include_once "alertas.php";
include_once "barra_horizontal.php";
include_once 'menu.php';
include_once '../Controller/Conversao.php'; // Incluindo a classe de conversão

// Define o usuário do banco de dados
$usuariobd = $_SESSION['usuariobd'] ?? 'educ_lem';
$_SESSION['usuariobd'] = $usuariobd;

include_once "../Model/Conexao_" . $usuariobd . ".php";
include_once '../Model/Aluno.php'; // Supondo que a função de listagem esteja em Aluno.php ou já foi definida

// Pega os parâmetros da URL
$idturma = $_GET['idturma'] ?? 0;
$idescola = $_GET['idescola'] ?? 0;

// Validação básica para evitar SQL injection se os IDs não forem inteiros (embora o prepared statement seja preferível)
$idturma = (int)$idturma;
$idescola = (int)$idescola;

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
                            // Lógica para determinar qual função de listagem usar (ano letivo vigente ou concluído)
                            $ano_letivo = $_SESSION['ano_letivo'] ?? date('Y'); // Assume ano atual se não estiver setado

                            if (isset($_SESSION['ano_letivo_vigente']) && $ano_letivo == $_SESSION['ano_letivo_vigente']) {
                                // Assume que esta função é para o ano vigente (e não concluído)
                                $result = listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $ano_letivo);
                            } else {
                                // Assume que esta função é para o ano concluído (traz a matrícula concluída)
                                $result = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $ano_letivo);
                            }

                            // Verifica se há resultados e itera sobre eles
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Utiliza a classe Conversao para formatar a data
                                    // Verifique se a classe e método 'data_d_m_a' existem em seu arquivo Conversao.php
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
                                }
                            } else {
                                // Mensagem caso não encontre alunos
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">Nenhum aluno encontrado para esta turma no ano letivo.</td>
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