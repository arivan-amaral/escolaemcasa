<?php
session_start();
if (!isset($_SESSION['idprofessor']) && !isset($_SESSION['idcoordenador']) && !isset($_SESSION['idsecretario']) && !isset($_SESSION['idfuncionario'])) {

       header("location:index.php?status=0");

}else{

  //$idprofessor=$_SESSION['idprofessor'];

}
  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once "cabecalho.php";
include_once "alertas.php";

  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Controller/Conversao.php';
  include_once '../Model/Setor.php';
  include_once '../Model/Chamada.php';

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
                echo $_SESSION['NOME_APLICACAO']; 
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
               <div>
                 <nav class="navbar navbar-light bg-dark" style="justify-content: center;">
                    <a class="navbar-bran">
                      <img src="assets/img/logos/logo.png" width="40" height="50">
                      <strong>&nbsp;&nbsp;&nbsp;&nbsp;SOLICITAÇÃO DE CHAMADO</strong>
                    </a>
                  </nav><br>
               </div>
              <div class="container-fluid">
             

                <div class="row" >
                  
                  <br>
                  <form class="mt-12" action="../Controller/Cadastro_chamada.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12">
                      <input type="hidden" name="funcionario" id="funcionario" value="<?php echo  $idFuncionario ?>">
                      <div class="form-group">
                       <label for="exampleInputEmail1">Setor a enviar</label>
                       <select class="form-control"  id="setor" name="setor" onchange="javascript:mostraTipo(this);" required>
                        <option></option>
                        <?php 
                          $res_setores=todos_setores_nao_supervisionado($conexao);
                          foreach ($res_setores as $key => $value) {
                            $setor_id = $value['id'];
                            $setor_nome = $value['nome'];
                            echo "<option value='$setor_id'>$setor_nome</option>";
                          }
                         ?>
                       </select> 
                      </div>
                      <div class="form-group">
                       <label for="exampleInputEmail1" id="titulo_solicitacao">Tipo de Socilitação</label>
                       <select class="form-control"  id="tipo_solicitacao" name="tipo_solicitacao" required>
                        
                       </select> 
                      </div>
                        <h4 class="card-title">Anexo</h4>
                        <div class="form-group">
                            <input name="arquivo[]" class="form-control"  type="file" multiple>
                        </div>
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3  >
                              Descrição do Chamado (campo obrigatório)
                            </h3>
                          </div>
                          <div class="card-body">
                            <textarea rows="5" style="height: 280px; width: 600px;" name="descricao" id="descricao"
                           required=""></textarea>
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

                </div><br>
                  <div>
                     <nav class="navbar navbar-light bg-dark" style="justify-content: center;">
                        <a class="navbar-bran">
                          <strong>&nbsp;&nbsp;&nbsp;&nbsp;LISTA DE CHAMADOS</strong>
                        </a>
                      </nav><br>
                  </div>
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
      var setor_id = 1;
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
      var setor_id = 1;
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


    var descricao =  document.getElementById("descricao").value;
    var setor =  document.getElementById("setor").value;
    var funcionario =  document.getElementById("funcionario").value;
    var tipo_solicitacao =  document.getElementById("tipo_solicitacao").value;

    if (descricao=="" || setor=="" || tipo_solicitacao=="") {
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
        var titulo = document.getElementById('titulo_solicitacao');
        titulo.innerHTML = "";
      if (setor_id != 11) {
        titulo.innerHTML = "Tipo de Socilitação";
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
      }else{
        titulo.innerHTML = "Escolas";

        xmlreq.open("GET", "../Controller/Mudar_tipo_solicitado_escola.php", true);

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

    include_once 'rodape.php';

 ?>