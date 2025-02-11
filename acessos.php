<?php
session_start();

class ServerStats {
    private $jsonFile;
    private $subdomains;
    
    public function __construct() {
        $this->jsonFile = _DIR_ . '/connections.json';
        $this->subdomains = [
            'servidor1.educalem.com.br',
            'servidor2.educalem.com.br',
            'servidor3.educalem.com.br'
        ];
        $this->initializeFile();
    }
    
    private function initializeFile() {
        if (!file_exists($this->jsonFile)) {
            $initial = array_fill_keys($this->subdomains, 0);
            file_put_contents($this->jsonFile, json_encode($initial));
        }
    }
    
    public function getStats() {
        if (!file_exists($this->jsonFile)) {
            return ['error' => 'Arquivo de conexões não encontrado'];
        }
        
        $data = json_decode(file_get_contents($this->jsonFile), true);
        if (!$data) {
            // Se o arquivo estiver vazio ou corrompido, reinicializa
            $this->initializeFile();
            $data = json_decode(file_get_contents($this->jsonFile), true);
        }
        
        return $data;
    }
}

$stats = new ServerStats();
$dados = $stats->getStats();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatísticas dos Servidores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .server-stats {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }
        .server-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .server-name {
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 10px;
        }
        .connections {
            font-size: 24px;
            color: #28a745;
        }
        .refresh-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .refresh-button:hover {
            background-color: #0056b3;
        }
        .total-stats {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 8px;
        }
        .last-update {
            text-align: center;
            color: #666;
            font-size: 0.9em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Estatísticas dos Servidores</h1>
        
        <div class="server-stats">
            <?php 
            if (isset($dados['error'])) {
                echo "<p>Erro: {$dados['error']}</p>";
            } else {
                $total = 0;
                foreach ($dados as $servidor => $conexoes) {
                    $total += $conexoes;
                    ?>
                    <div class="server-card">
                        <div class="server-name"><?php echo htmlspecialchars($servidor); ?></div>
                        <div class="connections"><?php echo number_format($conexoes, 0, ',', '.'); ?> conexões</div>
                    </div>
                    <?php
                }
                ?>
                <div class="total-stats">
                    <h2>Total de Conexões</h2>
                    <div class="connections"><?php echo number_format($total, 0, ',', '.'); ?></div>
                </div>
                <?php
            }
            ?>
        </div>
        
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="refresh-button">Atualizar Dados</a>
        
        <div class="last-update">
            Última atualização: <?php echo date('d/m/Y H:i:s'); ?>
        </div>
    </div>

    <script>
        // Atualiza a página automaticamente a cada 30 segundos
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>