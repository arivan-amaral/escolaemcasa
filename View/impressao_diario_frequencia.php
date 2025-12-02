<?php
// Configurações de erro (mantidas)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Aumentar o limite de tempo é comum para relatórios longos (mantido)
set_time_limit(0);

// A sessão deve ser iniciada antes de acessar $_SESSION
session_start(); 
// Se a página só lê dados da sessão, session_write_close() é bom para liberar o arquivo de sessão rapidamente.
session_write_close(); 

// Inclusões de arquivos (mantidas)
include_once "../Controller/Conversao.php";
include_once "../Model/Conexao.php";

// A variável $conexao é presumida como disponível via inclusão de Conexao.php
if (!isset($conexao) || !($conexao instanceof PDO)) {
    die("Erro: Objeto de conexão PDO não encontrado.");
}

// Inclusões de classes/modelos (mantidas)
include_once "../Model/Coordenador.php";
include_once "../Model/Aluno.php";
include_once "../Model/Escola.php";

// Inclusões de funções de diário (mantidas)
include_once "diarioFrequencia_infantil.php";
include_once "diarioFrequencia_fund1.php";
include_once "diarioFrequencia_fund2.php";
include_once "diarioFrequenciaPaginaFinal_infantil.php";
include_once "diarioFrequenciaPaginaFinal_fund1.php";
include_once "diarioFrequenciaPaginaFinal_fund2.php";
 
// --- Busca de Variáveis de Sessão e GET ---
$ano_letivo = $_SESSION['ano_letivo'] ?? date('Y'); // Use um fallback seguro
$idescola = $_GET['idescola'] ?? 0;
$idturma = $_GET['idturma'] ?? 0;
$iddisciplina = $_GET['iddisciplina'] ?? 0;
$idserie = $_GET['idserie'] ?? 0;
$periodo_id = $_GET['periodo_id'] ?? 0;

// --- Otimização: Busca de Seguimento (PDO Otimizado) ---
$seguimento = 0;
$nome_turma = "";

$stmt_seg = $conexao->prepare("SELECT nome_turma, seguimento FROM turma WHERE idturma = :idturma LIMIT 1");
$stmt_seg->execute([':idturma' => $idturma]);

if ($turma_data = $stmt_seg->fetch(PDO::FETCH_ASSOC)) {
    // Garante que $seguimento é um INT (compatível com PHP 8.3)
    $nome_turma = $turma_data['nome_turma'];
    $seguimento = (int)($turma_data['seguimento'] ?? 0); 
}

// --- Otimização: Busca de Dados do Calendário (PDO Otimizado) ---
$descricao_trimestre = "";
$data_inicio_trimestre = "";
$data_fim_trimestre = "";

// Assumindo que listar_data_por_periodo() é uma função que retorna dados do calendário
if (function_exists('listar_data_por_periodo')) {
    $res_calendario = listar_data_por_periodo($conexao, $ano_letivo, $periodo_id);
    // Presumindo que listar_data_por_periodo retorna um array de resultados
    if (!empty($res_calendario)) {
        $value = $res_calendario[0]; // Pega o primeiro resultado
        $descricao_trimestre = $value['descricao'] ?? '';
        $data_inicio_trimestre = $value['inicio'] ?? '';
        $data_fim_trimestre = $value['fim'] ?? '';
    }
}
// -----------------------------------------------------------------

// Definições de paginação
$inicio = 0;
$fim = 36;
$conta_aula = 1;
$conta_data = 1;
$limite_data = 36;
$limite_aula = 36;
?>

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta charset="UTF-8">
<title>Diário de Frequência</title>

<style>
/* Manter a rotação do texto para compatibilidade com o MS Word/Navegadores */
.Namerotate {
    transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    /* filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3); */ /* Mantido para IE */
}
 
.tblborder, .tblborder td, .tblborder th{
    border-collapse: collapse;
    border: 1px solid #000;
}

.tblborder td, .tblborder th{
    padding: 5px 10px; /* Reduzido padding para algo mais razoável */
}

/* Removido .positionRi - Não parece ser usado ou é complexo demais para o contexto */

/* Otimização de quebras de página */
@page {
    size: A4 portrait; /* Define o tamanho da página para A4 */
    margin: 1cm; /* Margem padrão para impressão */
}
table { page-break-inside:auto }
tr { page-break-inside:avoid; page-break-after:auto }
thead { display:table-header-group }
tfoot { display:table-footer-group }


@media print {
    .no-print, .no-print * {
        display: none !important;
    }
    .pagebreak { page-break-before: always; }
}
</style>

</head>

<body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>

    <p class="no-print">
        <br>
        <br>
    <button style="width: 100%; height: 6%; font-size: large; background: #0275d8; color: white; cursor: pointer;" onclick='window.print();'>IMPRIMIR</button> 
    </p>

<?php 

// --- 2. Lógica de Roteamento de Impressão (Mantida e Limpa) ---
/*
    A lógica de roteamento é complexa, usando idserie e seguimento para decidir qual função chamar.
    Não há como otimizar o roteamento sem saber o conteúdo das funções 'diarioFrequencia_...'.
    A principal melhoria é garantir que os parâmetros de paginação/limite estejam corretos para cada chamada.
*/

// Funções auxiliares para redefinir parâmetros de paginação
function reset_params_part2(&$inicio, &$fim, &$conta_aula, &$limite_data, &$limite_aula) {
    // Redefinição para a Segunda Página (Final)
    $inicio = 36;
    $conta_aula = 37; // AULA 37 em diante

    // Esses limites parecem ser para a PARTE 2 da tabela
    $limite_data = 31; 
    $limite_aula = 31;
    $fim = 30; // Diferente do limite, usado no LIMIT da query
}

function reset_params_inf_fund1_part2(&$inicio, &$fim, &$conta_aula, &$limite_data, &$limite_aula) {
    // Redefinição para a Segunda Página (Infantil/Fund 1)
    $inicio = 36;
    $conta_aula = 36; // AULA 36 em diante (mantendo o valor do código original)

    // Esses limites parecem ser para a PARTE 2 da tabela
    $limite_data = 41;
    $limite_aula = 30;
    $fim = 41; // Diferente do limite, usado no LIMIT da query
}


if ($idserie < 3 || $seguimento == 1) {
    // Roteamento: Educação Infantil (idserie < 3 OU seguimento 1)
    
    // Parte 1
    diario_frequencia_infantil($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);
    echo "<div class='pagebreak'> </div>";

    // Parte 2
    reset_params_inf_fund1_part2($inicio, $fim, $conta_aula, $limite_data, $limite_aula);
    diario_frequencia_pagina_final_infantil($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);

} elseif ($idserie >= 3 && $idserie < 8 || $seguimento == 2) {
    // Roteamento: Ensino Fundamental 1 (idserie 3-7 OU seguimento 2)

    // Parte 1
    diario_frequencia_fund1($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);
    echo "<div class='pagebreak'> </div>";
    
    // Parte 2
    reset_params_inf_fund1_part2($inicio, $fim, $conta_aula, $limite_data, $limite_aula);
    diario_frequencia_pagina_final_fund1($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);

} elseif ($seguimento == 3 || ($idserie >= 8 && $idserie <= 11)) { 
    // Roteamento: Ensino Fundamental 2 (seguimento 3 OU idserie 8-11, o else abaixo pega o restante)

    // Parte 1
    diario_frequencia_fund2($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);
    echo "<div class='pagebreak'> </div>";

    // Parte 2
    reset_params_part2($inicio, $fim, $conta_aula, $limite_data, $limite_aula);
    diario_frequencia_pagina_final_fund2($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);

} else {
    // Roteamento: Qualquer outro caso, incluindo Coordenador (usando Fund 2 como padrão)
    
    if (isset($_GET['coordenacao'])) {
        // Lógica de Coordenador: Itera por todas as disciplinas da turma
        
        // Assumindo que listar_disciplina_da_turma retorna as disciplinas
        $pes = listar_disciplina_da_turma($conexao, $idturma, $idescola, $ano_letivo);

        foreach ($pes as $linha) {
            $iddisciplina_loop = $linha['iddisciplina'];
            $nome_disciplina = $linha['nome_disciplina'];

            // Redefinição de parâmetros para cada disciplina
            $inicio = 0;
            $fim = 36;
            $conta_aula = 1;
            $conta_data = 1;
            $limite_data = 36;
            $limite_aula = 36;
            
            echo "<br><br><button style='width: 100%; height: 6%; font-size: large; background: #0FDEC2; color: black;' class='no-print'>$nome_disciplina</button>";

            // Parte 1
            diario_frequencia_fund2($conexao, $idescola, $idturma, $iddisciplina_loop, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);
            echo "<div class='pagebreak'> </div>";

            // Parte 2
            reset_params_part2($inicio, $fim, $conta_aula, $limite_data, $limite_aula);
            diario_frequencia_pagina_final_fund2($conexao, $idescola, $idturma, $iddisciplina_loop, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);
        }

    } else {
        // Lógica Padrão (Sem Coordenador) - usa os IDs de $_GET
        
        // Parte 1
        diario_frequencia_fund2($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);
        echo "<div class='pagebreak'> </div>";

        // Parte 2
        reset_params_part2($inicio, $fim, $conta_aula, $limite_data, $limite_aula);
        diario_frequencia_pagina_final_fund2($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento);
    }
}
?>
</body>
</html>