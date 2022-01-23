<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    include("../Model/Coordenador.php");
    

try {
 
    $professor_id=$_SESSION['idfuncionario'];
 
    $res_turma=escola_associada($conexao,$professor_id); 
    $array_escolas_coordenador=array();
    $conta_escolas=0;
    foreach ($res_turma as $key => $value) {
      $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
      $conta_escolas++;
    }
    $escola=$_GET['escola'];
    $pesquisa=$_GET['pesquisa'];

    if ($escola =="Todas") {
      $codigo_sql=" escola.nome_escola IS NOT NULL ";
    }else{
      $codigo_sql=" escola.idescola= $escola ";

    }

      $result="
       <div class='card-body'>
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th style='width: 10px'>Códido Aluno</th>
              <th>Aluno</th>
              <th>
              Opções
              </th>
            </tr>
          </thead>
          <tbody>

          ";
// ecidade_matricula.calendario_ano ='$ano_letivo_vigente' and 
  $result_aluno=$conexao->query("SELECT 
aluno.nome as 'nome_aluno',
aluno.sexo,
aluno.data_nascimento,
aluno.idaluno,
aluno.email,
aluno.status as 'status_aluno',
aluno.senha


FROM
 
aluno 

where
  aluno.nome LIKE '%$pesquisa%'  
  ORDER by  aluno.nome asc limit 50");


               // $result_aluno= pesquisar_aluno($conexao,$pesquisa,$codigo_sql );
               $cont=1;
               
               foreach ($result_aluno as $key => $value) {
                $nome_aluno=utf8_decode($value['nome_aluno']);
                $idaluno=$value['idaluno'];
                $numero="";
                $result.="<tr>
                      <td>$idaluno</td>
                      <td>
                        <b class='text-success'> $nome_aluno </b> <br> 
                      ";
           

                    $result_ecidade_matricula=$conexao->query("SELECT
                    turma.nome_turma,
                    escola.nome_escola,
                    escola.idescola,
                    ecidade_matricula.matricula_codigo as 'matricula',
                    ecidade_matricula.matricula_datamatricula as 'data_matricula',
                    ecidade_matricula.datasaida as 'datasaida',
                    ecidade_matricula.turma_escola as 'idescola',
                    ecidade_matricula.turma_id as 'idturma',
                    turma.serie_id as 'idserie',
                    ecidade_matricula.calendario_ano as 'calendario_ano'

                    FROM
                      ecidade_matricula,
                      turma,escola
                    where
                
                      ecidade_matricula.aluno_id = $idaluno and 
                      ecidade_matricula.turma_id = turma.idturma and 
                      ecidade_matricula.turma_escola = escola.idescola and 
                      ecidade_matricula.matricula_situacao !='CANCELADO'
                      ORDER by ecidade_matricula.calendario_ano desc");
$conta_ano_cursado=1;
$nome_turma='';
$nome_escola='';
$idescola='';
$idturma='';
$idserie='';
$matricula='';
$calendario_ano='';

foreach ($result_ecidade_matricula as $key => $value) {
                $nome_turma=($value['nome_turma']);
                $nome_escola=$value['nome_escola'];
                $idescola=$value['idescola'];
                $idturma=$value['idturma'];
                $idserie=$value['idserie'];
                $matricula=$value['matricula'];
                $calendario_ano=$value['calendario_ano'];
                if ($conta_ano_cursado==1) {
                  $nome_turma=($value['nome_turma']);
                  $nome_escola=$value['nome_escola'];
                  $idescola=$value['idescola'];
                  $idturma=$value['idturma'];
                  $idserie=$value['idserie'];
                  $matricula=$value['matricula'];
                  $calendario_ano=$value['calendario_ano'];

                   $result.="
                        <b class='text-primary'> $nome_escola -</b> 
                        <b class='text-primary'> $nome_turma </b> 
                        <b class='text-success'> Ano: $calendario_ano </b> <br>
                      ";
                }else{
                      $result.="
                        <b class='text-black'> $nome_escola -</b> 
                        <b class='text-black'> $nome_turma </b> 
                        <b class='text-success'> Ano: $calendario_ano</b> <br>
                      ";
                }


  $conta_ano_cursado++;
         
}//final => foreach ($result_ecidade_matricula as $key => $value) {

                  $result.="
                </td>
                      <td class = 'text-right'>
                          <div class = 'btn-group text-right'>
                              <button type = 'button' class = 'btn btn-primary fs12 dropdown-toggle' data-toggle = 'dropdown' aria-expanded = 'false'> 
                                  Opções
                                  <span class = 'caret ml5'></span>
                              </button>
                              <ul class = 'dropdown-menu' role = 'menu'>
                                  
                                  <li>
                                    <a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma'  target='_blank' class='dropdown-item'  > Boletim atual </a> </b>
                                  </li>";
                                
                                if (in_array($idescola, $array_escolas_coordenador) ) { 

                                // $result.="
                                //   <li>
                                //   <form name='form$idaluno' action='tranferencia_aluno.php' method='post' target='_blank'>
                                //       <input type='hidden' name='aluno_id' value='$idaluno'>
                                //       <input type='hidden' name='escola_id' value='$idescola'>
                                //       <input type='hidden' name='turma_id' value='$idturma'>
                                //       <input type='hidden' name='serie_id' value='$idserie'>
                                //       <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                //       <button type='submit' class='dropdown-item'  >Transferência</button>
                               
                                //   </form>
                                //   </li>"; 

                                $result.="
                                  <li>
                                  <form name='editar$idaluno' action='editar-aluno.php' method='post' >
                                      <input type='hidden' name='aluno_id' value='$idaluno'>
                                      <input type='hidden' name='escola_id' value='$idescola'>
                                      <input type='hidden' name='turma_id' value='$idturma'>
                                      <input type='hidden' name='serie_id' value='$idserie'>
                                      <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                      <button type='submit' class='dropdown-item'  >Editar dados</button>
                               
                                  </form>
                                  </li>";        

                                  $result.="
                                  <li>
                                  <form name='form$idaluno' action='registra_nota_fora_rede.php' method='post' target='_blank'>
                                      <input type='hidden' name='aluno_id' value='$idaluno'>
                                      <input type='hidden' name='escola_id' value='$idescola'>
                                      <input type='hidden' name='turma_id' value='$idturma'>
                                      <input type='hidden' name='serie_id' value='$idserie'>
                                      <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                      <button type='submit' class='dropdown-item'  >Notas fora da rede</button>
                               
                                  </form>
                                  </li>";


                                $result.="
                                  <li>
                                  <form name='declaracao$idaluno' action='declaracao.php' method='post' target='_blank'>
                                      <input type='hidden' name='aluno_id' value='$idaluno'>
                                      <input type='hidden' name='escola_id' value='$idescola'>
                                      <input type='hidden' name='turma_id' value='$idturma'>
                                      <input type='hidden' name='serie_id' value='$idserie'>
                                      <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                      <button type='submit' class='dropdown-item'  >Declarações</button>
                               
                                  </form>
                                  </li>";
                                
                                $result.="
                                  <li>
                                      <a href ='historico_aluno.php' class='dropdown-item' target='_blank' >Histórico</a>
                                  </li>";
                                }
                                  
                                 $result.="
                              </ul>
                          </div>
                      </td>";

                        
             
                     
                      

                    $result.="</tr>";
                  $cont++;
               }


          $result.="</tbody>
          </table>
        </div>
      ";

      echo $result;

  }catch (Exception $e) {
      echo "VERIFIQUE SUA CONEXÃO COM A INTERNET $e<br>";
  }

?>