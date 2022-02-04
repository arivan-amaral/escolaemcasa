<?php 
session_start();
try {
include_once"../Controller/Conversao.php";
include_once"../Model/Conexao.php";
include_once"../Model/Coordenador.php";
include_once"../Model/Aluno.php";
include_once"../Model/EScola.php";

include_once"diarioFrequencia_infantil.php";
include_once"diarioFrequencia_fund1.php";
include_once"diarioFrequencia_fund2.php";

include_once"diarioFrequenciaPaginaFinal_infantil.php";
include_once"diarioFrequenciaPaginaFinal_fund1.php";
include_once"diarioFrequenciaPaginaFinal_fund2.php";
 
$ano_letivo=$_SESSION['ano_letivo'];




} catch (Exception $e) {
    echo "erro: $e";
}
 ?>