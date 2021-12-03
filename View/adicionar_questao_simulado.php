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

$nome_questionario=$_GET['nome'];
$questionario_id=$_GET['questionario_id'];
$origem_questionario_id=$_GET['origem_questionario_id'];

$array_url=explode('p?', $_SERVER["REQUEST_URI"]);
$url_get=$array_url[1];




?>



<script src="ajax.js?<?php echo rand();?>"></script>


<div class="content-wrapper" style="min-height: 529px;">

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-10 alert alert-warning">

          <h1 class="m-0"><b>

            <?php
            if (isset($nome_escola_global)) {
              echo $nome_escola_global; 
            }
            ?>

            <?php if (isset($_SESSION['nome'])) {

              echo $_SESSION['nome'];  

            } 

          ?></b></h1>

        </div><!-- /.col -->

        <div class="col-sm-2">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="#">Home</a></li>

            <li class="breadcrumb-item active">Questionário</li>

          </ol>

        </div><!-- /.col -->

      </div><!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

  <!-- /.content-header -->



  <!-- Main content -->



</section>



<!-- Main content -->

<section class="content">

  <div class="container-fluid">


    <div class="row">
      <div class="col-md-12">

        <button type="button" class="btn btn-block btn-secondary"> Adicionar questões ao questionário: <b><?php echo $_GET['nome']; ?></b></button>

        <form class="mt-12" action="../Controller/Cadastrar_questao_simulado.php" method="post" enctype="multipart/form-data">
          

<input type="hidden" id="origem_questionario_id" value="<?php echo $origem_questionario_id; ?>">
          <div class="row">
            <div class="col-md-12">

              <div class="card card-outline card-info">
                <div class="card-header">
                  <h3 >
                    Descreva sua questão abaixo
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <textarea name="nome" id="summernote" style="height: 245.719px;" required></textarea>

                </div>
                <div class="card-footer">

                </div>

              </div>

            </div>
            <!-- /.col-->
          </div>




          <h4 class='card-title'>Pontos</h4>
          <div class='form-group'>
            <input type='text' name='pontos' class='form-control' autocomplete='off'  placeholder='' required='' onkeyup='somenteNumeros(this);'>
          </div>

          <h4 class='card-title'>Anexo (opcional) </h4>
          <div class='form-group'>
            <input type='file' name='imagem' class='form-control' >
          </div>


          <h4 class="card-title">Tipo </h4>
          <div class="form-group">
            <select name="tipo" class="form-control" onchange="gerar_questao(this.value);"  required="">
              <option></option>
              <option value="multipla">Múltipla Escolha</option>
              <option value="multipla_justificada">Múltipla Escolha(Justificada)</option>
              <option value="discursiva">Discursiva</option>

            </select>
          </div>

          <div id="gerar_questao" style="background-color: #e8eaec;">
          </div>

            




          <input type="hidden" name="origem_questionario_id" value="<?php echo $origem_questionario_id; ?>" class="form-control" required="">
          <input type="hidden" name="questionario_id" value="<?php echo $questionario_id; ?>" class="form-control" required="">
          <input type="hidden" name="url_get" value="<?php echo $url_get; ?>" class="form-control" required="">

          <button type="submit" class="btn waves-effect waves-light btn-lg btn-primary">
            Cadastrar Questão
          </button>

        </form>



      </div>
    </div>


    <br>
    <br>
    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-block btn-secondary">
        <h1>Confira abaixo a lista de questões cadastradas</h1>
      </button>

        <?php 

       

        $listar_questao=listar_questao_simulado($conexao,$questionario_id);
        $conta=1;
        foreach ($listar_questao as $key => $value) {
         $idquestao=$value['id'];
         $questao=converter_utf8($value['nome']);

         $questao=str_replace("^;", "'", $questao);

         $tipo=$value['tipo'];
         if ($conta%2==0) {
           echo "<div class='p-3 mb-2' style='background-color:#B0C4DE' id='linha$idquestao'>";
         }else{
           echo "<div class='p-3 mb-2' id='linha$idquestao'>";

         }
         echo "


         <div class='form-group'>
         <p>$questao </p>
         <!-- <textarea  name='$idquestao' id='$idquestao' class='form-control' required onKeyup=alterar_pergunta_discursiva('$idquestao'); rows='5'>

         </textarea>-->


         id:$idquestao <a onclick='excluir_questao_simulado($idquestao)' class='btn btn-danger'> Excluir Questão</a>
<a href='editar_simulado.php?questao_id=$idquestao&$url_get' class='btn btn-primary'> Editar</a>
         <br>
         <p id='res$idquestao'> </p>

         </div>";

         $arquivo_anexo=listar_arquivo_simulado($conexao,$idquestao);
         foreach ($arquivo_anexo as $key => $value) {
           $idarquivo=$value['id'];
           $arquivo=$value['arquivo'];

           echo "<a href='arquivo/$arquivo' class='btn btn-warning'> Ver arquivo Anexado </a>";

         // echo"  <a href='../Controller/Excluir_anexo.php?origem_questionario_id=$origem_questionario_id&id=$idarquivo' class='btn btn-danger' target='_blank'> Excluir Anexo </a><br> ";

         }


         $cont=1;
         $listar_alternativa=listar_alternativa_simulado($conexao,$idquestao);

         if ($tipo=="multipla" || $tipo=="multipla_justificada") {


         }

         foreach ($listar_alternativa as $chave => $linha) {
           $id=$linha['id'];
           $tipo=$linha['tipo'];
           $alternativa=$linha['nome'];
           $questao_id=$linha['questao_id'];
           $alternativa=str_replace("^;", "'", $alternativa);


           echo "<br>";
          $pesquisa_alt=$conexao->query("SELECT * FROM alternativa_simulado WHERE id=$id ");
   
          $marcado="";
          foreach ($pesquisa_alt as $key_alt => $value_alt) {
              if ($value_alt['correta']==1) {
                $marcado="checked";
                  
              }else{
                $marcado="";

              }
          }
            $questao_aux=substr($questao, 0, 25);

           if ($tipo=="discursiva") {

           }else if ($tipo=="multipla") {

            echo "                                                
            <div class='custom-control custom-radio'>
            <input type='hidden' value='$alternativa' id='alternativa$id'>
            <input type='hidden' value='$questao_aux' id='questao_alternativa$id'>

            <input type='checkbox' id='customRadio$id$cont' name='alternativa$id$questao_id' class='custom-control-input' onclick='resposta_multipla_professor_simulado($id)' $marcado>
            <label class='custom-control-label' for='customRadio$id$cont'>
            $alternativa</label>
            </div>
            ";

          }else if ($tipo=="multipla_justificada") {
           echo "              
            <input type='hidden' value='$questao_aux' id='questao_alternativa$id'>
           
            <input type='hidden' value='$alternativa' id='alternativa$id'>

           <div class='custom-control custom-radio'>
           <input type='checkbox' id='customRadio$id$cont' name='alternativa$id$questao_id' class='custom-control-input' onclick='resposta_multipla_professor_simulado($id)' $marcado>
           <label class='custom-control-label' for='customRadio$id$cont'>$alternativa</label>
           </div>
           "; 

         }
         echo"<p id='link$id'></p>";
         $cont++;
       }

       echo "</div>";

       $conta++;
     }

     ?>

     <!-- /.content -->

   </div>        

 </div>

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