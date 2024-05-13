<?php
set_time_limit(500);
  session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Aluno.php");
    include("../Model/Escola.php");
    include("Nota_final_funcao.php");
    include("Conversao.php");
    
 
try {

    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_GET['idescola'];
    $idturma=$_GET['idturma'];
    $idaluno=$_GET['idaluno'];
    //$data=$_GET['data_avaliacao'];
    $idperiodo=$_GET['idperiodo'];
    //$avaliacao=$_GET['avaliacao'];
    $idserie=$_GET['idserie'];
    $tamanho=4;
    $ano_letivo=$_SESSION['ano_letivo'];
    $idfuncionario=$_SESSION['idfuncionario'];

    $res_seg=$conexao->query("SELECT * FROM turma WHERE idturma=$idturma LIMIT 1");
    $seguimento='';
    foreach ($res_seg as $key => $value) {
      $seguimento=$value['seguimento'];
      // code...
    }
    
    $res_periodo=listar_data_por_periodo($conexao,$_SESSION['ano_letivo'], $idperiodo);
    $data_inicio_periodo='';
    $data_fim_periodo='';
 
    foreach ($res_periodo as $key => $value) {
       $data_inicio_periodo=$value['inicio'];
        $data_fim_periodo=$value['fim'];
    }


      $result="

       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>#</th>
              <th>Aluno</th>
        
            </tr>
          </thead>
          <tbody>";
$res_disciplina= listar_disciplina_para_nota_geral($conexao,$idturma,$idescola,$ano_letivo,$idfuncionario);

foreach ($res_disciplina as $key_disc => $value_disc) {

    $iddisciplina=$value_disc['iddisciplina'];
    $nome_disciplina=$value_disc['nome_disciplina'];

    if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
      $res_alunos=listar_aluno_da_turma_ata_resultado_final_geral($conexao,$idturma,$idescola,$_SESSION['ano_letivo'], $idaluno);
    }else{
      $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida_geral($conexao,$idturma,$idescola,$_SESSION['ano_letivo'], $idaluno);
     }
               $cont=1;
               $cor_tabela='table-primary';
               foreach ($res_alunos as $key => $value) {

                    $nome_aluno=strtoupper(($value['nome_aluno']));
                    $nome_turma=($value['nome_turma']);
                    $id=$value['idaluno'];
                    $idaluno=$value['idaluno'];
                    $status_aluno=$value['status_aluno'];
                    $email=$value['email'];
                    $senha=$value['senha'];
                    $data_matricula=$value['data_matricula'];
                      $matricula_aluno=$value['matricula'];

                $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

                $procedimento="";
                 $datasaida="";
                foreach ($res_movimentacao as $key => $value) {
                    $datasaida=($value['datasaida']);
                    $procedimento=$value['procedimento'];
                    if ($datasaida!="") {
                      $datasaida=converte_data($datasaida);
                    }
                }

                    if ($cont%2==0) {
                      $cor_tabela='table-primary';
                    }else {
                      $cor_tabela='table-secondary';
                    }
                     


                      $result.="
                         <tr  class='$cor_tabela'>
                          <td  colspan='2'>
                  
                          <div class='col-sm-6'>
                            <b class='text-success'> $nome_aluno </b>
                            <br>";

                            $disabled="";
                            if($procedimento!=""){
                                $result.="<b class='text-success'>
                                    <b class='text-danger'> $procedimento | $datasaida </b>
                                 </b>";
                            $disabled=" disabled ";
                             
                                
                            }else if(  (strtotime($data_matricula) <= strtotime($data_fim_periodo)) ){
                            //06/04/2022
                                 $result.=" <input type='hidden' name='aluno_id[]' value='$id'>
                                 <br>
                                 
                                 ";
                             
                            }else{
                             $result.="<b class='text-success'>
                                    <b class='text-danger'>Nessa data o aluno não estava na turma. Data matrícula: ".converte_data($data_matricula)."</b>
                                 </b>";
                            }

                          $result.="</div>                      
                        <tr class='$cor_tabela'>";

                      //se for diferente de diagnostico inicial
                      if ($idperiodo !=6 ) {
              
                             $result.="<td>
                             <!-- <label for='exampleInputEmail1'>Relatório descritivo</label>
                              <textarea class='form-control-sm' name='parecer_descritivo$id'>descricao_parecer</textarea><br>
                                <B></b> -->
                              </td>
                            
                              <td>";
                                if ($idserie >=3){
                                // arivan 
                                // if ($idserie >=3){
                                  // code...
                                   $nota1='0';
                                   $nota2='0';
                                   $nota3='0';
                                   $notarp='0'; 

                                   $array_nota1=array();
                                   $array_nota2=array();
                                    $array_notas3=array();
                                   $array_notarp=array();


                                  $result_n1=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av1',$ano_letivo);

                                   $conta_total_nota=0;
                                   foreach ($result_n1 as $key => $value) {
                                      $idnota=$value['idnota'];

                                      $nota1=$value['nota'];
                                      $array_nota1[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota++;
                                   }

                                  $result_n2=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av2',$ano_letivo);
                                   $conta_total_nota=0;

                                   foreach ($result_n2 as $key => $value) {
                                      $idnota=$value['idnota'];

                                      $nota2=$value['nota'];
                                      $array_nota2[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota++;
                                   }

                                  $result_nota3=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av3',$ano_letivo);
                                   $conta_total_nota=0;

                                   foreach ($result_nota3 as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $nota3=$value['nota'];
                                     $array_notas3[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota++;
                                   }

                                   ###################### ARIVAN 03-11-2021

                                  $result_nota_fund1_3=verifica_nota_diario_av3_fund1($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av3',$ano_letivo);

                                   $conta_total_nota_fund1=0;
                                   $nota_fund1_3=0;
                                   $array_notas_fund1_3=array();
                                   foreach ($result_nota_fund1_3 as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $nota_fund1_3=$value['nota'];
                                     $array_notas_fund1_3[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota_fund1++;
                                   }

                                   ######################ARIVAN 03-11-2021
                  


                                  $result_rp=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'RP',$ano_letivo);

                                   $conta_total_nota=0;
                                   foreach ($result_rp as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $notarp=$value['nota'];
                                      $array_notarp[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota++;
                                   }




                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota AV1:</label>
                                  <input type='text' id='nota_av1$id'  name='nota_av1$id' value='$nota1' style='width:50px;' onkeyup='somenteNumeros(this,3);total_notas($id);' $disabled>";


                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota AV2:</label>
                                  <input type='text' id='nota_av2$id' name='nota_av2$id' value='$nota2' style='width:50px;' onkeyup='somenteNumeros(this,3);total_notas($id);' $disabled>";

                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota AV3:</label>
                                  <input type='text' id='nota_av3$id' name='nota_av3$id' value='$nota3' style='width:50px;' onkeyup='somenteNumeros(this,4);total_notas($id);' $disabled>";

                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota RP:</label>
                                  <input type='text' id='nota_rp$id'  name='nota_RP$id' value='$notarp' style='width:50px;' onkeyup='somenteNumeros(this,4);total_notas($id);' $disabled>
                                  
                                  ";                     


                                  $media= ($nota1+$nota2+$nota3 );
                                  if ($media<5 && $notarp !='' && $notarp>$nota3) {
                                    $media=($media-$nota3)+$notarp;
                                  }

                                
                                    $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Total:</label>
                                    <input type='text' id='total$id' value='$media' style='width:50px; background-color: #FFDAB9;'>"; 
                                  
                                  $conta_aprovado=0;
                                      
                
                                    $res_conselho=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno, $ano_letivo);
                                    $conta_aprovado=count($res_conselho);
                                   
                                       if ($idserie >3 && $idperiodo==3) {  
                                         $result.="

                                         <input type='hidden' value='$idescola' id='escola_apc$idaluno'>

                                         <input type='hidden' value='$idturma' id='turma_apc$idaluno'>

                                         <input type='hidden' value='$iddisciplina' id='disciplina_apc$idaluno'>
                                          <span id='btn_apc$idaluno'>
                                          ";

                                       
                                         
                                         if ($conta_aprovado>0) {
                                            //aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
                                            $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>NF:</label>
                                            <input type='text'  value='5.0' style='width:50px; background-color: #FFDAB9;'>"; 
                                            
                                            $result.="
                                            <a class='btn btn-success'> APC </A>
                                            <a class='btn btn-danger' onclick='cancelar_aprovacao_concelho($idaluno);'> Cancelar aprovação</a>";

                                         }else{
                                          $result.="<a class='btn btn-primary' onclick='aprovar_concelho($idaluno);'> Aprovar pelo conselho</a>";

                                          
                                         }

                                           
                                         $result.=" </span>";
                                       }

                                  $result.="
                                        <br>
                                    ";

                                  


                            }


        

                                $result.="
                              </td>";

                                $result.="
                                <tr>
                                <td>
                                </td>
                                <td>";



                              $result_verifica_av3=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av3',$ano_letivo);
                              $descricao_parecer_av3='';
                              foreach ($result_verifica_av3 as $key22 => $value22) {
                                 $descricao_parecer_av3=$value22['parecer_descritivo'];
                              }

//teste 2 ano b educacao fisica ok
                                $result.="
                             <label for='exampleInputEmail1'>Relatório descritivo</label>
                                <textarea  class='form-control' rows='5' name='parecer_descritivo$id'>$descricao_parecer_av3 </textarea>

                              </td>
                              </tr>
                              ";



                      }else{// se for diagnostico inicial

                              $result_verifica=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'DIAGNÓSTICO INICIAL',$ano_letivo);
                              $descricao_parecer='';
                              foreach ($result_verifica as $key => $value) {
                                 $descricao_parecer=$value['parecer_descritivo'];
                              }

                             $result.="<td>
                              </td>

                              <td>
                                <div class='card card-outline card-info'>
                                         <div class='card-header'>
                                           <h6>
                                              Diagnóstico inicial - $nome_aluno 
                                           </h6>
                                         </div>
                                         <div class='card-body'>
                                           <textarea  class='form-control' rows='5' name='parecer_descritivo$id'>$descricao_parecer</textarea>
                                         </div>
                                         <div class='card-footer'>
                                         </div>

                                       </div>
                                       <BR>";


                                  $result.="    

                                <label for='exampleInputEmail1' style='display: none;'>Nota</label><br>
                                <input type='hidden'  name='nota$id' value='' style='display: none;' onkeyup='somenteNumeros(this,$tamanho);'>
                               </td>";
                      }




                        $result.="</tr>
                         
                        </td>
                     
                      </tr>";
            


//segunda comparação , se não for diagnostico inicial

            if ($idperiodo!=6) {

                $res_par=$conexao->query("SELECT * FROM parecer_disciplina WHERE disciplina_id =$iddisciplina  and status=1  and parecer_disciplina.ano=$ano_letivo ");
                 //$res_par=listar_parecer_disciplina($conexao,$iddisciplina,$idturma,$_SESSION['ano_letivo']);
                  foreach ($res_par as $key => $value) {
                    
                    $idparecer=$value['id'];
                    $serie_id=$value['serie_id'];

                    $descricao_parecer=$value['descricao'];
                    $res_verif_parece=verifica_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,$idparecer,'av3', $ano_letivo);
                    $sigla="";
                    // $idnota_sigla="";
                    foreach ($res_verif_parece as $key => $value) {
                      $sigla=$value['sigla'];
                     // $idnota_sigla=$value['idnota'];
                    }


                  if ($serie_id == $idserie) {  //pareceres que ja foram prenchidos
       

                    }else if ( ($serie_id =="" && $idserie <8) || ($idserie==16 && $seguimento <3) ) {//pareceres que NÃO  foram prenchidos
                       $result.="<tr class='$cor_tabela'>
                            <td colspan='2'>

                            <div class='col-12'>

                                  
                                 ";
                                   
                                  $result.="<p class='text-justify'>$descricao_parecer";
                                    
                                    
                                   $result.="                            
                                      <input type='hidden' name='descricao_parecer".$id."[]' value='$idparecer'>
                                  <select  name='parecer_sigla".$id."[]'>
                                    <option value='$sigla'>$sigla </option>
                                    <option value='S'>S</option>
                                    <option></option>
                                    <option value='N'>N</option>
                                    <option value='D'>D</option>
                                    <option value='NT'>NT</option>
                                   
                                  </select>
                                </p>

                              </div> ";

                              

                            $result.="
                            </td>
                            </tr>";
                    }


                }

              }//fim if


            $cont++;
          }


      }



          $result.="</tbody>
          </table>
        </div>
      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET $e";
  }

?>