<?php

/**
* Função para converter data do formato YYYY-MM-DD para DD/MM/YYYY.
* (Assumindo que esta função existe no seu projeto, se não, use o código abaixo)
*/
 


/**
* Função para gerar o Diário de Frequência.
*
* @param PDO $conexao Objeto de conexão PDO.
* @param int $idescola ID da Escola.
* @param int $idturma ID da Turma.
* @param int $iddisciplina ID da Disciplina.
* @param int $inicio Início da paginação para aulas.
* @param int $fim Fim da paginação para aulas.
* @param int $conta_aula Contador inicial de aula.
* @param int $conta_data Contador inicial de data.
* @param int $limite_data Limite de colunas de data.
* @param int $limite_aula Limite de colunas de aula.
* @param int $periodo_id ID do Período.
* @param int $idserie ID da Série.
* @param string $descricao_trimestre Descrição do Trimestre.
* @param string $data_inicio_trimestre Data de Início do Trimestre ('YYYY-MM-DD').
* @param string $data_fim_trimestre Data de Fim do Trimestre ('YYYY-MM-DD').
* @param int $ano_letivo Ano Letivo.
* @param int $seguimento Seguimento.
*/
function diario_frequencia_fund2(
  PDO $conexao,
  int $idescola,
  int $idturma,
  int $iddisciplina,
  int $inicio,
  int $fim,
  int $conta_aula,
  int $conta_data,
  int $limite_data,
  int $limite_aula,
  int $periodo_id,
  int $idserie,
  string $descricao_trimestre,
  string $data_inicio_trimestre,
  string $data_fim_trimestre,
  int $ano_letivo,
  int $seguimento
): void {
  $nome_disciplina = '';
  $tipo_ensino = "Tipo Desconhecido";

  // --- 1. Determinação do Tipo de Ensino ---
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

  // --- 2. Busca de Dados de Cabeçalho ---
  $stmt_disc = $conexao->prepare("SELECT nome_disciplina FROM disciplina WHERE iddisciplina = :iddisciplina");
  $stmt_disc->execute([':iddisciplina' => $iddisciplina]);
  $nome_disciplina = $stmt_disc->fetchColumn() ?? 'N/A';

  $stmt_escola = $conexao->prepare("SELECT nome_escola FROM escola WHERE idescola = :idescola");
  $stmt_escola->execute([':idescola' => $idescola]);
  $nome_escola = $stmt_escola->fetchColumn() ?? 'N/A';

  $stmt_turma = $conexao->prepare("SELECT nome_turma FROM turma WHERE idturma = :idturma");
  $stmt_turma->execute([':idturma' => $idturma]);
  $nome_turma_exibicao = $stmt_turma->fetchColumn() ?? 'N/A';


  // --- 3. Busca de Aulas e Datas ---
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
        // ATENÇÃO: $item['aula'] AQUI PODE SER 'AULA-3' (se o campo for VARCHAR) ou '3' (se for INT)
    $array_aula[] = $item['aula']; 
    $num_aulas_reais++;
  }

  $total_colunas_frequencia = max($num_aulas_reais, $limite_aula);


  // --- 4. Busca de Dados de Alunos ---
  if (isset($_SESSION['ano_letivo']) && isset($_SESSION['ano_letivo_vigente']) && $_SESSION['ano_letivo'] === $_SESSION['ano_letivo_vigente']) {
    $stmt_alunos = listar_aluno_da_turma_ata_resultado_final($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
  } else {
    $stmt_alunos = listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
  }
  $res_alunos = is_a($stmt_alunos, 'PDOStatement') ? $stmt_alunos->fetchAll(PDO::FETCH_ASSOC) : $stmt_alunos;
  $alunos_ids = array_column($res_alunos, 'idaluno');



  // --------------------------------------------------------------------------------
  // --- 5. Busca de Dados de Frequência em Massa (CORREÇÃO 1) ---
    // Consulta restrita apenas aos pares (data_frequencia, aula) exibidos no cabeçalho.
  // --------------------------------------------------------------------------------

  $frequencia_mapa = []; 
    $restricoes_aulas = [];

    foreach ($aulas_datas as $item) {
        // Cria a lista de pares (data, aula) para o IN clause da SQL
        $data_formatada = $conexao->quote($item['data_frequencia']);
        // Usamos quote para a aula também, pois ela pode conter 'AULA-'
        $aula_formatada = $conexao->quote($item['aula']);
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
            // Monta a chave usando o valor exato que veio do banco, como no debug: 2025-02-12_AULA-3
      $chave = $registro['data_frequencia'] . '_' . $registro['aula'];
      $frequencia_mapa[$registro['aluno_id']][$chave] = $registro['presenca'];
    }
  }

  $colspan_aulas = $limite_aula;

  ?>

<style>
/* Estilos CSS mantidos */
.MsoNormalTable { border-collapse: collapse; width: 100%; }
.MsoNormalTable td, .MsoNormalTable th { padding: 0; border: 1px solid black; vertical-align: top; box-sizing: border-box; }
.col-index { width: 30pt; text-align: center; }
.col-aluno { width: 250pt; padding: 0cm 3.5pt 0cm 3.5pt; }
.col-data-aula { width: calc((100% - 280pt) / <?php echo $colspan_aulas; ?>); min-width: 18pt; max-width: 18pt; text-align: center; height: 60pt; }
.rotate-text { writing-mode: vertical-rl; transform: rotate(180deg); white-space: nowrap; display: block; margin: auto; text-align: center; }
.row-data { height: 14pt; }
.header-cell { padding: 0cm 3.5pt; height: 18pt; }
</style>

  <div class="WordSection1">

  <table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" style='width: 100%;'>

    <tr style='height: 15.0pt;'>
      <td colspan="<?php echo 2 + $colspan_aulas; ?>" style='border: none; padding: 0;'>
        <table style='width: 100%; border-collapse: collapse;'>
          <tr>
            <td style='width: 68pt; border: none; padding: 0;'>
              <img width="68" height="75" src="imagens/logo.png" style="margin-right: 10px;">
            </td>
            <td style='border: none; padding: 0;'>
              <p style='text-align: center; margin: 0;'>
                <b><span style='font-size: 20.0pt; font-family:"Tw Cen MT Condensed",sans-serif;'>
                  <?php echo $_SESSION['ORGAO'] ?? 'PREFEITURA DE LUÍS EDUARDO MAGALHÃES'; ?>
                </span></b>
              </p>
              <p style='text-align: center; margin: 0;'>
                <b><span style='font-size: 16.0pt; font-family:"Tw Cen MT Condensed",sans-serif;'>
                  DIÁRIO DE CLASSE
                </span></b>
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr class="row-data">
      <td colspan="<?php echo 2 + $colspan_aulas; ?>" class="header-cell">
        <b>ESCOLA MUNICIPAL: <?php echo $nome_escola; ?> - INEP 29001269</b>
      </td>
    </tr>
    <tr class="row-data">
      <td colspan="<?php echo 2 + $colspan_aulas; ?>" class="header-cell">
        <b>ENDEREÇO:</b>
      </td>
    </tr>
    <tr class="row-data">
      <td colspan="<?php echo floor(($colspan_aulas + 2) / 2); ?>" class="header-cell">
        <b>TIPO DE ENSINO:</b> <?php echo $tipo_ensino; ?>
      </td>
      <td colspan="<?php echo ceil(($colspan_aulas + 2) / 2); ?>" class="header-cell">
        <b>CÓDIGO U.E.</b>
      </td>
    </tr>
    <tr class="row-data">
      <td colspan="<?php echo 2 + $colspan_aulas; ?>" class="header-cell">
        <b>TURMA:</b> <?php echo $nome_turma_exibicao; ?>
      </td>
    </tr>
    <tr class="row-data">
      <td colspan="<?php echo 2 + $colspan_aulas; ?>" class="header-cell">
        <b>PERÍODO LETIVO:</b> <?php echo $ano_letivo; ?>
      </td>
    </tr>
    <tr class="row-data">
      <td colspan="<?php echo 2 + $colspan_aulas; ?>" class="header-cell">
        <b>COMPONENTE CURRICULAR:</b> <?php echo $nome_disciplina; ?>
      </td>
    </tr>
    <tr class="row-data">
      <td colspan="<?php echo 2 + $colspan_aulas; ?>" class="header-cell">
        <b>UNIDADE:</b> <?php echo "$descricao_trimestre " . converte_data($data_inicio_trimestre) . " a " . converte_data($data_fim_trimestre); ?>
      </td>
    </tr>


    <tr>
      <td class="col-index" rowspan="3" style="border-right: none;">&nbsp;</td>
      <td class="col-aluno" rowspan="3" style="border-left: none; border-bottom: 1px solid black;">
        <p style='text-align: center; margin: 0;'><b>ALUNO(A)</b></p>
      </td>

      <td colspan="<?php echo $colspan_aulas; ?>" style='border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; text-align: center;'>
        <b><span style='font-size: 10.0pt;'>Aula/Data</span></b>
      </td>
    </tr>

    <tr style='height: 58.75pt;'>
      <?php for ($i = 0; $i < $colspan_aulas; $i++): ?>
        <?php
        $data = $array_data_aula[$i] ?? null;
        $classe_fundo = ($i % 2 === 0) ? 'background:#D9D9D9;' : '';
        ?>
        <td class="col-data-aula" style='<?php echo $classe_fundo; ?> border: 1px solid black; border-top: none;'>
          <span class='rotate-text' style='font-size:8.0pt;'>
            <?php echo $data ? converte_data($data) : '&nbsp;'; ?>
          </span>
        </td>
      <?php endfor; ?>
    </tr>

    <tr style='height: 72.25pt;'>
      <?php for ($i = 0; $i < $colspan_aulas; $i++): ?>
        <?php
        $aula_num = $array_aula[$i] ?? null;
        $classe_fundo = ($i % 2 === 0) ? 'background:#D9D9D9;' : '';
                
                // Extrai apenas o número da aula para exibição no cabeçalho (ex: 'AULA-3' vira '3')
                $aula_somente_num = $aula_num ? str_replace('AULA-', '', $aula_num) : '&nbsp;';
        ?>
        <td class="col-data-aula" style='<?php echo $classe_fundo; ?> border: 1px solid black; border-top: none;'>
          <span class='rotate-text' style='font-size:7.0pt;'>
            <?php echo $aula_num ? "Aula $aula_somente_num" : '&nbsp;'; ?>
          </span>
        </td>
      <?php endfor; ?>
    </tr>


    <?php $conta = 1; ?>
    <?php foreach ($res_alunos as $value): ?>
      <?php
      $idaluno = $value['idaluno'];
      $nome_aluno_completo = $value['nome_aluno'];
      $nome_identificacao_social = $value['nome_identificacao_social'];
      $data_matricula = $value['data_matricula'];

      $nome_exibicao = ($nome_identificacao_social !== '')
        ? "($idaluno) - $nome_identificacao_social"
        : "($idaluno) - $nome_aluno_completo";
      ?>

      <tr class="row-data">
        <td class="col-index" style='border-right: none;'>
          <span style='font-size:8.0pt;'><?php echo $conta; ?></span>
        </td>

        <td class="col-aluno" style='font-size:9.0pt; text-transform: uppercase; border-left: none; border-bottom: 1px solid black;'>
          <?php echo $nome_exibicao; ?>
        </td>

        <?php for ($i = 0; $i < $colspan_aulas; $i++): ?>
          <?php
          $data_frequencia = $array_data_aula[$i] ?? null;
          $aula = $array_aula[$i] ?? null; // Ex: 'AULA-3'
          $presenca = '&nbsp;'; // Valor padrão: Branco

          if ($data_frequencia && $aula) {
            // CORREÇÃO AQUI: Usa o valor exato da coluna 'aula' (Ex: 'AULA-3') para a chave
            $chave_frequencia = $data_frequencia . '_' . $aula;

            // Verifica se o aluno já estava matriculado na data da aula
            if ($data_frequencia >= $data_matricula) {
              if (isset($frequencia_mapa[$idaluno][$chave_frequencia])) {
                $status = $frequencia_mapa[$idaluno][$chave_frequencia];
                if ($status === '1') {
                  $presenca = '.'; // Presente
                } elseif ($status === '0') {
                  $presenca = 'F'; // Falta
                }
              } else {
                $presenca = '-'; // Sem registro do dia
              }
            }
          }

          $classe_fundo = ($i % 2 === 0) ? 'background:white;' : 'background:white;';
          ?>
        
                              <td class="col-data-aula" style='<?php echo $classe_fundo; ?> height: 13.5pt; border: 1px solid black; border-top: none; text-align: center; font-size:9.0pt;'>
            <?php echo $presenca; ?>
          </td>
        <?php endfor; ?>
      </tr>

      <?php $conta++; ?>
    <?php endforeach; ?>

  </table>

  </div>

  <?php
}