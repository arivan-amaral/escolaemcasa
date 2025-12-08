<?php

// Requisito: A função sanitizar_aula deve existir ou ser definida aqui.
if (!function_exists('sanitizar_aula')) {
    /**
     * Função para sanitizar a string da aula, removendo espaços e caracteres invisíveis.
     */
    function sanitizar_aula(string $aula): string {
        $aula_limpa = trim($aula);
        // Mantém apenas letras, números e hífen
        return preg_replace('/[^\w-]/', '', $aula_limpa);
    }
}

if (!function_exists('converte_data')) {
    /**
     * Função para converter data do formato YYYY-MM-DD para DD/MM/YYYY.
     */
    function converte_data($data) {
        if (empty($data) || $data == '0000-00-00') return '';
        return date('d/m/Y', strtotime($data));
    }
}

/**
* Função para gerar o Diário de Frequência.
* (Com código de DEBUG GLOBAL para chaves)
*/
function diario_frequencia_fund2(
 $conexao,
 $idescola,
 $idturma,
 $iddisciplina,
 $inicio,
 $fim,
 $conta_aula,
 $conta_data,
 $limite_aula,
 $periodo_id,
 $idserie,
 $descricao_trimestre,
 $data_inicio_trimestre,
 $data_fim_trimestre,
 $ano_letivo,
 $seguimento
){
    $nome_disciplina = '';
    $tipo_ensino = "Tipo Desconhecido";

    // --- 1. Determinação do Tipo de Ensino (Mantido) ---
    if ($idserie === 17) {
        $tipo_ensino = "Atendimento Educacional Especializado";
    } elseif ($idserie === 16) {
        if ($seguimento === 1) {
            $tipo_ensino = "Educação Infantil";
        } elseif ($seguimento === 2) {
            $tipo_ensino = "Ensino Fundamental - Anos Iniciais";
        } elseif ($seguimento === 3) {
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

    // --- 2. Busca de Dados de Cabeçalho (Lógica Mantida) ---
    $filtro_disciplina = "";

    if ($idserie == 16 && $iddisciplina == 1000 && $seguimento==1) {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,43,44)");
    }else if ($idserie == 16 && $iddisciplina == 1000 && $seguimento==2) {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,44)");
    }else if ($idserie > 2 && $iddisciplina == 1000) {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (1,5, 6,7,14, 35,47)");
        $filtro_disciplina = "AND disciplina_id in (1,5, 6,7,14, 35,47)";
    } elseif ($idserie == 1 && $iddisciplina == 1000) {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,43,44)");
    } elseif ($idserie == 2 && $iddisciplina == 1000) {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,44)");
    } else {
        $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina=$iddisciplina");
        $filtro_disciplina = "AND disciplina_id=$iddisciplina";
    }

    if ($idserie < 3 && $iddisciplina == 1000) {
        $filtro_disciplina = "";
    }

    foreach ($result_disc as $value) {
        $nome_disciplina .= $value['nome_disciplina'] . ", ";
    }
    $nome_disciplina = rtrim($nome_disciplina, ", ");


    $stmt_escola = $conexao->prepare("SELECT nome_escola FROM escola WHERE idescola = :idescola");
    $stmt_escola->execute([':idescola' => $idescola]);
    $nome_escola = $stmt_escola->fetchColumn() ?? 'N/A';

    $stmt_turma = $conexao->prepare("SELECT nome_turma FROM turma WHERE idturma = :idturma");
    $stmt_turma->execute([':idturma' => $idturma]);
    $nome_turma_exibicao = $stmt_turma->fetchColumn() ?? 'N/A';


    // --- 3. Busca de Aulas e Datas (Lógica Mantida) ---
    $sql_aulas = "
  SELECT aula, data_frequencia
  FROM frequencia
  WHERE escola_id = :idescola
   AND turma_id = :idturma
   AND disciplina_id = :iddisciplina
   AND data_frequencia BETWEEN :data_inicio AND :data_fim
  GROUP BY data_frequencia, aula
  ORDER BY data_frequencia ASC, aula ASC
  LIMIT :inicio, :limite";

    $stmt_data_aula = $conexao->prepare($sql_aulas);
    $limite_offset = $fim - $inicio;
    $stmt_data_aula->bindValue(':idescola', $idescola, PDO::PARAM_INT);
    $stmt_data_aula->bindValue(':idturma', $idturma, PDO::PARAM_INT);
    $stmt_data_aula->bindValue(':iddisciplina', $iddisciplina, PDO::PARAM_INT);
    $stmt_data_aula->bindValue(':data_inicio', $data_inicio_trimestre, PDO::PARAM_STR);
    $stmt_data_aula->bindValue(':data_fim', $data_fim_trimestre, PDO::PARAM_STR);
    $stmt_data_aula->bindValue(':inicio', $inicio, PDO::PARAM_INT);
    $stmt_data_aula->bindValue(':limite', $limite_offset, PDO::PARAM_INT);
    $stmt_data_aula->execute();
    $aulas_datas = $stmt_data_aula->fetchAll(PDO::FETCH_ASSOC);

    $array_data_aula = [];
    $array_aula = [];
    $num_aulas_reais = 0;

    foreach ($aulas_datas as $item) {
        $array_data_aula[] = $item['data_frequencia'];
        $array_aula[] = sanitizar_aula($item['aula']);
        $num_aulas_reais++;
    }

    $colspan_aulas = $limite_aula;


    // --- 4. Busca de Dados de Alunos (Lógica Mantida) ---
    if (isset($_SESSION['ano_letivo']) && isset($_SESSION['ano_letivo_vigente']) && $_SESSION['ano_letivo'] === $_SESSION['ano_letivo_vigente']) {
        // Assume que listar_aluno_da_turma_ata_resultado_final existe e retorna um PDOStatement ou array
        $stmt_alunos = listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    } else {
        // Assume que listar_aluno_da_turma_ata_resultado_final_matricula_concluida existe
        $stmt_alunos = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    }
    $res_alunos = is_a($stmt_alunos, 'PDOStatement') ? $stmt_alunos->fetchAll(PDO::FETCH_ASSOC) : $stmt_alunos;
    $alunos_ids = array_column($res_alunos, 'idaluno');


    // --- 5. Busca de Dados de Frequência em Massa (Lógica Mantida) ---
    $frequencia_mapa = [];
    $restricoes_aulas = [];

    foreach ($aulas_datas as $item) {
        $data_formatada = $conexao->quote($item['data_frequencia']);
        $aula_sanitizada = sanitizar_aula($item['aula']);
        $aula_formatada = $conexao->quote($aula_sanitizada);
        $restricoes_aulas[] = "({$data_formatada}, {$aula_formatada})";
    }
    $restricao_aulas_str = implode(', ', $restricoes_aulas);


    if (!empty($alunos_ids) && !empty($restricoes_aulas)) {
        $placeholders = implode(',', array_fill(0, count($alunos_ids), '?'));

        $sql_frequencia = "
    SELECT aluno_id, data_frequencia, aula, presenca
    FROM frequencia
    WHERE escola_id = ?
     AND turma_id = ?
     AND disciplina_id = ?
     AND aluno_id IN ({$placeholders})
           AND (data_frequencia, aula) IN ({$restricao_aulas_str})";

        $params = array_merge(
            [$idescola, $idturma, $iddisciplina],
            $alunos_ids
        );

        $stmt_frequencia = $conexao->prepare($sql_frequencia);
        $stmt_frequencia->execute($params);
        $res_frequencia = $stmt_frequencia->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res_frequencia as $registro) {
            $aula_limpa = sanitizar_aula($registro['aula']);
            $chave = $registro['data_frequencia'] . '_' . $aula_limpa;
            $frequencia_mapa[$registro['aluno_id']][$chave] = $registro['presenca'];
        }
    }

    // --- CÁLCULO DE LARGURAS PARA SIMETRIA ---
    // Largura total da folha A4 em landscape (aproximadamente)
    $LARGURA_TOTAL_PT = 760; 
    // Largura para Coluna Index e Aluno (fixas)
    $LARGURA_COL_INDEX_PT = 30;
    $LARGURA_COL_ALUNO_PT = 250;
    $LARGURA_FIXA_PT = $LARGURA_COL_INDEX_PT + $LARGURA_COL_ALUNO_PT;
    // Largura restante para as colunas de Aula/Data
    $LARGURA_FREQUENCIA_PT = $LARGURA_TOTAL_PT - $LARGURA_FIXA_PT;
    // Largura de cada coluna de aula (para garantir simetria)
    $LARGURA_COLUNA_AULA_PT = ($colspan_aulas > 0) ? round($LARGURA_FREQUENCIA_PT / $colspan_aulas, 2) : 20;

?>

<style>
/* ** CSS OTIMIZADO - Limpo e Simétrico ** */

/* 1. Reset e Estilo Básico da Tabela */
.diario-tabela {
    border-collapse: collapse;
    width: 100%;
    /* Fontes compatíveis com Office e Web, priorizando Tw Cen MT Condensed */
    font-family: "Tw Cen MT Condensed", "Arial Narrow", sans-serif;
    font-size: 10.0pt;
}

.diario-tabela td, .diario-tabela th {
    /* Estilos globais para células */
    padding: 0cm 3.5pt 0cm 3.5pt;
    border: solid windowtext 1.0pt;
    vertical-align: middle;
    /* Remove padding default em células de corpo */
    line-height: 1.2;
}

/* 2. Estilos de Colunas Fixas */
.col-index {
    width: <?php echo $LARGURA_COL_INDEX_PT; ?>pt;
    min-width: <?php echo $LARGURA_COL_INDEX_PT; ?>pt;
    text-align: center;
    font-size: 8.0pt;
    border-right: none !important; /* A borda será criada pela célula do aluno */
}
.col-aluno {
    width: <?php echo $LARGURA_COL_ALUNO_PT; ?>pt;
    min-width: <?php echo $LARGURA_COL_ALUNO_PT; ?>pt;
    text-align: left;
    font-size: 9.0pt;
    text-transform: uppercase;
    border-left: none !important; /* A borda virá da célula de index */
}

/* 3. Estilos de Colunas de Frequência (Simétricas) */
.col-data-aula {
    width: <?php echo $LARGURA_COLUNA_AULA_PT; ?>pt;
    min-width: <?php echo $LARGURA_COLUNA_AULA_PT; ?>pt;
    max-width: <?php echo $LARGURA_COLUNA_AULA_PT; ?>pt;
    text-align: center;
    padding: 0;
    /* Garante que a borda esquerda sempre comece a partir da coluna 3 (Aula 1) */
    border-left: solid windowtext 1.0pt; 
}

/* 4. Estilos de Rotação (para o Word e simulação HTML) */
.rotated-cell {
    height: 58.75pt; /* Altura padrão para o cabeçalho rotacionado */
    padding: 0;
}
.rotate-content {
    /* ** CHAVE PARA ROTAÇÃO NO WORD: mso-rotate:90 na TD ** */
    /* Simulação para renderização HTML/PDF */
    writing-mode: vertical-rl;
    transform: rotate(180deg); 
    white-space: nowrap;
    display: block;
    margin: auto;
    text-align: center;
}

/* 5. Estilos de Conteúdo */
.content-row td {
    height: 14pt;
    padding: 0cm 3.5pt;
    font-size: 9.0pt;
    border-top: none;
}
.content-frequencia-cell {
    height: 14pt;
    padding: 0;
    text-align: center;
    font-size: 11.0pt;
}

/* 6. Estilos de Informação Superior */
.info-row td {
    height: 18pt;
    text-align: left;
    border: solid windowtext 1.0pt;
}

/* 7. Estilos de Debug (opcional, se a lógica de debug for mantida) */
.debug-content {
    display: block;
    font-size: 11pt;
    padding-top: 2px;
}
</style>

 <table>
  <tr>
        <td colspan="<?php echo 2 + $colspan_aulas; ?>" style='border: none; padding: 0;'>
      <table style='width: 100%; border-collapse: collapse; border: none;'>
        <tr style='height: 30pt;'>
          <td style='width: 68pt; border: none; padding: 0;'>
            <img width="68" height="75" src="imagens/logo.png" style="margin-right: 10px;">
          </td>
          <td style='border: none; padding: 0;'>
            <p style='text-align: center; margin: 0;'>
              <b><span style='font-size: 20.0pt;'>
                <?php echo $_SESSION['ORGAO'] ?? 'PREFEITURA DE LUÍS EDUARDO MAGALHÃES'; ?>
              </span></b>
            </p>
            <p style='text-align: center; margin: 0;'>
              <b><span style='font-size: 16.0pt;'>
                DIÁRIO DE CLASSE
              </span></b>
            </p>
          </td>
        </tr>
      </table>
    </td>
  </tr>

    <tr class="info-row">
    <td colspan="<?php echo 2 + $colspan_aulas; ?>">
      <b>ESCOLA MUNICIPAL:</b> <?php echo $nome_escola; ?> - INEP 29001269
    </td>
  </tr>
  <tr class="info-row">
    <td colspan="<?php echo 2 + $colspan_aulas; ?>">
      <b>ENDEREÇO:</b>
    </td>
  </tr>
  <tr class="info-row">
    <td colspan="<?php echo floor(($colspan_aulas + 2) / 2); ?>">
      <b>TIPO DE ENSINO:</b> <?php echo $tipo_ensino; ?>
    </td>
    <td colspan="<?php echo ceil(($colspan_aulas + 2) / 2); ?>" style="border-left: none;">
      <b>CÓDIGO U.E.</b>
    </td>
  </tr>
  <tr class="info-row">
    <td colspan="<?php echo 2 + $colspan_aulas; ?>">
      <b>TURMA:</b> <?php echo $nome_turma_exibicao; ?>
    </td>
  </tr>
  <tr class="info-row">
    <td colspan="<?php echo 2 + $colspan_aulas; ?>">
      <b>PERÍODO LETIVO:</b> <?php echo $ano_letivo; ?>
    </td>
  </tr>
  <tr class="info-row">
    <td colspan="<?php echo 2 + $colspan_aulas; ?>">
      <b>COMPONENTE CURRICULAR:</b> <?php echo $nome_disciplina; ?>
    </td>
  </tr>
  <tr class="info-row">
    <td colspan="<?php echo 2 + $colspan_aulas; ?>">
      <b>UNIDADE:</b> <?php echo "$descricao_trimestre " . converte_data($data_inicio_trimestre) . " a " . converte_data($data_fim_trimestre); ?>
    </td>
  </tr>
  
        <tr>
        <td class="col-index" rowspan="3" style="border-right: none;">&nbsp;</td>
    
        <td class="col-aluno" rowspan="3" style="border-left: none; text-align: center;">
      <b>ALUNO(A)</b>
    </td>

        <td colspan="<?php echo $colspan_aulas; ?>" style='text-align: center;'>
      <b><span style='font-size: 10.0pt;'>Aula/Data</span></b>
    </td>
  </tr>

    <tr class="rotated-cell" style='height: 58.75pt;'>
    <?php for ($i = 0; $i < $colspan_aulas; $i++): ?>
      <?php
      $data = $array_data_aula[$i] ?? null;
      $classe_fundo = ($i % 2 === 0) ? 'background:#D9D9D9;' : 'background:white;';
      ?>
      <td class="col-data-aula rotated-cell" 
        style='<?php echo $classe_fundo; ?> border-top: none;'
        mso-rotate:90;>
        <span class='rotate-content' style='font-size:8.0pt;'>
          <?php echo $data ? converte_data($data) : '&nbsp;'; ?>
        </span>
      </td>
    <?php endfor; ?>
  </tr>

    <tr class="rotated-cell" style='height: 72.25pt;'>
    <?php for ($i = 0; $i < $colspan_aulas; $i++): ?>
      <?php
      $aula_num = $array_aula[$i] ?? null; 
      $classe_fundo = ($i % 2 === 0) ? 'background:#D9D9D9;' : 'background:white;';
      ?>
      <td class="col-data-aula rotated-cell" 
        style='<?php echo $classe_fundo; ?> border-top: none;'
        mso-rotate:90;>
        <span class='rotate-content' style='font-size:7.0pt;'>
          <?php echo $aula_num ? "Aula " . ($i + 1) : '&nbsp;'; ?>
        </span>
      </td>
    <?php endfor; ?>
  </tr>


        <?php
  $conta = 1;
  $mapa_total_faltas=[];
  ?>

  <?php foreach ($res_alunos as $value): ?>
   <?php
   $idaluno = $value['idaluno'];
   $nome_aluno_completo = $value['nome_aluno'];
   $nome_identificacao_social = $value['nome_identificacao_social'];
   $data_matricula = $value['data_matricula'];
  
   $mapa_total_faltas[$idaluno]=0;


   $nome_exibicao = ($nome_identificacao_social !== '')
    ? "($idaluno) - $nome_identificacao_social"
    : "($idaluno) - $nome_aluno_completo";
   ?>

   <tr class="content-row">
        <td class="col-index" style='border-right: none;'>
      <?php echo $conta; ?>
    </td>

        <td class="col-aluno" style='border-left: none; padding: 0cm 3.5pt;'>
      <?php echo $nome_exibicao; ?>
    </td>

        <?php for ($i = 0; $i < $colspan_aulas; $i++): ?>
      <?php
      $data_frequencia = $array_data_aula[$i] ?? null;
      $aula = $array_aula[$i] ?? null; 
      $presenca = '&nbsp;';
      $status_busca = ""; // Variável para o debug

      if ($data_frequencia && $aula) {
        $chave_frequencia = $data_frequencia . '_' . $aula;

        if ($data_frequencia >= $data_matricula) {
          if (isset($frequencia_mapa[$idaluno][$chave_frequencia])) {
            $status = $frequencia_mapa[$idaluno][$chave_frequencia];
           
            if ($status == 1) {
              $presenca = '.'; // Presente
            } elseif ($status ==0) {
              $presenca = 'F'; // Falta
              $mapa_total_faltas[$idaluno]+=1;
            }
          } else {
            $presenca = '<b>-</b>'; // Sem registro do dia
          }
        } 
      }

      $classe_fundo = ($i % 2 === 0) ? 'background:white;' : 'background:white;';
      ?>
          <td class="col-data-aula content-frequencia-cell" style='<?php echo $classe_fundo; ?>'>
                        <span class="debug-content"><?php echo $presenca; ?></span>
          </td>
    <?php endfor; ?>
   </tr>

   <?php $conta++; ?>
  <?php endforeach; ?>
    
    <?php
    $MAX_ALUNOS = 30; // Exemplo de limite de linhas
    while ($conta <= $MAX_ALUNOS) {
    ?>
    <tr class="content-row">
        <td class="col-index" style='border-right: none;'><?php echo $conta; ?></td>
        <td class="col-aluno" style='border-left: none;'>&nbsp;</td>
        <?php for ($i = 0; $i < $colspan_aulas; $i++): ?>
            <?php $classe_fundo = ($i % 2 === 0) ? 'background:white;' : 'background:white;'; ?>
            <td class="col-data-aula content-frequencia-cell" style='<?php echo $classe_fundo; ?>'>&nbsp;</td>
        <?php endfor; ?>
    </tr>
    <?php
        $conta++;
    }
    ?>

 </table>

 <?php

 return $mapa_total_faltas;
}