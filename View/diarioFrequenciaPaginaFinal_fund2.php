<?php

// A função exige que $conexao seja um objeto PDO válido e que as funções
// listar_aluno_da_turma_ata_resultado_final, listar_aluno_da_turma_ata_resultado_final_matricula_concluida
// e converte_data (incluída abaixo) estejam definidas ou acessíveis.

function diario_frequencia_pagina_final_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento,$mapa_total_faltas_pagina1){

// =====================================================================
// I. BLOCO DE PROCESSAMENTO (LÓGICA) - MANTIDO INALTERADO
// ... (Lógica de processamento original) ...
// =====================================================================

// 1.1 Buscar Nome da Disciplina, Escola e Turma (Lógica existente)
$stmt_disc = $conexao->query("SELECT nome_disciplina FROM disciplina WHERE iddisciplina = $iddisciplina");
$nome_disciplina = $stmt_disc->fetch(PDO::FETCH_ASSOC)['nome_disciplina'] ?? '';

$stmt_escola = $conexao->query("SELECT nome_escola FROM escola WHERE idescola = $idescola");
$nome_escola = $stmt_escola->fetch(PDO::FETCH_ASSOC)['nome_escola'] ?? '';

$stmt_turma = $conexao->query("SELECT nome_turma FROM turma WHERE idturma = $idturma");
$nome_turma = $stmt_turma->fetch(PDO::FETCH_ASSOC)['nome_turma'] ?? '';

// 1.2 Determinação do Tipo de Ensino (Lógica existente)
$tipo_ensino = "";
if ($idserie == 16) {
if ($seguimento == 1) {
$tipo_ensino = "Educação Infantil";
} elseif ($seguimento == 2) {
$tipo_ensino = "Ensino Fundamental - Anos Iniciais";
} elseif ($seguimento == 3) {
$tipo_ensino = "Ensino Fundamental - Anos Finais";
}
} else {
switch (true) {
case ($idserie < 3):
$tipo_ensino = "Educação Infantil";
break;
case ($idserie >= 3 && $idserie < 8):
$tipo_ensino = "Ensino Fundamental - Anos Iniciais";
break;
case ($idserie >= 8 && $idserie <= 11):
$tipo_ensino = "Ensino Fundamental - Anos Finais";
break;
case ($idserie > 11 && $idserie < 17):
$tipo_ensino = "Educação de Jovens e Adultos";
break;
case ($idserie == 17):
$tipo_ensino = "Atendimento Educacional Especializado";
break;
}
}

// 1.3 Buscar Datas/Aulas de Frequência (Lógica existente)
$query_frequencia = "
SELECT data_frequencia, aula
FROM frequencia
WHERE escola_id = $idescola
AND turma_id = $idturma
AND disciplina_id = $iddisciplina
AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
GROUP BY data_frequencia, aula
ORDER BY data_frequencia ASC
LIMIT $inicio, $fim
";
$result_data_aula = $conexao->query($query_frequencia)->fetchAll(PDO::FETCH_ASSOC);

$array_data_aula = [];
$array_aula = [];
$conta_data_offset = $inicio;
foreach ($result_data_aula as $row) {
$array_data_aula[$conta_data_offset] = $row['data_frequencia'];
$array_aula[$conta_data_offset] = $row['aula'];
$conta_data_offset++;
}
$num_aulas_carregadas = count($result_data_aula);
$limite_loop_data_aula = $inicio + $num_aulas_carregadas;

// 1.4 Buscar Dados dos Alunos (Lógica existente)
$res_alunos_raw = ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente'])
? listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo'])
: listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);

$res_alunos = [];
if (is_array($res_alunos_raw)) {
$res_alunos = $res_alunos_raw;
} elseif ($res_alunos_raw instanceof PDOStatement) {
try {
$res_alunos = $res_alunos_raw->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
$res_alunos = [];
}
}
$alunos_ids = array_column($res_alunos, 'idaluno');

// 1.5 OTIMIZAÇÃO CRÍTICA: Pré-busca de todas as frequências da página (Lógica existente)
$frequencia_chaves = [];
for ($i = $inicio; $i < $limite_loop_data_aula; $i++) {
$data = $array_data_aula[$i];
$aula = $array_aula[$i];
$frequencia_chaves[] = "('$data', '$aula')";
}
$frequencia_chaves_str = implode(', ', $frequencia_chaves);

$frequencias_aluno = [];
$total_faltas_aluno = [];

if (!empty($alunos_ids)) {
$alunos_ids_str = implode(',', $alunos_ids);

// 1.5.1 Pré-busca das presenças da página (Lógica existente)
if (!empty($frequencia_chaves_str)) {
$query_presencas = "
SELECT aluno_id, data_frequencia, aula, presenca
FROM frequencia
WHERE escola_id = $idescola
AND turma_id = $idturma
AND disciplina_id = $iddisciplina
AND aluno_id IN ($alunos_ids_str)
AND (data_frequencia, aula) IN ($frequencia_chaves_str)
";
$result_presencas = $conexao->query($query_presencas)->fetchAll(PDO::FETCH_ASSOC);

// Organizar os resultados em um array para acesso rápido
foreach ($result_presencas as $row) {
$aluno_id = $row['aluno_id'];
$data_freq = $row['data_frequencia'];
$aula_freq = $row['aula'];

if (!isset($frequencias_aluno[$aluno_id])) {
$frequencias_aluno[$aluno_id] = [];
}
if (!isset($frequencias_aluno[$aluno_id][$data_freq])) {
$frequencias_aluno[$aluno_id][$data_freq] = [];
}
$frequencias_aluno[$aluno_id][$data_freq][$aula_freq] = $row['presenca'];
}
}

// 1.5.2 Pré-busca do total de faltas do período (Lógica existente)
$query_total_faltas = "
SELECT aluno_id, SUM(CASE WHEN presenca = 0 THEN 1 ELSE 0 END) AS total_faltas
FROM frequencia
WHERE escola_id = $idescola
AND turma_id = $idturma
AND disciplina_id = $iddisciplina
AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
AND aluno_id IN ($alunos_ids_str)
GROUP BY aluno_id
";
$result_total_faltas = $conexao->query($query_total_faltas)->fetchAll(PDO::FETCH_ASSOC);

foreach ($result_total_faltas as $row) {
$total_faltas_aluno[$row['aluno_id']] = $row['total_faltas'];
}

// =================================================================
// 1.6 NOVA LÓGICA: Pré-busca de todas as NOTAS
// =================================================================
$query_notas = "
SELECT aluno_id, avaliacao, nota
FROM nota_parecer
WHERE ano_nota = '$ano_letivo'
AND escola_id = $idescola
AND turma_id = $idturma
AND disciplina_id = $iddisciplina
AND periodo_id = $periodo_id
AND aluno_id IN ($alunos_ids_str)
AND avaliacao IN ('av1', 'av2', 'av3', 'rp')
ORDER BY aluno_id, avaliacao DESC
";
$result_notas = $conexao->query($query_notas)->fetchAll(PDO::FETCH_ASSOC);

$notas_aluno = [];
foreach ($result_notas as $row) {
$aluno_id = $row['aluno_id'];
$avaliacao = $row['avaliacao'];
// Armazena a nota, garantindo que seja um número (float) ou 0 se nula.
$notas_aluno[$aluno_id][$avaliacao] = (float)($row['nota'] ?? 0);
}
}

// 1.7 Função auxiliar (Lógica existente)
if (!function_exists('converte_data')) {
function converte_data($data) {
if (empty($data) || $data == '0000-00-00') return '';
return date('d/m/Y', strtotime($data));
}
}

// CÁLCULO DE LAYOUT: Largura em pontos (pt) para a seção de Aulas/Datas (Lógica existente)
$LARGURA_TOTAL_FREQUENCIA_PT = 548;
$NUM_COLUNAS_EXIBIDAS = $limite_aula;
// A largura de cada coluna de aula é crucial para a simetria.
$LARGURA_COLUNA_PT = ($NUM_COLUNAS_EXIBIDAS > 0) ? round($LARGURA_TOTAL_FREQUENCIA_PT / $NUM_COLUNAS_EXIBIDAS, 2) : 20;

// NOVAS CONSTANTES DE LAYOUT OTIMIZADAS
// Redução da largura para AV1, AV2, AV3, RP e MÉDIA
$LARGURA_COLUNA_NOTA_PT = 25;
$LARGURA_COLUNA_FALTAS_PT = 30; // Largura para a coluna Faltas
?>

<style>
/* ** CSS OTIMIZADO **
Removendo a maioria dos mso- específicos, mantendo apenas o necessário para rotação no Word. 
*/

table {
    border-collapse: collapse;
    width: 100%;
}

td, th {
    /* Estilos globais para células */
    vertical-align: middle;
    padding: 0cm 3.5pt 0cm 3.5pt;
    border: solid windowtext 1.0pt;
    font-family: "Tw Cen MT Condensed", sans-serif;
    color: black;
}

.header-cell {
    text-align: center;
    font-weight: bold;
}

.table-header-info td {
    border: none;
    border-left: solid windowtext 1.0pt; /* Mantém a borda esquerda para a primeira célula */
    padding: 0.5pt 3.5pt;
    font-size: 10.0pt;
    height: 12.0pt;
}

.table-header-info td:last-child {
    border-right: solid windowtext 1.0pt; /* Garante a borda direita na última célula */
}

/* Estilo para a rotação de texto (simulação para HTML, mas o mso-rotate:90 é o que funciona no Word) */
.Namerotate {
    display: block;
    text-align: center;
    /* Ajusta o padding/margin para melhor centralização no modo rotacionado */
    line-height: 0.8;
}

/* Estilos específicos para células rotacionadas */
.rotated-cell {
    /* Mantém a tag mso-rotate na TD, que é o que o Word usa */
    /* text-align: center; não é necessário aqui, pois a rotação inverte as dimensões */
    padding: 0cm 0pt 0cm 0pt !important; /* Remove padding interno para maximizar espaço */
    height: 0.25pt; /* Minimiza a altura inicial para layout vertical */
    overflow: hidden;
}

/* Estilos para as colunas de Notas/Média */
.nota-cell {
    font-size: 9.0pt;
    text-align: center;
}

/* Estilo para as células de frequência (o ponto/F) */
.frequencia-cell {
    font-size: 10.0pt;
    text-align: center;
}

/* Estilo para a coluna de contagem (primeira coluna) */
.contagem-cell {
    width: 15.4pt;
    font-size: 8.0pt;
    text-align: center;
    padding: 0cm 3.5pt;
}
</style>


<div class=WordSection1>

<table border=1 cellspacing=0 cellpadding=0 style='width: 100%;'>

<tr style='height:30.0pt'>
    <td colspan=2 style='width:15.4pt; border:solid windowtext 1.0pt; border-bottom:none;'>
        <img width=68 height=75 src="imagens/logo.png" style="float: left; margin-right: 10pt;">
    </td>
    <td colspan=<?php echo $NUM_COLUNAS_EXIBIDAS + 6; ?> class="header-cell" style='font-size:20.0pt; border:solid windowtext 1.0pt; border-left:none; border-bottom:none;'>
        <?php echo $_SESSION['ORGAO']; ?>
    </td>
</tr>

<tr style='height:18.0pt'>
    <td colspan=2 style='width:15.4pt; border:solid windowtext 1.0pt; border-top:none; border-bottom:none;'>&nbsp;</td>
    <td colspan=<?php echo $NUM_COLUNAS_EXIBIDAS + 6; ?> class="header-cell" style='font-size:16.0pt; border:solid windowtext 1.0pt; border-left:none; border-top:none;'>
        DIÁRIO DE CLASSE
    </td>
</tr>

<tr class="table-header-info">
    <td class="contagem-cell" style="width:15.4pt; border-top:solid windowtext 1.0pt;">&nbsp;</td>
    <td colspan=<?php echo $NUM_COLUNAS_EXIBIDAS + 7; ?> style='width: 100%;'>
        <b>ESCOLA MUNICIPAL:</b> <?php echo $nome_escola; ?>
    </td>
</tr>
<tr class="table-header-info">
    <td class="contagem-cell">&nbsp;</td>
    <td colspan=<?php echo $NUM_COLUNAS_EXIBIDAS + 7; ?>>
        <b>ENDEREÇO:</b>
    </td>
</tr>
<tr class="table-header-info">
    <td class="contagem-cell">&nbsp;</td>
    <td colspan=<?php echo floor(($NUM_COLUNAS_EXIBIDAS + 7) / 2); ?>>
        <b>TIPO DE ENSINO:</b> <?php echo $tipo_ensino; ?>
    </td>
    <td colspan=<?php echo ceil(($NUM_COLUNAS_EXIBIDAS + 7) / 2); ?>>
        Codigo U.E.
    </td>
</tr>
<tr class="table-header-info">
    <td class="contagem-cell">&nbsp;</td>
    <td colspan=<?php echo floor(($NUM_COLUNAS_EXIBIDAS + 7) / 2); ?>>
        <b>TURMA:</b> <?php echo $nome_turma; ?>
    </td>
    <td colspan=<?php echo ceil(($NUM_COLUNAS_EXIBIDAS + 7) / 2); ?>>
        <b>PERIODO LETIVO</b> <?php echo "$ano_letivo"; ?>
    </td>
</tr>
<tr class="table-header-info">
    <td class="contagem-cell">&nbsp;</td>
    <td colspan=<?php echo $NUM_COLUNAS_EXIBIDAS + 7; ?>>
        COMPONENTE CURRICULAR: <b><?php echo $nome_disciplina; ?></b>
    </td>
</tr>
<tr class="table-header-info">
    <td class="contagem-cell" style="border-bottom:solid windowtext 1.0pt;">&nbsp;</td>
    <td colspan=<?php echo $NUM_COLUNAS_EXIBIDAS + 7; ?> style='border-bottom:solid windowtext 1.0pt;'>
        UNIDADE: <?php echo "$descricao_trimestre " . converte_data($data_inicio_trimestre) . " a " . converte_data($data_fim_trimestre); ?>
    </td>
</tr>


<tr style='height:12.0pt'>

    <td rowspan=2 class="contagem-cell" style='mso-rotate:90; padding:0cm 0pt;'>
        <div class="Namerotate" style='font-size:12.0pt;'>&nbsp;&nbsp;</div>
    </td>

    <td rowspan=2 style='width:195.55pt; border-left:none;' class="header-cell">
        ALUNO(A)
    </td>

    <td colspan='<?php echo $NUM_COLUNAS_EXIBIDAS; ?>' style='width:<?php echo $LARGURA_TOTAL_FREQUENCIA_PT; ?>pt;' class="header-cell">
        Aula/Data
    </td>

    <td rowspan=2 style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt;' class="rotated-cell" mso-rotate:90;>
        <div class="Namerotate"><span class="nota-cell">AV1</span></div>
    </td>
    <td rowspan=2 style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt;' class="rotated-cell" mso-rotate:90;>
        <div class="Namerotate"><span class="nota-cell">AV2</span></div>
    </td>
    <td rowspan=2 style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt;' class="rotated-cell" mso-rotate:90;>
        <div class="Namerotate"><span class="nota-cell">AV3</span></div>
    </td>
    <td rowspan=2 style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt;' class="rotated-cell" mso-rotate:90;>
        <div class="Namerotate"><span class="nota-cell">RP</span></div>
    </td>
    <td rowspan=2 style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt;' class="rotated-cell" mso-rotate:90;>
        <div class="Namerotate"><span class="nota-cell">MÉDIA</span></div>
    </td>

    <td rowspan=2 style='width:<?php echo $LARGURA_COLUNA_FALTAS_PT; ?>pt;' class="rotated-cell" mso-rotate:90;>
        <div class="Namerotate"><span style='font-size:10.0pt;'>FALTAS</span></div>
    </td>

</tr>

<tr style='height:58.75pt'>
    <?php
    for ($i = $inicio; $i < ($inicio + $limite_aula); $i++) {
        $data_frequencia = $array_data_aula[$i] ?? null;
        $is_even = (($i - $inicio) % 2 == 0); // Ímpar/Par baseado no loop atual, não no offset
    ?>
        <td width='<?php echo $LARGURA_COLUNA_PT; ?>' style='width:<?php echo $LARGURA_COLUNA_PT; ?>pt; border-left:none; <?php echo $is_even ? 'background:#D9D9D9;' : ''; ?>' 
            class="rotated-cell" mso-rotate:90;>
            <div class="Namerotate">
                <span style='font-size:8.0pt;'>
                    <?php echo ($data_frequencia) ? converte_data($data_frequencia) : '&nbsp;'; ?>
                </span>
            </div>
        </td>
    <?php
    }
    ?>
    </tr>


<tr style='height:18.0pt'>
    <td class="contagem-cell" style='border-top:none;'>&nbsp;</td>

    <td style='border-left:none; border-top:none;'>&nbsp;</td>

    <?php
    for ($i = $inicio; $i < ($inicio + $limite_aula); $i++) {
        $is_even = (($i - $inicio) % 2 == 0);
    ?>
        <td width='<?php echo $LARGURA_COLUNA_PT; ?>' style='width:<?php echo $LARGURA_COLUNA_PT; ?>pt; border-left:none; border-top:none; <?php echo $is_even ? 'background:#D9D9D9;' : ''; ?>'
            class="rotated-cell" mso-rotate:90;>
            <div class="Namerotate">
                <span style='font-size:7.0pt;'>
                    <?php echo "Aula " . ($i + 1); ?>
                </span>
            </div>
        </td>
    <?php
    }
    ?>

    <td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:solid windowtext 1.0pt; border-top:none;'>&nbsp;</td>
    <td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
    <td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
    <td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
    <td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
    <td style='width:<?php echo $LARGURA_COLUNA_FALTAS_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
</tr>


<?php
$conta = 1;
foreach ($res_alunos as $value) {
$idaluno = $value['idaluno'];
$nome_aluno = ($value['nome_aluno']);
$nome_identificacao_social = ($value['nome_identificacao_social']);
$nome_exibido = (!empty($nome_identificacao_social)) ? $nome_identificacao_social : $nome_aluno;

// CÁLCULO DAS NOTAS E FALTAS (MANTIDO)
$nota_av1 = $notas_aluno[$idaluno]['av1'] ?? 0;
$nota_av2 = $notas_aluno[$idaluno]['av2'] ?? 0;
$nota_av3 = $notas_aluno[$idaluno]['av3'] ?? 0;
$nota_rp = $notas_aluno[$idaluno]['rp'] ?? 0;
$nota_final_av3 = max($nota_av3, $nota_rp);

$media_aritmetica = 0;
if (($nota_av1 + $nota_av2 + $nota_final_av3) > 0) {
$media_aritmetica = ($nota_av1 + $nota_av2 + $nota_final_av3) / 3;
}
$media_formatada = ($media_aritmetica > 0) ? number_format($media_aritmetica, 1, ',', '') : '';

$faltas_do_aluno = $total_faltas_aluno[$idaluno] ?? 0;

?>
<tr style='height:13.5pt'>

<td class="contagem-cell" style='border-top:none;'>
<?php echo $conta; ?>
</td>

<td style='width:195.55pt; border-left:none; border-top:none; font-size:9.0pt; text-transform: uppercase; padding:0cm 3.5pt;'>
<?php echo $nome_exibido; ?>
</td>

<?php
for ($i = $inicio; $i < ($inicio + $limite_aula); $i++) {

$presenca = "&nbsp;"; 
if ($i < $limite_loop_data_aula) {
$data_frequencia = $array_data_aula[$i];
$aula = $array_aula[$i];
$is_present = $frequencias_aluno[$idaluno][$data_frequencia][$aula] ?? null;

if ($is_present == 1) {
$presenca = ".";
} elseif ($is_present == 0) {
$presenca = "F";
}
}

$is_even = (($i - $inicio) % 2 == 0);
?>
<td width='<?php echo $LARGURA_COLUNA_PT; ?>' style='width:<?php echo $LARGURA_COLUNA_PT; ?>pt; border-left:none; border-top:none; <?php echo $is_even ? 'background:#D9D9D9;' : ''; ?>'
    class="frequencia-cell">
 <?php echo $presenca; ?>
</td>
<?php
}
?>

 <td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:solid windowtext 1.0pt; border-top:none;' class="nota-cell">
<?php echo ($nota_av1 > 0) ? number_format($nota_av1, 1, ',', '') : ''; ?>
</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;' class="nota-cell">
<?php echo ($nota_av2 > 0) ? number_format($nota_av2, 1, ',', '') : ''; ?>
</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;' class="nota-cell">
<?php echo ($nota_av3 > 0) ? number_format($nota_av3, 1, ',', '') : ''; ?>
</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;' class="nota-cell">
<?php echo ($nota_rp > 0) ? number_format($nota_rp, 1, ',', '') : ''; ?>
</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;' class="nota-cell">
<?php echo $media_formatada; ?>
</td>

<td style='width:<?php echo $LARGURA_COLUNA_FALTAS_PT; ?>pt; border-left:none; border-top:none; text-align: center;'>
 <span class="frequencia-cell">
 <?php echo $faltas_do_aluno; ?>
 </span>
</td>

</tr>
<?php
$conta++;
}
?>
<?php 
// Adiciona linhas vazias até, digamos, 30 alunos. Ajuste este limite conforme necessário.
$MAX_ALUNOS = 30; 
while ($conta <= $MAX_ALUNOS) { 
?>
<tr style='height:13.5pt'>
<td class="contagem-cell" style='border-top:none;'>
<?php echo $conta; ?>
</td>
<td style='width:195.55pt; border-left:none; border-top:none; padding:0cm 3.5pt;'>&nbsp;</td>
<?php
for ($i = $inicio; $i < ($inicio + $limite_aula); $i++) {
$is_even = (($i - $inicio) % 2 == 0);
?>
<td width='<?php echo $LARGURA_COLUNA_PT; ?>' style='width:<?php echo $LARGURA_COLUNA_PT; ?>pt; border-left:none; border-top:none; <?php echo $is_even ? 'background:#D9D9D9;' : ''; ?>'>&nbsp;</td>
<?php
}
?>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:solid windowtext 1.0pt; border-top:none;'>&nbsp;</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
<td style='width:<?php echo $LARGURA_COLUNA_NOTA_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
<td style='width:<?php echo $LARGURA_COLUNA_FALTAS_PT; ?>pt; border-left:none; border-top:none;'>&nbsp;</td>
</tr>
<?php 
$conta++;
} 
?>

</table>

</div>

<?php
// Fim da função
}