<?php
// Certifique-se de que a função converte_data() e as funções de listagem estejam definidas antes de usar este código.

function diario_frequencia_fund1($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento){

    // --- OTIMIZAÇÃO 1: Definindo Variáveis de Disciplina e Ensino de forma mais limpa ---
    $nome_disciplina = '';
    $tipo_ensino = "";
    $disciplinas_query = ""; // Nova variável para a condição IN na frequência

    if ($idserie == 16) {
        if ($seguimento == 1) {
            $tipo_ensino = "Educação Infantil";
        } elseif ($seguimento == 2) {
            $tipo_ensino = "Ensino Fundamental - Anos Iniciais";
        } elseif ($seguimento == 3) {
            $tipo_ensino = "Ensino Fundamental - Anos Finais";
        }
    } elseif ($idserie < 3) {
        $tipo_ensino = "Educação Infantil";
    } elseif ($idserie >= 3 && $idserie < 8) {
        $tipo_ensino = "Ensino Fundamental - Anos Iniciais";
    } elseif ($idserie >= 8 && $idserie <= 11) {
        $tipo_ensino = "Ensino Fundamental - Anos Finais";
    } elseif ($idserie > 11) {
        $tipo_ensino = "Educação de Jovens e Adultos";
    }

    if ($idserie > 2 && $iddisciplina == 1000) {
        $disciplinas = [1, 5, 6, 7, 14, 35, 47];
    } elseif ($idserie == 1 && $iddisciplina == 1000) {
        $disciplinas = [40, 42, 43, 44];
    } elseif ($idserie == 2 && $iddisciplina == 1000) {
        $disciplinas = [40, 42, 44];
    } else {
        $disciplinas = [$iddisciplina];
    }

    $disciplinas_query = implode(',', $disciplinas);
    $result_disc = $conexao->query("SELECT nome_disciplina FROM disciplina WHERE iddisciplina IN ($disciplinas_query)");

    foreach ($result_disc as $key => $value) {
        $nome_disciplina .= $value['nome_disciplina'] . ", ";
    }
    $nome_disciplina = rtrim($nome_disciplina, ', ');

    // --- Busca e Armazena as Datas/Aulas ---
    // A consulta foi unificada e otimizada para ser executada apenas uma vez.
    $query_data_aula = "
        SELECT data_frequencia, aula 
        FROM frequencia 
        WHERE escola_id=$idescola 
        AND turma_id=$idturma 
        AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
        AND disciplina_id IN ($disciplinas_query)
        GROUP BY data_frequencia, aula 
        ORDER BY data_frequencia, aula ASC 
        LIMIT $inicio, $fim
    ";
    
    // Se for Educação Infantil, a restrição de disciplina_id não é necessária na frequência, mas mantemos
    // a busca para Educação Infantil separada por clareza (assumindo que $disciplinas_query é a lista correta
    // de IDs de disciplina para o caso $iddisciplina==1000).

    if ($idserie < 3 && $iddisciplina == 1000) {
        // Para Educação Infantil (idserie < 3) com iddisciplina=1000, assumimos que busca todas as disciplinas
        // já que no código original não havia restrição de disciplina nesse caso, exceto no cabeçalho.
         $query_data_aula = "
            SELECT data_frequencia, aula 
            FROM frequencia 
            WHERE escola_id=$idescola 
            AND turma_id=$idturma 
            AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
            GROUP BY data_frequencia, aula 
            ORDER BY data_frequencia, aula ASC 
            LIMIT $inicio, $fim
        ";
    }

    $result_data_aula = $conexao->query($query_data_aula);

    $array_data_aula = [];
    $array_aula = [];
    $conta_data_real = 0;
    foreach ($result_data_aula as $value) {
        $array_data_aula[$conta_data_real] = $value['data_frequencia'];
        $array_aula[$conta_data_real] = $value['aula'];
        $conta_data_real++;
    }

    // --- Pré-carregamento da Frequência de Todos os Alunos/Datas ---
    // Este é o ganho de desempenho principal.

    $alunos_ids = [];
    if ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
        $res_alunos = listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    } else {
        $res_alunos = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    }
    foreach ($res_alunos as $aluno) {
        $alunos_ids[] = $aluno['idaluno'];
    }

    $frequencia_alunos = [];
    if (!empty($alunos_ids)) {
        $alunos_in = implode(',', $alunos_ids);
        
        // As datas no array $array_data_aula já estão no formato 'Y-m-d'
        $frequencia_datas = array_unique($array_data_aula); 
        $datas_in = implode("','", $frequencia_datas);

        $frequencia_query = "
            SELECT aluno_id, data_frequencia, aula, presenca 
            FROM frequencia 
            WHERE escola_id=$idescola 
            AND turma_id=$idturma 
            AND aluno_id IN ($alunos_in) 
            AND data_frequencia IN ('$datas_in')
        ";

        // Se for por disciplina ou grupo, aplica o filtro de disciplina
        if ($iddisciplina != 1000 || $idserie >= 3) {
             $frequencia_query .= " AND disciplina_id IN ($disciplinas_query)";
        }
        
        $result_frequencia = $conexao->query($frequencia_query);
        
        foreach ($result_frequencia as $frequencia) {
            $aluno_id = $frequencia['aluno_id'];
            $data = $frequencia['data_frequencia'];
            $aula = $frequencia['aula'];
            
            // Chave do array: [aluno_id][data_frequencia][aula]
            $frequencia_alunos[$aluno_id][$data][$aula] = $frequencia['presenca'];
        }
    }


    // --- Configuração dos Colspan do Cabeçalho ---
    $colspan_cabecalho_info = 37; // Mantenha o original se for necessário para a estrutura de tabelas
    $colspan_turma_nome = 29; // Mantenha o original
    $colspan_disciplina = 10; // Colspan da linha do Componente Curricular
    $total_colunas_data = $limite_aula; // Número total de colunas de datas a serem preenchidas
    $colspan_data_aula = $total_colunas_data;
    
    // Colunas na tabela de dados: N°(1) + ALUNO(1) + Data/Aula(X) = 2 + X
    // Para dar mais espaço ao nome do aluno, usamos 2 colunas: N° (1) + ALUNO(COLSPAN=2) + Data/Aula (X)
    $colspan_aluno = 2; // Coluna do nome do aluno terá 2 colunas de largura.
    $colspan_data_aula_header = $limite_aula; // O cabeçalho 'Aula/Data' irá sobrepor todas as colunas de data/aula

    // A coluna do número de ordem (N°) é a primeira.
    // A coluna do nome do aluno é a segunda e terá o colspan.
    // O cabeçalho 'ALUNO(A)' ocupará 2 colunas de largura.
    
    // Ajustando o Colspan da Linha de Dados da Escola/Turma se necessário, embora não afete a tabela principal.
    $colspan_escola_info = 37; // Mantendo o original para não quebrar a estrutura.
?>

<style>
    /* Estilos CSS para garantir que o nome do aluno não seja espremido */
    .aluno-nome {
        /* Largura base razoável, se o colspan não for suficiente */
        width: 250pt; 
        max-width: 250pt;
        min-width: 250pt;
        text-align: left; /* Alinhamento à esquerda para nomes */
        padding-left: 5px !important; /* Mais padding para o nome do aluno */
    }
    .col-data {
        width: 10pt; /* Colunas de data bem estreitas */
        min-width: 10pt;
        max-width: 10pt;
        text-align: center;
    }
    .col-ordem {
        width: 15.4pt;
    }
    .rotate {
        /* CSS para rotação, como no seu código original */
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        white-space: nowrap;
        height: 58.75pt;
        vertical-align: bottom;
    }
</style>

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
    
    <td nowrap colspan=<?php echo $colspan_cabecalho_info; ?> valign=bottom style='padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
        <p style='margin-bottom:0cm;line-height:normal'>
            <span style='position:absolute;z-index:251659264;margin-top:0px;
                width:68px;height:75px'><img width=68 height=75 src="imagens/logo.png" v:shapes="Imagem_x0020_6">
            </span>
            <br>
            <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%;'>
                <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;'>
                    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                        <b><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
                            color:black;mso-fareast-language:PT-BR;margin-left: 100px;'>
                            <?php echo $_SESSION['ORGAO']; ?> <o:p></o:p>
                        </span></b>
                    </p>
                </tr>
            </table>
        </td>
    </tr>

    <tr style='mso-yfti-irow:2;height:18.0pt'>
        <td nowrap colspan=<?php echo $colspan_cabecalho_info; ?> valign=bottom style='padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
            line-height:normal'><b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR; margin-left: 300px;'>DIÁRIO DE CLASSE <o:p></o:p></span></b></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:3;height:18.0pt'>
        <td nowrap colspan=<?php echo $colspan_cabecalho_info; ?> valign=bottom style='padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
            line-height:normal'><b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR; margin-left: 300px;'><o:p></o:p></span></b></p>
        </td>
    </tr>
    
    <tr style='mso-yfti-irow:4;height:12.0pt'>
        <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>&nbsp;</td>
        <td nowrap colspan=<?php echo $colspan_cabecalho_info; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>
            ESCOLA MUNICIPAL: <?php
                $result_escola = $conexao->query("SELECT nome_escola FROM escola WHERE idescola =$idescola");
                foreach ($result_escola as $value) {
                    echo $value['nome_escola'];
                }
            ?>
            <o:p></o:p></span></b></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:5;height:12.0pt'>
        <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>&nbsp;</td>
        <td nowrap colspan=<?php echo $colspan_turma_nome; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>
            ENDEREÇO: <o:p></o:p></span></b></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:6;height:12.0pt'>
        <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>&nbsp;</td>
        <td nowrap style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>
            TIPO DE ENSINO: <?php echo $tipo_ensino; ?> <o:p></o:p></span></b></p>
        </td>
        <td nowrap colspan=<?php echo $colspan_turma_nome; ?> style='width:263.6pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>
            Codigo U.E.<span style='mso-spacerun:yes'> </span><o:p></o:p></span></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:7;height:12.0pt'>
        <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>&nbsp;</td>
        <td nowrap colspan=<?php echo $colspan_turma_nome; ?> style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>
            TURMA:
            <?php
                $result_turma = $conexao->query("SELECT nome_turma FROM turma WHERE idturma =$idturma");
                foreach ($result_turma as $value) {
                    echo $value['nome_turma'];
                }
            ?>
            <o:p></o:p></span></b></p>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
            style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
            "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>
            PERIODO LETIVO <?php echo $ano_letivo; ?><o:p></o:p></span></b></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:8;height:15.0pt'>
        <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>&nbsp;</td>
        <td nowrap colspan=<?php echo $colspan_disciplina; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
            style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR'>
            COMPONENTE CURRICULAR: <b> <?php echo $nome_disciplina; ?></b> </span></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:9;height:16.5pt'>
        <td width=21 nowrap style='width:15.4pt;border-top:none;border-left:solid windowtext 1.0pt;
            border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 3.5pt 0cm 3.5pt;
            height:16.5pt'>&nbsp;</td>
        <td nowrap colspan=<?php echo $colspan_disciplina; ?> style='border:none;border-bottom:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
            style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR'>
            UNIDADE: <?php echo " $descricao_trimestre " . converte_data($data_inicio_trimestre) . " " . converte_data($data_fim_trimestre); ?>
            <o:p></o:p></span></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:10;height:12.0pt'>
        <td class="col-ordem" nowrap rowspan=2 style='border-top:none;border-left:solid windowtext 1.0pt;
            border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:12.0pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                <div class="Namerotate" ><span style='font-size:12.0pt;'>&nbsp;</span></div>
            </p>
        </td>

        <td nowrap rowspan=2 colspan="<?php echo $colspan_aluno; ?>" class="aluno-nome" style='border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
            line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
            color:black;'>ALUNO(A)<o:p></o:p></span></b></p>
        </td>

        <td nowrap colspan="<?php echo $colspan_data_aula_header; ?>" style='border:none;border-bottom:solid windowtext 1.0pt;border-top:solid windowtext 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
            line-height:normal'><b><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
            color:black;'>Aula/Data<o:p></o:p></span></b></p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:11;height:58.75pt'>

    <?php
    // --- Impressão das Datas/Aulas Reais ---
    $conta_data_header = 0;
    for ($i = 0; $i < $conta_data_real; $i++) {
        $data_frequencia = $array_data_aula[$i];
        $class_data = ($i % 2 == 0) ? 'background:#D9D9D9;' : '';
        ?>
        <td class="col-data" style='border:solid windowtext 1.0pt;
            border-left:none;<?php echo $class_data; ?> padding:0cm 0pt 0cm 0pt;'>
            <div class="rotate" >
                <span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;color:black;'>
                <?php echo "" . converte_data($data_frequencia); ?>
                </span>
            </div>
        </td>
        <?php
        $conta_data_header++;
    }

    // --- Impressão das Datas/Aulas Vazias (Preenchimento) ---
    for ($i = $conta_data_header; $i < $limite_data; $i++) {
        $class_data = ($i % 2 == 0) ? 'background:#D9D9D9;' : '';
        ?>
        <td class="col-data" style='border:solid windowtext 1.0pt;
            border-left:none;<?php echo $class_data; ?> padding:0cm 0pt 0cm 0pt;'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                <div class="rotate"><span style='font-size:6.0pt;'>&nbsp;</span></div>
            </p>
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
        // $data_matricula = $value['data_matricula']; // Não é mais estritamente necessário no loop, pois filtramos no pré-carregamento

        $nome_a_exibir = ($nome_identificacao_social != '') ? $nome_identificacao_social : $nome_aluno;
        ?>

        <tr style='mso-yfti-irow:13;height:13.5pt'>
            <td class="col-ordem" style='border:solid windowtext 1.0pt;border-top:none;
                background:white;padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                color:black;'><?php echo "$conta"; ?> <o:p></o:p></span></p>
            </td>

            <td nowrap colspan="<?php echo $colspan_aluno; ?>" class="aluno-nome" valign=bottom style='border:none;border-bottom:solid windowtext 1.0pt;
                padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt;font-size:9.0pt; text-transform: uppercase;'>
                <?php echo $nome_a_exibir; ?>
            </td>


            <?php
            // --- Impressão das Presenças/Faltas (Otimizada) ---
            $conta_presenca = 1;

            for ($i = 0; $i < $conta_data_real; $i++) {
                $data_frequencia = $array_data_aula[$i];
                $aula = $array_aula[$i];

                // Busca no array pré-carregado
                $presenca_valor = $frequencia_alunos[$idaluno][$data_frequencia][$aula] ?? null;

                $presenca = "<span style='font-size: 18px;'>-</span>"; // Padrão: Não houve aula ou não há registro
                if ($presenca_valor !== null) {
                    if ($presenca_valor == 1) {
                        $presenca = "."; // Presença
                    } else if ($presenca_valor == 0) {
                        $presenca = "F"; // Falta
                    }
                }
                ?>
                <td class="col-data" nowrap valign=top style='border:solid windowtext 1.0pt;border-top:none;
                    background:white;height:13.5pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0cm;line-height:normal'>
                        <b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                        color:black;'><?php echo $presenca; ?></span></b>
                    </p>
                </td>
                <?php
                $conta_presenca++;
            }

            // --- Células de Frequência Vazias (Preenchimento) ---
            for ($i = $conta_presenca; $i <= $limite_aula; $i++) {
                ?>
                <td class="col-data" nowrap valign=top style='border:solid windowtext 1.0pt;border-top:none;
                    background:white;height:13.5pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
                    line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
                    color:black;'>&nbsp;</span></b></p>
                </td>
                <?php
            }
            ?>
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