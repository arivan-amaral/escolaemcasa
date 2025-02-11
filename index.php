<?php
session_start();

class LoadBalancer {
    private $subdomains;
    private $jsonFile;
    private $lockFile;

    public function __construct() {
        // Configuração dos subdomínios
        $this->subdomains = [
            'servidor1.educalem.com.br',
            'servidor2.educalem.com.br',
            'servidor3.educalem.com.br'
        ];
        


        $this->jsonFile = __DIR__ . '/connections.json';
        $this->lockFile = __DIR__ . '/connections.lock';

        $this->initializeConnectionsFile();
    }

    private function initializeConnectionsFile() {
        if (!file_exists($this->jsonFile)) {
            $initial = array_fill_keys($this->subdomains, 0);
            file_put_contents($this->jsonFile, json_encode($initial));
        }
    }

    private function acquireLock() {
        $lock = fopen($this->lockFile, 'w+');
        $attempts = 0;
        while (!flock($lock, LOCK_EX) && $attempts < 10) {
            usleep(100000); // 0.1 segundo
            $attempts++;
        }
        return $lock;
    }

    private function releaseLock($lock) {
        flock($lock, LOCK_UN);
        fclose($lock);
    }

    public function getSubdomain() {
        if (isset($_SESSION['assigned_subdomain'])) {
            return $_SESSION['assigned_subdomain'];
        }

        $lock = $this->acquireLock();
        $connections = json_decode(file_get_contents($this->jsonFile), true);
        
        // Encontra o subdomínio com menos conexões
        $minConnections = PHP_INT_MAX;
        $selectedSubdomain = null;
        
        foreach ($connections as $subdomain => $count) {
            if ($count < $minConnections) {
                $minConnections = $count;
                $selectedSubdomain = $subdomain;
            }
        }

        // Incrementa o contador de conexões
        $connections[$selectedSubdomain]++;
        file_put_contents($this->jsonFile, json_encode($connections));
        
        $this->releaseLock($lock);

        $_SESSION['assigned_subdomain'] = $selectedSubdomain;
        return $selectedSubdomain;
    }

    public function decrementConnections() {
        if (!isset($_SESSION['assigned_subdomain'])) {
            return;
        }

        $lock = $this->acquireLock();
        $connections = json_decode(file_get_contents($this->jsonFile), true);
        
        $subdomain = $_SESSION['assigned_subdomain'];
        if (isset($connections[$subdomain]) && $connections[$subdomain] > 0) {
            $connections[$subdomain]--;
        }
        
        file_put_contents($this->jsonFile, json_encode($connections));
        $this->releaseLock($lock);

        unset($_SESSION['assigned_subdomain']);
    }
}

// Verifica se é uma requisição de logout
if (isset($_GET['logout'])) {
    $balancer = new LoadBalancer();
    $balancer->decrementConnections();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Processo normal de balanceamento
$balancer = new LoadBalancer();
$subdomain = $balancer->getSubdomain();

// Construir a URL de redirecionamento corretamente
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

// Pegar apenas o path da URL atual, removendo query strings
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentPath = preg_replace('/\/balanceador\.php$/', '', $currentPath);

// Se o path estiver vazio, use '/'
$currentPath = empty($currentPath) ? '/' : $currentPath;

// Construir a URL final
$redirectUrl = $protocol . $subdomain . $currentPath;

// Debug
error_log("Debug - Redirect URL: " . $redirectUrl);
error_log("Debug - Current Path: " . $currentPath);
error_log("Debug - Subdomain: " . $subdomain);

// Se for uma requisição AJAX, retorna o subdomínio em JSON
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode(['subdomain' => $subdomain, 'redirect_url' => $redirectUrl]);
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecionando...</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .loader {
            width: 100px;
            height: 100px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .message {
            color: #333;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .subdomain {
            color: #3498db;
            font-weight: bold;
            margin-top: 10px;
        }
        #debug {
            margin-top: 20px;
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="loader"></div>
        <div class="message">Escolhendo o melhor servidor para você...</div>
        <div class="subdomain">Conectando a <?php echo htmlspecialchars($subdomain); ?></div>
        <div id="debug">
            Redirecionando para: <?php echo htmlspecialchars($redirectUrl); ?>
        </div>
    </div>
    <script>
        // Função para redirecionar com retry
        function redirectWithRetry(url, maxAttempts = 3) {
            let attempts = 0;
            
            function tryRedirect() {
                if (attempts >= maxAttempts) {
                    alert('Erro ao redirecionar. Por favor, recarregue a página.');
                    return;
                }
                
                attempts++;
                try {
                    window.location.href = url;
                } catch (e) {
                    console.error('Erro no redirecionamento:', e);
                    setTimeout(tryRedirect, 1000);
                }
            }
            
            setTimeout(tryRedirect, 2000);
        }
        
        redirectWithRetry(<?php echo json_encode($redirectUrl); ?>);
    </script>
</body>
</html>