<?php
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Setor.php';

try {
    $chamada_id=$_GET['id_chamada_transferir'];
    $setor_transferir=$_GET['setor_transferir'];
    $tipo_solicitacao_transferir=$_GET['tipo_solicitacao_transferir'];
 
    $conexao->exec("UPDATE chamada SET setor_id=$setor_id, status='esperando_resposta', tipo_solicitacao= $tipo_solicitacao_transferir where id=$chamada_id");
    $_SESSION['status']=1;
    
} catch (Exception $exc) {
    $_SESSION['status']=0;
    echo "$exc";

    // header("location:../View/lista_chamada.php?setor=14&status=esperando_resposta");

}
?>