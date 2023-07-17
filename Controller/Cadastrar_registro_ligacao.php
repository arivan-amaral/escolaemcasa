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
    $escola_id = $_POST["escola_id"];
    $turma_id = $_POST["turma_id"];
 

    // Preparar e executar o INSERT na tabela
    $stmt = $conexao->prepare("INSERT INTO busca_ativa (aluno_id,escola_id,turma_id, periodo_inicial, periodo_final, quantidade_faltas, exitosa, ficai) VALUES (  ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array( $idaluno,$escola_id,$turma_id, $data_inicial, $data_final, $quantidade_faltas, $exitosa, $ficai));
    $busca_ativa_id= $conexao->lastInsertId();





      $sql = $conexao->prepare("INSERT INTO registro_ligacao_busca_ativa(funcionario_id, busca_ativa_id, quem_atendeu, descricao_chamada) VALUES (?,?,?,?)");

      $sql->execute(array($funcionario_id,$busca_ativa_id,$quemAtendeu, $descricaoChamada));
    

    $_SESSION['status']=1;
     header("Location:../View/registro_ligacao_ficai.php");
 



} catch (Exception $e) {
            $_SESSION['status']=0;
        header("Location:../View/registro_ligacao_ficai.php");
         echo $e;
}


     

    ?>