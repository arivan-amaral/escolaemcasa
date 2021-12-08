<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");


try{
    if (!isset($_SESSION['idfuncionario'])) {
        $funcionario_id=175;
    }else{
        $funcionario_id=$_SESSION['idfuncionario'];
    }

    

    //generico
    $aluno_finalizou=$_REQUEST['aluno_finalizou'];
    
    
    if ($aluno_finalizou=="Sim") {
        $idperiodo=7;
        $idturma=1000;

    }else{
        $idturma=$_REQUEST['idturma'];
        $idperiodo=$_REQUEST['idperiodo'];

    }

    //generico
    $escola_origem=$_REQUEST['escola_origem']; //de onde o aluno veio 

    $idescola=$_REQUEST['idescola']; // escola da rede a qual a nota está sendo inserida
    $iddisciplina=$_REQUEST['iddisciplina'];
    $idaluno=$_REQUEST['idaluno'];
    $avaliacao=$_REQUEST['tipo_registro'];
    $nota=$_REQUEST['media_ou_nf'];

    $ano_referencia=$_REQUEST['ano_referencia'];
    $idserie=$_REQUEST['idserie'];
    $carga_horaria=$_REQUEST['carga_horaria'];
    $total_falta=$_REQUEST['total_falta'];


    // aluno não finalizou o ano


   $data=date("Y-m-d");

   cadastro_nota_aluno_fora($conexao,$nota, $idescola, $idturma, $iddisciplina, $idaluno, $idperiodo, $avaliacao,$funcionario_id,$escola_origem,$ano_referencia, $idserie, $carga_horaria, $total_falta,$aluno_finalizou );

       


   // $_SESSION['status']=1;
   // $_SESSION['mensagem']='Dados inseridos';
$url_get="escola_id=$idescola"."&turma_id=$idturma"."&serie_id=$idserie"."&aluno_id=$idaluno";

echo"certo";
 // header("location: ../View/registra_nota_fora_rede.php?$url_get");
} catch (Exception $e) {
   // $_SESSION['status']=0;
   echo "$e";
//   header("location: ../View/registra_nota_fora_rede.php?$url_get");


}
?>