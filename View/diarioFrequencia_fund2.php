<?php

function diario_frequencia_fund2($conexao, $idescola, $idturma, $iddisciplina, $inicio, $fim, $conta_aula, $conta_data, $limite_data, $limite_aula, $periodo_id, $idserie, $descricao_trimestre, $data_inicio_trimestre, $data_fim_trimestre, $ano_letivo, $seguimento) {
    // --- 1. Otimização de Busca de Dados Únicos (Melhor Prática) ---
    // Buscar nome da disciplina
    $nome_disciplina = '';
    $result_disc = $conexao->query("SELECT nome_disciplina FROM disciplina WHERE iddisciplina = $iddisciplina");
    if ($result_disc && $disc = $result_disc->fetch(PDO::FETCH_ASSOC)) { // Usando fetch para obter 1 linha
        $nome_disciplina = $disc['nome_disciplina'];
    }
    
    // Buscar nome da escola
    $nome_escola = '';
    $result_escola = $conexao->query("SELECT nome_escola FROM escola WHERE idescola = $idescola");
    if ($result_escola && $esc = $result_escola->fetch(PDO::FETCH_ASSOC)) {
        $nome_escola = $esc['nome_escola'];
    }

    // Buscar nome da turma
    $nome_turma = '';
    $result_turma = $conexao->query("SELECT nome_turma FROM turma WHERE idturma = $idturma");
    if ($result_turma && $turma = $result_turma->fetch(PDO::FETCH_ASSOC)) {
        $nome_turma = $turma['nome_turma'];
    }

    // --- 2. Lógica para Tipo de Ensino (Otimização de Estrutura) ---
    $tipo_ensino = "tttt";
    if ($idserie == 17) {
        $tipo_ensino = "AEE";
    } elseif ($idserie == 16) {
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
    } elseif ($idserie > 11 && $idserie < 17) {
        $tipo_ensino = "Educação de Jovens e Adultos";
    }

    // --- 3. Busca de Aulas/Datas (Preparação) ---
    // Busque todas as aulas e datas de uma vez
    $result_data_aula = $conexao->query("
        SELECT aula, data_frequencia 
        FROM frequencia 
        WHERE escola_id = $idescola
        AND turma_id = $idturma 
        AND disciplina_id = $iddisciplina 
        AND data_frequencia BETWEEN '$data_inicio_trimestre' AND '$data_fim_trimestre' 
        GROUP BY aula, data_frequencia 
        ORDER BY data_frequencia ASC 
        LIMIT $inicio, $fim
    ");
    
    $array_data_aula = array();
    $array_aula = array();
    $conta_data_indice = 0; // Usado para indexar os arrays
    if ($result_data_aula) {
        foreach ($result_data_aula as $value) {
            $array_data_aula[$conta_data_indice] = $value['data_frequencia'];
            $array_aula[$conta_data_indice] = $value['aula'];
            $conta_data_indice++;
        }
    }
    
    // Calcula $limite_data baseado no que realmente foi buscado
    $limite_data_real = count($array_data_aula);
    
    // --- 4. Busca de Dados de Frequência (Principal Otimização) ---
    // Obter TODOS os registros de frequência para TODOS os alunos e o período em UMA consulta.
    // Isso evita o loop de consultas dentro do loop de alunos.
    $datas_aulas_string = implode(', ', array_map(function($data, $aula) {
        return "(data_frequencia = '$data' AND aula = '$aula')";
    }, $array_data_aula, $array_aula));

    $frequencias_por_aluno_data = [];

    if (!empty($datas_aulas_string)) {
        $sql_frequencias = "
            SELECT aluno_id, data_frequencia, aula, presenca 
            FROM frequencia 
            WHERE escola_id = $idescola
            AND disciplina_id = $iddisciplina 
            AND turma_id = $idturma 
            AND ($datas_aulas_string)
            ORDER BY aluno_id, data_frequencia, aula
        ";
        
        $result_frequencias = $conexao->query($sql_frequencias);

        if ($result_frequencias) {
            foreach ($result_frequencias as $row) {
                $chave = $row['aluno_id'] . '_' . $row['data_frequencia'] . '_' . $row['aula'];
                $frequencias_por_aluno_data[$chave] = $row['presenca'];
            }
        }
    }

    // --- O restante do código HTML/saída deve vir aqui. 
    // Foi removido para simplificar a visualização do código, 
    // mas a lógica principal de iteração dos alunos deve usar 
    // as novas estruturas de dados ($frequencias_por_aluno_data, $array_data_aula, etc.)

    $colspan = "100%";
    
    // (Início do HTML... preenchido com as variáveis $nome_disciplina, $nome_escola, $tipo_ensino, etc.)

    // ... Conteúdo HTML ...

    ?>
<div class=WordSection1>
    <table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='width: 100%;'>
        <tr style='mso-yfti-irow:4;height:12.0pt'>
            <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
            </td>
            <td width=808 nowrap colspan=<?php echo "$colspan"; ?> style='width:606.25pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>ESCOLA MUNICIPAL:<span style='mso-spacerun:yes'>
                    <?php echo $nome_escola; ?>
                </span><o:p></o:p></span></b></p>
            </td>
        </tr>
        <tr style='mso-yfti-irow:6;height:12.0pt'>
             <td nowrap style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>TIPO DE ENSINO: <?php echo $tipo_ensino; ?> <o:p></o:p></span></b></p>
            </td>
             </tr>
        <tr style='mso-yfti-irow:7;height:12.0pt'>
             <td width=457 nowrap colspan=<?php echo "$colspan"; ?> style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>TURMA: <o:p>
                    <?php echo $nome_turma; ?>
                </o:p></span></b></p>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>PERIODO LETIVO <?php echo "$ano_letivo"; ?><o:p></o:p></span></b></p>
            </td>
             </tr>
        <tr style='mso-yfti-irow:8;height:15.0pt'>
             <td width=261 colspan="10" style='width:195.55pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
                <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'>COMPONENTE CURRICULAR: <b> <?php echo $nome_disciplina; ?></b> </span></p>
            </td>
             </tr>

        <tr style='mso-yfti-irow:11;height:58.75pt'>
        <?php
        $conta_data = 0;
        for ($i = 0; $i < $limite_data_real; $i++) {
            $data_frequencia = $array_data_aula[$i];
            $background_color = ($conta_data % 2 == 0) ? 'background:#D9D9D9;' : '';
        ?>
            <td style='border:solid windowtext 1.0pt; border-left:none; <?php echo $background_color; ?> mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90; '>
                <span style='writing-mode: vertical-lr;font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'><?php echo "".converte_data($data_frequencia); ?></span>
            </td>
        <?php
            $conta_data++;
        }
        // Preenche células vazias se houver mais $limite_data
        for ($i = $limite_data_real; $i < $limite_data; $i++) {
            $background_color = ($conta_data % 2 == 0) ? 'background:#D9D9D9;' : '';
        ?>
            <td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt; border-left:none;<?php echo $background_color; ?>mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'><div class="Namerotate"><span style='font-size:6.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'> </span></div></p>
            </td>
        <?php
            $conta_data++;
        }
        ?>
        </tr>

        <tr style='mso-yfti-irow:12;height:72.25pt'>
        <?php
        $conta_aula_exibida = 1; // Começa a contar de 1 para exibição (Aula 1, Aula 2...)
        for ($i = 0; $i < $limite_data_real; $i++) {
            $background_color = ($conta_aula_exibida % 2 != 0) ? 'background:#D9D9D9;' : '';
        ?>
            <td style='border:solid windowtext 1.0pt; border-left:none; mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:solid windowtext 1.0pt;<?php echo $background_color; ?> mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'><div class="Namerotate"><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'><?php echo "Aula " . ($i + 1); ?> </div></span></p>
            </td>
        <?php
            $conta_aula_exibida++;
        }
        // Preenche células vazias
        for ($i = $limite_data_real; $i < $limite_aula; $i++) {
            $background_color = ($conta_aula_exibida % 2 != 0) ? 'background:#D9D9D9;' : '';
        ?>
            <td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt; border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt: solid windowtext 1.0pt;<?php echo $background_color; ?> mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:.25pt'>
                <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'><div class="Namerotate"><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'><?php echo "Aula " . ($i + 1); ?> </div></span></p>
            </td>
        <?php
            $conta_aula_exibida++;
        }
        ?>
        </tr>

        <?php
        $res_alunos = ($_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) ?
            listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo']) :
            listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);

        $conta = 1;
        foreach ($res_alunos as $key => $value) {
            $idaluno = $value['idaluno'];
            $nome_aluno = ($value['nome_aluno']);
            $nome_identificacao_social = ($value['nome_identificacao_social']);
            $data_matricula = $value['data_matricula'];
        ?>

            <tr style='mso-yfti-irow:13;height:13.5pt'>
                <td width=21 style='width:15.4pt;border:solid windowtext 1.0pt;border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'><?php echo "$conta"; ?> <o:p></o:p></span></p>
                </td>

                <td width=261 nowrap valign=bottom style='width:235.55pt;border:none;border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt;font-size:9.0pt; text-transform: uppercase;'>
                    <?php
                    if ($nome_identificacao_social == '') {
                        echo "(" . $idaluno . ") - $nome_aluno";
                    } else {
                        echo "(" . $idaluno . "S) - $nome_identificacao_social";
                    }
                    ?>
                </td>

                <?php
                for ($i = 0; $i < $limite_data_real; $i++) {
                    $aula = $array_aula[$i];
                    $data_frequencia = $array_data_aula[$i];
                    $chave = $idaluno . '_' . $data_frequencia . '_' . $aula;
                    $presenca = "<span style='font-size: 18px;'>-</span>"; // Valor padrão para ausente ou não registrado

                    if (isset($frequencias_por_aluno_data[$chave])) {
                        if ($data_frequencia >= $data_matricula) {
                            $status_presenca = $frequencias_por_aluno_data[$chave];
                            if ($status_presenca == 1) {
                                $presenca = "."; // Presente
                            } elseif ($status_presenca == 0) {
                                $presenca = "F"; // Falta
                            }
                        }
                    }
                ?>
                    <td width=10 nowrap valign=top style='border:solid windowtext 1.0pt;border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background:white;height:13.5pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0cm;line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'><?php echo $presenca; ?></span></b></p>
                    </td>
                <?php
                }

                // Preenche células vazias se houver mais $limite_aula
                for ($i = $limite_data_real; $i < $limite_aula; $i++) {
                ?>
                    <td width=10 nowrap valign=top style='border:solid windowtext 1.0pt;border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background:white;height:13.5pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:PT-BR'> </span></b></p>
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