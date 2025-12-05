<?php 
function diario_frequencia_fund1($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento) {
    
    // --- LÓGICA DE DEFINIÇÃO DE TIPO DE ENSINO E DISCIPLINA ---
    $nome_disciplina = '';
    $tipo_ensino = "";

    if ($idserie == 16) {
        if ($seguimento == 1) $tipo_ensino = "Educação Infantil";
        elseif ($seguimento == 2) $tipo_ensino = "Ensino Fundamental - Anos Iniciais";
        elseif ($seguimento == 3) $tipo_ensino = "Ensino Fundamental - Anos Finais";
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
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (1,5, 6,7,14, 35,47)");
    } elseif ($idserie == 1 && $iddisciplina == 1000) {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,43,44)");
    } elseif ($idserie == 2 && $iddisciplina == 1000) {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,44)");
    } else {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina=$iddisciplina");
    }

    foreach ($result_disc as $value) {
        $nome_disciplina .= $value['nome_disciplina'] . ", ";
    }
    $nome_disciplina = rtrim($nome_disciplina, ", ");

    $nome_escola = "";
    $res_esc = $conexao->query("SELECT nome_escola FROM escola WHERE idescola = $idescola LIMIT 1");
    foreach($res_esc as $r) { $nome_escola = $r['nome_escola']; }

    $nome_turma_txt = "";
    $res_turma = $conexao->query("SELECT nome_turma FROM turma WHERE idturma = $idturma LIMIT 1");
    foreach($res_turma as $r) { $nome_turma_txt = $r['nome_turma']; }


    // --- OTIMIZAÇÃO DE PERFORMANCE ---
    $filtro_disciplina = "";
    if ($iddisciplina == 1000) {
        if ($idserie > 2) $filtro_disciplina = "AND disciplina_id in (1,5, 6,7,14, 35,47)";
    } else {
        $filtro_disciplina = "AND disciplina_id=$iddisciplina";
    }

    // 1. Recuperar Datas
    $sql_datas = "SELECT data_frequencia, aula 
                  FROM frequencia 
                  WHERE escola_id=$idescola 
                  AND turma_id=$idturma 
                  $filtro_disciplina
                  AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre' 
                  GROUP BY aula, data_frequencia 
                  ORDER BY data_frequencia, aula ASC 
                  LIMIT $inicio, $fim";

    $result_data_aula = $conexao->query($sql_datas);
    
    $array_cabecalho = [];
    foreach ($result_data_aula as $row) {
        $array_cabecalho[] = ['data' => $row['data_frequencia'], 'aula' => $row['aula']];
    }
    
    $total_colunas_aulas = count($array_cabecalho);
    $colunas_vazias = $limite_data - $total_colunas_aulas;
    if($colunas_vazias < 0) $colunas_vazias = 0;

    // 2. Recuperar Alunos
    if ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
        $res_alunos = listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    } else {
        $res_alunos = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    }

    // 3. MAPA DE PRESENÇAS
    $mapa_presenca = [];
    $sql_presencas = "SELECT aluno_id, data_frequencia, aula, presenca 
                      FROM frequencia 
                      WHERE escola_id=$idescola 
                      AND turma_id=$idturma 
                      $filtro_disciplina
                      AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre'";
    
    $busca_presenca = $conexao->query($sql_presencas);
    foreach($busca_presenca as $p) {
        $chave = $p['aluno_id'] . '_' . $p['data_frequencia'] . '_' . $p['aula'];
        $mapa_presenca[$chave] = $p['presenca'];
    }

?>

<style>
    /* Estilos atualizados */
    .tabela-diario {
        width: 100%;
        border-collapse: collapse;
        font-family: "Arial", sans-serif;
        font-size: 11px;
        /* Removido table-layout: fixed global para permitir que o nome cresça */
    }

    .tabela-diario th, .tabela-diario td {
        border: 1px solid #000;
        padding: 2px 4px;
    }

    .header-info { text-align: left; font-size: 10px; text-transform: uppercase; }
    
    .col-num { width: 25px; text-align: center; }

    /* CORREÇÃO DA COLUNA NOME */
    .col-nome { 
        width: 350px;       /* Tamanho fixo generoso */
        min-width: 350px;   /* Garante que não diminua */
        text-align: left; 
        white-space: nowrap; /* Não quebra linha (fica bonito em 1 linha) */
        overflow: hidden;    /* Segurança */
    }

    .col-data-header {
        height: 100px;
        vertical-align: bottom;
        padding-bottom: 5px;
        width: 20px; /* Coluna de data bem fina */
        max-width: 20px;
        background-color: #f9f9f9;
    }

    .vertical-text {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        white-space: nowrap;
        font-size: 10px;
        margin: 0 auto;
    }

    .celula-presenca { text-align: center; font-size: 11px; width: 20px; }
    .zebra:nth-child(even) { background-color: #f2f2f2; }
    
    .text-center { text-align: center; }
    .text-bold { font-weight: bold; }
    
    /* Estilo para o traço de "sem registro" */
    .sem-registro {
        color: #555;
        font-weight: bold;
    }
</style>

<div class="WordSection1">

    <table class="tabela-diario">
        <tr>
            <td colspan="<?php echo (2 + $limite_data); ?>" style="border: 2px solid #000; padding: 10px;">
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="width: 80px; border: none;"><img src="imagens/logo.png" width="60"></td>
                        <td style="border: none; text-align: center;">
                            <span style="font-size: 18px; font-weight: bold; font-family: 'Arial Narrow', sans-serif;">
                                <?php echo $_SESSION['ORGAO']; ?>
                            </span>
                            <br>
                            <span style="font-size: 14px; font-weight: bold;">DIÁRIO DE CLASSE</span>
                        </td>
                        <td style="width: 80px; border: none;"></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr><td colspan="<?php echo (2 + $limite_data); ?>" class="header-info"><b>ESCOLA MUNICIPAL:</b> <?php echo $nome_escola; ?></td></tr>
        <tr><td colspan="<?php echo (2 + $limite_data); ?>" class="header-info"><b>ENDEREÇO:</b></td></tr>
        <tr>
            <td colspan="<?php echo (2 + $limite_data); ?>" class="header-info">
                <table style="width: 100%; border: none;"><tr>
                    <td style="border: none; width: 60%;"><b>TIPO DE ENSINO:</b> <?php echo $tipo_ensino; ?></td>
                    <td style="border: none;"><b>CODIGO U.E.:</b> </td>
                </tr></table>
            </td>
        </tr>
        <tr>
            <td colspan="<?php echo (2 + $limite_data); ?>" class="header-info">
                <table style="width: 100%; border: none;"><tr>
                    <td style="border: none; width: 60%;"><b>TURMA:</b> <?php echo $nome_turma_txt; ?></td>
                    <td style="border: none;"><b>PERÍODO LETIVO:</b> <?php echo $ano_letivo; ?></td>
                </tr></table>
            </td>
        </tr>
        <tr><td colspan="<?php echo (2 + $limite_data); ?>" class="header-info"><b>COMPONENTE CURRICULAR:</b> <?php echo $nome_disciplina; ?></td></tr>
        <tr><td colspan="<?php echo (2 + $limite_data); ?>" class="header-info"><b>UNIDADE:</b> <?php echo "$descricao_trimestre (" . converte_data($data_inicio_trimestre) . " a " . converte_data($data_fim_trimestre) . ")"; ?></td></tr>

        <tr>
            <td rowspan="2" class="col-num text-bold">Nº</td>
            <td rowspan="2" class="col-nome text-center text-bold">ALUNO(A)</td>
            <td colspan="<?php echo $limite_data; ?>" class="text-center text-bold">AULA / DATA</td>
        </tr>

        <tr>
            <?php 
            $contador_cols = 0;
            foreach ($array_cabecalho as $cab) {
                echo '<td class="col-data-header">';
                echo '<div class="vertical-text">' . converte_data($cab['data']) . '</div>';
                echo '</td>';
                $contador_cols++;
            }
            for ($i = 0; $i < $colunas_vazias; $i++) {
                 echo '<td class="col-data-header"><div class="vertical-text">&nbsp;</div></td>';
            }
            ?>
        </tr>

        <?php
        $conta = 1;
        $mapa_total_faltas=[];

        foreach ($res_alunos as $aluno) {
            $idaluno = $aluno['idaluno'];
            $nome_mostra = ($aluno['nome_identificacao_social'] != '') ? $aluno['nome_identificacao_social'] : $aluno['nome_aluno'];
            // $data_mat = $aluno['data_matricula']; // Não vamos usar para bloquear, vamos usar o array de presença
            
            echo "<tr class='zebra'>";
            echo "<td class='text-center'>$conta</td>";
            
            // NOME: style inline para garantir prioridade se o CSS falhar em algum cliente
            echo "<td class='col-nome' style='width:350px; min-width:350px; white-space:nowrap;'> " . strtoupper($nome_mostra) . "</td>";

            // LOOP PRESENÇAS
            $mapa_total_faltas[$aluno['idaluno']]=0;

            foreach ($array_cabecalho as $cab) {
                $data_aula = $cab['data'];
                $num_aula = $cab['aula'];
                
                // Verifica se existe no array (Melhor que verificar data de matrícula, pois registro é registro)
                $chave_busca = $idaluno . '_' . $data_aula . '_' . $num_aula;
                
                if (array_key_exists($chave_busca, $mapa_presenca)) {
                    // Existe registro (0 ou 1)
                    $status = $mapa_presenca[$chave_busca];
                    
                    if ($status == 0) {
                        echo "<td class='celula-presenca' style='font-weight:bold;'>F</td>";
                        $mapa_total_faltas[$aluno['idaluno']]+=1;
                    } else {
                        // Presença normal (1)
                        echo "<td class='celula-presenca'>.</td>";
                    }
                } else {
                    // NÃO existe registro para esse aluno nessa data/aula
                    echo "<td class='celula-presenca sem-registro'><b>-</b></td>";
                }
            }

            // Colunas vazias (estética)
            for ($i = 0; $i < $colunas_vazias; $i++) {
                 echo "<td class='celula-presenca'>&nbsp;</td>";
            }

            echo "</tr>";
            $conta++;
        }
        ?>

    </table>
</div>

<?php

return $mapa_total_faltas;
} 
?>