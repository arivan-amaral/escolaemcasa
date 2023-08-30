<?php
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    # https://educalem.com.br/escolaemcasa/View/script_trabalho_visitante.php?idescola_anterior=&idescola_nova=&idturma_nova=
    $idescola_anterior=$_GET['idescola_anterior'];
    $idescola_nova=$_GET['idescola_nova'];
    $idturma_nova=$_GET['idturma_nova'];

    $res = $conexao->query("SELECT * FROM trabalho where escola_id=$idescola_anterior ");
    foreach ($res as $key => $value) {
        $id=$value['id'];
        $titulo=$value['titulo'];
        $descricao=$value['descricao'];
        $turma_id=$value['turma_id'];
        $disciplina_id=$value['disciplina_id'];
        $professor_id=$value['professor_id'];
        $data_entrega=$value['data_entrega'];
        $caminho=$value['caminho'];
        $escola_id=$value['escola_id'];
        $data_hora_visivel=$value['data_hora_visivel'];
        $extensao=$value['extensao'];
        $data_hora=$value['data_hora'];

        $conexao->exec("INSERT INTO trabalho(titulo, descricao, turma_id, disciplina_id, professor_id, data_entrega, caminho, escola_id, data_hora_visivel, extensao, data_hora,notificado) VALUES (
            '$titulo',
            '$descricao',
            $idturma_nova,
            $disciplina_id,
            175,
            '$data_entrega',
            '$caminho',
            $idescola_nova,
            '$data_hora_visivel',
            '$extensao',
            '$data_hora',
            1

            )");



    }

?>