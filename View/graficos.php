<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Notas dos Alunos</title>
    <!-- Inclua a biblioteca ECharts -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
</head>
<body>
    <div id="grafico" style="width: 800px; height: 400px;"></div>

    <?php
    // Gerar dados dinâmicos
    $escola = "Escola XYZ";
    $turma = "Turma A";
    $alunos = [];
    $notas = [];

    for ($i = 1; $i <= 30; $i++) {
        $aluno = "Aluno " . $i;
        $alunos[] = $aluno;

        $notasAluno = [];
        for ($j = 1; $j <= 9; $j++) {
            $nota = rand(0, 10); // Gere notas aleatórias entre 50 e 100
            $notasAluno[] = $nota;
        }
        $notas[] = $notasAluno;
    }
    ?>

    <script>
    // Dados dinâmicos gerados pelo PHP
    var escola = "<?php echo $escola; ?>";
    var turma = "<?php echo $turma; ?>";
    var alunos = <?php echo json_encode($alunos); ?>;
    var notas = <?php echo json_encode($notas); ?>;

    // Inicialize o gráfico ECharts
    var myChart = echarts.init(document.getElementById('grafico'));

    // Defina as opções do gráfico
    var options = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985',
                },
            },
        },
        legend: {
            data: alunos,
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['Nota 1', 'Nota 2', 'Nota 3', 'Nota 4', 'Nota 5', 'Nota 6', 'Nota 7', 'Nota 8', 'Nota 9'],
        },
        yAxis: {
            type: 'value',
        },
        series: [],
    };

    // Adicione dados ao gráfico
    for (var i = 0; i < alunos.length; i++) {
        options.series.push({
            name: alunos[i],
            type: 'line',
            stack: 'total',
            areaStyle: {},
            data: notas[i],
        });
    }

    options.title = {
        text: 'Notas dos Alunos - ' + escola + ' - ' + turma,
        x: 'center',
        y: 'top',
    };

    // Configurar as opções no gráfico
    myChart.setOption(options);
    </script>
</body>
</html>