<?php
  session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Escola.php");
    
    include("../Model/Aluno.php");
    
    if (!isset($_SESSION['idfuncionario'])) {
        $funcionario_id=175;
        $professor_id=175;

    }else{
        $funcionario_id=$_SESSION['idfuncionario'];
        $professor_id=$_SESSION['idfuncionario'];
    }

    $idescola=$_POST['idescola'];
    $idturma=$_POST['idturma'];
    $iddisciplina=$_POST['iddisciplina'];
    $idserie=$_POST['idserie'];

    $ano_nota=$_SESSION['ano_letivo'];
    $ano_letivo=$_SESSION['ano_letivo'];

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

##################### FUNÇÃO VERIFICA BLOQUEIO DE PROFESSOR ##################
    $res_bloqueio=listar_calendario_por_data($conexao,$data);
   
    $idcalendario=0;
    foreach ($res_bloqueio as $key => $value) {
        $idcalendario=$value['idcalendario'];
        break;
    }
    $verificar_bloqueio=$conexao->query("SELECT * from bloquear_acesso  where funcionario_id = $professor_id and calendario_letivo_id=$idcalendario and status=1
      ");
    $conta_bloqueio=0;

    foreach ($verificar_bloqueio as $key => $value) {
       $conta_bloqueio=1;
       break;
    }
    // echo "$idcalendario = $conta_bloqueio | SELECT * from bloquear_acesso  where funcionario_id = $professor_id and calendario_letivo_id=$idcalendario and status=1";
    
    // die();

    if ($conta_bloqueio>0) {
 
        $_SESSION['status']=2;
        $_SESSION['mensagem']='BLOQUEADO PARA PROFESSOR!';
        $fallback = '../View/index.php';
        $anterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $fallback;
         header("location: {$anterior}");
        exit();
    }
      

    ##################### FIM FUNÇÃO VERIFICA BLOQUEIO DE PROFESSOR ##################
    
    


foreach ($_POST['aluno_id'] as $key => $value) {
      $aluno_id=$_POST['aluno_id'][$key];

      // limpa_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$data,$avaliacao);
      $parecer_descritivo='';
      if (isset($_POST["parecer_descritivo$aluno_id"])) {
        $parecer_descritivo=  escape_mimic($_POST["parecer_descritivo$aluno_id"]);
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

                  $verifica_duplicidade=verifica_sigla_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,'av3',$parecer_disciplina_id, $ano_letivo);
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
                             UPDATE nota_parecer SET
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
                             UPDATE nota_parecer SET
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
                      $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao,$funcionario_id,$ano_nota);
                  }
              }



          }else{
              // $conexao->query("SELECT * FROM nota_parecer where aluno_id=$aluno_id and escola_id =$idescola and disciplina_id=$iddisciplina and a  ");

            $verifica_duplicidade=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$avaliacao,$ano_nota);
             $conta_total_nota=0;
             $nome_aluno_nota_duplicada="";
             foreach ($verifica_duplicidade as $key => $value) {
                $nome_aluno_nota_duplicada.=", ".$value['aluno_id'];
                $conta_total_nota++;
             }

             if ($conta_total_nota ==0) {
                cadastro_nota($conexao,$nota, 
                      $parecer_disciplina_id, $parecer_descritivo, $sigla,$idescola, $idturma, $iddisciplina, $aluno_id, $periodo, $data,$avaliacao,$funcionario_id,$ano_nota);
             }else if ($conta_total_nota==1) {

                $verifica_duplicidade=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$aluno_id,$periodo,$avaliacao,$ano_nota);
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
                             UPDATE nota_parecer SET
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
                             UPDATE nota_parecer SET
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