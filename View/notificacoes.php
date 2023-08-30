<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>NÃO FECHE ESSA PAGINA</h1>
<script src='ajax.js?<?php echo rand(); ?>'></script>

<DIV id='log_conexao'>
	
</DIV>

    <?php 
              $result=$conexao->query("SELECT * FROM turma,disciplina, ministrada, funcionario,escola where escola.idescola= ministrada.escola_id and turma_id=idturma and disciplina_id=iddisciplina and professor_id=idfuncionario and idfuncionario");
              $cont=0;
// notificacao_video_whatsapp($cont);
//                  	notificacao_mural_whatsapp($cont);

              foreach ($result as $key => $value) {
                  $turma_id=$value['turma_id'];
                  $serie_id=$value['serie_id'];
                  $escola_id=$value['escola_id'];
                 echo "
                 <input id='turma_id$cont' value='$turma_id'>
                 <input id='escola_id$cont' value='$escola_id'>
                 <input id='serie_id$cont' value='$serie_id'>
                 <script>
                 	notificacao_video_whatsapp($cont);
                 	notificacao_mural_whatsapp($cont);
                 	notificacao_trabalho_whatsapp($cont);
                 </script>
                 	certo<br>
                 ";

                 $cont++;
              }
   
?>
<script>
//	setInterval('location.reload()',15000);
</script>