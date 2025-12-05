<?php
// Certifique-se de que a função converte_data() e as funções de listagem estejam definidas antes de usar este código.

function diario_frequencia_fund1($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento){

    // --- 1. CONFIGURAÇÃO INICIAL E DEFINIÇÃO DE VARIÁVEIS ---
    $nome_disciplina = '';
    $tipo_ensino = "";
    $disciplinas_query = ""; 

    // Define o tipo de ensino
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

    // Define as IDs das disciplinas para a consulta
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

    foreach ($result_disc as $value) {
        $nome_disciplina .= $value['nome_disciplina'] . ", ";
    }
    $nome_disciplina = rtrim($nome_disciplina, ', ');

    // --- 2. BUSCA E ARMAZENA AS DATAS/AULAS ---
    $query_data_aula = "
        SELECT data_frequencia, aula FROM frequencia 
        WHERE escola_id=$idescola 
        AND turma_id=$idturma 
        AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'
        AND disciplina_id IN ($disciplinas_query)
        GROUP BY data_frequencia, aula 
        ORDER BY data_frequencia, aula ASC 
        LIMIT $inicio, $fim
    ";
    
    // Condição especial para Educação Infantil (idserie < 3) com iddisciplina=1000, 
    // onde a restrição de disciplina pode ser removida (baseado no código original)
    if ($idserie < 3 && $iddisciplina == 1000) {
         $query_data_aula = "
            SELECT data_frequencia, aula FROM frequencia 
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

    // --- 3. BUSCA DE ALUNOS ---
    $alunos_ids = [];
    if ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
        $res_alunos = listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    } else {
        $res_alunos = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    }
    foreach ($res_alunos as $aluno) {
        $alunos_ids[] = $aluno['idaluno'];
    }

    // --- 4. PRÉ-CARREGAMENTO DA FREQUÊNCIA (OTIMIZAÇÃO DE DESEMPENHO) ---
    $frequencia_alunos = [];
    if (!empty($alunos_ids)) {
        $alunos_in = implode(',', $alunos_ids);
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

        // Aplica filtro de disciplina se não for Educação Infantil (idserie < 3) e iddisciplina=1000
        if (!($idserie < 3 && $iddisciplina == 1000)) {
             $frequencia_query .= " AND disciplina_id IN ($disciplinas_query)";
        }
        
        $result_frequencia = $conexao->query($frequencia_query);
        
        foreach ($result_frequencia as $frequencia) {
            $aluno_id = $frequencia['aluno_id'];
            $data = $frequencia['data_frequencia'];
            $aula = $frequencia['aula'];
            
            // Armazena a presença: [aluno_id][data_frequencia][aula] = presenca
            $frequencia_alunos[$aluno_id][$data][$aula] = $frequencia['presenca'];
        }
    }


    // --- 5. CONFIGURAÇÃO DE LAYOUT/COLSPAN ---
    $colspan_cabecalho_info = 37; 
    $colspan_turma_info = 29; 
    $colspan_disciplina = 10; 
    $colspan_aluno = 2; // Coluna do nome do aluno terá 2 colunas de largura.
    $colspan_data_aula_header = $limite_aula; // O cabeçalho 'Aula/Data' irá sobrepor todas as colunas de data/aula
?>

<style>
    /* Estilos CSS para garantir que o nome do aluno não seja espremido */
    .aluno-nome {
        width: 250pt; 
        max-width: 250pt;
        min-width: 250pt;
        text-align: left;
        padding-left: 5px !important; 
    }
    .col-data {
        width: 10pt;
        min-width: 10pt;
        max-width: 10pt;
        text-align: center;
        /* Estilos para rotação (se necessário) */
        font-size: 8.0pt;
        font-family:"Tw Cen MT Condensed",sans-serif;
    }
    .col-ordem {
        width: 15.4pt;
    }
    .rotate {
        /* Garante que o texto de data esteja de lado */
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        white-space: nowrap;
        height: 58.75pt;
        vertical-align: bottom;
        display: block; /* Garante que o div ocupe o espaço */
    }
</style>

<div class=WordSection1>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%; border-collapse:collapse;'>

<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.0pt'>
    <td width=11 nowrap valign=bottom style='width:15.4pt;border-top:solid windowtext 1.0pt;border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>&nbsp;</td>
    <td nowrap colspan=<?php echo $colspan_cabecalho_info; ?> valign=bottom style='padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;'>
             <b><span style='font-size:20.0pt;'>PREFEITURA DE LUÍS EDUARDO MAGALHÃES<o:p></o:p></span></b>
        </p>
    </td>
</tr>

<tr style='mso-yfti-irow:2;height:18.0pt'>
    <td nowrap colspan=<?php echo $colspan_cabecalho_info; ?> valign=bottom style='padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;'>
            <b><span style='font-size:16.0pt;'>DIÁRIO DE CLASSE<o:p></o:p></span></b>
        </p>
    </td>
</tr>

<tr style='mso-yfti-irow:4;height:12.0pt'>
    <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>&nbsp;</td>
    <td nowrap colspan=<?php echo $colspan_cabecalho_info; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>
            <b><span>ESCOLA MUNICIPAL: 
            <?php 
                $result_escola = $conexao->query("SELECT nome_escola FROM escola WHERE idescola =$idescola");
                foreach ($result_escola as $value) { echo $value['nome_escola']; }
            ?>
            <o:p></o:p></span></b>
        </p>
    </td>
</tr>

<tr style='mso-yfti-irow:8;height:15.0pt'>
    <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>&nbsp;</td>
    <td nowrap colspan=<?php echo $colspan_disciplina; ?> style='padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:9.0pt;'>COMPONENTE CURRICULAR: <b> <?php echo $nome_disciplina; ?></b> </span></p>
    </td>
</tr>

<tr style='mso-yfti-irow:9;height:16.5pt'>
    <td width=21 nowrap style='width:15.4pt;border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>&nbsp;</td>
    <td nowrap colspan=<?php echo $colspan_disciplina; ?> style='border:none;border-bottom:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:9.0pt;'>UNIDADE: <?php echo " $descricao_trimestre " . converte_data($data_inicio_trimestre) . " " . converte_data($data_fim_trimestre); ?>
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
        line-height:normal'><b><span style='font-size:12.0pt;'>ALUNO(A)<o:p></o:p></span></b></p>
    </td>

    <td nowrap colspan="<?php echo $colspan_data_aula_header; ?>" style='border:none;border-bottom:solid windowtext 1.0pt;border-top:solid windowtext 1.0pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:8.0pt;'>Aula/Data<o:p></o:p></span></b></p>
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
        border-left:none;<?php echo $class_data; ?> padding:0cm 0pt 0cm 0pt; vertical-align: top;'>
        <div class="rotate" >
            <span style='font-size:8.0pt;'>
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
if (empty($res_alunos)) {
    // Caso não haja alunos na turma
    echo "<tr><td colspan='100%' style='text-align:center; padding:10px;'>Nenhum aluno encontrado para a turma selecionada.</td></tr>";
} else {
    foreach ($res_alunos as $value) {
        $idaluno = $value['idaluno'];
        $nome_aluno = ($value['nome_aluno']);
        $nome_identificacao_social = ($value['nome_identificacao_social']);

        $nome_a_exibir = (trim($nome_identificacao_social) != '') ? $nome_identificacao_social : $nome_aluno;
        ?>

        <tr style='mso-yfti-irow:<?php echo 12 + $conta; ?>;height:13.5pt'>
            <td class="col-ordem" style='border:solid windowtext 1.0pt;border-top:none;
                background:white;height:13.5pt; text-align: center;'>
                <span style='font-size:8.0pt;'><?php echo "$conta"; ?></span>
            </td>

            <td nowrap colspan="<?php echo $colspan_aluno; ?>" class="aluno-nome" valign=bottom style='border-left:none; border-right:solid windowtext 1.0pt; border-bottom:solid windowtext 1.0pt;
                height:13.5pt;font-size:9.0pt; text-transform: uppercase;'>
                <?php echo $nome_a_exibir; ?>
            </td>


            <?php
            // --- Impressão das Presenças/Faltas (OTIMIZADA) ---
            $conta_presenca = 0; // Começa em 0 para corresponder ao array
            for ($i = 0; $i < $conta_data_real; $i++) {
                $data_frequencia = $array_data_aula[$i];
                $aula = $array_aula[$i];

                // Busca no array pré-carregado
                $presenca_valor = $frequencia_alunos[$idaluno][$data_frequencia][$aula] ?? null;

                $presenca = "<span style='font-size: 18px;'>-</span>"; // Padrão: Não houve registro
                if ($presenca_valor !== null) {
                    if ($presenca_valor == 1) {
                        $presenca = "."; // Presença
                    } else if ($presenca_valor == 0) {
                        $presenca = "F"; // Falta
                    }
                }
                ?>
                <td class="col-data" nowrap valign=top style='border:solid windowtext 1.0pt;border-top:none;
                    border-left: none; background:white;height:13.5pt; text-align: center;'>
                    <b><span style='font-size:9.0pt;'><?php echo $presenca; ?></span></b>
                </td>
                <?php
                $conta_presenca++;
            }

            // --- Células de Frequência Vazias (Preenchimento) ---
            for ($i = $conta_presenca; $i < $limite_data; $i++) {
                ?>
                <td class="col-data" nowrap valign=top style='border:solid windowtext 1.0pt;border-top:none;
                    border-left: none; background:white;height:13.5pt; text-align: center;'>
                    <b><span style='font-size:9.0pt;'>&nbsp;</span></b>
                </td>
                <?php
            }
            ?>
        </tr>

        <?php
        $conta++;
    }
}
?>

</table>
</div>

<?php
}
?>