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
    $data=$_GET['data_avaliacao'];
    $idperiodo=$_GET['idperiodo'];
    $avaliacao=$_GET['avaliacao'];
    $idserie=$_GET['idserie'];
    $tamanho=4;
    
 if ($avaliacao=='av1') {
    $tamanho=3;
 }elseif ($avaliacao=='av2') {
    $tamanho=3;
 }elseif ($avaliacao=='av3') {
    $tamanho=4;
 }elseif ($avaliacao=='RP') {
    $tamanho=4;
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
                     $result_verifica=verifica_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,$data,$avaliacao);
                     $nota='';
                     $descricao_parecer='';
                     foreach ($result_verifica as $key => $value) {
                        $nota=$value['nota'];
                        $descricao_parecer=$value['parecer_descritivo'];
                     }

                      $result.="
                         <tr  class='$cor_tabela'>
                          <td  colspan='2'>
                  
                          <div class='col-sm-6'>
                            <b class='text-success'> $nome_aluno </b>
                            <br>
                          <b>DATA: ".converte_data($data)."</b><br>";
                        if ($idserie>3) {
                            
                          $result.="
                          I TRIMESTRE <p style='border: 1px solid black;'>";

                          $array_avaliacao=array('1'=>'av1','2'=>'av2','3'=>'av3','4'=>'RP');
                          foreach ($array_avaliacao as $key_avs=> $value_avs) {
                      
                              $result_nota=$conexao->query("
                              SELECT * FROM nota WHERE
                              escola_id=$idescola and
                              turma_id=$idturma and
                              disciplina_id=$iddisciplina and 
                              avaliacao='$value_avs' and 
                              periodo_id=1 and aluno_id=$id  group by avaliacao,periodo_id ");


                              $nota_tri_1=0;
                              foreach ($result_nota as $key => $value) {
                                  $nota_tri_1=$value['nota'];
                              }
                          $result.="<b style='border: 1px solid black;'>$value_avs :</b>$nota_tri_1 ";
                          }
                          $result.="
                          </p> ";

                          $result.="
                            II TRIMESTRE <p style='border: 1px solid black;'>";

                            $array_avaliacao=array('1'=>'av1','2'=>'av2','3'=>'av3','4'=>'RP');
                            foreach ($array_avaliacao as $key_avs=> $value_avs) {
                        
                                $result_nota=$conexao->query("
                                SELECT * FROM nota WHERE
                                escola_id=$idescola and
                                turma_id=$idturma and
                                disciplina_id=$iddisciplina and 
                                avaliacao='$value_avs' and 
                                periodo_id=2 and aluno_id=$id  group by avaliacao,periodo_id ");


                                $nota_tri_1=0;
                                foreach ($result_nota as $key => $value) {
                                    $nota_tri_1=$value['nota'];
                                }
                            $result.="<b style='border: 1px solid black;'>$value_avs :</b>$nota_tri_1 ";
                            }
                            $result.="
                            </p>";




                        }



                          $result.="
                            <input type='hidden' name='aluno_id[]' value='$id'><br>
                          </div>                      
                          
                        <tr class='$cor_tabela'>";

                      if ($idperiodo !=6 ) {//se for diferente de diagnostico inicial
              
                             $result.="<td>

                             <!-- <label for='exampleInputEmail1'>Relatório descritivo</label>
                              <textarea class='form-control-sm' name='parecer_descritivo$id'>$descricao_parecer</textarea><br>
                                <B></b> -->
                              </td>
                            
                              <td>";
                                if ($idserie >=3) {
                                  // code...
                                   $result.="<label for='exampleInputEmail1'>Nota</label><br>
                                  <input type='text'  name='nota$id' value='$nota' style='min-width:60px;' onkeyup='somenteNumeros(this,$tamanho);'> 
                                  <br>
                                  <br>
                                  ";
                                }

 
                                  $result.="<div class='card card-outline card-info'>
                                         <div class='card-header'>
                                           <h6>
                                              Relatório descritivo - $nome_aluno .
                                           </h6>
                                         </div>
                                         <!-- /.card-header -->
                                         <div class='card-body'>
                                           <textarea  class='form-control' rows='7' name='parecer_descritivo$id'>$descricao_parecer</textarea>
                                         </div>
                                         <div class='card-footer'>
                                           
                                         </div>

                                       </div>
                              </td>";
                      }else{
                              
                             $result.="<td>
                              </td>

                              <td>
                                <div class='card card-outline card-info'>
                                         <div class='card-header'>
                                           <h6>
                                              Diagnóstico inicial - $nome_aluno ..
                                           </h6>
                                         </div>
                                         <!-- /.card-header -->
                                         <div class='card-body'>
                                           <textarea  class='form-control' rows='5' name='parecer_descritivo$id'>$descricao_parecer</textarea>
                                         </div>
                                         <div class='card-footer'>
                                         </div>

                                       </div>
                                                  
                                <label for='exampleInputEmail1' style='display: none;'>Nota</label><br>
                                <input type='hidden'  name='nota$id' value='$nota' style='display: none;' onkeyup='somenteNumeros(this,$tamanho);'>
                               </td>";
                      }




                        $result.="</tr>
                         
                        </td>
                     
                      </tr>";
            
            if ($idperiodo!=6) {
              // $result.="";
             
                 $res_par=listar_parecer_disciplina($conexao,$iddisciplina,$idturma);
                  foreach ($res_par as $key => $value) {
                    $idparecer=$value['id'];
                    $serie_id=$value['serie_id'];

                    $descricao_parecer=$value['descricao'];
                    $res_verif_parece=verifica_parecer_nota_diario($conexao,$idescola,$idturma,$iddisciplina,$id,$idperiodo,$data,$idparecer,$avaliacao);
                    $sigla="";
                    foreach ($res_verif_parece as $key => $value) {
                      $sigla=$value['sigla'];
                    }

              
                    //arivan
                                 
                    if ($serie_id == $idserie && $avaliacao=='av3') {
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
                    }else if ($serie_id =="" && $idserie <8 && $avaliacao=='av3') {
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

// $res_conteu=verificar_conteudo_aula($conexao, $iddisciplina, $idturma, $idescola, $professor_id, $data);

// $conteudo_aula="";
// foreach ($res_conteu as $key => $value) {
//   $conteudo_aula=$value['descricao'];
// }

          $result.="</tbody>
          </table>
        </div>
      ";

      echo $result;
  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET";
  }

?>