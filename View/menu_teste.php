<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Centralizado</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
    <style>
        .card i {
            font-size: 1.5rem; /* Reduced icon size */
        }
        .card-body {
            padding: 0.5rem; /* Reduced padding */
        }
        .row-cols-1 .col {
            flex: 0 0 calc(50% - 1rem); /* Ensure two cards fit side-by-side */
            max-width: calc(50% - 1rem);
            margin: 0.5rem;
        }
    </style>
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3>Menu</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cols-1 row-cols-md-2 g-2">
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-video mb-2"></i>
                                                    <p>ATUALIZAR ETAPAS</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-chart-line mb-2"></i>
                                                    <p>Ficha de Rendimento Tri I</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-chart-line mb-2"></i>
                                                    <p>Ficha de Rendimento Tri II</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-chart-line mb-2"></i>
                                                    <p>Ficha de Rendimento Tri III</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-file-alt mb-2"></i>
                                                    <p>Relatório Trimestral</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-user-check mb-2"></i>
                                                    <p>Relatório de Frequência</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-users mb-2"></i>
                                                    <p>Listar Alunos da Turma</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-book mb-2"></i>
                                                    <p>Conteúdos de Aulas Trimestre I</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-book mb-2"></i>
                                                    <p>Conteúdos de Aulas Trimestre II</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-book mb-2"></i>
                                                    <p>Conteúdos de Aulas Trimestre III</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-comment-dots mb-2"></i>
                                                    <p>Parecer Descritivo</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-clipboard mb-2"></i>
                                                    <p>Boletim</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-exclamation-circle mb-2"></i>
                                                    <p>Ocorrência</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-print mb-2"></i>
                                                    <p>Impressão Ocorrências</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-file-signature mb-2"></i>
                                                    <p>Ata de Resultados Finais</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <i class="fas fa-folder mb-2"></i>
                                                    <p>Capa da Turma</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- AdminLTE JS -->
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
</body>
</html>
