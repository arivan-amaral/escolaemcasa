<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    
    if (!isset($_SESSION['idfuncionario'])) {
        $funcionario_id=175;
    }else{
        $funcionario_id=$_SESSION['idfuncionario'];
    }

    $idescola=$_POST['idescola'];
    $idturma=$_POST['idturma'];
    $iddisciplina=$_POST['iddisciplina'];
    $idserie=$_POST['idserie'];

    $periodo=$_POST['periodo'];

   $data=date("Y-m-d");
   // $data=$_POST['data_avaliacao'];
    // $avaliacao=$_POST['avaliacao'];
   if ($periodo=="6") {
      $array_avaliacao= array('1'=>'DIAGNÓSTICO INICIAL');
   }else if ($idserie<3) {
      $array_avaliacao= array('0'=>'av1','1'=>'av2','2'=>'av3','3'=>'DIAGNÓSTICO INICIAL','4'=>'RP');
   }else{
      $array_avaliacao= array('0'=>'av1','1'=>'av2','2'=>'av3','3'=>'RP');
   }
try {

    $sigla=null;
    $parecer_disciplina_id=0;
    $nota=0;
    $url_get=$_POST['url_get'];

    /////////////////////////////////////////////////////////
      
        if(
         
         $_SESSION['idprofessor']==645 ||
         $_SESSION['idprofessor']==281 ||
         $_SESSION['idprofessor']==325 ||

         $_SESSION['idprofessor']==514 ||
         $_SESSION['idprofessor']==485 || 
         $_SESSION['idprofessor']==467 || 
         $_SESSION['idprofessor']==718 || 
         $_SESSION['idprofessor']==1416 || 
         $_SESSION['idprofessor']==895 ||
         $_SESSION['idprofessor']==972 ||
         $_SESSION['idprofessor']==679 ||
         $_SESSION['idprofessor']==686 || 
         $_SESSION['idprofessor']==305 ||
         $_SESSION['idprofessor']==722 ||
         $_SESSION['idprofessor']==907 ||
         $_SESSION['idprofessor']==867 ||
         $_SESSION['idprofessor']==501
     ) {
///
        }elseif (isset($_SESSION['cargo'])) {
        
        if (isset($_SESSION['idprofessor'])) {
                $_SESSION['status']=0;
            $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
            header("location: ../View/diario_avaliacao.php?$url_get");
            exit;
        }
    }else{
                $_SESSION['status']=0;
        
            $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
          header("location: ../View/diario_avaliacao.php?$url_get");
            exit;
    }
    /////////////////////////////////////////////////////////

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
          // if ($avaliacao!='av3' && $avaliacao!="DIAGNÓSTICO INICIAL") {
          //    $parecer_descritivo='ttt';
          // }
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

                  $verifica_duplicidade=verifica_sigla_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,'av3',$parecer_disciplina_id);
                  $conta_qnt_siglas=0;
                  foreach ($verifica_duplicidade as $key => $value) {
                        $idnota_bd=$value['idnota'];
                        $nota_bd=$value['nota'];
                        $avaliacao_bd=$value['avaliacao'];
                        $parecer_disciplina_id_bd=$value['parecer_disciplina_id'];
                        $parecer_descritivo_bd=$value['parecer_descritivo'];
                        $sigla_bd=$value['sigla'];
                        $escola_id_bd=$value['escola_id'];
                        $turma_id_bd=$value['turma_id'];
                        $disciplina_id_bd=$value['disciplina_id'];
                        $aluno_id_bd=$value['aluno_id'];
                        $periodo_id_bd=$value['periodo_id'];
                        $data_nota_bd=$value['data_nota'];
                        $funcionario_id_bd=$value['funcionario_id'];
                        
                        if ( ($nota != $nota_bd) || ($sigla != $sigla_bd) ||($funcionario_id_bd=='') || ($parecer_descritivo_bd !=$parecer_descritivo) ) {
                           
                            $conexao->exec("
                             UPDATE nota SET
                             nota=$nota,
                             sigla='$sigla',
                             funcionario_id=$funcionario_id,
                             parecer_descritivo='$parecer_descritivo'
                             WHERE 
                             idnota =$idnota_bd
                             ");
                            
                            // echo "string1:          UPDATE nota SET
                            //  nota=$nota,
                            //  sigla='$sigla',
                            //  funcionario_id=$nota,
                            //  parecer_descritivo='$parecer_descritivo'
                            //  WHERE 
                            //  idnota =$idnota_bd";
                        }else{
                             $conexao->exec("
                             UPDATE nota SET
                             nota=$nota,
                             sigla='$sigla',
                       
                             parecer_descritivo='$parecer_descritivo'
                             WHERE 
                             idnota =$idnota_bd
                             ");

                             // echo "string2:  UPDATE nota SET
                             // nota=$nota,
                             // sigla='$sigla',
                       
                             // parecer_descritivo='$parecer_descritivo'
                             // WHERE 
                             // idnota =$idnota_bd";
                        }

                       // echo "$idnota_bd - $avaliacao - $nota <br>";
                        $conta_qnt_siglas++;

                  }
                


                  // if ($conta_qnt_siglas>=0) {
                  if ($conta_qnt_siglas==0) {
                      $parecer_disciplina_id=0;
                      if (isset($_POST["descricao_parecer$aluno_id"][$key])) {
                        $parecer_disciplina_id=$_POST["descricao_parecer$aluno_id"][$key];
                      }

                      cadastro_nota($conexao,$nota, 
                      $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao,$funcionario_id);
                  }
              }



          }else{
              // $conexao->query("SELECT * FROM nota where aluno_id=$aluno_id and escola_id =$idescola and disciplina_id=$iddisciplina and a  ");

            $verifica_duplicidade=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$avaliacao);
             $conta_total_nota=0;
             $nome_aluno_nota_duplicada="";
             foreach ($verifica_duplicidade as $key => $value) {
                $nome_aluno_nota_duplicada.=", ".$value['aluno_id'];
                $conta_total_nota++;
             }

             if ($conta_total_nota ==0) {
                cadastro_nota($conexao,$nota, 
                      $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao,$funcionario_id);
             }else if ($conta_total_nota==1) {

                $verifica_duplicidade=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$avaliacao);
                 foreach ($verifica_duplicidade as $key => $value) {
                      $idnota_bd=$value['idnota'];
                      $nota_bd=$value['nota'];
                      $avaliacao_bd=$value['avaliacao'];
                      $parecer_disciplina_id_bd=$value['parecer_disciplina_id'];
                      $parecer_descritivo_bd=$value['parecer_descritivo'];
                      $sigla_bd=$value['sigla'];
                      $escola_id_bd=$value['escola_id'];
                      $turma_id_bd=$value['turma_id'];
                      $disciplina_id_bd=$value['disciplina_id'];
                      $aluno_id_bd=$value['aluno_id'];
                      $periodo_id_bd=$value['periodo_id'];
                      $data_nota_bd=$value['data_nota'];
                      $funcionario_id_bd=$value['funcionario_id'];
                        
                        if ( ($nota != $nota_bd) || ($funcionario_id_bd=='') || ($parecer_descritivo_bd !=$parecer_descritivo) ) {
                           // $funcionario_id=0;
                            $conexao->exec("
                             UPDATE nota SET
                             nota=$nota,
                             funcionario_id=$funcionario_id,
                             parecer_descritivo='$parecer_descritivo'
                             WHERE 
                             idnota =$idnota_bd
                             ");

                            // echo "string4:$nota != $nota_bd  UPDATE nota SET
                            //  nota=$nota,
                            //  funcionario_id=$funcionario_id,
                            //  parecer_descritivo='$parecer_descritivo'
                            //  WHERE 
                            //  idnota =$idnota_bd <br>
                            //  ";

                        }else{

                             $conexao->exec("
                             UPDATE nota SET
                             nota=$nota,
                             parecer_descritivo='$parecer_descritivo'
                             WHERE 
                             idnota =$idnota_bd
                             ");

                             // echo " string5: $nota != $nota_bd
                             // UPDATE nota SET
                             // nota=$nota,
                             // parecer_descritivo='$parecer_descritivo'
                             // WHERE 
                             // idnota =$idnota_bd <br>";
                        }

                        // echo " UPDATE nota SET
                        //      nota=$nota,
                        //      parecer_descritivo='$parecer_descritivo'
                        //      WHERE 
                        //      idnota =$idnota_bd an avaliacao=$avaliacao<br>";
                  }

                 $_SESSION['status']=1;
                 $_SESSION['mensagem']='Dados atualizados';
                 //header("location: ../View/diario_avaliacao.php?$url_get");
                 //exit();


             }else if ($conta_total_nota>1) {

              $_SESSION['status']=0;
              $_SESSION['mensagem']="ALGUM ALUNO TEM NOTA DUPLICADA, VERIFIQUE QUAL A NOTA QUE DEVE PERSISTIR E EXCLUA A NOTA DUPLICADA id: ".$nome_aluno_nota_duplicada;
              header("location: ../View/diario_avaliacao.php?$url_get");
              exit();
             }


          }

      }//arivan

    
}


   $_SESSION['status']=1;
   $_SESSION['mensagem']='Dados inseridos';

  header("location: ../View/diario_avaliacao.php?$url_get");
} catch (Exception $e) {
   $_SESSION['status']=0;
   echo "$e";
   //header("location: ../View/diario_avaliacao.php?$url_get");;

}
?>