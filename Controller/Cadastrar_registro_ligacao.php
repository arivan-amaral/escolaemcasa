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
 

    // Preparar e executar o INSERT na tabela
    $stmt = $conexao->prepare("INSERT INTO sua_tabela (quem_atendeu, descricao_chamada, exitosa, ficai) VALUES (?, ?, ?, ?)");

    if ( $stmt->execute(array( $quemAtendeu, $descricaoChamada, $exitosa, $ficai))) {
        $_SESSION['status']=1;
        header("Location:../View/registro_ligacao.php");
    } else {
        $_SESSION['status']=0;
        header("Location:../View/relatorio_falta.php");

    }



} catch (Exception $e) {
            $_SESSION['status']=0;
        header("Location:../View/relatorio_falta.php");
        // echo $e;
}


     

    ?>