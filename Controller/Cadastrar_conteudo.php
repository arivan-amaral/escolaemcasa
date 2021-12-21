<?php
	session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    include("Conversao.php");


try {

    $professor_id=$_SESSION['idfuncionario'];

    // $idescola=$_POST['idescola'];
   	// $idturma=$_POST['idturma'];
    // $iddisciplina=$_POST['iddisciplina'];

    $data=$_POST['data_frequencia'];
    $descricao="";
    // if (isset($_POST['descricao'])) {
    //  $descricao=escape_mimic($_POST['descricao']);
    // }

    $aula=$_POST['aula'];
    $url_get=$_POST['url_get'];
    /////////////////////////////////////////////////////////
    
        if (isset($_SESSION['cargo'])) {
            if (isset($_SESSION['idprofessor'])) {
                header("location: ../View/cadastrar_conteudo.php?$url_get");
                $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
                exit;
            }
        }else{
              header("location: ../View/cadastrar_conteudo.php?$url_get");
                $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
                exit;
        }
  
    /////////////////////////////////////////////////////////

    foreach ($_POST['escola_turma_disciplina'] as $key => $value) {

        $array_url=explode('-',$_POST['escola_turma_disciplina'][$key]);
        $idescola=$array_url[0];
        $idturma=$array_url[1];
        $iddisciplina=$array_url[2];
        $idserie=$array_url[3];
        $campo_origem_conteudo=$idescola."".$idturma."".$iddisciplina."".$idserie;

            if (isset($_POST["descricao$campo_origem_conteudo"])) {
             $descricao=escape_mimic($_POST["descricao$campo_origem_conteudo"]);
            }
        //limpar_cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$aula);
       
        // $res_pes_cont_aluno_trasf=pesquisa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula);
        // $idconteudo="";
        // foreach ($res_pes_cont_aluno_trasf as $key => $value) {
        //     $idconteudo=$value['id'];
        // }    

        $res_pes_cont_aluno_trasf=pesquisa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula);
        $idconteudo="";
        $conteudo_aula_id="";

        foreach ($res_pes_cont_aluno_trasf as $key => $value) {
            $idconteudo=$value['id'];


            editar_conteudo_aula($conexao,$descricao, $idconteudo);
            $conteudo_aula_id=$idconteudo;
        }


        if ($idconteudo=="") {
            cadastro_conteudo_aula($conexao,$descricao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula);
            $conteudo_aula_id= $conexao->lastInsertId();
        }

        echo "$iddisciplina <br>";

        // arivan 17/09/2021

        // foreach ($_POST['aluno_id'] as $key => $value) {
        //     $aluno_id=$_POST['aluno_id'][$key];
        //     $presenca=0;

        //     if (isset($_POST["presenca$aluno_id"])) {
        //         $presenca=1;
        //     }
        //     cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$aluno_id,$data,$conteudo_aula_id,$presenca,$aula);
        // }
    }
            $_SESSION['status']=1;
            header("location: ../View/cadastrar_conteudo.php?$url_get");
        } catch (Exception $e) {
            $_SESSION['status']=0;
            $_SESSION['mensagem']='Alguma coisa deu errado!';
            $_SESSION['erro_sql']=$e;
           echo "$e";
          //header("location: ../View/cadastrar_conteudo.php?$url_get");

         }

?>