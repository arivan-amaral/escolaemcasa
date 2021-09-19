<?php
	session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    include("Conversao.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_POST['idescola'];
   	$idturma=$_POST['idturma'];

    $data=$_POST['data_frequencia'];
    $descricao="";
    if (isset($_POST['descricao'])) {
     $descricao=escape_mimic($_POST['descricao']);
    }

    $aula=$_POST['aula'];
    $url_get=$_POST['url_get'];
   	
    //$iddisciplina=$_POST['iddisciplina'];
    foreach ($_POST['iddisciplina'] as $key => $value) {
        $iddisciplina=$_POST['iddisciplina'][$key];
    

        limpar_cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$data,$aula);
        
        $res_pes_cont_aluno_trasf=pesquisa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula);
        $idconteudo="";
        foreach ($res_pes_cont_aluno_trasf as $key => $value) {
            $idconteudo=$value['id'];
        }    
        // arivan 17/09/2021

        // $res_pes_cont_aluno_trasf=pesquisa_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $data,$aula);
        // $idconteudo="";
        // $conteudo_aula_id="";

        // foreach ($res_pes_cont_aluno_trasf as $key => $value) {
        //     $idconteudo=$value['id'];
        //     editar_conteudo_aula($conexao,$descricao, $idconteudo);
        //     $conteudo_aula_id=$idconteudo;
        // }


            // if ($idconteudo=="") {
            //      cadastro_conteudo_aula($conexao,$descricao, $iddisciplina, $idturma, $idescola, $professor_id, $data,$aula);
            //     $conteudo_aula_id= $conexao->lastInsertId();
            // }



        foreach ($_POST['aluno_id'] as $key => $value) {
            $aluno_id=$_POST['aluno_id'][$key];
            $presenca=0;

            if (isset($_POST["presenca$aluno_id"])) {
                $presenca=1;
            }
            cadastro_frequencia($conexao,$idescola,$idturma,$iddisciplina,$professor_id,$aluno_id,$data,$idconteudo,$presenca,$aula);
        }
    }
            $_SESSION['status']=1;
            header("location: ../View/diario_frequencia.php?$url_get");
        } catch (Exception $e) {
            $_SESSION['status']=0;
            $_SESSION['mensagem']='Alguma coisa deu errado!';
            $_SESSION['erro_sql']=$e;
          //   echo "$e";
          header("location: ../View/diario_frequencia.php?$url_get");

         }

?>