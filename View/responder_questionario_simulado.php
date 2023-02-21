<?php
date_default_timezone_set('America/Bahia');

include_once 'seguranca_aluno.php';

include_once "cabecalho.php";
include_once "alertas.php";

include_once "barra_horizontal.php";

include_once 'menu.php';

include_once '../Model/Conexao.php';

include_once '../Model/Aluno.php';

include_once '../Controller/Conversao.php';

include_once '../Model/Questionario.php';



//$idturma=$_GET['turm'];
$questionario_id=$_GET['questionario_id'];

//$iddisciplina=$_GET['disc'];
$data=date("Y-m-d H:i:s");



?>



<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" style="min-height: 529px;">

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-12 alert alert-warning">

          <h1 class="m-0"><b>

            <?php
            if (isset($nome_escola_global)) {
              echo $_SESSION['NOME_APLICACAO']; 
            }
            ?>

            <?php if (isset($_SESSION['nome'])) {

              echo "  ".$_SESSION['nome'];  

            } 

          ?></b></h1>

        </div><!-- /.col -->

        <div class="col-sm-2">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="#">Home</a></li>

            <li class="breadcrumb-item active">Início</li>

          </ol>

        </div><!-- /.col -->

      </div><!-- /.row -->

    </div><!-- /.container-fluid -->

  </div>

  <!-- /.content-header -->




<script src="dropzone/dist/dropzone.js"></script>
<script type="text/javascript">


  $(function () {

      var form;
      $('#fileUpload').change(function (event) {
          form = new FormData();
          form.append('fileUpload', event.target.files[0]); // para apenas 1 arquivo
          //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção
      });

      $('#btnEnviar').click(function () {
          $.ajax({
               url:'../Controller/Enviar_imagem_prova.php',
               // Url do lado server que vai receber o arquivo
              data: form,
              processData: false,
              contentType: false,
              type: 'POST',
              success: function (data) {
                  // utilizar o retorno
              }
          });
      });
  });







var discurciva = {};
var objetiva_justificada = {};

escrever_array = function (discurciva, objetiva_justificada) {
    Object.keys(discurciva).forEach(function(key) {
        resposta_discursiva(key);

    });   

    Object.keys(objetiva_justificada).forEach(function(key) {
        resposta_justificada_simulado(key);

    });



            // console.log(JSON.stringify(objetiva_justificada));

};


adiciona_discurciva_simulado = function (title, filter) {
        if (discurciva[title] !== undefined) { // Testa se a chave existe
            discurciva[title]=filter;    // Adiciona um elemento no array
        } else {
            discurciva[title] = [filter];      // Se não existe, cria um array com um elemento
        }

        console.log(discurciva[title]);
        console.log("id: "+title);
};

adiciona_justificada = function (title, filter) {
        if (objetiva_justificada[title] !== undefined) { // Testa se a chave existe
            objetiva_justificada[title]=filter;    // Adiciona um elemento no array
        } else {
            objetiva_justificada[title] = [filter];      // Se não existe, cria um array com um elemento
        }

          console.log(objetiva_justificada[title]);
        console.log("id: "+title);
};
adiciona_justificada_marcacao = function (title) {
    var filter= document.getElementById(id).value;
        if (objetiva_justificada[title] !== undefined) { // Testa se a chave existe
            objetiva_justificada[title]=filter;    // Adiciona um elemento no array
        } else {
            objetiva_justificada[title] = [filter];      // Se não existe, cria um array com um elemento
        }

          console.log(objetiva_justificada[title]);
        console.log("id: "+title);
};




</script>

  <!-- Main content -->

  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-md-12"> 



          <?php 


            $hora_inicio="codi: ";
            $hora_fim="erro";
            $hora_atual=date("H:i:s");
 

       if ($questionario_id>0) {

        $listar_questao=listar_questao_simulado($conexao,$questionario_id);


        $conta=1;
        foreach ($listar_questao as $key => $value) {
          $idquestao=$value['id'];
          $questao=converter_utf8($value['nome']);

          // $questao=str_replace("^;", "'", $questao);
          // $questao=str_replace('Ã§', 'ç', $questao);
          // $questao= str_replace('Ã©', 'é', $questao);
          // $questao=str_replace('Ã¡','á',$questao);
          // $questao= str_replace('Ã£', 'ã', $questao);
          // $questao= str_replace('Ã³', 'ó', $questao); 


          $tipo=$value['tipo'];

          echo "<hr>
        $questao
          ";

          $arquivo_anexo=listar_arquivo_simulado($conexao,$idquestao);
          foreach ($arquivo_anexo as $key => $value) {
            $arquivo=$value['arquivo'];

            echo "<a href='arquivo/$arquivo' class='btn btn-warning' target='_blank'> Ver arquivo Anexado </a><br>";
          }


          $cont=1;


          $listar_alternativa=listar_alternativa_simulado($conexao,$idquestao);


          foreach ($listar_alternativa as $chave => $linha) {

            $id=$linha['id'];
            $tipo=$linha['tipo'];
            $alternativa=$linha['nome'];
            $questao_id=$linha['questao_id'];

            $alternativa=str_replace("^;", "'", $alternativa);
            $alternativa=str_replace("^;", "'", $alternativa);
            $alternativa=str_replace('Ã§', 'ç', $alternativa);
            $alternativa= str_replace('Ã©', 'é', $alternativa);
            $alternativa=str_replace('Ã¡','á',$alternativa);
            $alternativa= str_replace('Ã£', 'ã', $alternativa);
            $alternativa= str_replace('Ã³', 'ó', $alternativa); 



                                  //pesquisa as respostas do banco de dado para serem listadas como já respondidadas
            $listar_alternativa=listar_resposta_alternativa_aluno_simulado($conexao,$idquestao,$idaluno );
            $resposta_discursiva="";
            $alternativa_id="";
            foreach ($listar_alternativa as $chave => $linha) {
              $alternativa_id=$linha['alternativa_id'];
              $resposta_discursiva=$linha['resposta_discursiva'];
            }
                                    //fim pesquisa

            echo "<br>  
            <input type='hidden' id='questao_id$questao_id' value='$questao_id'>
            ";

            if ($tipo=="discursiva") {



              echo "                                                
              <h5> Descreva sua resposta abaixo.</h5>
              <div class='form-group'>
              <textarea type='text'  name='$id' class='form-control' 
              id='$id' onKeyup='adiciona_discurciva_simulado($id,this.value)' value='' required rows='5'>$resposta_discursiva</textarea>
              </div>



<input type='hidden' id='fileUpload' name='fileUpload' />
<input type='hidden' id='btnEnviar' value='Enviar' />
   

              <div id='rd$id' class='alert-success'>
              </div>
              <div id='erro_rd$id' class='alert-danger'>
              </div>
              ";
            }else if ($tipo=="multipla") {



             if ($id==$alternativa_id) {
               echo "                                                
               <div class='custom-control custom-radio'>
               
               <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_multipla_simulado($id,$questao_id);' value='$alternativa_id' checked>

               <label class='custom-control-label' for='customRadio$id$cont'>
               $alternativa</label>
               </div>
               ";
             }else{
               echo "                                                
               <div class='custom-control custom-radio'>
              
               <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_multipla_simulado($id,$questao_id);' value='$id'>

               <label class='custom-control-label' for='customRadio$id$cont'>
               $alternativa</label>
               </div>";

             }




           }else if ($tipo=="multipla_justificada") {

            if ($id==$alternativa_id){
              echo "                                                
              <div class='custom-control custom-radio'>
              <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_justificada_simulado($id);
              adiciona_justificada_marcacao($id);' 
              value='$id' checked>

              <label class='custom-control-label' for='customRadio$id$cont'>$alternativa</label>
              </div>

              <h5> Justifique sua resposta.</h5>
              <div class='form-group'>
              <textarea  name='resposta$id' class='form-control' required id='$id' onKeyup='adiciona_justificada($id,this.value)'>$resposta_discursiva</textarea>
              </div>
              "; 
            }else {
              echo "                                                
              <div class='custom-control custom-radio'>
              <input type='radio' id='customRadio$id$cont' name='alternativa$questao_id' class='custom-control-input' onclick='resposta_justificada_simulado($id);adiciona_justificada_marcacao($id);' value='$id'>

              <label class='custom-control-label' for='customRadio$id$cont'>$alternativa</label>
              </div>

              <h5> Justifique sua resposta.</h5>
              <div class='form-group'>
              <textarea  name='resposta$id' class='form-control' required id='$id' onKeyup='adiciona_justificada($id,this.value)'></textarea>
              </div>
              "; 
            }


          }
          $cont++;


        }

        echo "


        ";
        $conta++;
      }


      ?>



      <br>
      <br>
  <?php 
  echo"
      <button  class='btn waves-effect waves-light btn-lg btn-success' onclick='escrever_array(discurciva,objetiva_justificada);aguarde_tempo_dinamico_simulado($questionario_id);'>
        Finalizar Questionário
      </button>";
   ?>



    <?php } ?>


  </div>        

</div>

</div>

</section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>


<script type="text/javascript">

 function carregando(){
  let timerInterval
  Swal.fire({
    title: 'Aguarde, sua atividade está sendo enviada!',
    html: ' <b></b> ',
    timer: 100000,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading()
      timerInterval = setInterval(() => {
        const content = Swal.getContent()
        if (content) {
          const b = content.querySelector('b')
          if (b) {
            b.textContent = Swal.getTimerLeft()
          }
        }
      }, 100)
    },
    willClose: () => {
      clearInterval(timerInterval)
    }
  }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
      console.log('I was closed by the timer')
    }
  })
}

</script>




<!-- /.control-sidebar -->

<script type="text/javascript">

  function refreshPage(){
    window.location.reload();
  } 

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

    include_once 'rodape_pesquisas.php';

  ?>