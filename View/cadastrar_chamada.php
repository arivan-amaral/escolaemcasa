<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador'])) {

       header("location:index.php?status=0");

}else{

  //$idprofessor=$_SESSION['idprofessor'];

}
include "cabecalho.php";
include "alertas.php";

  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';
  include '../Model/Setor.php';
  include '../Model/Chamada.php';

  $idFuncionario=$_SESSION['idfuncionario'];


 //$array_url=explode('p?', $_SERVER["REQUEST_URI"]);
 //$url_get=$array_url[1];


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
                echo $nome_escola_global; 
              }
              ?> 

             <?php if (isset($_SESSION['nome'])) {

              echo $_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->



            </section>



            <!-- Main content -->

            <section class="content">
               <h4 align="center">Criar Chamada</h4>
              <div class="container-fluid">
             

                <div class="row" >
                  
                  <br>
                  <form class="mt-12" action="../Controller/Cadastro_chamada.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12">
                      <input type="hidden" name="funcionario" id="funcionario" value="<?php echo  $idFuncionario ?>">
                      <div class="form-group">
                       <label for="exampleInputEmail1">Setor a enviar</label>
                       <select class="form-control"  id="setor" name="setor" onchange="javascript:mostraTipo(this);">
                        <?php 
                          $res_setores=todos_setores($conexao);
                          foreach ($res_setores as $key => $value) {
                            $setor_id = $value['id'];
                            $setor_nome = $value['nome'];
                            echo "<option value='$setor_id'>$setor_nome</option>";
                          }
                         ?>
                       </select> 
                      </div>
                      <div class="form-group">
                       <label for="exampleInputEmail1">Tipo de Socilitação</label>
                       <select class="form-control"  id="tipo_solicitacao" name="tipo_solicitacao">
                        
                       </select> 
                      </div>
                        <h4 class="card-title">Anexo</h4>
                        <div class="form-group">
                            <input type="file" name="arquivo" class="form-control" >
                        </div>
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3  >
                              Descrição da Chamada (campo obrigatório)
                            </h3>
                            <b style="color: red;">POR FAVOR, NÃO COLOCAR EMOJI NOS CAMPOS DA ATIVIDADE </b>
                          </div>
                          <div class="card-body">
                            <textarea rows="5" style="height: 245.719px;" name="descricao" id="summernote" required="">
                            </textarea>
                          </div>
                        </div>

  
                        <br>
                        <br>
                      <div onclick='carregando();'>
                        <button type="submit" class="btn btn-block btn-primary">Enviar Chamado</button>
                      </div>
                    </form> 
                    <br>
                    

                                    
                  </div>

                </div>
                <br>
                  <h4 align="center">Minhas Chamadas</h4>
                  <br>
                  <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">INFORMAÇÕES</th>
                            <th scope="col">DESCRIÇÃO</th>
                          </tr>
                        </thead>
                        <tbody id="tabela_chamada">
                         
                        </tbody>
                    </table>
                  </div> 
    </div>

  </section>

</div>
<script type="text/javascript">
  function primeiraOpcao()
    {
      var setor_id = 6;
      var result = document.getElementById('tipo_solicitacao');
      result.options.length = 0;
     
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Mudar_tipo_solicitado.php?setor_id="+setor_id, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                   result.innerHTML = xmlreq.responseText;
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
        };
     xmlreq.send(null);
    }
 setTimeout(primeiraOpcao(), 2000);
 function primeiraOpcao2()
    {
      var setor_id = 6;
      var result = document.getElementById('tabela_chamada');
      result.innerHTML = "";
     
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Mostrar_chamadas.php?setor_id="+setor_id, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                   result.innerHTML = xmlreq.responseText;
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
        };
     xmlreq.send(null);
    }
    setTimeout(primeiraOpcao2(), 2000);
 function carregando(){


    var descricao =  document.getElementById("summernote").value;
    var setor =  document.getElementById("setor").value;
    var funcionario =  document.getElementById("funcionario").value;

    if (descricao=="" || setor=="") {
        Swal.fire('Preencha os campos obrigatorios!', '', 'info');
        
      

    }else{
          let timerInterval
          Swal.fire({
            title: 'Aguarde, ação está sendo realizada...',
            html: '',
            timer: 200000,
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
      }//else
  }

  function mostraTipo(elemento)
    {
      var element = elemento;
      var setor_id = elemento.value;
      var result = document.getElementById('tipo_solicitacao');
      result.options.length = 0;
     
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Mudar_tipo_solicitado.php?setor_id="+setor_id, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                   result.innerHTML = xmlreq.responseText;
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
        };
     xmlreq.send(null);
     mostraChamada(element);
    }

    function mostraChamada(elemento)
    {
      var setor_id = elemento.value;
      var result = document.getElementById('tabela_chamada');
      result.innerHTML = "";
     
        var xmlreq = CriaRequest();
        xmlreq.open("GET", "../Controller/Mostrar_chamadas.php?setor_id="+setor_id, true);

        xmlreq.onreadystatechange = function(){
      
         if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                   result.innerHTML = xmlreq.responseText;
             }else{
                   alert('Erro desconhecido, verifique sua conexão com a internet');

                result.innerHTML ="Erro ao receber mensagens";                 
             }
         }
        };
     xmlreq.send(null);
    }
</script>
<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>


 <?php 

    include 'rodape.php';

 ?>