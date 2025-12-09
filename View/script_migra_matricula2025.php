<?php
session_start();

$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao.php"; // aqui está sua variável $conexao (PDO)

// Consulta
$sql = "
    SELECT 
        7 as idserie,
        escola_id as idescola,
        turma_id as idturma,
        escola.nome_escola,
        turma.nome_turma,
        CASE 
            WHEN turno = 'MATUTINO' THEN 1
            WHEN turno = 'VESPERTINO' THEN 2
            ELSE 0
        END as turno_id
    FROM relacionamento_turma_escola
    JOIN turma ON turma_id = idturma
    JOIN escola ON escola_id = escola.idescola
    WHERE ano = 2025
      AND turma.serie_id = 7
";

$stmt = $conexao->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem</title>
</head>
<body>

<h3>Listagem</h3>

<?php foreach($resultados as $linha): ?>

    <?php
        $idserie = $linha['idserie'];
        $idescola = $linha['idescola'];
        $idturma = $linha['idturma'];
        $nome_escola = urlencode($linha['nome_escola']);
        $nome_turma = urlencode($linha['nome_turma']);
        $turno_id = $linha['turno_id'];

        $link = "https://teste.educalem.com.br/View/ata_script_matricula.php?idserie={$idserie}&idescola={$idescola}&idturma={$idturma}&nome_escola={$nome_escola}&nome_turma={$nome_turma}&turno_id={$turno_id}";
    ?>

    <div style="margin-bottom:10px;">
        <a href="<?= $link ?>" target="_blank">
            <?= $linha['nome_escola'] ?> — <?= $linha['nome_turma'] ?> (Turno <?= $turno_id ?>)
        </a>
    </div>

<?php endforeach; ?>

</body>
</html>
