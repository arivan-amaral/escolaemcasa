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
      <form action="../Controller/Solicitacao_transferencia.php" method='post'>
        <input type="hidden" name="aluno_id" value="<?php echo $aluno_id; ?>" >
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
                          <textarea name="nome" id="summernote" style="height: 245.719px;">
                            <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:10.0pt;line-height:107%;font-family:&quot;Arial&quot;,sans-serif;">Atestado de Frequência</span></b></p>

<p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:9.0pt;line-height:111%;font-family:&quot;Arial&quot;,sans-serif;">Atesto que ADRYANA DA SILVA ALMEIDA natural de LUIS EDUARDO MAGALHAES,
no estado de BA, nascido(a) aos 31 dias de Julho do ano de 2009, filho(a) de
CICERO DA SILVA ALMEIDA e VALDELICE SILVA DE ALMEIDA, está cursando a(o) 6º
ANO, turma 6º ANO A - MATUTINO 2021 do(a) FUNDAMENTAL II (6º À 9ºANO) nesta
escola.</span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><div style="text-align: center;"><span style="font-family: Arial, sans-serif; font-size: 9pt; text-indent: -0.5pt;">__________________________________________________________________</span></div><span style="font-family: Arial, sans-serif; font-size: 9pt; text-align: left;"><div style="text-align: center;"><span style="font-size: 9pt; text-indent: -0.5pt;">OBS.: Declaro que
o aluno está apto a cursar o 6º ano do ensino fundamental II</span></div></span></p><p></p></textarea>

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