<?php 
include '../Model/Conexao.php';
$data_file = date("d/m/Y H:i:s", filemtime("pagina_estatica/listar_alunos_da_turma.php idturma=6269 nome_turma=2 20ANO 20C idescola=13 idserie=4.php"));
echo "data atualização: $data_file";
?>