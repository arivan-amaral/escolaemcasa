<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['idfuncionario'])) {
    //header("location:index.php?status=0");
  } else {
    $idcoordenador = $_SESSION['idfuncionario'];
  }
  
  print_r($_SESSION);

  include_once '../Controller/Conversao.php';
  
  if (!isset($_SESSION['usuariobd'])) {
    $_SESSION['usuariobd'] = 'educ_lem';
  }
  $usuariobd = $_SESSION['usuariobd'];
  include_once "../Model/Conexao_" . $usuariobd . ".php";
  include_once '../Model/Coordenador.php';
  include_once '../Model/Setor.php';
  include_once '../Model/Chamada.php';
  include_once '../Model/Escola.php';

$escola_id = $_POST['escola_id'];
$situacao_resolvida = $_POST['situacao_resolvida'];
$funcionario_id = $_POST['funcionario_id'];
$objetivo_visita = $_POST['objetivo_visita'];
$data_hora_visita = $_POST['data_hora_visita'];
$relatorio_visita = $_POST['relatorio_visita'];

if (empty($escola_id) || empty($situacao_resolvida) || empty($funcionario_id) || empty($objetivo_visita) || empty($data_hora_visita) || empty($relatorio_visita)) {
    $_SESSION['mensagem'] = 'Todos os campos com * são obrigatórios!';
    header("Location: ../View/relatorio_visita.php");
    exit();
}

cadastrar_visita_escola($conexao, $escola_id, $situacao_resolvida, $funcionario_id, $objetivo_visita, $data_hora_visita, $relatorio_visita);
$_SESSION['mensagem'] = 'Relatório de visita cadastrado com sucesso!';


header("Location: ../View/relatorio_visita.php");
exit();
