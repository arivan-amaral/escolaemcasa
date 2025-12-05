<?php

// A função exige que $conexao seja um objeto PDO válido e que as funções
// listar_aluno_da_turma_ata_resultado_final, listar_aluno_da_turma_ata_resultado_final_matricula_concluida
// e converte_data (incluída abaixo) estejam definidas ou acessíveis.

function diario_frequencia_pagina_final_fund2($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
     $conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento){
    
    // =====================================================================
    // I. BLOCO DE PROCESSAMENTO (LÓGICA)
    // =====================================================================

    // 1.1 Buscar Nome da Disciplina, Escola e Turma
    $stmt_disc = $conexao->query("SELECT nome_disciplina FROM disciplina WHERE iddisciplina = $iddisciplina");
    $nome_disciplina = $stmt_disc->fetch(PDO::FETCH_ASSOC)['nome_disciplina'] ?? '';

    $stmt_escola = $conexao->query("SELECT nome_escola FROM escola WHERE idescola = $idescola");
    $nome_escola = $stmt_escola->fetch(PDO::FETCH_ASSOC)['nome_escola'] ?? '';

    $stmt_turma = $conexao->query("SELECT nome_turma FROM turma WHERE idturma = $idturma");
    $nome_turma = $stmt_turma->fetch(PDO::FETCH_ASSOC)['nome_turma'] ?? '';

    // 1.2 Determinação do Tipo de Ensino
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
    
    // 1.3 Buscar Datas/Aulas de Frequência lançadas no período (Limitado por $inicio e $fim)
    // ATENÇÃO: $inicio é o offset, $fim é a quantidade de registros
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
    // O contador deve começar no $inicio para mapear corretamente o índice (coluna)
    $conta_data_offset = $inicio;
    foreach ($result_data_aula as $row) {
        $array_data_aula[$conta_data_offset] = $row['data_frequencia'];
        $array_aula[$conta_data_offset] = $row['aula'];
        $conta_data_offset++;
    }
    $num_aulas_carregadas = count($result_data_aula);
    // Este limite marca a última coluna preenchida
    $limite_loop_data_aula = $inicio + $num_aulas_carregadas; 

    // 1.4 Buscar Dados dos Alunos (Com Tratamento de Erro de Tipo/Retorno)
    
    $res_alunos_raw = ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) 
        ? listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo'])
        : listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    
    $res_alunos = [];

    // Verificação de tipo e conversão para array
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

    // 1.5 OTIMIZAÇÃO CRÍTICA: Pré-busca de todas as frequências da página
    $frequencia_chaves = [];
    // A busca deve ir até o final dos dados carregados (limite_loop_data_aula)
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

        // 1.5.1 Pré-busca das presenças da página
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
        
        // 1.5.2 Pré-busca do total de faltas do período (para preencher a coluna final)
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
    }
    
    // 1.6 Função auxiliar
    if (!function_exists('converte_data')) {
        function converte_data($data) {
            if (empty($data) || $data == '0000-00-00') return '';
            return date('d/m/Y', strtotime($data));
        }
    }

    // CÁLCULO DE LAYOUT: Determina a largura total disponível para a seção de frequência (em WordML/pt)
    $LARGURA_TOTAL_FREQUENCIA_PT = 548; // Largura em pontos (pt) para a seção de Aulas/Datas
    // O número de colunas a exibir é o $limite_aula total que a página deve ter.
    $NUM_COLUNAS_EXIBIDAS = $limite_aula; 
    
    // Calcula a largura de cada coluna individualmente para que todas tenham o mesmo tamanho
    $LARGURA_COLUNA_PT = ($NUM_COLUNAS_EXIBIDAS > 0) ? round($LARGURA_TOTAL_FREQUENCIA_PT / $NUM_COLUNAS_EXIBIDAS, 2) : 20;

?>


<div class=WordSection1>

    <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%;'>

        <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.0pt'>
            <td width=11 nowrap valign=bottom style='width:15.4pt;border-top:solid windowtext 1.0pt;
                border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
                padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            
            <td width=824 nowrap colspan=30 valign=bottom style='width:618.25pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
                <p style='margin-bottom:0cm;line-height:normal'>
                    <span style='mso-ignore:vglayout;
                        position:absolute;z-index:251659264;margin-top:0px;
                        width:68px;height:75px'><img width=68 height=75
                        src="imagens/logo.png" v:shapes="Imagem_x0020_6"></span><span
                        style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
                        "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></p><br>
                
                <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%;'>
                    <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;'>
                        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                            line-height:normal'><b><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                            color:black;mso-fareast-language:PT-BR;margin-left: 100px;'>
                            <?php echo $_SESSION['ORGAO']; ?> <o:p></o:p></span></b>
                        </p>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr style='mso-yfti-irow:2;height:18.0pt'>
            <td width=824 nowrap colspan=25 valign=bottom style='width:618.25pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR; margin-left: 300px;'>DIÁRIO DE CLASSE <o:p></o:p></span></b></p>
            </td>
        </tr>

        <tr style='mso-yfti-irow:4;height:12.0pt'>
            <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            <td width=808 nowrap colspan=29 style='width:606.25pt;padding:0cm 3.5pt 0cm 3.5pt;
                height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
                            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
                            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
                            PT-BR'>ESCOLA MUNICIPAL:<span style='mso-spacerun:yes'>
                                <?php echo $nome_escola; ?>
                            </span><o:p></o:p></span></b></p>
            </td>
        </tr>

        <tr style='mso-yfti-irow:5;height:12.0pt'>
            <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            <td width=808 nowrap colspan=29 style='width:606.25pt;padding:0cm 3.5pt 0cm 3.5pt;
                height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
                            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
                            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
                            PT-BR'>ENDEREÇO:<span style='mso-spacerun:yes'> </span><o:p></o:p></span></b></p>
            </td>
        </tr>

        <tr style='mso-yfti-irow:6;height:12.0pt'>
            <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            <td width=457 nowrap colspan=11 style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;
                height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
                            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
                            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
                            PT-BR'>TIPO DE ENSINO: <?php echo $tipo_ensino; ?> <o:p></o:p></span></b></p>
            </td>
            <td width=351 nowrap colspan=18 style='width:263.6pt;padding:0cm 3.5pt 0cm 3.5pt;
                height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        class=SpellE><span style='font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>Codigo</span></span><span
                        style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
                        "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
                        PT-BR'> U.E.<span style='mso-spacerun:yes'> </span><o:p></o:p></span></p>
            </td>
        </tr>

        <tr style='mso-yfti-irow:7;height:12.0pt'>
            <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            <td width=457 nowrap colspan=11 style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;
                height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
                            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
                            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
                            PT-BR'>TURMA: <o:p>
                                <?php echo $nome_turma; ?>
                            </o:p></span></b></p>
            </td>
            <td width=351 nowrap colspan=18 style='width:263.6pt;padding:0cm 3.5pt 0cm 3.5pt;
                height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
                            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
                            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
                            PT-BR'>PERIODO LETIVO <?php echo "$ano_letivo"; ?><o:p></o:p></span></b></p>
            </td>
        </tr>

        <tr style='mso-yfti-irow:8;height:15.0pt'>
            <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            <td width=261 colspan="10" style='width:195.55pt;padding:0cm 3.5pt 0cm 3.5pt;
                height:15.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>COMPONENTE CURRICULAR: <b> <?php echo $nome_disciplina; ?></b> </span></p>
            </td>
        </tr>

        <tr style='mso-yfti-irow:9;height:16.5pt'>
            <td width=21 nowrap style='width:15.4pt;border-top:none;border-left:solid windowtext 1.0pt;
                border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 3.5pt 0cm 3.5pt;
                height:16.5pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            <td width=261 nowrap style='width:195.55pt;border:none;border-bottom:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>UNIDADE:
                        <?php echo "$descricao_trimestre " . converte_data($data_inicio_trimestre) . " a " . converte_data($data_fim_trimestre); ?>
                        <o:p></o:p></span></p>
            </td>
            <td width=20 nowrap style='width:14.8pt;border:none;border-bottom:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
                        style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
        </tr>

        <tr style='mso-yfti-irow:10;height:12.0pt'>
            
            <td width=21 nowrap rowspan=2 style='width:15.4pt; border-top:none;border-left:
                solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:12.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                    <div class="Namerotate" ><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>&nbsp;&nbsp;</span></div>
                </p>
            </td>

            <td width=261 nowrap rowspan=2 style='width:195.55pt;border-top:none;
                border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
                mso-border-left-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;
                mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>ALUNO(A)<o:p></o:p></span></b></p>
            </td>

            <td width='<?php echo $LARGURA_TOTAL_FREQUENCIA_PT; ?>' nowrap colspan='<?php echo $NUM_COLUNAS_EXIBIDAS; ?>' style='width:<?php echo $LARGURA_TOTAL_FREQUENCIA_PT; ?>pt;border:none;border-bottom:
                solid windowtext 1.0pt;border-top:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;height:12.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><b><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>Aula/Data<o:p></o:p></span></b></p>
            </td>
            
            <td width=60 nowrap rowspan=2 style='width:12.0pt; border-top::solid windowtext 1.0pt; border-left:
                solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
                mso-rotate:90;height:12.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><div class="Namerotate" ><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>TRIM I<o:p></o:p></span></div></p>
            </td>  


            <td width=60 nowrap rowspan=2 style='width:12.0pt; border-top::solid windowtext 1.0pt; border-left:
                solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
                mso-rotate:90;height:12.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><div class="Namerotate" ><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>TRIM II<o:p></o:p></span></div></p>
            </td>   

            
            <td width=60 nowrap rowspan=2 style='width:12.0pt; border-top::solid windowtext 1.0pt; border-left:
                solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
                mso-rotate:90;height:12.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><div class="Namerotate" ><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>TRIM III<o:p></o:p></span></div></p>
            </td>   



            <td width=60 nowrap rowspan=2 style='width:12.0pt; border-top::solid windowtext 1.0pt; border-left:
                solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
                mso-rotate:90;height:12.0pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><div class="Namerotate" ><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>FALTAS<o:p></o:p></span></div></p>
            </td>




        </tr>

        <tr style='mso-yfti-irow:11;height:58.75pt'>
            <?php
            // O loop agora vai de 0 até $limite_aula, garantindo que todas as colunas sejam preenchidas.
            for ($i = $inicio; $i < ($inicio + $limite_aula); $i++) {
                
                // Verifica se esta coluna tem dados reais (i.e., se i < $limite_loop_data_aula)
                $data_frequencia = $array_data_aula[$i] ?? null; 
                $is_even = ($i % 2 == 0); 
                ?>
                <td width='<?php echo $LARGURA_COLUNA_PT; ?>' style='width:<?php echo $LARGURA_COLUNA_PT; ?>pt;border:solid windowtext 1.0pt;
                    border-left:none;<?php echo $is_even ? 'background:#D9D9D9;' : ''; ?>mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
                    solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
                    <span style='writing-mode: vertical-lr;font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'>
                    <?php 
                        // Se houver dado real para esta coluna, exibe a data
                        echo ($data_frequencia) ? converte_data($data_frequencia) : '&nbsp;'; 
                    ?>
                    </span>
                </td>
            <?php
            }
            ?>
        </tr>

        <tr style='mso-yfti-irow:12;height:72.25pt'>
            <?php
            // O loop agora vai de 0 até $limite_aula, garantindo que todas as colunas sejam preenchidas.
            for ($i = $inicio; $i < ($inicio + $limite_aula); $i++) {
                $is_even = ($i % 2 == 0);
                ?>
                <td width='<?php echo $LARGURA_COLUNA_PT; ?>' style='width:<?php echo $LARGURA_COLUNA_PT; ?>pt;border:solid windowtext 1.0pt;
                    border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
                    solid windowtext 1.0pt;<?php echo $is_even ? 'background:#D9D9D9;' : ''; ?>mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><div class="Namerotate"><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                    color:black;mso-fareast-language:PT-BR'> 
                    <?php echo "Aula " . ($inicio + 1); ?> 
                    </div></span></p>
                </td>
                <?php
            }
            ?>
        </tr>


        <?php
        $conta = 1;
        foreach ($res_alunos as $value) {
            $idaluno = $value['idaluno'];
            $nome_aluno = ($value['nome_aluno']);
            $nome_identificacao_social = ($value['nome_identificacao_social']);
            $data_matricula = $value['data_matricula'];
            $nome_exibido = (!empty($nome_identificacao_social)) ? $nome_identificacao_social : $nome_aluno;
            ?>
            <tr style='mso-yfti-irow:<?php echo 12 + $conta; ?>;height:13.5pt'>
                
                <td width=21 style='width:15.4pt;border:solid windowtext 1.0pt;border-top:
                    none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
                    mso-border-right-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
                    height:13.5pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                        line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'>
                        <?php echo $conta; ?>
                        <o:p></o:p></span></p>
                </td>

                <td width=261 nowrap valign=bottom style='width:235.55pt;border:none;
                    border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
                    mso-border-left-alt:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
                    mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
                    padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt;font-size:9.0pt; text-transform: uppercase;'>
                    <?php echo $nome_exibido; ?>
                </td>




                <?php
                // Loop de preenchimento das presenças (células de frequência)
                // O loop agora vai de 0 até $limite_aula, garantindo que todas as colunas sejam preenchidas.
                for ($i = $inicio; $i < ($inicio + $limite_aula); $i++) {
                    
                    $presenca = "<span style='font-size: 18px;'>&nbsp;</span>"; // Valor padrão (não lançada ou vazia)

                    // Só tenta buscar dados se a coluna $i estiver dentro do intervalo de dados carregados
                    if ($i < $limite_loop_data_aula) {
                        $data_frequencia = $array_data_aula[$i];
                        $aula = $array_aula[$i];

                        // Acessar o array de pré-busca
                        $is_present = $frequencias_aluno[$idaluno][$data_frequencia][$aula] ?? null;

                        if ($is_present !== null) {
                            // Checa se a data da frequência é posterior ou igual à data de matrícula
                            if (strtotime($data_frequencia) >= strtotime($data_matricula)) {
                                if ($is_present == 1) {
                                    $presenca = "."; // Presente
                                } elseif ($is_present == 0) {
                                    $presenca = "F"; // Falta
                                }
                            }
                        }
                    }
                    
                    ?>
                    <td width='<?php echo $LARGURA_COLUNA_PT; ?>' nowrap valign=top style='width:<?php echo $LARGURA_COLUNA_PT; ?>pt;border:solid windowtext 1.0pt;
                        border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:
                        solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background:
                        white;height:13.5pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0cm;
                            line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                            color:black;mso-fareast-language:PT-BR'><?php echo $presenca; ?></span></b></p>
                    </td>
                    <?php
                }
                
                // Célula Total de Faltas (Calculada)
                $total_faltas = $total_faltas_aluno[$idaluno] ?? 0;
                ?>
                <td width=60 style='width:12.0pt;border:solid windowtext 1.0pt;border-top:
                    none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
                    mso-border-right-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
                    height:13.5pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                        line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                        color:black;mso-fareast-language:PT-BR'><?php echo $total_faltas; ?></span></b></p>
                </td>

            </tr>
            <?php
            $conta++;
        }
        ?>

    </table>
</div>

<?php 
}
?>