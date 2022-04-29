<?php
session_start();
if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");
}else{
  $idprofessor=$_SESSION['idfuncionario'];
}
include "cabecalho.php";
include "alertas.php";

include "barra_horizontal.php";
include 'menu.php';
include '../Model/Conexao.php';
include '../Controller/Conversao.php';
include '../Model/Questionario.php';

$questao_id=$_GET['questao_id'];



$array_url=explode('p?', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];





   $listar_questao=listar_questao_simulado_por_id($conexao,$questao_id);
   $conta=1;
   $idquestao="";
   foreach ($listar_questao as $key => $value) {
    $idquestao=$value['id'];
    $pontos=$value['pontos'];
    $questao=converter_utf8($value['nome']);

    $questao=str_replace("^;", "'", $questao);

    $tipo=$value['tipo'];
  


  $conta++;
}

?>



<script src="ajax.js?<?php echo rand(1100,2000);?>"></script>



<div class="content-wrapper" style="min-height: 529px;">


</section>



<!-- Main content -->

<section class="content">

  <div class="container-fluid">


    <div class="row">
      <div class="col-md-12">

        <form class="mt-12" action="../Controller/Editar_questao_simulado.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="idquestao" value="<?php echo $idquestao ?>">
  <div class='card card-outline card-info'>
                <div class='card-header'>
                  <h3 >
                    Descreva sua questão abaixo
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class='card-body'>
                  <textarea name='nome' id='summernote' style='height: 245.719px;'><?php echo $questao; ?></textarea>

                </div>
                <div class='card-footer'>

                </div>

              </div>



          <b>Pontos</b>
          <div class='form-group'>
            <input type='text' name='pontos' value="<?php echo $pontos; ?>" class='form-control' autocomplete='off'  placeholder='' required='' onkeyup='somenteNumeros(this);'>
          </div>
<?php 


  $cont=1;
  $listar_alternativa=listar_alternativa_simulado($conexao,$idquestao);

  foreach ($listar_alternativa as $chave => $linha) {
    $id=$linha['id'];
    $tipo=$linha['tipo'];
    $alternativa=$linha['nome'];
    $questao_id=$linha['questao_id'];
    $alternativa=str_replace("^;", "'", $alternativa);

     echo "                                                

     <input type='hidden'  name='idalternativa[]' class='form-control' value='$id' >
     <input type='text'  name='$id' class='form-control' value='$alternativa' >
   
     ";

  $cont++;
}


 ?>




          <input type="hidden" name="url_get" value="<?php echo $url_get; ?>" class="form-control" required="">

          <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">
            CONCLUIR
          </button>

        </form>



      </div>
    </div>


       

 </div>

</div>

</section>

</div>



    <script>
      function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        var valor_campo_nota=campo.value;
        campo.value=valor_campo_nota.replace(",", ".");


        if (er.test(campo.value)) {
          campo.value = "";
          Swal.fire('Esse campo é permitido apenas números.', '', 'info')


        }
      }
    </script>

    <?php 

    include 'rodape.php';

  ?>