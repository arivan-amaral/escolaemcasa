<?php
set_time_limit(0);
session_start();
$url = "https://educalem.com.br/View/impressao_diario_frequencia.php?iddisciplina=1000&idturma=6288&idescola=227&idserie=1&periodo_id=1";
$arquivo = "teste.html";

try {
    // Inicializa o cURL
    $ch = curl_init($url);

    if ($ch === false) {
        throw new Exception("Falha ao inicializar cURL.");
    }

    // Configurações do cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna o conteúdo como string
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Segue redirecionamentos

    // Executa a solicitação
    $conteudo = curl_exec($ch);

    if ($conteudo === false) {
        throw new Exception("Erro ao carregar a página: " . curl_error($ch));
    }

    // Fecha a conexão cURL
    curl_close($ch);

    // Salva o conteúdo no arquivo
    $resultado = file_put_contents($arquivo, $conteudo);

    if ($resultado === false) {
        throw new Exception("Não foi possível salvar o conteúdo no arquivo.");
    }

    echo "Página salva com sucesso em '$arquivo'.";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
