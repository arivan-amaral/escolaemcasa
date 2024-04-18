<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enviar Arquivo</title>
</head>
<body>
    <h2>Enviar Arquivo</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Enviar Arquivo" name="submit">
    </form>
</body>
</html>


<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $file = $_FILES["fileToUpload"];

    // Verifica se houve algum erro durante o envio
    if ($file["error"] !== UPLOAD_ERR_OK) {
        die("Erro ao enviar o arquivo.");
    }

    // Diretório de destino para os arquivos enviados
    $uploadDir = "laudo/";

    // Gera um nome de arquivo único com base no timestamp atual
    $timestamp = time();
    $fileName = $timestamp . '_' . basename($file["name"]);
    $targetPath = $uploadDir . $fileName;

    // Move o arquivo temporário para o diretório de destino
    if (move_uploaded_file($file["tmp_name"], $targetPath)) {
        echo "Arquivo enviado com sucesso.";
    } else {
        echo "Erro ao mover o arquivo para o diretório.";
    }
} else {
    echo "Erro: nenhum arquivo enviado.";
}
?>
