<?php
session_start();

include "cabecalho.php";
include "alertas.php";

include "barra_horizontal.php";
include 'menu.php';
include '../Controller/Conversao.php';
include '../Model/Conexao.php';
include '../Model/Escola.php';
include '../Model/Turma.php';
include '../Model/Serie.php';
include '../Model/Coordenador.php';
include '../Model/Aluno.php';

$aluno_id=$_POST['aluno_id'];
$escola_id=$_POST['escola_id'];
$turma_id=$_POST['turma_id'];
$serie_id=$_POST['serie_id'];
$nome_aluno=$_POST['nome_aluno'];
$idfuncionario=$_SESSION['idfuncionario'];
$ano=2021;
// $ano=date("Y");
$status=1;

?>

<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->

  <div class="row mb-2">

    <div class="col-sm-12 alert alert-secondary">

      <h1 class="m-1">DECLARAÇÃO PARA:  <?php echo $nome_aluno; ?></h1>

    </div><!-- /.col -->
  </div>

    <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <form action="pdf_declaracao.php" method='post' target="_blank">
        <input type="hidden" name="aluno_id" value="<?php echo $aluno_id; ?>" >
        <input type="hidden" name="escola_id" value="<?php echo $escola_id; ?>" >
        <input type="hidden" name="turma_id" value="<?php echo $turma_id; ?>" >
      <div class="row">

                    <div class="col-md-12">

                      <div class="card card-outline card-info">
                        <div class="card-header">
                          <h3 >
                            Descreva a declaração abaixo
                          </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <textarea name="texto_declaracao" id="summernote" style="height: 245.719px;">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;">Atestado de Frequência</span></b></p>
<?php 
  $res_aluno= pesquisar_dados_aluno_por_id($conexao,$aluno_id,$ano,$status);
  foreach ($res_aluno as $key => $value) {
    $nome_aluno=$value['nome'];
    $naturalidade=$value['naturalidade'];
    $uf_naturalidade=$value['uf_cartorio'];
    $data_nascimento= converte_data($value['data_nascimento']);
  
    $nome_escola=$value['nome_escola'];
    $filiacao1=$value['filiacao1'];
    $filiacao2=$value['filiacao2'];
    $nome_serie=$value['nome_serie'];
    $nome_turma=$value['nome_turma'];
 ?>
<p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:14.0pt;line-height:111%;font-family:&quot;Arial&quot;,sans-serif;">Atesto que <b> <?php echo $nome_aluno; ?> </b> natural de <?php echo $naturalidade .",". $uf_naturalidade; ?>, nascido(a) em <?php echo $data_nascimento; ?>, filho(a) de
<?php echo $filiacao1.",". $filiacao2 ; ?>, está cursando a(o) <?php echo $nome_serie; ?>, <?php echo $nome_turma; ?>  na <b> <?php echo $nome_escola; ?> </b> </span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><div style="text-align: center;"><span style="font-family: Arial, sans-serif; font-size: 9pt; text-indent: -0.5pt;"></span></div><span style="font-family: Arial, sans-serif; font-size: 9pt; text-align: left;"><div style="text-align: center;"><span style="font-size: 14pt; text-indent: -0.5pt;">OBS.: Declaro que ...<p></p><p></p><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;">____________________________________________________</span></div><div style="text-align: center;"><span style="font-size: 1rem;"><span style="font-family: Arial, sans-serif; font-size: 9pt; text-indent: -0.5pt;">Luís Eduardo Magalhães, <?php echo date("d/m/Y"); ?> </span></span></div></p><p><br></p>
</textarea>
<?php 
}
?>

                        </div>
                        <div class="card-footer">
                        </div>

                      </div>

                    </div>




    </div>
    <br>





        <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <button type="submit"  class="btn btn-block btn-success " onclick="aguarde();">Gerar declaração</button>

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
    include 'rodape.php';
  ?>