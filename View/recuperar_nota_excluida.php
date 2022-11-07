<?php 
  include_once '../Model/Conexao.php';

  $res=$conexao->query("SELECT * FROM `nota_backup` WHERE `avaliacao` LIKE 'av1' AND `escola_id` = 162 AND `turma_id` = 6403 AND `disciplina_id` = 9 AND `periodo_id` = 1 and data_nota='2021-05-24' and data_hora>'2021-08-09 23:59:59' ORDER BY `nota_backup`.`data_hora` DESC");
  foreach ($res as $key => $value) {
    $nota=$value['nota'];
    $avaliacao=$value['avaliacao'];
    $parecer_disciplina_id=$value['parecer_disciplina_id'];
    $parecer_descritivo=$value['parecer_descritivo'];
    $sigla=$value['sigla'];
    $escola_id=$value['escola_id'];
    $turma_id=$value['turma_id'];
    $disciplina_id=$value['disciplina_id'];
    $aluno_id=$value['aluno_id'];
    $periodo_id=$value['periodo_id'];
    $data_nota=$value['data_nota'];

     $conexao->exec("INSERT INTO nota(nota, avaliacao, parecer_disciplina_id, parecer_descritivo, sigla, escola_id, turma_id, disciplina_id, aluno_id, periodo_id, data_nota) VALUES (
      $nota, '$avaliacao', $parecer_disciplina_id, '$parecer_descritivo', '$sigla', $escola_id, $turma_id, $disciplina_id, $aluno_id, $periodo_id, '$data_nota')"
      );
  }
 ?>