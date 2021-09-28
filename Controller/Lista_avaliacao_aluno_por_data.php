<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    include("../Controller/Conversao.php");
    

try {

    $professor_id=$_SESSION['idfuncionario'];

    $idescola=$_GET['idescola'];
    $idturma=$_GET['idturma'];
    $iddisciplina=$_GET['iddisciplina'];
    //$data=$_GET['data_avaliacao'];
    $idperiodo=$_GET['idperiodo'];
    //$avaliacao=$_GET['avaliacao'];
    $idserie=$_GET['idserie'];
    $tamanho=4;
    
 // if ($avaliacao=='av1') {
 //    $tamanho=3;
 // }elseif ($avaliacao=='av2') {
 //    $tamanho=3;
 // }elseif ($avaliacao=='av3') {
 //    $tamanho=4;
 // }elseif ($avaliacao=='RP') {
 //    $tamanho=4;
 // }

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

               $result_aluno= listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
               $cont=1;
               $cor_tabela='table-primary';
               foreach ($result_aluno as $key => $value) {

                    $nome_aluno=utf8_decode($value['nome_aluno']);
                    $nome_turma=($value['nome_turma']);
                    $id=$value['idaluno'];
                    $status_aluno=$value['status_aluno'];
                    $email=$value['email'];
                    $senha=$value['senha'];
                

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
                            <br>

                            <input type='hidden' name='aluno_id[]' value='$id'><br>
                          </div>                      
                        <tr class='$cor_tabela'>";

                      //se for diferente de diagnostico inicial
                      if ($idperiodo !=6 ) {
              
                             $result.="<td>
                             <!-- <label for='exampleInputEmail1'>Relatório descritivo</label>
                              <textarea class='form-control-sm' name='parecer_descritivo$id'>descricao_parecer</textarea><br>
                                <B></b> -->
                              </td>
                            
                              <td>";
                                if ($idserie >=3) {
                                  // code...
                                   $nota1='';
                                   $nota2='';
                                   $nota3='';
                                   $notarp=''; 

                                   $array_nota1=array();
                                   $array_nota2=array();
                                   $array_nota3=array();
                                   $array_notarp=array();


                                  $result_n1=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av1');

                                   $conta_total_nota=0;
                                   foreach ($result_n1 as $key => $value) {
                                      $idnota=$value['idnota'];

                                      $nota1=$value['nota'];
                                      $array_nota1[$idnota]=$value['nota'];
                                      $conta_total_nota++;
                                   }

                                  $result_n2=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av2');
                                   $conta_total_nota=0;

                                   foreach ($result_n2 as $key => $value) {
                                      $idnota=$value['idnota'];

                                      $nota2=$value['nota'];
                                      $array_nota2[$idnota]=$value['nota'];
                                      $conta_total_nota++;
                                   }

                                  $result_n3=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av3');
                                   $conta_total_nota=0;

                                   foreach ($result_n3 as $key => $value) {
                                      $idnota=$value['idnota'];

                                      $nota3=$value['nota'];
                                      $array_nota3[$idnota]=$value['nota'];
                                      $conta_total_nota++;
                                   }

                                  $result_rp=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'RP');
                                   $conta_total_nota=0;
                                   foreach ($result_rp as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $notarp=$value['nota'];
                                      $array_notarp[$idnota]=$value['nota'];
                                      $conta_total_nota++;
                                   }




                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota AV1:</label>
                                  <input type='text'  name='nota_av1$id' value='$nota1' style='width:50px;' onkeyup='somenteNumeros(this,3);'>";


                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota AV2:</label>
                                  <input type='text'  name='nota_av2$id' value='$nota2' style='width:50px;' onkeyup='somenteNumeros(this,3);'>";

                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota AV3:</label>
                                  <input type='text'  name='nota_av3$id' value='$nota3' style='width:50px;' onkeyup='somenteNumeros(this,4);'>";

                                   $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Nota RP:</label>
                                  <input type='text'  name='nota_RP$id' value='$notarp' style='width:50px;' onkeyup='somenteNumeros(this,4);'>
                                    <br>
                                  ";

                                  if (count($array_nota1)>1) {
                                    $result.="<font color='red'> AV1 DESSE ALUNO POSSUI DUPLICIDADE: <br>";
                                    foreach ($array_nota1 as $key_dupli => $value) {
                                      $result.="<b>id:$key_dupli</b> : $value <br>";
                                    }
                                    $result.="</FONT><BR>";
                                  }
                                  if (count($array_nota2)>1) {
                                    $result.="<font color='red'> AV2 DESSE ALUNO POSSUI DUPLICIDADE:  <br>";
                                    foreach ($array_nota2 as $key_dupli => $value) {
                                      $result.="<b>id:$key_dupli</b> : $value <br>";
                                    }
                                    $result.="</FONT><BR>";
                                  }
                                  if (count($array_nota3)>1) {
                                    // $result.="<font color='red'> AV3 DESSE ALUNO POSSUI DUPLICIDADE: ".count($array_nota3)."</FONT><BR>";
                                  }
                                  if (count($array_notarp)>1) {
                                    $result.="<font color='red'> RP DESSE ALUNO POSSUI DUPLICIDADE <br>";
                                    foreach ($array_notarp as $key_dupli => $value) {
                                      $result.="<b>id:$key_dupli</b> : $value <br>";
                                    }
                                    $result.="</FONT><BR>";
                                  }

                                  $result.="
                                  <br>
                                  ";
                                }
                                         //  <b>
                                         //      Relatório descritivo - $nome_aluno .
                                         //   </b>
  
                                         // <div class='card-body'>
                                         //   <textarea  class='form-control' rows='3' name='parecer_descritivo$id'>$descricao_parecer</textarea>
                                         // </div>
 
                                $result.="
  
                              </td>";
                      }else{// se for diagnostico inicial

                              $result_verifica=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'DIAGNÓSTICO INICIAL');
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
                                         <!-- /.card-header -->
                                         <div class='card-body'>
                                           <textarea  class='form-control' rows='5' name='parecer_descritivo$id'>$descricao_parecer</textarea>
                                         </div>
                                         <div class='card-footer'>
                                         </div>

                                       </div>
                                       <BR>";

                                       $result_rp=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'DIAGNÓSTICO INICIAL');

                                        $array_DIAGNOSTICO_INICIAL=array();
                                        $conta_total_nota=0;

                                        foreach ($result_rp as $key => $value) {
                                           $idnota=$value['idnota'];
                                           $notarp=$value['nota'];
                                           $array_DIAGNOSTICO_INICIAL[$idnota]=$value['nota'];
                                           $conta_total_nota++;
                                        }

                                        if (count($array_DIAGNOSTICO_INICIAL)>1) {
                                          $result.="<font color='red'> DIAGNÓSTICO INICIAL DESSE ALUNO POSSUI DUPLICIDADE <br>";
                                          foreach ($array_DIAGNOSTICO_INICIAL as $key_dupli => $value) {
                                            $result.="<b>id:$key_dupli</b> : $value <br>";
                                          }
                                          $result.="</FONT><BR>";
                                        }


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
              // $result.="";
             
                 $res_par=listar_parecer_disciplina($conexao,$iddisciplina,$idturma);
                  foreach ($res_par as $key => $value) {
                    $idparecer=$value['id'];
                    $serie_id=$value['serie_id'];

                    $descricao_parecer=$value['descricao'];
                    $res_verif_parece=verifica_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,$idparecer,'av3');
                    $sigla="";
                    foreach ($res_verif_parece as $key => $value) {
                      $sigla=$value['sigla'];
                    }

              
                    //arivan
                                 
                    if ($serie_id == $idserie) {  //pareceres que ja foram prenchidos
                    // if ($serie_id == $idserie && $avaliacao=='av3') {  //pareceres que ja foram prenchidos
                       $result.="<tr class='$cor_tabela'>
                            <td colspan='2'>
                            <div class='col-12'>
                                  
                                 ";
                                   
                                  $result.="<p class='text-justify'>$descricao_parecer";
                                    
                                    
                                   $result.="                            
                                      <input type='hidden' name='descricao_parecer".$id."[]' value='$idparecer'>
                                  <select  name='parecer_sigla".$id."[]'>
                                    <option value='$sigla'>$sigla</option>
                                    <option ></option>
                                    <option value='S'>S</option>
                                    <option value='N'>N</option>
                                    <option value='D'>D</option>
                                    <option value='NT'>NT</option>
                                   
                                  </select>
                                </p>

                              </div>   
                            </td>
                            </tr>";

                    }else if ($serie_id =="" && $idserie <8 ) {//pareceres que NÃO  foram prenchidos
                       $result.="<tr class='$cor_tabela'>
                            <td colspan='2'>
                            <div class='col-12'>
                                  
                                 ";
                                   
                                  $result.="<p class='text-justify'>$descricao_parecer";
                                    
                                    
                                   $result.="                            
                                      <input type='hidden' name='descricao_parecer".$id."[]' value='$idparecer'>
                                  <select  name='parecer_sigla".$id."[]'>
                                    <option value='$sigla'>$sigla</option>
                                    <option value='S'>S</option>
                                    <option></option>
                                    <option value='N'>N</option>
                                    <option value='D'>D</option>
                                    <option value='NT'>NT</option>
                                   
                                  </select>
                                </p>

                              </div>   
                            </td>
                            </tr>";
                    }


                }

              }//fim if


            $cont++;
          }



          $result.="</tbody>
          </table>
        </div>
      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>