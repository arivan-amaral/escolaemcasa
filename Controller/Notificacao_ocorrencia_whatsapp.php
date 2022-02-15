<?php

session_start();
include '../Model/Conexao.php';
include'Api_zapi.php';
include'Conversao.php';
 
try {
    $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
$res_ocorrencias= $conexao->query("SELECT 
ocorrencia_pedagogica.id,
aluno.nome as 'nome_aluno',
aluno.nome_responsavel,
aluno.whatsapp,
aluno.whatsapp_responsavel,
ocorrencia_pedagogica.descricao,
ocorrencia_pedagogica.data_hora,
ocorrencia_pedagogica.aluno_id,
escola.nome_escola,
turma.nome_turma,
disciplina.nome_disciplina,
funcionario.nome as 'nome_professor'
FROM ocorrencia_pedagogica,aluno,escola,turma,disciplina, funcionario WHERE
ocorrencia_pedagogica.professor_id= funcionario.idfuncionario and 
ocorrencia_pedagogica.turma_id =turma.idturma and 
ocorrencia_pedagogica.disciplina_id =disciplina.iddisciplina and 
 ocorrencia_pedagogica.escola_id = escola.idescola AND
ocorrencia_pedagogica.aluno_id = aluno.idaluno AND
 ocorrencia_pedagogica.ano=2021 AND 

 ocorrencia_pedagogica.descricao IS NOT NULL and ocorrencia_pedagogica.descricao !=''
and
 ocorrencia_pedagogica.id NOT IN (SELECT ocorrencia_pedagogica_id FROM ocorrencia_enviada_whatsapp ) AND
 ocorrencia_pedagogica.aluno_id NOT IN (SELECT ocorrencia_enviada_whatsapp.aluno_id FROM ocorrencia_enviada_whatsapp )  LIMIT 5");

foreach ($res_ocorrencias as $key => $value) {
    $idocorrencia=$value['id'];
    $aluno_id=$value['aluno_id'];
    $descricao_ocorrencia=$value['descricao'];
    $nome_disciplina=$value['nome_disciplina'];
    
    $nome_responsavel=$value['nome_responsavel'];
    $whatsapp=$value['whatsapp'];
    $whatsapp_responsavel=$value['whatsapp_responsavel'];
    $data_hora=converte_data_hora($value['data_hora']);
    $nome_responsavel=$value['nome_responsavel'];
    $nome_professor=$value['nome_professor'];
    $nome_escola=$value['nome_escola'];
    $nome_turma=$value['nome_turma'];
    $nome_disciplina=$value['nome_disciplina'];
    $nome_aluno=$value['nome_aluno'];
 
 
if ($descricao_ocorrencia !='') {
    // code...
    $mensagem=" Olá *$nome_responsavel*! 

O aluno(a) *$nome_aluno*, matriculado na escola *$nome_escola*, na turma $nome_turma, recebeu o registro de ocorrência na plataforma de ensino EDUCALEM. 
A ocorrência foi realizada pelo professor(a) *$nome_professor*, da disciplina *$nome_disciplina*. 
Segue ocorrência registrada para o aluno *$nome_aluno*:\n\r\n\r

$descricao_ocorrencia

\n\r\n\r
🚨ATENÇÃO! Esta é uma mensagem automática, gerada pela plataforma de ensino EDUCALEM. Para maiores informações, procure a escola *$nome_escola* onde seu filho(a) está matriculado(a).\n\r\n\r

Atenciosamente, Secretaria Municipal de Educação de Luís Eduardo Magalhães! 🤝";

// echo "$mensagem <br>";
    if ($whatsapp_responsavel=='') {
       // $whatsapp_responsavel='7799323906';
        enviar_mensagem($conexao,'55'.$whatsapp_responsavel,$mensagem);
        $conexao->exec("INSERT INTO ocorrencia_enviada_whatsapp( ocorrencia_pedagogica_id, aluno_id) VALUES ($idocorrencia, $aluno_id) ");

    }elseif ($whatsapp=='') {
       // $whatsapp='7799323906';

        enviar_mensagem($conexao,'55'.$whatsapp,$mensagem);
        $conexao->exec("INSERT INTO ocorrencia_enviada_whatsapp( ocorrencia_pedagogica_id, aluno_id) VALUES ($idocorrencia, $aluno_id) ");
    }

}


}

$data_hora_atual=date("Y-m-d H:i:s");
$data_banco=verifica_validade_api($conexao,$data_hora_atual);
$diferenca=(strtotime($data_hora_atual) - strtotime($data_banco));

if($diferenca > 125876){
        enviar_mensagem($conexao,'558999342837','CADASTRO Z-API.IO PARA EUCALEM');

}
echo "DEU CERTO $diferenca <BR>";
   
    
} catch (Exception $e) {
    echo "$e";
}