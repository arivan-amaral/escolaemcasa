<?php 
session_start();
  include_once '../Model/Conexao.php';

if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

}
/*======================NOME DA URL SEM SIMBOLOS====================*/
$url_inteira = $_SERVER["REQUEST_URI"];
$url = explode("View/", $url_inteira);
$url_cortada= $url[1];
$url_teste1 = strtr($url_cortada, "?", " ");
$url_teste2 =strtr($url_teste1, "&", " ");
$url_teste3 =strtr($url_teste2, "%", " ");
/*==================================================================*/
$nome_url = $url_teste3.".php";
$pagina_estatica="pagina_estatica/".$nome_url;
$arquivoCriado = false;

$criar_nova=false;
$diferenca=0;
if (file_exists($pagina_estatica)) {
  $data_file = date("Y-m-d H:i:s", filemtime($pagina_estatica));
  $data_atual= date('Y-m-d H:i:s');
  $diferenca=(strtotime($data_atual) - strtotime($data_file));

}

if(file_exists("pagina_estatica/".$nome_url) && $diferenca<500){


// if(file_exists("pagina_estatica/".$nome_url)){

  include_once "cabecalho.php";
  include_once "alertas.php";
  include_once "barra_horizontal.php";

  include_once 'menu.php';

  include_once '../Controller/Conversao.php';
  include_once '../Controller/Cauculos_notas.php';


  include_once '../Model/Aluno.php';
  include_once '../Model/Coordenador.php';
  include_once '../Model/Escola.php';
  include_once '../Model/Serie.php';
  include_once '../Model/Nota.php';
  include_once '../Model/Turma.php';

  $idturma=$_GET['idturma']; 
  $idescola=$_GET['idescola'];
  $idescola_get=$_GET['idescola'];

  $rematricula_escola_id=$_GET['idescola']; 
  $serie_id=$_GET['idserie']; 
  $idserie=$_GET['idserie']; 
  $idserie_atual=$_GET['idserie']; 

  $array_url=explode('php?', $_SERVER["REQUEST_URI"]);
  $url_get=$array_url[1];
  include_once "pagina_estatica/$url_teste3".".php";

}else{

  include_once "cabecalho.php";
  include_once "alertas.php";
  include_once "barra_horizontal.php";

  include_once 'menu.php';

  include_once '../Controller/Conversao.php';
  include_once '../Controller/Cauculos_notas.php';

  include_once '../Model/Conexao.php';

  include_once '../Model/Aluno.php';
  include_once '../Model/Coordenador.php';
  include_once '../Model/Escola.php';
  include_once '../Model/Serie.php';
  include_once '../Model/Nota.php';
  include_once '../Model/Turma.php';

  $idturma=$_GET['idturma']; 
  $idescola=$_GET['idescola'];
  $idescola_get=$_GET['idescola'];
  $rematricula_escola_id=$_GET['idescola']; 
  $serie_id=$_GET['idserie']; 
  $idserie=$_GET['idserie']; 
  $idserie_atual=$_GET['idserie']; 

  $array_url=explode('php?', $_SERVER["REQUEST_URI"]);
  $url_get=$array_url[1];
  $arquivo="";
  $arquivo.="
  <script src='ajax.js?".rand()."'></script>

<div class='content-wrapper' style='min-height: 529px;'>

  <!-- Content Header (Page header) -->

  <div class='content-header'>

    <div class='container-fluid'>

      <div class='row mb-2'>

        <div class='col-sm-12 alert alert-warning'>
          <center>
            <h1 class='m-0'><b>";

          
             if (isset($nome_escola_global)) {
              $arquivo.="$nome_escola_global";
             }
             if (isset($_SESSION['nome'])) {
            //  $arquivo.=' '.$_SESSION['nome']; 
             } 

          $arquivo.=" </b></h1>
        </center>

      </div><!-- /.col -->

      

    </div><!-- /.row -->

  </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->



<!-- Main content -->

<section class='content'>

  <div class='container-fluid'>
    <!-- Info boxes -->
    <!-- .row -->
    <div class='row'>
      <div class='col-sm-1'></div>
      <div class='col-sm-10'>
        <button class='btn btn-block btn-lg btn-secondary'>";

          $nome_turma_global='';
          $nome_disciplina='';
          $res_turma=lista_de_turmas_por_id($conexao,$idturma);

          foreach ($res_turma as $key => $value) {
            $nome_turma_global=$value['nome_turma'];
          }           

          $nome_escola_global='';
    $res_escola=buscar_escola_por_id($conexao,$idescola);
    $nome_escola_global='';
    foreach ($res_escola as $key => $value) {
      $nome_escola_global=$value['nome_escola'];
    }    


          $arquivo.="$nome_escola_global-<b class='text-warning'>$nome_turma_global </b>

          </button>
        </div>
      </div>
      <br>";


      // if (isset($_GET['teste'])) { 
        if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
        $arquivo.="
        <div class='row'>
          <div class='col-sm-3'>
            <a  class='btn btn-block btn-danger'";$arquivo.=' onclick="mudar_action_form(';$arquivo.="'Solicitacao_transferencia.php'";  $arquivo.=');" '; $arquivo.=" data-toggle='modal' data-target='#modal_transferencia'>Transferir selecionados</a>
          </div>
         ";
        }
   // }
        if ($_SESSION['ano_letivo']!=$_SESSION['ano_letivo_vigente']) {
        $arquivo.="
         <div class='col-sm-3'>
          <a href='' class='btn btn-block btn-success'"; $arquivo.=' onclick=
          "mudar_action_form(';$arquivo.="'Rematricular_aluno.php'";$arquivo.=');"';
         $arquivo.=" data-toggle='modal' data-target='#modal_rematricula'>Rematricular selecionados</a>
        </div> 
        ";
        
      } 
 
      if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
       $arquivo.="
       <div class='col-sm-3'>
        <a href='' class='btn btn-block btn-primary'";  $arquivo.=' onclick=
        "mudar_action_form(
        ';$arquivo.="'Troca_aluno_de_turma.php'";$arquivo.=');"'; 
        $arquivo.="data-toggle='modal' data-target='#modal_troca_de_turma'>Trocar de turma os selecionados</a>
      </div>
      ";
       $arquivo.="
       <div class='col-sm-3'>
        <a  class='btn btn-block btn-secondary'";  $arquivo.=' onclick=
        "criar_linha_para_cada_aluno_carteirinha();mudar_action_form(
        ';$arquivo.="'Carteirinha_transporte.php'";$arquivo.=');"'; 
        $arquivo.="data-toggle='modal' data-target='#modal_carteirinha_transporte'>Gerar carterinha de trasp</a>
      </div>
      ";
    }

      if ($serie_id==1 || $serie_id==2 || $serie_id==7 || $serie_id==11 || $serie_id==15) {
        
     $arquivo.="
     <div class='col-sm-3'>
      <button onclick=mudar_action_form_declaracao('imprimir_declaracao_terminalidade.php'); data-toggle='modal' data-target='#modal_declaracao_terminalidade' class='btn btn-block btn-warning'>Declaração de terminalidade</button>
    </div>
    ";

    }
  
$arquivo.="
  </div>



  <form action='' name='procedimentos' id='procedimentos' method='post'>




    <div class='row'>

     <div class='card-body'>

      <table class='table table-bordered'>

        <thead>
          <tr>
            <th style='width: 20px'>
              Todos
              <input type='checkbox' id='checkTodos' class='checkbox' name='checkTodos' onclick='seleciona_todos_alunos();'> 
            </th>


            <th style='width: 50px'>Situação Matrícula</th>
            <th>Dados do Aluno</th>
            <th>Carterinha</th>
            <th>Resultado</th>
            
            <th>Status</th>
          </tr>
        </thead>

        <tbody>";
         
          $conta_aluno=1; 
          $matricula='';

          if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
            $result=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
          }else{

            $result=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
          }

          foreach ($result as $key => $value) {
            $nome_aluno=($value['nome_aluno']);
            $nome_turma=($value['nome_turma']);
            $linha_transporte=($value['linha_transporte']);
            if ($linha_transporte ==NULL) {
             $linha_transporte=01;
            }

            $data_matricula=($value['data_matricula']);
            $id=$value['idaluno'];
            $idaluno=$value['idaluno'];
            $status_aluno=$value['status_aluno'];
            $email=$value['email'];
            $data_nascimento=converte_data($value['data_nascimento']);
            $senha=$value['senha'];
            $matricula_aluno=$value['matricula'];
            $aluno_transpublico=$value['aluno_transpublico'];

            // $res_movimentacao=array();
  $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

            $data_evento='';
            $descricao_procedimento='';
            $procedimento='';
            // $matricula=';
            foreach ($res_movimentacao as $key => $value) {
              $datasaida=($value['datasaida']);     
              $procedimento=$value['procedimento'];

              if ($datasaida!="") {
                $datasaida=converte_data($datasaida);
              }
            }
            $res_solicitacao_trasferencia=pesquisar_solicitacao_transferencia_por_aluno($conexao,$matricula_aluno,0);

            $verificar_aluno_na_turna_rematricula=verificar_aluno_na_turna_rematricula($conexao,$idaluno,$_SESSION['ano_letivo_vigente']);
            
          $arquivo.="<tr id='linha$idaluno'>
              <input type='hidden' id='matricula$idaluno' name='matricula$idaluno' value='$matricula_aluno'>
              ";
            if ($procedimento!='') {
            $arquivo.="

             <td>
             $conta_aluno
             </td>        
             <td>
             $procedimento 
             <br>
              <button type='button' class='btn btn-danger' onclick='cancelar_transferencia($idaluno, $matricula_aluno);' >Cancelar </button>

             </td>
             <td  valign=top style='border:solid black 1.0pt;
             $conta_aluno -  
             padding:0cm 0cm 0cm 0cm;height:11.3pt; '>
             $nome_aluno
             Data nascimento: $data_nascimento <BR>
             Data matrícula: $data_matricula <BR>
             </td>


             <td colspan='100%' valign=top style='border:solid black 1.0pt;
             ;padding:0cm 0cm 10pt 0cm;height:11.3pt; '>
             $datasaida 
             </td> 
             

             <td>
              <div class='form-group1'>
                <label for='exampleInputEmail1'>Status</label>
                 <select class='form-control'  id='situacao_aluno' name='situacao_aluno' onchange='alterar_situacao_aluno($matricula_aluno,this);'>
                  <option value='MATRICULADO'>MATRICULADO</option>
                  <option value='EVADIDO'>EVADIDO</option>
                  <option value='DESISTENTE'>DESISTENTE</option>
                  <option value='FALECIDO'>FALECIDO</option>
                  <option value='CANCELADO'>CANCELADO</option>
                 </select> 
                </div>
              </td>";


           }else{
           
           
            if (count($res_solicitacao_trasferencia)==0 && count($verificar_aluno_na_turna_rematricula)==0) {

               $arquivo.="  <td>$conta_aluno - <p><input type='checkbox' class='checkbox' name='idaluno[]' id='idaluno_carterinha$idaluno' value='$idaluno'>   </p></td>";
               $arquivo.=" <td><B>MATRICULADO</B></td>";

            }else{

              if ( count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
                $arquivo.=" <td>$conta_aluno -  <p><input type='checkbox' class='checkbox' id='idaluno_carterinha$idaluno' name='idaluno[]' value='$idaluno'></p> </td>";
                $arquivo.="<td><B>ALUNO REMATRICULADO</B>
               
                </td>";

              }elseif ( count($res_solicitacao_trasferencia)>0) {
                $arquivo.="<td>$conta_aluno - </td>";
                $arquivo.="<td>  <B>SOLICITADO TRANSFERÊNCIA</B>
                   

                </td>";

              }
    
              elseif (count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo_vigente']) {

                $arquivo.="<td>
                $conta_aluno - 
                </td>";
                $arquivo.="<td><B>REMATRICULADO</B></td>";

              }
              elseif (count($verificar_aluno_na_turna_rematricula)==0) {
               $arquivo.="<td>
                $conta_aluno - 
                </td>";
                $arquivo.="<td><B>MATRICULADO</B></td>";

              }
            }


            $arquivo.="
            <td>$id -
            <b class='text-success'> $nome_aluno </b><br> Linha:
            <input type='hidden' id='idaluno_carterinha$idaluno"."_nome' value='$nome_aluno' >
            <input type='text' name='idaluno_carterinha_linha$idaluno' id='idaluno_carterinha$idaluno"."_nome_linha' value='$linha_transporte' ><BR>
            Data nascimento: $data_nascimento <BR>
            Data matrícula: $data_matricula

            <b class='text-primary'> $nome_turma</b><BR>
            <b class='text-danger'>$email  </b><BR>
            <b class='text-danger'>Senha: $senha  </b><BR>


            </td>";

          
            
          // $arquivo.="<td>";   

// $arquivo.="</td>";
             
if ($aluno_transpublico==1) {
  $alerta_trans="alert-success";
  $aluno_transpublico="SIM";
}else{
  $alerta_trans="alert-danger";
  $aluno_transpublico="NÃO";


}
$arquivo.="<td class='alert $alerta_trans'>";

$arquivo.="<input type='hidden' name='nome_aluno$idaluno' value='$nome_aluno'>";
$arquivo.="<input type='hidden' name='matricula_aluno$idaluno' value='$matricula_aluno'>";
$arquivo.="<input type='hidden' disable name='resultado$idaluno' value='Apr'>";
// $arquivo.="<input type='text' disable name='resultado$idaluno' value='$resultado'>";
$arquivo.="<input type='hidden' name='idturma' value='$idturma'>";
$arquivo.="<input type='hidden' name='url_get' value='$url_get'>";

 





$arquivo.="$aluno_transpublico</td>";
 

$arquivo.="<td>
<div class='form-group1'>
  <label for='exampleInputEmail1'>Status</label>
   <select class='form-control'  id='situacao_aluno' name='situacao_aluno' onchange='alterar_situacao_aluno($matricula_aluno,this);'>
    <option value='MATRICULADO'>MATRICULADO</option>
    <option value='EVADIDO'>EVADIDO</option>
    <option value='DESISTENTE'>DESISTENTE</option>
    <option value='FALECIDO'>FALECIDO</option>
    <option value='CANCELADO'>CANCELADO</option>
   </select> 
  </div>
</td>";
$arquivo.="<td>";
if ( count($verificar_aluno_na_turna_rematricula)==0 && $_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
  // echo '<a class='btn btn-danger' onclick='excluir_aluno_matriculado($idaluno);' >Excluir aluno</a> <br> <br>';

}elseif ( count($verificar_aluno_na_turna_rematricula)>0 && $_SESSION['ano_letivo'] == $_SESSION['ano_letivo_vigente']) {
 // $arquivo.="Atenção a forma correta de transferir o aluno é dada pela funcionalidade acima (<b class='text-danger'>Transferir selecionados</b>)<br>";

  //echo'<a class='btn btn-danger' onclick='cancelar_rematricula($idaluno);' >Cancelar rematricula</a> <br> <br>';

}




$arquivo.="</td>

</tr>
";
            }//procedimento =='
            $conta_aluno++;
          }
          


$arquivo.="
        </tbody>

      </table>

    </div>

    

  </div>



  <!-- Main row -->

  <!-- /.row -->

</div>





</div>

</section>

</div>

<aside class='control-sidebar control-sidebar-dark'>

  <!-- Control sidebar content goes here -->

</aside>

<!-- /.control-sidebar -->

<script type='text/javascript'>

  function seleciona_todos_alunos(){

    var checkBoxes = document.querySelectorAll('.checkbox');
    var selecionados = 0;
    checkBoxes.forEach(function(el) {
     if(el.checked) {
         //selecionados++;
         console.log(el.value);
         el.checked=false;
       }else{

        el.checked=true;
      }

    });
 // console.log(selecionados);

}

function mascara(o,f){

  v_obj=o

  v_fun=f

  setTimeout('execmascara()',1)

}

function execmascara(){

  v_obj.value=v_fun(v_obj.value)

}

function mtel(v){

    v=v.replace(/\D/g,'');             //Remove tudo o que não é dígito

    v=v.replace(/^(\d{2})(\d)/g,'($1) $2'); //Coloca parênteses em volta dos dois primeiros dígitos

    v=v.replace(/(\d)(\d{4})$/,'$1-$2');    //Coloca hífen entre o quarto e o quinto dígitos

    return v;

  }



</script>

<div class='modal fade bd-example-modal-lg' id='modal_transferencia'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header alert alert-danger'>
        <h4 class='modal-title'>PROCEDIMENTO TRANSFERÊNCIA</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>
            <input type='hidden' name='escola_id_origem' id='escola_id_origem' value=' $idescola_get'>  
            <input type='hidden' name='turma_id_origem' id='turma_id_origem' value='$idturma'>
                 <div class='col-sm-2'>
                  <div class='form-group'>
                    <label for='exampleInputEmail1'>Ano letivo</label>
                    <select  id='ano_letivo' class='form-control' onchange=mudar_ano_letivo(this.value);>";
                     if (isset($_SESSION['ano_letivo'])) {    
                      $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
                      $arquivo.="<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
                    }
                  $arquivo.="

                  </select>
                </div>
              </div> 


          <div class='col-sm-6'>
            <div class='form-group'>
              <label for='exampleInputEmail1'>Escola pretendida</label>
              <select class='form-control'  name='escola_id' id='escola'  onchange='listar_vagas_turma_transferencia_aluno();'>
                <option></option>
                <!-- ESCOLA FORA DO MUNICÍPIO -->
                <option value='0' style='color: black; background-color:#D2691E;'>ESCOLA FORA DA REDE </option>";
                
                $res_turma=escola_associada($conexao,$idfuncionario); 
                $array_escolas_coordenador=array();
                $conta_escolas=0;
                foreach ($res_turma as $key => $value) {
                  $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
                  $conta_escolas++;
                }

                $res_escola=lista_escola($conexao);
                foreach ($res_escola as $key => $value) {
                 $idescola=$value['idescola'];
                 $nome_escola=$value['nome_escola'];
                  if ($idescola_get != $idescola) {
                    // code...
                     if (in_array($idescola, $array_escolas_coordenador) ) { 
                      $arquivo.="<option value='$idescola' style='color: white; background-color:#A9A9A9;'>$nome_escola </option>";
                    }else{
                      $arquivo.="<option value='$idescola'>$nome_escola </option>";
                    }

                  }

                  }
              $arquivo.="
            </select>
          </div>
        </div>
    <div class='col-sm-3'>
      <div class='form-group'>
        <label for='exampleInputEmail1'>Série</label>
        <select class='form-control'  name='serie_id' id='serie' >";

          $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
          foreach ($res_serie as $key => $value) {
            $id=$value['id'];
            $nome_serie=$value['nome'];
            $arquivo.="<option value='$id'>$nome_serie </option>";
          }
          $arquivo.="
        </select>
      </div>
    </div>       
    <div class='col-sm-8'>
      <div class='form-group'>
        <label for='exampleInputEmail1'>Observação <b class='text-danger'> ( Obrigatório )</b></label>
        <textarea class='form-control'  name='observacao' rows='5'>Solicito a aceitação da transferência do aluno que está sendo transferido da ESCOLA: $nome_escola_global e TURMA: $nome_turma_global </textarea>
      </div>
    </div>

  </div>
  <div class='row'>
    <div class='col-sm-12' id='resultado'>
    </div>
  </div>




  <div class='modal-footer justify-content-between'>
   <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
  
   <div id='botao_continuar'>
     <button id='botao_transferir' type='submit' class='btn btn-primary' onclick=bloquear_botao_concluir('botao_transferir'); >TRANSFERIR SELECIONADOS</button>
   </div>
 </div>

 <!-- /corpo -->
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>




<div class='modal fade bd-example-modal-lg' id='modal_rematricula'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header alert alert-success'>
        <h4 class='modal-title'>PROCEDIMENTO REMATRÍCULA</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>

         <div class='col-sm-2'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Ano letivo</label>
            <select  id='ano_letivo' class='form-control' onchange=mudar_ano_letivo(this.value);>";
            
             if (isset($_SESSION['ano_letivo'])) {    
              $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
              $arquivo.="<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
            }
           
$arquivo.="
          </select>
        </div>
      </div>  
      <div class='col-sm-2'>
        <div class='form-group'>
          <input type='hidden' name='rematricula_escola_id' id='rematricula_escola_id' value='$rematricula_escola_id'>
          <label for='exampleInputEmail1'>Série atual</label>
          <select class='form-control'  name='rematricula_serie_id' id='serie' >";


           
            $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
            foreach ($res_serie as $key => $value) {
              $id=$value['id'];
              $nome_serie=$value['nome'];

              $arquivo.="<option value='$id'>$nome_serie </option>";

            }
            $arquivo.="
          </select>
        </div>
      </div>    

      <div class='col-sm-3'>
        <div class='form-group'>

          <label for='exampleInputEmail1'>Turno</label>
          <select class='form-control' onchange=lista_turma_escola_por_serie('lista_de_turmas_rematricula'); name='rematricula_turno' id='rematricula_turno' >
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
          <select class='form-control'  name='rematricula_nova_serie' id='rematricula_nova_serie'  onchange=lista_turma_escola_por_serie('lista_de_turmas_rematricula'); >
            <option></option>";
           
            $res_destino_rematricula=lista_ordem_serie_rematricula($conexao,$serie_id);
            foreach ($res_destino_rematricula as $key_re => $value_re) {
                $possivel_destino=$value_re['possivel_destino'];

                $res_serie=pesquisar_serie_por_id($conexao,$possivel_destino);
                foreach ($res_serie as $key => $value) {
                  $id=$value['id'];
                  $nome_serie=$value['nome'];
                  $arquivo.="<option value='$id'>$nome_serie </option>";
                } 
            }      

            // $res_serie=pesquisar_serie_por_id($conexao,$serie_id+1);
            // foreach ($res_serie as $key => $value) {
            //   $id=$value['id'];
            //   $nome_serie=$value['nome'];
            //   echo '<option value='$id'>$nome_serie </option>';
            // }
            $arquivo.="
          </select>
        </div>
      </div>



      <div class='col-sm-3'>
        <div class='form-group' id=''>
         <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
         <select class='form-control' name='rematricula_turma' id='lista_de_turmas_rematricula' onchange=quantidade_vaga_turma('lista_de_turmas_rematricula');>
         </select>

       </div>
     </div>       

     <div class='col-sm-6'>
      <div class='form-group' >
        <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

        <input type='text'  name='quantidade_vagas_restante' id='quantidade_vagas_restante' value='0' readonly class='alert alert-secondary'>

      </div>
    </div>
  </div>



  <div class='modal-footer justify-content-between'>
   <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
   <!-- onclick='carregando_login()' -->
   <div id='botao_continuar' >
     <button type='submit' class='btn btn-primary' >REMATRICULAR SELECIONADOS</button>
   </div>
 </div>

 <!-- /corpo -->
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>  


<div class='modal fade bd-example-modal-lg' id='modal_troca_de_turma'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title'>PROCEDIMENTO TROCA DE TURMA</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>
          <div class='col-sm-3'>
            <div class='form-group'>
              <label for='exampleInputEmail1'>Ano letivo</label>
              <select  id='ano_letivo' class='form-control' onchange=mudar_ano_letivo(this.value);>";
               
               if (isset($_SESSION['ano_letivo_vigente'])) {    
                $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
                $arquivo.="<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
              }
            $arquivo.="

            </select>
          </div>
        </div>   

        <div class='col-sm-2'>
          <div class='form-group'>
            <label for='exampleInputEmail1'>Série atual</label>
            <select class='form-control'  name='troca_turma_serie_id_antiga' id='' >";


              
              $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
              foreach ($res_serie as $key => $value) {
                $id=$value['id'];
                $nome_serie=$value['nome'];
                $arquivo.="<option value='$id'>$nome_serie </option>";
              }
              $arquivo.="
            </select>
          </div>
        </div>    




        <div class='col-sm-3'>
         <div class='form-group'>

           <label for='exampleInputEmail1' class='text-danger'>Novo Turno</label>
           <select class='form-control' onchange=troca_de_turma_escola_por_serie('troca_turma'); name='troca_turma_turno' id='troca_turma_turno'  >
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
           <select class='form-control'  name='troca_turma_serie_id' id='troca_turma_serie_id'  onchange=troca_de_turma_escola_por_serie(); >
             <option></option>";
           
             $res_destino_rematricula=lista_ordem_serie_rematricula($conexao,$serie_id);
             foreach ($res_destino_rematricula as $key_re => $value_re) {
                 $possivel_destino=$value_re['possivel_destino'];

                 $res_serie=pesquisar_serie_por_id($conexao,$possivel_destino);
                 foreach ($res_serie as $key => $value) {
                   $id=$value['id'];
                   $nome_serie=$value['nome'];
                   $arquivo.="<option value='$id'>$nome_serie </option>";
                 } 
             }      
            $arquivo.="
           </select>
         </div>
       </div>
       <div class='col-sm-3'>
         <div class='form-group' >
            <label class='text-danger'>Nova turma</label>
            <select id='lista_de_turmas_troca_turma' name='lista_de_turmas_troca_turma' class='form-control' onchange=quantidade_vaga_turma('troca_turma');>

            </select>
         </div>
       </div> 
        <div class='col-sm-4'>
         <div class='form-group' >
           <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

           <input type='text'  name='quantidade_vagas_restante_troca_turma' id='quantidade_vagas_restante_troca_turma' value='0' readonly class='alert alert-secondary'>

         </div>
       </div>

     </div>



     <div class='modal-footer justify-content-between'>
       <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
       <!-- onclick='carregando_login()' -->
       <div id='botao_continuar' >
         <button type='submit' class='btn btn-primary' >TROCAR DE TURMA ALUNOS SELECIONADOS</button>
       </div>
     </div>

     <!-- /corpo -->
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>



<div class='modal fade bd-example-modal-lg' id='modal_carteirinha_transporte'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title'>PROCEDIMENTO GERAR CARTERINHA DE TRANSPOSTE ESCOLAR</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>
        <input type='hidden' name='teste[]' value='teste'>
            <div class='col-sm-12' id='carteirinha_linha_transporte'>
            
            </div>
        </div>


     <div class='modal-footer justify-content-between'>
       <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>
       <!-- onclick='carregando_login()' -->
       <div id='botao_continuar' >
         <button type='submit' class='btn btn-primary' >GERAR CARTEIRINHA DOS ALUNOS SELECIONADOS</button>
       </div>
     </div>

     <!-- /corpo -->
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>





<div class='modal fade bd-example-modal-lg' id='modal_declaracao_terminalidade'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header alert alert-warning'>
        <h4 class='modal-title'>PROCEDIMENTO GERAR DECLARAÇÃO DE TERMINALIDADE</h4>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>    

        <div class='row'>
          <input type='hidden' name='escola_id_origem' id='escola_id_origem' value=' $idescola_get'>  
          <input type='hidden' name='turma_id_origem' id='turma_id_origem' value='$idturma'>
          <div class='col-sm-2'>
            <div class='form-group'>

              <select hidden id='ano_letivo' class='form-control' onchange=mudar_ano_letivo(this.value);>";
               if (isset($_SESSION['ano_letivo'])) {    
                $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
                $arquivo.="<option value='$ano_letivo_vigente' selected>$ano_letivo_vigente</option>";                            
              }
              $arquivo.="

            </select>
          </div>
        </div> 





        <div class='modal-footer justify-content-between'>
         <button type='button' class='btn btn-default' data-dismiss='modal'>FECHAR</button>

         <div id='botao_continuar'>
           <button type='submit' class='btn btn-primary' >GERAR DECLARAÇÃO DOS SELECIONADOS</button>
         </div>
       </div>

       <!-- /corpo -->
     </div>
   </div>
   <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>
</div>









</form>

<script>
  function mudar_action_form(procedimento){
    document.procedimentos.action = '../Controller/'+procedimento+'';
    console.log('../Controller/'+procedimento);
  }    

  function mudar_action_form_declaracao(procedimento){
    document.procedimentos.action = ''+procedimento+'';
    console.log(''+procedimento);
  }  


</script>

";
// file_put_contents("pagina_estatica/$url_teste3".".php", $arquivo);
// $arquivoCriado = true;
}
echo "$arquivo";


include_once 'rodape.php';

?>