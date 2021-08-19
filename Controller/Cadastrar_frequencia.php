<?php
	session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_POST['idescola'];
   	$idturma=$_POST['idturma'];

    $data=$_POST['data_frequencia'];
    $descricao=$_POST['descricao'];
    $aula=$_POST['aula'];
    $url_get=$_POST['url_get'];
   	
    //$iddisciplina=$_POST['iddisciplina'];
    foreach ($_POST['iddisciplina'] as $key => $value) {
        $iddisciplina=$_POST['iddisciplina'][$key];
    

        limpar_cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$aula);

        limpa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula);

        cadastro_conteudo_aula($conexao,$descricao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula);
        $conteudo_aula_id= $conexao->lastInsertId();


        foreach ($_POST['aluno_id'] as $key => $value) {
            $aluno_id=$_POST['aluno_id'][$key];
            $presenca=0;

            if (isset($_POST["presenca$aluno_id"])) {
                $presenca=1;
            }
            cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$aluno_id,$data,$conteudo_aula_id,$presenca,$aula);
        }
    }
            $_SESSION['status']=1;
            header("location: ../View/diario_frequencia.php?$url_get");
        } catch (Exception $e) {
            $_SESSION['status']=0;
            $_SESSION['mensagem']='Alguma coisa deu errado!';
            $_SESSION['erro_sql']=$e;
            echo "$e";
            //header("location: ../View/diario_frequencia.php?$url_get");

         }

?>