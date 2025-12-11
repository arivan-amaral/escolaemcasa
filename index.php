<?php
// Lista dos servidores
$servers = [
    "https://servidor1.educalem.com.br",
    "https://servidor2.educalem.com.br",
    "https://educalem.com.br"
];

// Arquivo que guarda o índice do próximo servidor
$contadorFile = __DIR__ . "/contador.txt";

// Se não existir, cria começando em 0
if (!file_exists($contadorFile)) {
    file_put_contents($contadorFile, "0");
}

$index = (int)file_get_contents($contadorFile);
$destino = $servers[$index];
$index = ($index + 1) % count($servers);
file_put_contents($contadorFile, $index);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">

<title>Carregando...</title>

<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #4a90e2, #005bea);
        color: #fff;
        overflow: hidden;
    }

    .container {
        text-align: center;
        animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .loader {
        border: 6px solid rgba(255, 255, 255, 0.3);
        border-top: 6px solid #fff;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        margin: 0 auto 20px auto;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .msg {
        font-size: 20px;
        letter-spacing: 0.5px;
        opacity: 0.95;
    }
</style>

<script>
    setTimeout(function() {
        window.location.href = "<?php echo $destino; ?>";
    }, 1200);
</script>

</head>
<body>

<div class="container">
    <div class="loader"></div>
    <div class="msg">Escolhendo o melhor servidor para você...</div>
</div>

</body>
</html>
