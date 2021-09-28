<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    
    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_POST['idescola'];
    $idturma=$_POST['idturma'];
    $iddisciplina=$_POST['iddisciplina'];

    $periodo=$_POST['periodo'];
   $data=date("Y-m-d");
   // $data=$_POST['data_avaliacao'];
    // $avaliacao=$_POST['avaliacao'];
   if ($periodo=="6") {
         $array_avaliacao= array('1'=>'DIAGNÓSTICO INICIAL');
   }else{
      $array_avaliacao= array('0'=>'av1','1'=>'av2','2'=>'av3','3'=>'DIAGNÓSTICO INICIAL','4'=>'RP');
   }

try {


    $sigla=null;
    $parecer_disciplina_id=0;
    $nota=0;
    $url_get=$_POST['url_get'];


foreach ($_POST['aluno_id'] as $key => $value) {
      $aluno_id=$_POST['aluno_id'][$key];

      // limpa_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$data,$avaliacao);
      $parecer_descritivo='';
      if (isset($_POST["parecer_descritivo$aluno_id"])) {
        $parecer_descritivo=$_POST["parecer_descritivo$aluno_id"];
      }
      
 

      foreach ($array_avaliacao as $key_av => $value_av) {//arivan
        $nota=0;
        $avaliacao=$value_av;

          if (isset($_POST["nota_$value_av$aluno_id"])) {
            if ($_POST["nota_$value_av$aluno_id"] !="") {
                $nota=trim($_POST["nota_$value_av$aluno_id"]);
                $nota=str_replace(',','.',$nota);
            }
          }

          if (isset($_POST["parecer_sigla$aluno_id"]) && $avaliacao=='av3') {
             
              foreach ($_POST["parecer_sigla$aluno_id"] as $key => $value) {
                  $sigla=null;
                  if (isset($_POST["parecer_sigla$aluno_id"][$key])) {
                    $sigla=$_POST["parecer_sigla$aluno_id"][$key];
                  }      

                  $parecer_disciplina_id=0;
                  if (isset($_POST["descricao_parecer$aluno_id"][$key])) {
                    $parecer_disciplina_id=$_POST["descricao_parecer$aluno_id"][$key];
                  }

                 // limpa_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$data,$parecer_disciplina_id,$avaliacao);


                  cadastro_nota($conexao,$nota, 
                    $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao);
              }

          }else{
              // $conexao->query("SELECT * FROM nota where aluno_id=$aluno_id and escola_id =$idescola and disciplina_id=$iddisciplina and a  ");

            $verifica_duplicidade=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$avaliacao);
             $conta_total_nota=0;
             foreach ($verifica_duplicidade as $key => $value) {
                $conta_total_nota++;
             }

             if ($conta_total_nota ==0) {
              cadastro_nota($conexao,$nota, 
                      $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao);
             }else if ($conta_total_nota>1) {

              $_SESSION['status']=0;
              $_SESSION['mensagem']='ALGUM ALUNO TEM NOTA DUPLICADA, VERIFIQUE QUAL A NOTA QUE DEVE PERSISTIR E EXCLUA A NOTA DUPLICADA';
              header("location: ../View/diario_avaliacao.php?$url_get");
              exit();
             }


          }

      }//arivan

    
}

  $_SESSION['status']=1;
  header("location: ../View/diario_avaliacao.php?$url_get");
} catch (Exception $e) {
   $_SESSION['status']=0;
   echo "$e";
   //header("location: ../View/diario_avaliacao.php?$url_get");;

}
?>