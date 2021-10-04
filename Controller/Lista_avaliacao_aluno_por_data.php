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
                                if ($idserie >=3){
                                  // code...
                                   $nota1='0';
                                   $nota2='0';
                                   $nota3='0';
                                   $notarp='0'; 

                                   $array_nota1=array();
                                   $array_nota2=array();
                                    $array_notas3=array();
                                   $array_notarp=array();


                                  $result_n1=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av1');

                                   $conta_total_nota=0;
                                   foreach ($result_n1 as $key => $value) {
                                      $idnota=$value['idnota'];

                                      $nota1=$value['nota'];
                                      $array_nota1[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota++;
                                   }

                                  $result_n2=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av2');
                                   $conta_total_nota=0;

                                   foreach ($result_n2 as $key => $value) {
                                      $idnota=$value['idnota'];

                                      $nota2=$value['nota'];
                                      $array_nota2[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota++;
                                   }

                                  $result_nota3=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av3');
                                   $conta_total_nota=0;

                                   foreach ($result_nota3 as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $nota3=$value['nota'];
                                     $array_notas3[$idnota]=$value['nota']." data: ".$value['data_nota'];;
                                      $conta_total_nota++;
                                   }

                  


                                  $result_rp=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'RP');
                                   $conta_total_nota=0;
                                   foreach ($result_rp as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $notarp=$value['nota'];
                                      $array_notarp[$idnota]=$value['nota']." data: ".$value['data_nota'];;
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
                                  
                                  ";                     


                                  $media= ($nota1+$nota2+$nota3 );
                                  if ($media<5 && $notarp !='' && $notarp>$nota3) {
                                    $media=($media-$nota3)+$notarp;
                                  }

                                

                                  if ($media <5) {
                                    $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Total:</label>
                                    <input type='text'  value='$media' style='width:50px; background-color: #FFDAB9;'>
                                      <br>
                                    ";
                                  }else{
                                    $result.="<label for='exampleInputEmail1' style='margin-left:10px;'>Total:</label>
                                    <input type='text'  value='$media' style='width:50px;background-color: #00BFFF;''>
                                      <br>
                                    ";
                                  }



                                  if (count($array_nota1)>1) {
                                    $result.="<font color='red'> AV1 DESSE ALUNO POSSUI DUPLICIDADE:</FONT> <br>";
                                    foreach ($array_nota1 as $key_dupli => $value) {
                                      $result.="<div id='nota_excluir$key_dupli'><b> nota av1:</b> <font color='blue'> $value </FONT> <a onclick='excluir_nota_duplicada($key_dupli);' class='btn btn-sm bg-danger'>Excluir $value</a></div><br>";
                                    }
                                    $result.="______________________________________________________<BR>";
                                  }
                                  if (count($array_nota2)>1) {
                                    $result.="<font color='red'> AV2 DESSE ALUNO POSSUI DUPLICIDADE:  </FONT> <br>";
                                    foreach ($array_nota2 as $key_dupli => $value) {
                                      $result.="<div id='nota_excluir$key_dupli'><b> nota av2:</b> <font color='blue'> $value </FONT><a onclick='excluir_nota_duplicada($key_dupli);' class='btn btn-sm bg-danger'>Excluir $value</a></div><br>";
                                    }
                                    $result.="______________________________________________________<BR>";
                                  } 

                                  if ( (count($array_notas3)>1) && $idserie >=8) {
                                    $result.="<font color='red'> AV3 DESSE ALUNO POSSUI DUPLICIDADE:  </FONT> <br>";
                                    foreach ($array_notas3 as $key_dupli => $value) {
                                      $result.="<div id='nota_excluir$key_dupli'><b> nota av3:</b> <font color='blue'> $value </FONT><a onclick='excluir_nota_duplicada($key_dupli);' class='btn btn-sm bg-danger'>Excluir $value</a></div><br>";
                                    }
                                    $result.="______________________________________________________<BR>";
                                  }
        
                                  if (count($array_notarp)>1) {
                                    $result.="<font color='red'> RP DESSE ALUNO POSSUI DUPLICIDADE  </FONT> <br>";
                                    foreach ($array_notarp as $key_dupli => $value) {
                                         $result.="<div id='nota_excluir$key_dupli'>
                                         <b> nota RP:</b> <font color='blue'> $value </FONT>  <a onclick='excluir_nota_duplicada($key_dupli);' class='btn btn-sm bg-danger'>Excluir $value</a></div><br>";
                                    }
                                    $result.="______________________________________________________<BR>";
                                  }

                                  $result.="
                                  <br>
                                  ";
                                }

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
                                           $array_DIAGNOSTICO_INICIAL[$idnota]=" data: ".$value['data_nota']." => ".$value['nota'];
                                           $conta_total_nota++;
                                        }

                                        if (count($array_DIAGNOSTICO_INICIAL)>1) {
                                          $result.="<font color='red'> DIAGNÓSTICO INICIAL DESSE ALUNO POSSUI DUPLICIDADE <br>";
                                          foreach ($array_DIAGNOSTICO_INICIAL as $key_dupli => $value) {
                                            $result.="<b></b> : $value <br>";
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

                              </div>";
                                  $array_nota3=array();
                                  $result_n3=verifica_sigla_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av3',$parecer_disciplina_id);

                                  $conta_total_nota=0;
                                  foreach ($result_n3 as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $nota3=$value['sigla'];
                                      $array_nota3[$idnota]=$value['nota']." data: ".$value['data_nota'];
                                      $conta_total_nota++;
                                   }

                              if (count($array_nota3)>1) {
                                 $result.="<font color='red'> AV3 (PARECERES) DESSE ALUNO POSSUI DUPLICIDADE  </FONT> <br>";
                                foreach ($array_nota3 as $key_dupli => $value) {
                                     $result.="<div id='nota_excluir$key_dupli'>
                                     <b> nota AV3:</b> <font color='blue'> $value </FONT>  <a onclick='excluir_nota_duplicada($key_dupli);' class='btn btn-sm bg-danger'>Excluir $value</a></div><br>";
                                }
                                $result.="______________________________________________________<BR>";
                              }


                            $result.="</td>
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

                              </div> ";


                                $array_nota3=array();
                                  $result_n3=verifica_sigla_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,'av3',$idparecer);

                                  $conta_total_nota=0;
                                  foreach ($result_n3 as $key => $value) {
                                      $idnota=$value['idnota'];
                                      $nota3=$value['sigla'];
                                      $array_nota3[$idnota]="nota: ".$value['nota']." sigla: ".$value['sigla']." data: ".$value['data_nota'];
                                      $conta_total_nota++;
                                   }

                              if (count($array_nota3)>1) {
                                 $result.="<font color='red'> AV3 (PARECERES) DESSE ALUNO POSSUI DUPLICIDADE  </FONT> <br>";
                                foreach ($array_nota3 as $key_dupli => $value) {
                                     $result.="<div id='nota_excluir$key_dupli'>
                                     <b> nota AV3:</b> <font color='blue'> $value </FONT>  <a onclick='excluir_nota_duplicada($key_dupli);' class='btn btn-sm bg-danger'>Excluir $value</a></div><br>";
                                }
                                $result.="______________________________________________________<BR>";
                              }


                            $result.="
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
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET ".$e;
  }

?>