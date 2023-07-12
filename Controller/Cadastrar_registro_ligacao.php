<?php 
    session_start();
    set_time_limit(0);
    include_once '../Model/Conexao.php';
    include_once '../Model/Aluno.php';
    include_once "Conversao.php";

try{
    

    $quemAtendeu = $_POST["quem_atendeu"];
    $descricaoChamada = $_POST["descricao_chamada"];
    $exitosa = $_POST["exitosa"];
    $ficai = $_POST["ficai"];

    $funcionario_id = $_SESSION["idfuncionario"];
    $idaluno = $_POST["idaluno"];
    $data_inicial = $_POST["data_inicial"];
    $data_final = $_POST["data_final"];
    $quantidade_faltas = $_POST["quantidade_faltas"];
 

    // Preparar e executar o INSERT na tabela
    $stmt = $conexao->prepare("INSERT INTO busca_ativa (aluno_id, periodo_inicial, periodo_final, quantidade_faltas, funcionario_id, quem_atendeu, descricao_chamada, exitosa, ficai) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ( $stmt->execute(array( $idaluno, $data_inicial, $data_final, $quantidade_faltas,$funcionario_id, $quemAtendeu, $descricaoChamada, $exitosa, $ficai))) {
        $_SESSION['status']=1;
        header("Location:../View/registro_ligacao.php");
    } else {
        $_SESSION['status']=0;
       header("Location:../View/relatorio_falta.php");

    }



} catch (Exception $e) {
            $_SESSION['status']=0;
       header("Location:../View/relatorio_falta.php");
       //  echo $e;
}


     

    ?>