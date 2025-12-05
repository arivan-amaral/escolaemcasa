<?php

/**
 * Função completa do Diário de Classe para Ensino Fundamental 1 e outros.
 * Otimizada para velocidade através da redução de consultas SQL (N+1 Queries).
 * Corrigida para garantir o alinhamento da tabela usando CSS (Layout) e revisão de lógica de filtro de disciplina.
 */
function diario_frequencia_fund1($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre,$ano_letivo,$seguimento){

    // Variáveis iniciais
    $nome_disciplina = '';
    $tipo_ensino = "";
    $colspan_header_data = $limite_aula;
    $colspan_info = $limite_aula + 1; 

    ## 1. Lógica de Tipo de Ensino
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

    ## 2. Otimização: Obter Nomes das Disciplinas (Consulta Única)
    $disciplina_ids = [];
    if ($idserie > 2 && $iddisciplina == 1000) {
        $disciplina_ids = [1, 5, 6, 7, 14, 35, 47]; // Fundamental II (disciplinas separadas)
    } elseif ($idserie == 1 && $iddisciplina == 1000) {
        $disciplina_ids = [40, 42, 43, 44]; // Ed. Infantil N1
    } elseif ($idserie == 2 && $iddisciplina == 1000) {
        $disciplina_ids = [40, 42, 44]; // Ed. Infantil N2
    } else {
        $disciplina_ids = [$iddisciplina]; // Disciplina única
    }

    $disciplina_list = implode(",", $disciplina_ids);
    $result_disc = $conexao->query("SELECT nome_disciplina FROM disciplina WHERE iddisciplina IN ($disciplina_list)");

    $nome_disciplina_array = [];
    foreach ($result_disc as $value) {
        $nome_disciplina_array[] = $value['nome_disciplina'];
    }
    $nome_disciplina = implode(", ", $nome_disciplina_array);


    ## 3. Otimização: Pré-busca de Dados de Frequência (N+1 Queries corrigido)

    // 3.1. Determina a cláusula WHERE para a disciplina (CORRIGIDA)
    $where_disciplina = "";
    if ($iddisciplina != 1000) {
        // Se for uma disciplina específica, filtra por ela
        $where_disciplina = "disciplina_id = $iddisciplina";
    } elseif ($idserie > 7 && $iddisciplina == 1000) {
        // Se for Fundamental II (Anos Finais) com ID 1000, filtra pelo conjunto de disciplinas
        $where_disciplina = "disciplina_id IN (1, 5, 6, 7, 14, 35, 47)";
    } else {
        // Para Fundamental I (Anos Iniciais) ou Educação Infantil, a frequência é geralmente única (1=1).
        // ATENÇÃO: Se isso estiver puxando dados incorretos, substitua '1=1' pelo ID da disciplina de Frequência Geral (ex: 'disciplina_id = 40').
        $where_disciplina = "1=1"; 
    }

    // 3.2. Consulta ÚNICA para obter todas as datas/aulas do período
    $result_data_aula = $conexao->query("
        SELECT data_frequencia, aula
        FROM frequencia
        WHERE
            escola_id = $idescola AND
            turma_id = $idturma AND
            $where_disciplina AND
            data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
        GROUP BY aula, data_frequencia
        ORDER BY data_frequencia, aula ASC
        LIMIT $inicio, $fim
    ");

    $array_data_aula = [];
    $array_aula = [];
    foreach ($result_data_aula as $key => $value) {
        $array_data_aula[$key] = $value['data_frequencia'];
        $array_aula[$key] = $value['aula'];
    }
    $conta_data_obtida = count($array_data_aula);


    // 3.3. Consulta ÚNICA para obter TODAS as presenças/faltas dos alunos para essas datas/aulas
    $frequencia_lookup = [];
    if (!empty($array_data_aula)) {
        
        // Criar a lista de condições (data E aula) para a cláusula IN / OR
        $data_aula_conditions = [];
        foreach ($array_data_aula as $key => $data) {
            $data_aula_conditions[] = "(data_frequencia = '{$data}' AND aula = {$array_aula[$key]})";
        }
        $data_aula_where = implode(" OR ", $data_aula_conditions);

        $query_frequencia_geral = "
            SELECT aluno_id, data_frequencia, aula, presenca
            FROM frequencia
            WHERE
                escola_id = $idescola AND
                turma_id = $idturma AND
                $where_disciplina AND
                ($data_aula_where)
        ";

        $result_frequencia_geral = $conexao->query($query_frequencia_geral);

        // 3.4. Cria um array de busca rápida (Lookup) para a frequência
        foreach ($result_frequencia_geral as $value) {
            $aluno_id = $value['aluno_id'];
            $data = $value['data_frequencia'];
            $aula = $value['aula'];
            $presenca = $value['presenca'];

            if (!isset($frequencia_lookup[$aluno_id])) {
                $frequencia_lookup[$aluno_id] = [];
            }
            if (!isset($frequencia_lookup[$aluno_id][$data])) {
                $frequencia_lookup[$aluno_id][$data] = [];
            }
            $frequencia_lookup[$aluno_id][$data][$aula] = $presenca;
        }
    }
?>

<style>
    /* Estilos para evitar desconfiguração da tabela e garantir alinhamento */
    .MsoNormalTable {
        width: 100%;
        table-layout: fixed; /* Força o navegador a respeitar as larguras */
        border-collapse: collapse; 
        font-family: "Tw Cen MT Condensed", sans-serif;
    }

    /* Colunas fixas para alinhamento */
    .col-num {
        width: 20pt !important;
        text-align: center;
        vertical-align: middle;
    }
    .col-aluno {
        width: 180pt !important; /* Aumento para melhor visualização */
        text-align: left;
        padding-left: 5pt !important;
        white-space: normal; 
    }

    /* Largura fixa para TODAS as colunas de data/aula e frequência */
    .celula-data-aula, .frequencia-celula {
        width: 20pt !important; 
        padding: 0;
        text-align: center;
        vertical-align: middle;
        overflow: hidden; 
        font-size: 8.0pt;
    }

    /* Estilo de rotação mais robusto para cabeçalho de data/aula */
    .rotaciona {
        white-space: nowrap;
        height: 100%;
        display: block; 
        font-family: "Tw Cen MT Condensed", sans-serif;
        font-size: 8.0pt;
        
        position: relative;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) rotate(90deg);
        transform-origin: 50% 50%;
        width: 100px;
        line-height: 100%;
    }
    
    .frequencia-celula p {
        margin: 0;
        line-height: 100%;
    }
</style>

<div class=WordSection1>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%; table-layout: fixed;'>

    <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.0pt'>
        <td width=11 nowrap valign=bottom style='width:15.4pt; border:solid windowtext 1.0pt; border-bottom:none; border-right:none; padding:0cm 3.5pt 0cm 3.5pt; height:15.0pt;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>&nbsp;<o:p></o:p></span></p>
        </td>

        <td nowrap colspan=<?php echo $colspan_info; ?> valign=bottom style='padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt; border-top:solid windowtext 1.0pt; border-left:none; border-bottom:none; border-right:solid windowtext 1.0pt;'>
            <p style='margin-bottom:0cm;line-height:normal'>
                <span style='mso-ignore:vglayout; position:absolute;z-index:251659264;margin-top:0px; width:68px;height:75px'><img width=68 height=75 src="imagens/logo.png" v:shapes="Imagem_x0020_6"></span>
            </p><br>
            <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 style='width: 100%;'>
                <tr>
                    <td style="text-align:center;">
                        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                            <b><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif; color:black;'>
                                <?php echo $_SESSION['ORGAO']; ?> <o:p></o:p>
                            </span></b>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr style='mso-yfti-irow:2;height:18.0pt'>
        <td nowrap colspan=<?php echo $colspan_info; ?> valign=bottom style='padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt; border-left:solid windowtext 1.0pt; border-right:solid windowtext 1.0pt;'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                <b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif; color:black;'>DIÁRIO DE CLASSE <o:p></o:p></span></b>
            </p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:3;height:12.0pt'>
        <td nowrap colspan=<?php echo $colspan_info; ?> style='padding:0cm 3.5pt 0cm 3.5pt; height:12.0pt; border-left:solid windowtext 1.0pt; border-right:solid windowtext 1.0pt;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;'>ESCOLA MUNICIPAL: <?php
                $result_escola= $conexao->query("SELECT nome_escola FROM escola where idescola =$idescola");
                $nome_escola = "";
                foreach ($result_escola as $value) {$nome_escola = $value['nome_escola'];}
                echo $nome_escola;
            ?></span><o:p></o:p></b></p>
        </td>
    </tr>
    
    <tr style='mso-yfti-irow:5;height:12.0pt'>
        <td nowrap colspan=<?php echo $colspan_info; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt; border-left:solid windowtext 1.0pt; border-right:solid windowtext 1.0pt;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
            style='font-family:"Tw Cen MT Condensed",sans-serif;'>ENDEREÇO:<span style='mso-spacerun:yes'> </span><o:p></o:p></span></b></p>
        </td>
    </tr>


    <tr style='mso-yfti-irow:6;height:12.0pt'>
        <td width=15pt nowrap style='width:15.4pt; border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>&nbsp;</p>
        </td>
        <td nowrap colspan=<?php echo $colspan_info; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt; border-right:solid windowtext 1.0pt; border-left:none;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>
                <b><span style='font-family:"Tw Cen MT Condensed",sans-serif;'>TIPO DE ENSINO: <?php echo $tipo_ensino; ?> </span></b>
                <span style='font-family:"Tw Cen MT Condensed",sans-serif;'>| CÓDIGO U.E.:</span>
            </p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:7;height:12.0pt'>
        <td width=15pt nowrap style='width:15.4pt; border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>&nbsp;</p>
        </td>
        <td nowrap colspan=<?php echo $colspan_info; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt; border-right:solid windowtext 1.0pt; border-left:none;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>
                <b><span style='font-family:"Tw Cen MT Condensed",sans-serif;'>TURMA: <?php
                    $result_turma= $conexao->query("SELECT nome_turma FROM turma where idturma =$idturma");
                    $nome_turma = "";
                    foreach ($result_turma as $value) {$nome_turma = $value['nome_turma'];}
                    echo $nome_turma;
                ?> | PERÍODO LETIVO <?php echo $ano_letivo; ?></span></b>
            </p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:8;height:15.0pt'>
        <td width=15pt nowrap style='width:15.4pt; border-left:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>&nbsp;</p>
        </td>
        <td nowrap colspan=<?php echo $colspan_info; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt; border-right:solid windowtext 1.0pt; border-left:none;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>
                <span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>COMPONENTE CURRICULAR: <b> <?php echo $nome_disciplina; ?></b> </span>
            </p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:9;height:16.5pt'>
        <td width=15pt nowrap style='width:15.4pt; border-top:none;border-left:solid windowtext 1.0pt; border-bottom:solid windowtext 1.0pt; border-right:none; padding:0cm 3.5pt 0cm 3.5pt; height:16.5pt'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>&nbsp;<o:p></o:p></span></p>
        </td>
        <td nowrap colspan=<?php echo $colspan_info; ?> style='border:none;border-bottom:solid windowtext 1.0pt; padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt; border-right:solid windowtext 1.0pt; border-left:none;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>
                <span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>
                    UNIDADE: <?php echo " $descricao_trimestre ".converte_data($data_inicio_trimestre)." ".converte_data($data_fim_trimestre); ?>
                </span>
            </p>
        </td>
    </tr>


    <tr style='mso-yfti-irow:10;height:12.0pt'>
        <td class="col-num" nowrap rowspan=2 style='border: solid windowtext 1.0pt; border-bottom:solid black 1.0pt; height:12.0pt;'>
            <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>Nº</span></b></p>
        </td>

        <td class="col-aluno" nowrap rowspan=2 style='border: solid windowtext 1.0pt; border-left:none; border-bottom:solid windowtext 1.0pt; height:12.0pt; text-align:center;'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                <b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>ALUNO(A)<o:p></o:p></span></b>
            </p>
        </td>

        <td nowrap colspan="<?php echo $colspan_header_data; ?>" style='border:solid windowtext 1.0pt; border-left:none; border-bottom:none; height:12.0pt; text-align:center;'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                <b><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>Frequência por Data/Aula<o:p></o:p></span></b>
            </p>
        </td>
    </tr>

    <tr style='mso-yfti-irow:11;height:58.75pt'>

    <?php
    $data_count = 0;
    for ($i = 0; $i < $conta_data_obtida; $i++) {
        $data_frequencia = $array_data_aula[$i];
        $aula = $array_aula[$i];
        $is_even = ($i % 2 == 0);
        $background_style = $is_even ? 'background:#D9D9D9;' : 'background:white;';
    ?>

        <td class="celula-data-aula" style='border:solid windowtext 1.0pt; border-top:none; border-left:none; <?php echo $background_style; ?>'>
            <span class="rotaciona">
                <?php echo "".converte_data($data_frequencia); ?> 
            </span>
        </td>

    <?php
        $data_count++;
    }

    // Preenche as células vazias até o limite
    for ($i = $data_count; $i < $limite_aula; $i++) {
        $is_even = ($i % 2 == 0);
        $background_style = $is_even ? 'background:#D9D9D9;' : 'background:white;';
    ?>
        <td class="celula-data-aula" style='border:solid windowtext 1.0pt; border-top:none; border-left:none; <?php echo $background_style; ?>'>
            <span class="rotaciona">&nbsp;</span>
        </td>
    <?php
    }
    ?>
    </tr>


    <?php
    if ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
        // Função externa: listar_aluno_da_turma_ata_resultado_final
        $res_alunos = listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    } else {
        // Função externa: listar_aluno_da_turma_ata_resultado_final_matricula_concluida
        $res_alunos = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    }

    $conta = 1;
    foreach ($res_alunos as $value) {

        $idaluno = $value['idaluno'];
        $nome_aluno = ($value['nome_aluno']);
        $nome_identificacao_social = ($value['nome_identificacao_social']);
        $data_matricula = $value['data_matricula'];
        $data_matricula_timestamp = strtotime($data_matricula);
    ?>

    <tr style='mso-yfti-irow:<?php echo $conta + 13; ?>;height:13.5pt'>
        <td class="col-num" style='border:solid windowtext 1.0pt; border-top:none; background:white; height:13.5pt;'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;line-height:normal'>
                <span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'><?php echo "$conta"; ?></span>
            </p>
        </td>

        <td class="col-aluno" nowrap valign=bottom style='border:solid windowtext 1.0pt; border-left:none; border-top:none; height:13.5pt; font-size:9.0pt; text-transform: uppercase;'>
            <?php
            // Decide qual nome exibir (social ou regular)
            if ($nome_identificacao_social == '') {
                echo "$nome_aluno";
            } else {
                echo "$nome_identificacao_social";
            }
            ?>
        </td>

        <?php
        $data_count = 0;
        for ($i = 0; $i < $conta_data_obtida; $i++) {
            $data_frequencia = $array_data_aula[$i];
            $aula = $array_aula[$i];
            $data_frequencia_timestamp = strtotime($data_frequencia);

            // 1. Busca no array pré-carregado (Lookup)
            // Acesso seguro: verifica se o aluno_id, a data e a aula existem no lookup
            $presenca_valor = $frequencia_lookup[$idaluno][$data_frequencia][$aula] ?? null;

            $presenca = "<span style='font-size: 18px;'>-</span>"; // Padrão: Não registrado

            if ($presenca_valor ==1) {
                $presenca = "."; // Presente
            } else if ($presenca_valor ==0) {
                $presenca = "F"; // Falta
            }

            // 2. Verifica a data de matrícula (alunos que entraram depois)
            if ($data_frequencia_timestamp < $data_matricula_timestamp) {
                $presenca = "<span style='font-size: 18px;'>-</span>"; // Não matriculado na data
            }
        ?>

        <td class="frequencia-celula" nowrap valign=top style='border:solid windowtext 1.0pt; border-top:none; border-left:none; background:white; height:13.5pt;'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;line-height:normal'>
                <b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'><?php echo $presenca; ?></span></b>
            </p>
        </td>

        <?php
            $data_count++;
        }

        // Preencher as colunas vazias até o limite (células não usadas no período)
        for ($i = $data_count; $i < $limite_aula; $i++) {
        ?>
        <td class="frequencia-celula" nowrap valign=top style='border:solid windowtext 1.0pt; border-top:none; border-left:none; background:white; height:13.5pt;'>
            <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'>
                <b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;'>&nbsp;</span></b>
            </p>
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