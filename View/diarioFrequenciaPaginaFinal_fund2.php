<?php

/**
 * Gera a página final do diário de frequência para o Fundamental II.
 *
 * @param object $conexao Conexão com o banco de dados.
 * @param int $idescola ID da escola.
 * @param int $idturma ID da turma.
 * @param int $iddisciplina ID da disciplina.
 * @param int $inicio Offset inicial para as aulas.
 * @param int $fim Limite de aulas a serem exibidas (fim do offset).
 * @param int $conta_aula Contador de aulas.
 * @param int $conta_data Contador de datas.
 * @param int $limite_data Limite total de colunas de data.
 * @param int $limite_aula Limite total de colunas de aula.
 * @param int $periodo_id ID do período (trimestre/bimestre).
 * @param int $idserie ID da série.
 * @param string $descricao_trimestre Descrição do período.
 * @param string $data_inicio_trimestre Data de início do período.
 * @param string $data_fim_trimestre Data de fim do período.
 * @param int $ano_letivo Ano letivo.
 * @param int $seguimento Seguimento (se idserie == 16).
 * @return void
 */
function diario_frequencia_pagina_final_fund2(
    $conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim,
    $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie,
    $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento
) {
    // --- 1. Pré-processamento e Consultas Otimizadas ---

    // 1.1 Determinar o Tipo de Ensino
    $tipo_ensino = "";
    if ($idserie == 16) {
        if ($seguimento == 1) $tipo_ensino = "Educação Infantil";
        else if ($seguimento == 2) $tipo_ensino = "Ensino Fundamental - Anos Iniciais";
        else if ($seguimento == 3) $tipo_ensino = "Ensino Fundamental - Anos Finais";
    } else if ($idserie < 3) {
        $tipo_ensino = "Educação Infantil";
    } else if ($idserie >= 3 && $idserie < 8) {
        $tipo_ensino = "Ensino Fundamental - Anos Iniciais";
    } else if ($idserie >= 8 && $idserie <= 11) {
        $tipo_ensino = "Ensino Fundamental - Anos Finais";
    } else if ($idserie > 11 && $idserie < 17) {
        $tipo_ensino = "Educação de Jovens e Adultos";
    } else if ($idserie == 17) {
        $tipo_ensino = "Atendimento Educacional Especializado";
    }

    // 1.2 Obter Dados da Disciplina, Escola e Turma (Consultas Únicas)
    // Reduzindo consultas repetidas no HTML.

    $nome_disciplina = '';
    $result_disc = $conexao->query("SELECT nome_disciplina FROM disciplina WHERE iddisciplina=$iddisciplina");
    if ($row = $result_disc->fetch_assoc()) {
        $nome_disciplina = $row['nome_disciplina'];
    }
    
    $nome_escola = '';
    $result_escola = $conexao->query("SELECT nome_escola FROM escola WHERE idescola =$idescola");
    if ($row = $result_escola->fetch_assoc()) {
        $nome_escola = $row['nome_escola'];
    }

    $nome_turma = '';
    $result_turma = $conexao->query("SELECT nome_turma FROM turma WHERE idturma =$idturma");
    if ($row = $result_turma->fetch_assoc()) {
        $nome_turma = $row['nome_turma'];
    }

    // 1.3 Obter Dados de Aulas e Frequência (Data/Aula)
    // Buscar todas as datas/aulas de uma vez.
    $query_data_aula = "
        SELECT data_frequencia, aula
        FROM frequencia
        WHERE escola_id=$idescola
          AND turma_id=$idturma
          AND disciplina_id=$iddisciplina
          AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
        GROUP BY data_frequencia, aula
        ORDER BY data_frequencia ASC
        LIMIT $inicio,$fim
    ";
    $result_data_aula = $conexao->query($query_data_aula);
    $array_data_aula = [];
    $array_aula = [];
    while ($row = $result_data_aula->fetch_assoc()) {
        $array_data_aula[] = $row['data_frequencia'];
        $array_aula[] = $row['aula'];
        $conta_data++; // Atualiza o contador de dados reais
    }

    // 1.4 Obter Dados de Avaliações/Notas
    $query_nota_aula = "
        SELECT data_nota, avaliacao
        FROM nota_parecer
        WHERE ano_nota='$ano_letivo'
          AND escola_id=$idescola
          AND turma_id=$idturma
          AND disciplina_id=$iddisciplina
          AND periodo_id=$periodo_id
        GROUP BY avaliacao, periodo_id, data_nota
        LIMIT 3
    ";
    $result_nota_aula = $conexao->query($query_nota_aula);
    $array_data_nota = [];
    $array_avaliacao = [];
    $conta_nota = 1;
    while ($row = $result_nota_aula->fetch_assoc()) {
        $array_data_nota[$conta_nota] = $row['data_nota'];
        $array_avaliacao[$conta_nota] = $row['avaliacao'];
        $conta_nota++;
    }

    // 1.5 Obter Lista de Alunos
    $funcao_alunos = ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente'])
        ? 'listar_aluno_da_turma_ata_resultado_final'
        : 'listar_aluno_da_turma_ata_resultado_final_matricula_concluida';
    // Assumindo que essas funções são definidas em outro lugar e retornam um array de resultados.
    $res_alunos = $funcao_alunos($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);

    // --- 2. Geração do HTML (Mais limpo e com menos PHP inline) ---
?>

<div class=WordSection1>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%;'>

<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.0pt'>
    <td width=11 nowrap valign=bottom style='width:15.4pt;border-top:solid windowtext 1.0pt; border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none; padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
    <td width=824 nowrap colspan=30 valign=bottom style='width:618.25pt; padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
        <p style='margin-bottom:0cm;line-height:normal'>
            <span style='mso-ignore:vglayout; position:absolute;z-index:251659264;margin-top:0px; width:68px;height:75px'><img width=68 height=75 src="imagens/logo.png" v:shapes="Imagem_x0020_6"></span>
            <span style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p></o:p></span>
        </p>
        <br>
        <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%;'>
            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'>
                    <b><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR;margin-left: 100px;'>
                        <?php echo $_SESSION['ORGAO']; ?> <o:p></o:p>
                    </span></b>
                </p>
            </tr>
        </table>
    </td>
</tr>

<tr style='mso-yfti-irow:2;height:18.0pt'>
    <td width=824 nowrap colspan=25 valign=bottom style='width:618.25pt; padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR; margin-left: 300px;'>DIÁRIO DE CLASSE <o:p></o:p></span></b></p>
    </td>
</tr>
<tr style='mso-yfti-irow:2;height:18.0pt'>
    <td width=824 nowrap colspan=25 valign=bottom style='width:618.25pt; padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR; margin-left: 300px;'><o:p></o:p></span></b></p>
    </td>
</tr>

<tr style='mso-yfti-irow:4;height:12.0pt'>
    <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
    <td width=808 nowrap colspan=29 style='width:606.25pt;padding:0cm 3.5pt 0cm 3.5pt; height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family: "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language: PT-BR'>ESCOLA MUNICIPAL:.<span style='mso-spacerun:yes'> <?php echo $nome_escola; ?></span><o:p></o:p></span></b></p>
    </td>
</tr>

<tr style='mso-yfti-irow:5;height:12.0pt'>
    <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
    <td width=808 nowrap colspan=29 style='width:606.25pt;padding:0cm 3.5pt 0cm 3.5pt; height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family: "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language: PT-BR'>ENDEREÇO:<span style='mso-spacerun:yes'> </span><o:p></o:p></span></b></p>
    </td>
</tr>

<tr style='mso-yfti-irow:6;height:12.0pt'>
    <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
    <td width=457 nowrap colspan=11 style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt; height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family: "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language: PT-BR'>TIPO DE ENSINO:  <?php echo $tipo_ensino; ?> <o:p></o:p></span></b></p>
    </td>
    <td width=351 nowrap colspan=18 style='width:263.6pt;padding:0cm 3.5pt 0cm 3.5pt; height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span class=SpellE><span style='font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>Codigo</span></span><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family: "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language: PT-BR'> U.E.<span style='mso-spacerun:yes'> </span><o:p></o:p></span></p>
    </td>
</tr>

<tr style='mso-yfti-irow:7;height:12.0pt'>
    <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
    <td width=457 nowrap colspan=11 style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt; height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family: "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language: PT-BR'>TURMA: <?php echo $nome_turma; ?> </span></b></p>
    </td>
    <td width=351 nowrap colspan=18 style='width:263.6pt;padding:0cm 3.5pt 0cm 3.5pt; height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family: "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language: PT-BR'>PERIODO LETIVO <?php echo "$ano_letivo"; ?><o:p></o:p></span></b></p>
    </td>
</tr>

<tr style='mso-yfti-irow:8;height:15.0pt'>
    <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
    <td width=261 colspan="10" style='width:195.55pt;padding:0cm 3.5pt 0cm 3.5pt; height:15.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>COMPONENTE CURRICULAR: <b> <?php echo $nome_disciplina; ?></b> </span></p>
    </td>
</tr>

<tr style='mso-yfti-irow:9;height:16.5pt'>
    <td width=21 nowrap style='width:15.4pt;border-top:none;border-left:solid windowtext 1.0pt; border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 3.5pt 0cm 3.5pt; height:16.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
    <td width=261 nowrap style='width:195.55pt;border:none;border-bottom:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>UNIDADE: 
            <?php echo " $descricao_trimestre " . (function_exists('converte_data') ? converte_data($data_inicio_trimestre) : $data_inicio_trimestre) . " " . (function_exists('converte_data') ? converte_data($data_fim_trimestre) : $data_fim_trimestre); ?>
            <o:p></o:p>
        </span></p>
    </td>
    <td width=20 nowrap style='width:14.8pt;border:none;border-bottom:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
    </td>
</tr>

<tr style='mso-yfti-irow:10;height:12.0pt'>
    <td width=21 nowrap rowspan=3 style='width:15.4pt; border-top:none;border-left: solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:12.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'>
            <div class="Namerotate" >
                <span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;</span>
            </div>
        </p>
    </td>
    <td width=261 nowrap rowspan=3 style='width:195.55pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; mso-border-left-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt; mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>ALUNO(A)<o:p></o:p></span></b></p>
    </td>

    <td width=548 nowrap colspan=17 style='width:150.7pt;border:none;border-bottom: solid windowtext 1.0pt;border-top: solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;height:12.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>Aula/Data<o:p></o:p></span></b></p>
    </td>

    <td width=164 nowrap colspan='100%' style='width:13.2pt;border-bottom: solid windowtext 1.0pt;border-left: solid windowtext 1.0pt; border-top:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>Rendimento<o:p></o:p></span></b></p>
    </td>

    <td width=60 nowrap rowspan=3 style='width:12.0pt; border-top::solid windowtext 1.0pt; border-left: solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt; mso-rotate:90;height:12.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><div class="Namerotate" ><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>FALTAS<o:p></o:p></span></div></p>
    </td>
</tr>

<tr style='mso-yfti-irow:11;height:58.75pt'>

    <?php
    $converter_data = function_exists('converte_data') ? 'converte_data' : function($d) { return $d; };

    // Datas das aulas reais
    foreach ($array_data_aula as $key => $data_frequencia) {
        $bg_color = ($key % 2 == 0) ? 'background:#D9D9D9;' : '';
        $data_formatada = $converter_data($data_frequencia);
        echo "<td style='border:solid windowtext 1.0pt; border-left:none;{$bg_color}mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>";
        echo "<span style='writing-mode: vertical-lr;font-size:8.0pt;font-family:\"Tw Cen MT Condensed\",sans-serif; mso-fareast-font-family:\"Times New Roman\";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>{$data_formatada}</span></td>";
    }

    // Colunas de data vazias (para preencher o limite)
    $conta_data_vazia = count($array_data_aula);
    for ($i = $conta_data_vazia; $i < $limite_data ; $i++) {
        $bg_color = ($i % 2 == 0) ? 'background:#D9D9D9;' : '';
        echo "<td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt; border-left:none;{$bg_color}mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>";
        echo "<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><div class=\"Namerotate\"><span style='font-size:6.0pt;font-family:\"Tw Cen MT Condensed\",sans-serif; mso-fareast-font-family:\"Times New Roman\";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;</span></div></p></td>";
    }

    // Datas das avaliações
    foreach ($array_data_nota as $nota_index => $data_nota) {
        $data_formatada = $converter_data($data_nota);
        echo "<td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt; border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>";
        echo "<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><div class=\"Namerotate\"><span style='font-size:8.0pt;font-family:\"Tw Cen MT Condensed\",sans-serif; mso-fareast-font-family:\"Times New Roman\";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>{$data_formatada}</span></div></p></td>";
    }

    // Colunas de nota vazias (para preencher 3)
    for($i = $conta_nota; $i < 4; $i++) {
        echo "<td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt; border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>";
        echo "<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><div class=\"Namerotate\"><span style='font-size:8.0pt;font-family:\"Tw Cen MT Condensed\",sans-serif; mso-fareast-font-family:\"Times New Roman\";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;</span></div></p></td>";
    }
    ?>

    <td width=41 nowrap rowspan=2 style='width:30.8pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt; mso-border-left-alt:solid windowtext 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt; mso-rotate:90;height:48.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><div class="Namerotate"><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>RP<o:p></o:p></span></div></b></p>
    </td>
    <td width=41 nowrap rowspan=2 style='width:30.8pt;border-top:none;border-left: none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt; mso-border-left-alt:solid windowtext 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt; mso-rotate:90;height:48.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><b><div class="Namerotate"><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>RU<o:p></o:p></span></div></b></p>
    </td>

</tr>

<tr style='mso-yfti-irow:12;height:72.25pt'>

    <?php
    $conta_aula = 1; // Reinicia o contador de aulas para a linha de "Aula X"

    // Colunas de aulas reais (usando count($array_aula) ao invés de buscar novamente)
    for ($i = 0; $i < count($array_aula); $i++) {
        $bg_color = ($conta_aula % 2 == 0) ? 'background:#D9D9D9;' : '';
        echo "<td style='border:solid windowtext 1.0pt; border-left:none;{$bg_color}mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>";
        echo "<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><div class=\"Namerotate\"><span style='font-size:7.0pt;font-family:\"Tw Cen MT Condensed\",sans-serif; mso-fareast-font-family:\"Times New Roman\";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'> Aula {$conta_aula} </span></div></p></td>";
        $conta_aula++;
    }

    // Colunas de aula vazias (para preencher o limite)
    for ($i = $conta_aula; $i <= $limite_aula; $i++) {
        $bg_color = ($i % 2 == 0) ? 'background:#D9D9D9;' : '';
        echo "<td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt; border-left:none;{$bg_color}mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:.25pt'>";
        echo "<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><div class=\"Namerotate\"><span style='font-size:7.0pt;font-family:\"Tw Cen MT Condensed\",sans-serif; mso-fareast-font-family:\"Times New Roman\";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'> Aula {$i} </span></div></p></td>";
        $conta_aula++;
    }
    ?>

    <td width=10 style='width:30.8pt;border-top:none;border-left:none;border-bottom: solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;background: #D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:32.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>1-AV <o:p></o:p></span></p>
    </td>
    <td width=41 style='width:30.8pt;border-top:none;border-left:none;border-bottom: solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;background: white;padding:0cm 3.5pt 0cm 3.5pt;height:32.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>2-AV <o:p></o:p></span></p>
    </td>
    <td width=41 style='width:30.8pt;border-top:none;border-left:none;border-bottom: solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:white; padding:0cm 3.5pt 0cm 3.5pt;height:32.25pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>3-AV <o:p></o:p></span></p>
    </td>
</tr>

<?php
$conta = 1;

// Preparar a busca de frequência dos alunos para evitar N+1 queries.
// Busca todas as frequências do período, turma e disciplina de uma vez.
$query_frequencias_alunos = "
    SELECT aluno_id, data_frequencia, aula, presenca
    FROM frequencia
    WHERE escola_id=$idescola
      AND turma_id=$idturma
      AND disciplina_id=$iddisciplina
      AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
";
$result_frequencias = $conexao->query($query_frequencias_alunos);
$frequencias_por_aluno_data_aula = [];

while ($row = $result_frequencias->fetch_assoc()) {
    $aluno_id = $row['aluno_id'];
    $data_frequencia = $row['data_frequencia'];
    $aula = $row['aula'];
    // Cria uma chave única (aluno_id-data-aula) para acesso rápido
    $frequencias_por_aluno_data_aula["{$aluno_id}-{$data_frequencia}-{$aula}"] = $row['presenca'];
}

foreach ($res_alunos as $value) {
    $idaluno = $value['idaluno'];
    $nome_aluno = ($value['nome_aluno']);
    $nome_identificacao_social = ($value['nome_identificacao_social']);
    $data_matricula = $value['data_matricula'];
    $nome_exibido = ($nome_identificacao_social != '') ? $nome_identificacao_social : $nome_aluno;
?>

<tr style='mso-yfti-irow:<?php echo 12 + $conta; ?>;height:13.5pt'>
    <td width=21 style='width:15.4pt;border:solid windowtext 1.0pt;border-top: none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt; mso-border-right-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt; height:13.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center; line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>
            <?php echo $conta; ?>
        <o:p></o:p></span></p>
    </td>

    <td width=261 nowrap valign=bottom style='width:235.55pt;border:none; border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt; mso-border-left-alt:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt; mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt; padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt;font-size:9.0pt; text-transform: uppercase;'>
        <?php echo $nome_exibido; ?>
    </td>

    <?php
    // Iterar sobre as aulas/datas para buscar a frequência
    $conta_presenca = 1;
    foreach ($array_aula as $key => $aula) {
        $data_frequencia = $array_data_aula[$key];
        $presenca_key = "{$idaluno}-{$data_frequencia}-{$aula}";
        $presenca_valor = $frequencias_por_aluno_data_aula[$presenca_key] ?? null;

        $presenca_exibida = "<span style='font-size: 18px;'>-</span>"; // Padrão para não encontrado

        if ($presenca_valor !== null) {
            // Verificar a data de matrícula (originalmente a consulta de frequência fazia isso)
            if ($data_frequencia >= $data_matricula) {
                if ($presenca_valor == 1) {
                    $presenca_exibida = ".";
                } else if ($presenca_valor == 0) {
                    $presenca_exibida = "F";
                }
            }
        }

        // Se a data da frequência for anterior à matrícula, o ideal é que seja '-'.
        // O código original não fazia uma verificação explícita do `data_frequencia>='$data_matricula'`
        // para *dentro* do loop de alunos. Adicionar aqui para clareza:
        if ($data_frequencia < $data_matricula) {
            $presenca_exibida = "<span style='font-size: 18px;'>-</span>";
        }
    ?>

    <td width=10 nowrap valign=top style='border:solid windowtext 1.0pt; border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background: white;height:13.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm; line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'><?php echo $presenca_exibida; ?></span></b></p>
    </td>

    <?php
        $conta_presenca++;
    }

    // Colunas de frequência vazias (para preencher o limite)
    for ($i = $conta_presenca; $i <= $limite_aula; $i++) {
    ?>

    <td width=10 nowrap valign=top style='border:solid windowtext 1.0pt; border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background: white;height:13.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm; line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif; mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial; color:black;mso-fareast-language:PT-BR'>&nbsp;</span></b></p>
    </td>

    <?php
    }
    // Faltam as 3 colunas de notas, RP e RU aqui, que foram cortadas no final da submissão original
    // (Presumindo que elas seriam adicionadas aqui com placeholders)
    ?>
    <td width=10 style='width:30.8pt;border-top:none;border-left:none;border-bottom: solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;background: #D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;height:32.25pt'>&nbsp;</td>
    <td width=41 style='width:30.8pt;border-top:none;border-left:none;border-bottom: solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;background: white;padding:0cm 3.5pt 0cm 3.5pt;height:32.25pt'>&nbsp;</td>
    <td width=41 style='width:30.8pt;border-top:none;border-left:none;border-bottom: solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:white; padding:0cm 3.5pt 0cm 3.5pt;height:32.25pt'>&nbsp;</td>

    <td width=41 nowrap valign=top style='border:solid windowtext 1.0pt; border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background: white;height:13.5pt'>&nbsp;</td>
    <td width=41 nowrap valign=top style='border:solid windowtext 1.0pt; border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt: solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background: white;height:13.5pt'>&nbsp;</td>
    
</tr>

<?php
    $conta++;
}
?>
</table>
<?php
// O resto da função original seria fechado aqui
}
// Assumindo que a função `converte_data` existe globalmente
if (!function_exists('converte_data')) {
    function converte_data($data) {
        if (empty($data) || $data == '0000-00-00') return '';
        return date('d/m/Y', strtotime($data));
    }
}
?>