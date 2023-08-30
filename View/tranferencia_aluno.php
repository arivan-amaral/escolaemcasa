<?php
session_start();

include_once "cabecalho.php";
include_once "alertas.php";

include_once "barra_horizontal.php";
include_once 'menu.php';
include_once '../Controller/Conversao.php';
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Escola.php';
include_once '../Model/Turma.php';
include_once '../Model/Serie.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Aluno.php';

$aluno_id=$_POST['aluno_id'];
$escola_id=$_POST['escola_id'];
$turma_id=$_POST['turma_id'];
$serie_id=$_POST['serie_id'];
$nome_aluno=$_POST['nome_aluno'];
$idfuncionario=$_SESSION['idfuncionario'];

?>

<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->

  <div class="row mb-2">

    <div class="col-sm-12 alert alert-secondary">

      <h1 class="m-0">TRANSFERÊNCIA:  <?php echo $nome_aluno; ?></h1>

    </div><!-- /.col -->
  </div>

    <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <form action="../Controller/Solicitacao_transferencia.php" method='post'>
        <input type="hidden" name="aluno_id" value="<?php echo $aluno_id; ?>" >
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Escola pretendida</label>
            <select class="form-control"  name="escola_id" id="escola" required onchange="listar_vagas_turma_transferencia_aluno()">
              <option></option>
              <option value='ESCOLA FORA DO MUNICÍPIO' style='color: black; background-color:#8B0000;'>ESCOLA FORA DO MUNICÍPIO </option>
              <?php 
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
               
                if (in_array($idescola, $array_escolas_coordenador) ) { 
                  echo"<option value='$idescola' style='color: white; background-color:#A9A9A9;'>$nome_escola </option>";
                }else{
                    echo"<option value='$idescola'>$nome_escola </option>";
                }

               
             }
             ?>
           </select>
         </div>
       </div>
       <div class="col-sm-3">
        <div class="form-group">
          <label for="exampleInputEmail1">Série</label>
          <select class="form-control"  name="serie_id" id="serie" >
    

            <?php 
            $res_serie=pesquisar_serie_por_id($conexao,$serie_id);
            foreach ($res_serie as $key => $value) {
              $id=$value['id'];
              $nome_serie=$value['nome'];
              echo "<option value='$id'>$nome_serie </option>";
            }
            ?>
          </select>
        </div>
      </div>       
      <div class="col-sm-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Observação</label>
          <textarea class="form-control"  name="observacao" ></textarea>
        </div>
      </div>

    </div>
    <br>




        <span id="resultado">
          

        </span>

        <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <button type="submit"  class="btn btn-block btn-success " onclick="aguarde();">Enviar solicitação de transferência</button>

        </div>
      </div>

    </div>


</form>

  </div>
</section>
</div>
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<script type="text/javascript">
  /* Máscaras ER */
  function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
  }
  function execmascara(){
    v_obj.value=v_fun(v_obj.value)
  }
  function mtel(v){
        v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
        v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
        return v;
      }

    </script>

    <?php 
    include_once 'rodape.php';
  ?>