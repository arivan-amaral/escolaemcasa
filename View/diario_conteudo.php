<?php
session_start();
set_time_limit(0);
// setlocale(LC_ALL,'pt_BR.UTF8');
// mb_internal_encoding('UTF8');
// mb_regex_encoding('UTF8');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING); // Oculta avisos e notificações
ini_set('display_errors', '0'); // Desativa a exibição de erros

include_once "../Model/Conexao.php";
include_once "../Model/Escola.php";
include "../Controller/Conversao.php";
include "../Model/Coordenador.php";
include "../Model/Aluno.php";
include "../Model/Professor.php";

include_once "conteudos_registrados_infantil.php";
include_once "conteudos_registrados_fund1.php";
include_once "conteudos_registrados_fund2.php";

$ano_letivo = $_SESSION['ano_letivo'];

$data_inicio_trimestre1 = "";
$data_fim_trimestre1 = "";

$data_inicio_trimestre2 = "";
$data_fim_trimestre2 = "";

$data_inicio_trimestre3 = "";
$data_fim_trimestre3 = "";

$res_calendario = listar_data_periodo($conexao, $ano_letivo);
foreach ($res_calendario as $key => $value) {
    if ($value['periodo_id'] == 1) {
        $data_inicio_trimestre1 = $value['inicio'];
        $data_fim_trimestre1 = $value['fim'];
    } elseif ($value['periodo_id'] == 2) {
        $data_inicio_trimestre2 = $value['inicio'];
        $data_fim_trimestre2 = $value['fim'];
    } elseif ($value['periodo_id'] == 3) {
        $data_inicio_trimestre3 = $value['inicio'];
        $data_fim_trimestre3 = $value['fim'];
    }
}
?>

<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:w="urn:schemas-microsoft-com:office:word"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
      xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta name="ProgId" content="Word.Document">
    <meta name="Generator" content="Microsoft Word 15">
    <meta name="Originator" content="Microsoft Word 15">
    <link rel="File-List" href="regitro_conteudo_arquivos/filelist.xml">
    <link rel="Edit-Time-Data" href="regitro_conteudo_arquivos/editdata.mso">
    <link rel="themeData" href="regitro_conteudo_arquivos/themedata.thmx">
    <link rel="colorSchemeMapping" href="regitro_conteudo_arquivos/colorschememapping.xml">

    <style>
        @media print {


            .no-print,
            .no-print * {
                display: none !important;
            }


            body {
                background: none;
                -ms-zoom: 1.665;
                margin: 0;
            }


            .pagebreak {
                page-break-before: always;
            }
/*caso de impressão pre escola */
            body {
                margin: 0; /* Define margem zero para o corpo */
                padding: 0; /* Define preenchimento zero para o corpo */
                font-size: 80%; /* Define a escala em 80% para o texto */
            }

          /*  .conteudo {
                margin: 1rem; /* Define a margem mínima para o conteúdo */
            }*/
            div.page {
                margin: 0;
                padding: 0;
                border: none;
                background: none;
                width: 297mm;
                height: 210mm;
                page-break-before: auto;
            }

            div.landscape {
                transform: rotate(270deg) translate(-297mm, 0);
                transform-origin: 0 0;
            }
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }



        .button {
            width: 100%;
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            background-color: #008CBA;
        }
    </style>




    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body lang="PT-BR" style="">

<p class="no-print">
    <br>
    <br>
    <a href='#' class="btn btn-block btn-primary button" onclick='print();'>IMPRIMIR</a>
</p>

<?php
$idescola = $_GET['idescola'];
$idturma = $_GET['idturma'];
$idserie = $_GET['idserie'];
$res_seg = $conexao->query("SELECT * FROM turma WHERE idturma=$idturma LIMIT 1");
$seguimento = '';

foreach ($res_seg as $key => $value) {
    $seguimento = $value['seguimento'];
}

if (isset($_GET['periodo_id'])) {
    if ($_GET['periodo_id'] > 0 && $_GET['periodo_id'] <= 3) {
        $periodo_id = $_GET['periodo_id'];
    } else {
        $periodo_id = "todos";
    }
} else {
    $periodo_id = "todos";
}
$nome_escola = "";
$res = buscar_escola_por_id($conexao, $idescola);
foreach ($res as $key => $value) {
    $nome_escola = $value['nome_escola'];
}

if ($idserie < 3) {
    $nome_professor = " ";

$res = listar_nome_professor_turma_ministrada($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
$nomes_professores = array();

foreach ($res as $key => $value) {
    $nomes_professores[] = $value['nome_professor'];
}

// Remover nomes duplicados
$nomes_unicos = array_unique($nomes_professores);

// Juntar os nomes únicos com uma vírgula
$nome_professor = implode(", ", $nomes_unicos);


// Exibição do resultado
// echo $nome_professor;
    $nome_professor .= ".";

    $pes = listar_disciplina_da_turma($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    $nome_disciplina = "";
    $nome_turma = "";

    foreach ($pes as $chave => $linha) {
        $nome_disciplina = ($linha['nome_disciplina']);
        $iddisciplina = $linha['iddisciplina'];
        $nome_turma = $linha['nome_turma'];
    }

    if ($periodo_id == 1 || $periodo_id == "todos") {
        diario_conteudo_infantil($conexao, $idescola, $idturma, $idserie, $iddisciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre1, $data_fim_trimestre1, "I TRIMESTRE", $ano_letivo);
        echo "<div class='pagebreak'></div>";
    }

    if ($periodo_id == 2 || $periodo_id == "todos") {
        diario_conteudo_infantil($conexao, $idescola, $idturma, $idserie, $iddisciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre2, $data_fim_trimestre2, "II TRIMESTRE", $ano_letivo);
        echo "<div class='pagebreak'></div>";
    }

    if ($periodo_id == 3 || $periodo_id == "todos") {
        diario_conteudo_infantil($conexao, $idescola, $idturma, $idserie, $iddisciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre3, $data_fim_trimestre3, "III TRIMESTRE", $ano_letivo);
        echo "<div class='pagebreak'></div>";
    }
} elseif (($idserie > 2 && $idserie < 8) || $seguimento == 2) {
    $pes = listar_disciplina_da_turma($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);

    foreach ($pes as $chave => $linha) {
        $nome_disciplina = ($linha['nome_disciplina']);
        $iddisciplina = $linha['iddisciplina'];
        $nome_professor = $linha['nome'];
        $nome_turma = $linha['nome_turma'];

        if ($periodo_id == 1 || $periodo_id == "todos") {
            diario_conteudo_fund1($conexao, $idescola, $idturma, $iddisciplina, $idserie, $nome_disciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre1, $data_fim_trimestre1, "I TRIMESTRE");
            echo "<div class='pagebreak'></div>";
        }

        if ($periodo_id == 2 || $periodo_id == "todos") {
            diario_conteudo_fund1($conexao, $idescola, $idturma, $iddisciplina, $idserie, $nome_disciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre2, $data_fim_trimestre2, "II TRIMESTRE");
            echo "<div class='pagebreak'></div>";
        }

        if ($periodo_id == 3 || $periodo_id == "todos") {
            diario_conteudo_fund1($conexao, $idescola, $idturma, $iddisciplina, $idserie, $nome_disciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre3, $data_fim_trimestre3, "III TRIMESTRE");
            echo "<div class='pagebreak'></div>";
        }
    }
} else {
    $pes = listar_disciplina_da_turma($conexao, $idturma, $idescola, $_SESSION['ano_letivo']);
    foreach ($pes as $chave => $linha) {
        $nome_disciplina = ($linha['nome_disciplina']);
        $iddisciplina = $linha['iddisciplina'];
        $nome_professor = $linha['nome'];
        $nome_turma = $linha['nome_turma'];

        if ($periodo_id == 1 || $periodo_id == "todos") {
            diario_conteudo_fund2($conexao, $idescola, $idturma, $iddisciplina, $idserie, $nome_disciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre1, $data_fim_trimestre1, "I TRIMESTRE");
            echo "<div class='pagebreak'></div>";
        }

        if ($periodo_id == 2 || $periodo_id == "todos") {
            diario_conteudo_fund2($conexao, $idescola, $idturma, $iddisciplina, $idserie, $nome_disciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre2, $data_fim_trimestre2, "II TRIMESTRE");
            echo "<div class='pagebreak'></div>";
        }

        if ($periodo_id == 3 || $periodo_id == "todos") {
            diario_conteudo_fund2($conexao, $idescola, $idturma, $iddisciplina, $idserie, $nome_disciplina, $nome_professor, $nome_turma, $nome_escola, $data_inicio_trimestre3, $data_fim_trimestre3, "III TRIMESTRE");
            echo "<div class='pagebreak'></div>";
        }
    }
}
?>

</body>
</html>