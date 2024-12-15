<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'educ_lem_producao';
$username = 'educ_lem';
$password = 'Ari200120022003_';

// Número de repetições para calcular o tempo médio
$repeticoes = 500;

try {
    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL
    $sql = "SELECT data_frequencia, aula FROM frequencia 
            WHERE escola_id = 15 
              AND turma_id = 5631 
              AND data_frequencia BETWEEN '2024-02-02' AND '2024-05-30' 
            GROUP BY aula, data_frequencia 
            ORDER BY data_frequencia, aula ASC 
            LIMIT 0, 36";

    $tempos = [];

    for ($i = 0; $i < $repeticoes; $i++) {
        $inicio = microtime(true); // Início da medição

        $stmt = $pdo->query($sql); // Executa a consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém os resultados

        $fim = microtime(true); // Fim da medição
        $tempos[] = $fim - $inicio; // Calcula o tempo decorrido
    }

    // Calcula a média dos tempos
    $tempoTotal = array_sum($tempos);
    $mediaTempo = $tempoTotal / $repeticoes;

    // Exibe os resultados
    echo "Consulta executada $repeticoes vezes.\n";
    echo "Tempo médio de execução: " . round($mediaTempo, 5) . " segundos.\n";

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>