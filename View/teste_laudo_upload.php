<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idRegistro = $_POST['id_registro'] ?? 'desconhecido';

    if (isset($_FILES['arquivo_pdf']) && $_FILES['arquivo_pdf']['error'] === UPLOAD_ERR_OK) {
        $nomeTemp = $_FILES['arquivo_pdf']['tmp_name'];
        $extensao = strtolower(pathinfo($_FILES['arquivo_pdf']['name'], PATHINFO_EXTENSION));

        if ($extensao === 'pdf') {
            $novoNome = uniqid("registro_{$idRegistro}_", true) . '.pdf';
            $destino = __DIR__ . '/laudo/' . $novoNome;

            if (move_uploaded_file($nomeTemp, $destino)) {
                echo "PDF do registro $idRegistro enviado com sucesso!";
            } else {
                echo "Erro ao mover o arquivo.";
            }
        } else {
            echo "Apenas arquivos PDF são permitidos.";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
} else {
    echo "Requisição inválida.";
}
?>
