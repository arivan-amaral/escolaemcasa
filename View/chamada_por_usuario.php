<?php
session_start();
if (!isset($_COOKIE['dia_doservidor_publico2'])) {
  setcookie('dia_doservidor_publico2', 1, (time()+(30*24*3600)));
 // setcookie('conteudo', 1, (time()+(300*24*3600)));
}else{
  setcookie('dia_doservidor_publico2', 0, (time()+(30*24*3600)));
  setcookie('dia_doservidor_publico2', $_COOKIE['dia_doservidor_publico2']+1);
}
  
###################################################
if (!isset($_SESSION['idcoordenador'])) {
  //header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idcoordenador'];

}
  include "cabecalho.php";
  include "alertas.php";
 
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';
   
 



if ($_COOKIE['dia_doservidor_publico2']<2 && date("m-d")=="10-28") {
?>
    <script>
     function dia_doservidor_publico(){
         Swal.fire({
           title: "Parabéns!",
           imageUrl: 'dia_doservidor_publico.png',
           // imageWidth: 400,
           // imageHeight: 200,
           imageAlt: 'dia_doservidor_publico',
         });
     }
setTimeout('dia_doservidor_publico();',3000);
  </script> 
<?php 
  }
?>

<style>
                      .quadro {
                        background-image: url(imagens/logo_educalem_natal.png);
                        background-repeat: no-repeat;
                   
                        background-position: center;
                         
                            background-size: 100% 100%;
                      }
                       </style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   


<script src="ajax.js?<?php echo rand(); ?>"></script>

<script type="text/javascript">
   // setInterval("licitalem_webhook();",30000);
   // setInterval("notificacao_ocorrencia();",10000);
</script>

<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1">
          </div>
          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

           <?php
              if (isset($nome_escola_global)) {
                echo $nome_escola_global; 
              }
              ?>

             <?php if (isset($_SESSION['nome'])) {

              echo " ".$_SESSION['nome'];  

            } 

             ?></b></h1>

          </div><!-- /.col -->

          

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->

    <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center" style="background-color: #EAEDED; font-size: 24px; ">
                      <strong>Chamado Por Usuário</strong>
                    </p><br>


                    

                <div class="row">
                  <div class="col-sm-3">
                    <!-- checkbox -->
                      <?php 
                        $res_setores = todos_setores($conexao);
                        foreach ($res_setores as $key => $value) {
                          $id_setor = $value['id'];
                          $nome_setor = $value['nome'];
                          echo "<div class='form-check'>
                        <input class='form-check-input' type='radio' name='exampleRadios' id='$id_setor' value='$id_setor' onChange = 'mudarUsuarios(this)'>
                        <label for='customCheckbox1' class='form-check-label'>$nome_setor</label>
                      </div>";
                        }
                      ?>
                    
                  </div>

                  <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Selecione Usuários</label>
                        <select class="custom-select" id="usuarios"  onchange="javascript:mostrar_chamadas(this,'usuario');">
     
                        </select>
                      </div>
                    </div>
                </div>
                  

        <div class="row" id='chamadas'>
         </div>  
          <!-- /.progress-group -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- ./card-body -->

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->

  <script type="text/javascript">

    setTimeout('listar_turmas_coordenador_automatico()',500);
    function listar_turmas_coordenador_automatico(){
        var idescola = document.getElementById("idescola").value;  
        listar_turmas_coordenador(idescola);
    }


  </script>

  <script type="text/javascript">
    var setor_usado;
    function mudarUsuarios(elemento) {

      var setor_id = elemento.value;
      setor_usado = elemento.value;
      var result = document.getElementById('usuarios');
      //result.options.length = 0;
        var xmlreq = CriaRequest();

        xmlreq.open("GET", "../Controller/Mudar_usuarios.php?setor_id="+setor_id, true);

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
      mostrar_chamadas(elemento,'setor')
    }
    function mostrar_chamadas(elemento,tipo) {
      if (tipo == 'usuario') {
        var usuario_id = elemento.value;
      var result = document.getElementById('chamadas'); 
        var xmlreq = CriaRequest();

        xmlreq.open("GET", "../Controller/Mudar_busca_chamada.php?usuario_id="+usuario_id+"&setor_id="+setor_usado, true);

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
        var usuario_id = 0;
        var result = document.getElementById('chamadas'); 
        var xmlreq = CriaRequest();
        var setor = elemento.value;
        xmlreq.open("GET", "../Controller/Mudar_busca_chamada.php?usuario_id="+usuario_id+"&setor_id="+setor, true);

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
      
    }
  </script>



 <?php 

    include 'rodape.php';

 ?>