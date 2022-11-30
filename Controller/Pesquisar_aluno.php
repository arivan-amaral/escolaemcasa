<?php
  session_start();
    include("../Model/Conexao.php");
    include("../Model/Aluno.php");
    include("../Model/Coordenador.php");
    include("../Model/Serie.php");
    include("Conversao.php");
    

try {
 
    if(isset($_GET['valor_paginacao'])){

      $valor_paginacao=$_GET['valor_paginacao'];
      $limite_antigo =$valor_paginacao-25;
       $limite_novo=$valor_paginacao;
    }else{
      $limite_antigo =0;
       $limite_novo=25;
    }

    $professor_id=$_SESSION['idfuncionario'];
    $idfuncionario=$_SESSION['idfuncionario'];
 
    $res_turma=escola_associada($conexao,$idfuncionario); 
    $array_escolas_coordenador=array();
    $conta_escolas=0;
    $lista_escolas="";
    foreach ($res_turma as $key => $value) {
      $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
      $idescola_ass=$value['idescola'];
      $nome_escola_ass=$value['nome_escola'];
      $lista_escolas.="<option value='$idescola_ass'>$nome_escola_ass</option>";
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
aluno.whatsapp,
aluno.whatsapp_responsavel,
aluno.senha


FROM
 
aluno 

where
  aluno.nome LIKE '%$pesquisa%'   OR idaluno='$pesquisa'
  ORDER by  aluno.nome asc limit $limite_antigo , $limite_novo");


               // $result_aluno= pesquisar_aluno($conexao,$pesquisa,$codigo_sql );
               $cont=1;
               
               foreach ($result_aluno as $key => $value) {
                $nome_aluno=($value['nome_aluno']);
                $idaluno=$value['idaluno'];
                $data_nascimento=converte_data($value['data_nascimento']);
                $whatsapp=($value['whatsapp']);
                $whatsapp_responsavel=($value['whatsapp_responsavel']);
                $numero="";
                $result.="<tr id='linha$idaluno'>
                      <td>$idaluno</td>
                      <td>
                        <b class='text-success'> $nome_aluno </b> <br> 
                        <b class='text-success'> Data nascimento: $data_nascimento </b> <br> 
                        <b class='text-info'> Contato: $whatsapp | $whatsapp_responsavel </b> <br>  
                      ";
           

                    $result_ecidade_matricula=$conexao->query("SELECT
                    turma.nome_turma,
                    escola.nome_escola,
                    escola.idescola,

                    ecidade_matricula.matricula_concluida as 'matricula_concluida',
                    ecidade_matricula.matricula_ativa as 'matricula_ativa',
                    ecidade_matricula.matricula_situacao as 'matricula_situacao',

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
                      ORDER by ecidade_matricula.matricula_codigo asc,  ecidade_matricula.calendario_ano asc");
$conta_ano_cursado=1;
$result_ecidade_matricula=$result_ecidade_matricula->fetchAll();

$detectar_ultimo=count($result_ecidade_matricula);
 $nome_turma='';
$nome_escola='';
$idescola=1;
$idturma='';
$idserie=3;
$matricula='';
$calendario_ano='';
$matricula_situacao='';
foreach ($result_ecidade_matricula as $key => $value) {
                $nome_turma=($value['nome_turma']);
                $nome_escola=$value['nome_escola'];
                $idescola=$value['idescola'];
                $idturma=$value['idturma'];
                $idserie=$value['idserie'];
                $matricula=$value['matricula'];
                $calendario_ano=$value['calendario_ano'];
                $matricula_situacao=$value['matricula_situacao'];
 // $result.="$detectar_ultimo==$conta_ano_cursado || $matricula_situacao==TRANSFERIDO FORA";
                if ($detectar_ultimo==$conta_ano_cursado) {
                    $result.="
                        <b class='text-primary'> $nome_escola -</b> 
                        <b class='text-primary'> $nome_turma </b> 
                        <b class='text-danger'> Ano: $calendario_ano </b>
                        
                      ";



                      ###############################################################     



                            $result.="



                        <input type='hidden' name='aluno_id$idaluno'  id='idaluno$idaluno' value='$idaluno'>     
                        <input type='hidden' id='matricula_aluno$idaluno'  value='$matricula'>
                        <input type='hidden' name='turma_id_anterior$idaluno' id='turma_id_anterior$idaluno' value='$idturma'>

                            <div class='modal fade bd-example-modal-lg' id='modal_rematricula$idaluno'>
                              <div class='modal-dialog modal-lg'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h4 class='modal-title'>REMATRICULAR: $nome_aluno</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                      <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>
                                    <div class='modal-body'>    
                                        <div class='row'>
                                           <div class='col-sm-2'>
                                           <div class='form-group'>
                                            <label for='exampleInputEmail1'>Ano</label>
                                            <select  id='ano_letivo' class='form-control' onchange=mudar_ano_letivo(this.value);>";
                                          
                                                       if (isset($_SESSION['ano_letivo'])) {    
                                                            $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
                                                            $result.="<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
                                                       }
                                          
                                                    
                                            $result.=" </select>
                                          </div>
                                        </div>  
                                          <div class='col-sm-5'>
                                          <div class='form-group'>
                                            <label>Escola</label>
                                            <select id='rematricula_escola_id$idaluno' class='form-control'  name='rematricula_escola_id$idaluno' >".                                            $lista_escolas
                                            ." </select>

                                            <!--label for='exampleInputEmail1'>Série atual</label -->
                                            <select hidden class='form-control'  name='rematricula_serie_id$idserie' id='rematricula_serie_id$idaluno' >";  
                                            $result.="<option value='$idserie'></option>";
                                              $result.="
                                           </select>
                                          </div>
                                        </div>    

                                        <div class='col-sm-2'>
                                          <div class='form-group'>
                                       
                                            <label for='exampleInputEmail1'>Turno</label>
                                            <select class='form-control' onchange='lista_turma_escola_por_serie_escola_individual($idaluno);' name='rematricula_turno$idaluno' id='rematricula_turno$idaluno' >
                                                  <option></option>
                                                   <option value='MATUTINO'>MATUTINO</option>
                                                   <option value='VESPERTINO'>VESPERTINO</option>
                                                      <option value='NOTURNO'>NOTURNO</option>
                                                      <option value='INTEGRAL'>INTEGRAL</option>
                                            </select>
                                          </div>
                                        </div>              

                                        <div class='col-sm-2'>
                                          <div class='form-group'>
                                            <label for='exampleInputEmail1' class='text-danger'>Nova Série</label>
                                            <select class='form-control'  name='rematricula_nova_serie$idserie' id='rematricula_nova_serie$idaluno'  onchange='lista_turma_escola_por_serie_escola_individual($idaluno);' >
                                              <option></option>";
                                            $res_serie=lista_todas_series($conexao);
                                            foreach ($res_serie as $key => $value) {
                                                $id=$value['id'];
                                                $nome_serie=$value['nome'];
                                                $result.="<option value='$id'>$nome_serie </option>";
                                            }
                                           
                                            $result.="</select>
                                          </div>
                                        </div>



                                        <div class='col-sm-3'>
                                          <div class='form-group' id=''>
                                             <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
                                              <select class='form-control' name='rematricula_turma$idaluno' id='lista_de_turmas_rematricula$idaluno' onchange=quantidade_vaga_turma_rematricula_individual($idaluno);>
                                              </select>
                                            
                                          </div>
                                        </div>      
                                
                                      <div class='col-sm-5'>
                                          <div class='form-group' >
                                            <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

                                            <input type='text'  name='quantidade_vagas_restante$idaluno' id='quantidade_vagas_restante$idaluno' value='0' readonly class='alert alert-secondary'>
                                             
                                          </div>
                                        </div>
                                      </div>
                                    
                                      <div class='modal-footer justify-content-between'>
                                               <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
                                               
                                               <div id='botao_continuar' >
                                                 <a class='btn btn-primary' onclick='rematricular_aluno_individual($idaluno);' >REMATRICULAR ALUNO</a>
                                               </div>
                                          </div>
                                  </div>
                                </div>

                              </div>
                            </div>

                      ";




                      ###############################################################     
                       




                }else{
                      $result.="
                        <b class='text-black'> $nome_escola -</b> 
                        <b class='text-black'> $nome_turma </b> 
                        <b class='text-success'> Ano: $calendario_ano</b> 
                      ";
                }

                if ($calendario_ano>2020) {
                    $result.="<a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma&ano=$calendario_ano'  target='_blank' class='btn btn-primary'  > Boletim  $calendario_ano  </a> <br> ";

                }
  $conta_ano_cursado++;
         
}//final => foreach ($result_ecidade_matricula as $key => $value) {

                  $result.="
                </td>





                <td class = 'text-right'>
                    <div class = 'btn-group text-right'>
                        <button type = 'button' class = 'btn btn-info fs12 dropdown-toggle' data-toggle = 'dropdown' aria-expanded = 'false'> 
                            Declarações
                            <span class = 'caret ml5'></span>
                        </button>
                        <ul class = 'dropdown-menu' role = 'menu'>";
                            
                 
                          
                        if (in_array($idescola, $array_escolas_coordenador) ) { 

                     
                


                          $result.="
                            <li>
                            <form name='declaracao$idaluno' action='declaracao.php' method='post' target='_blank'>
                                <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                <input type='hidden' name='aluno_id' value='$idaluno'>
                                <input type='hidden' name='escola_id' value='$idescola'>
                                <input type='hidden' name='turma_id' value='$idturma'>
                                <input type='hidden' name='serie_id' value='$idserie'>
                                <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                <input type='hidden' name='tipo_declaracao' value='Declarações Auxílio Brasil'>
                                
                                <button type='submit' class='dropdown-item'  >Declarações Auxílio Brasil</button>
                         
                            </form>
                            </li>";         

                            if ($idserie<4) {
                              // code...
                               $result.="
                              <li>
                              <form name='declaracao$idaluno' action='declaracao_termino_pre.php' method='post' target='_blank'>
                                  <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                  <input type='hidden' name='aluno_id' value='$idaluno'>
                                  <input type='hidden' name='escola_id' value='$idescola'>
                                  <input type='hidden' name='turma_id' value='$idturma'>
                                  <input type='hidden' name='serie_id' value='$idserie'>
                                  <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                  <input type='hidden' name='tipo_declaracao' value='Declarações Auxílio Brasil'>
                                  
                                  <button type='submit' class='dropdown-item'  >Declaração de terminalidade </button>
                           
                              </form>
                              </li>";

                            }

                          $result.="
                            <li>
                            <form name='declaracao$idaluno' action='declaracao.php' method='post' target='_blank'>
                                <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                <input type='hidden' name='aluno_id' value='$idaluno'>
                                <input type='hidden' name='escola_id' value='$idescola'>
                                <input type='hidden' name='turma_id' value='$idturma'>
                                <input type='hidden' name='serie_id' value='$idserie'>
                                <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                <input type='hidden' name='tipo_declaracao' value='Atestado de Frequência'>
                                <button type='submit' class='dropdown-item'  >Declaração Frequência</button>
                         
                            </form>
                            </li>";                        

                            // $result.="
                            // <li>
                            // <form name='declaracao$idaluno' action='declaracao.php' method='post' target='_blank'>
                            //     <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                            //     <input type='hidden' name='aluno_id' value='$idaluno'>
                            //     <input type='hidden' name='escola_id' value='$idescola'>
                            //     <input type='hidden' name='turma_id' value='$idturma'>
                            //     <input type='hidden' name='serie_id' value='$idserie'>
                            //     <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                            //     <button type='submit' class='dropdown-item'  >Declarações Bolsa Família</button>
                         
                            // </form>
                            // </li>";
                          
                           
                          }
                            
                           $result.="
                        </ul>
                    </div>
                </td>";
                
                
                // **************************************************************
                  $result.="
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

                                  if ($detectar_ultimo==0) {
                                   $result.= "
                                   <li>
                                    <a class='dropdown-item' onclick='excluir_aluno($idaluno);'> Excluir </a> </b>
                                  </li>";
                                  }

                                // if ($calendario_ano2 !='2021') {
                                 if ($calendario_ano !=$_SESSION['ano_letivo_vigente'] || ($calendario_ano ==$_SESSION['ano_letivo_vigente'] && $matricula_situacao !="MATRICULADO")) {

                                  $result.="
                                    <li>
                                    <!-- form name='form$idaluno' action='rematricular_aluno.php' method='post' target='_blank'>
                                        <input type='hidden' name='aluno_id' value='$idaluno'>
                                        <input type='hidden' name='escola_id' value='$idescola'>
                                        <input type='hidden' name='turma_id' value='$idturma'>
                                        <input type='hidden' name='serie_id' value='$idserie'>
                                        <input type='hidden' name='nome_aluno' value='$nome_aluno' -->

                                        <!-- button type='submit' class='dropdown-item'  >Rematricular </button -->
                                        <a   class='dropdown-item' data-toggle='modal' data-target='#modal_rematricula$idaluno' >Rematricular </a>
                                  
                                    <!--/form>
                                    </li -->";
                                }
                                
                              if (in_array($idescola, $array_escolas_coordenador) ) { 

                                
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
                                      <input type='hidden' name='ano_letivo_post' value='$calendario_ano'>
                                      <input type='hidden' name='aluno_id' value='$idaluno'>
                                      <input type='hidden' name='escola_id' value='$idescola'>
                                      <input type='hidden' name='turma_id' value='$idturma'>
                                      <input type='hidden' name='serie_id' value='$idserie'>
                                      <input type='hidden' name='nome_aluno' value='$nome_aluno'>
                                      <button type='submit' class='dropdown-item'  >Declarações</button>
                               
                                  </form>
                                  </li>";
                                  if ($idserie>2) {

                                      
                                      $result.="
                                        <li>
                                            <a href ='historico_aluno.php?idaluno=$idaluno&idserie=$idserie&idescola=$idescola' class='dropdown-item' target='_blank' >Histórico</a>
                                        </li>";
                                  }
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
