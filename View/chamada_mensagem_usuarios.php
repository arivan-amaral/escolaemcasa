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

  include '../Model/Conexao.php';

  include '../Model/Setor.php';
  include '../Model/Chamada.php';
   
  $res_chamadas_totais_novas = quantidade_chamada_novas_vg($conexao);
  $res_chamadas_totais_atrasadas = quantidade_chamada_atraso_vg($conexao);
  $res_chamadas_totais_resolvidos = quantidade_chamada_finalizadas_vg($conexao);
  $res_chamadas_totais_andamento = quantidade_chamada_andamento_vg($conexao);
  $res_chamadas_totais = quantidade_chamada_total_vg($conexao);

  $quant_novas = 0;
  $quant_atraso = 0;
  $quant_resolvido = 0;
  $quant_andamento = 0;
  $quant_total = 0;

  foreach ($res_chamadas_totais_novas as $key => $value) {
    $quant_novas = $value['chamada'];
  }
  foreach ($res_chamadas_totais_atrasadas as $key => $value) {
    $quant_atraso = $value['chamada'];
  }
  foreach ($res_chamadas_totais_resolvidos as $key => $value) {
    $quant_resolvido = $value['chamada'];
    
  }
  foreach ($res_chamadas_totais_andamento as $key => $value) {
    $quant_andamento = $value['chamada'];
  }
  foreach ($res_chamadas_totais as $key => $value) {
    $quant_total = $value['chamada'];
  }

  $valor_base = 4000;
  $valor = 500;

  $porcentagem_novas = ($quant_novas / $quant_total) * 100;
  $porcentagem_atraso = ($quant_atraso / $quant_total) * 100;
  $porcentagem_resolvidos = ($quant_resolvido / $quant_total) * 100;
  $porcentagem_andamento = ($quant_andamento / $quant_total) * 100;



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
                      <strong>Mariana Júlia você recebeu 2 Mensagens - Secretário Café</strong>
                    </p><br>


                    <div class="row">
                      <!-- /.col -->
                      <div class="col-md-6">
                        <div class="card card-warning">
                          <div class="card-header">
                            <h3 class="card-title">1ª Mensagem</h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                            <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <b>Solicitante: Gildete Vasconcelos - Escolar Ivo Hering ( Protocolo 1514)</b><br><br>
                            <b>Locitação</b> - Compra de caixa d´agua 1.000 litros
                            Solicitante: Maria ANdrade
                          </div>
                          <div class="card-body">
                            <b>Retorno</b> - Enviado para orçamento.
                            <b>Previsão de solução:</b> 15/05/2022
                          </div>
                          <div class="card-body">
                            <div class="card text-white bg-danger mb-3" style="text-align: left;"><b>Mensagem do Secretário Café - 15/06/2022</b></div>Porqual motivo esse chamado ainda esta aberto ? Não foi comprado a caixa d´agua ou não foi instalada ?
                          </div>
                          <button type="button" class="btn btn-primary btn-lg btn-block">Retorno</button>
<br>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->

                      <!-- /.col -->
                      <div class="col-md-6">
                        <div class="card card-warning">
                          <div class="card-header">
                            <h3 class="card-title">2ª Mensagem</h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                            <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <b>Solicitante: Gildete Vasconcelos - Escolar Ivo Hering ( Protocolo 1514)</b><br><br>
                            <b>Locitação</b> - Compra de caixa d´agua 1.000 litros
                            Solicitante: Maria ANdrade
                          </div>
                          <div class="card-body">
                            <b>Retorno</b> - Enviado para orçamento.
                            <b>Previsão de solução:</b> 15/05/2022
                          </div>
                          <div class="card-body">
                            <div class="card text-white bg-danger mb-3" style="text-align: left;"><b>Mensagem do Secretário Café - 15/06/2022</b></div>Porqual motivo esse chamado ainda esta aberto ? Não foi comprado a caixa d´agua ou não foi instalada ?
                          </div>
                          <button type="button" class="btn btn-primary btn-lg btn-block">Retorno</button>
<br>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->

                      
                    </div>


                    

                <!--div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                        <label for="customCheckbox1" class="custom-control-label">RH</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option1">
                        <label for="customCheckbox2" class="custom-control-label">Infraestrutura</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox3" value="option1">
                        <label for="customCheckbox3" class="custom-control-label">Pedagógia</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox4" value="option1">
                        <label for="customCheckbox4" class="custom-control-label">Esportes</label>
                      </div>
                      
                    </div>
                  </div>

                  <!--div class="col-sm-6">
                      <div class="form-group">
                        <label>Selecione Usuários</label>
                        <select class="custom-select">
                          <option>Mariana Brito</option>
                          <option>Antônio Pereira</option>
                          <option>Nilda Pires</option>
                          <option>Gildete Silva</option>
                          <option>Paulo Valent</option>
                        </select>
                      </div>
                    </div>
                </div-->
                  

        <!--div class="row">

          <div class="col-md-4">
            
            <div class="card card-widget widget-user-2">
              
              <div class="widget-user-header bg-secondary">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="../View/dist/img/user7-128x128.jpg" alt="User Avatar">
                </div>
                
                <h3 class="widget-user-username">Mariana Brito</h3>
                <h5 class="widget-user-desc"><b>RH</b></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <p style="text-align: center;">
                      <b>Administrativo - Operacional </b>
                    </p>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Novo(s) <span class="float-right badge bg-primary">11</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Andamento <span class="float-right badge bg-warning">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Atrasado(s) <span class="float-right badge bg-danger">5</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Finalizados <span class="float-right badge bg-success">457</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            
          </div>

          <div class="col-md-4">
            <div class="card card-widget widget-user-2">
              
              <div class="widget-user-header bg-danger">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="../View/dist/img/user2-160x160.jpg" alt="User Avatar">
                </div>
                
                <h3 class="widget-user-username">Antônio Pereira</h3>
                <h5 class="widget-user-desc"><b>Infraestrutura</b></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <p style="text-align: center;">
                      <b>Administrativo </b>
                    </p>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Novo(s) <span class="float-right badge bg-primary">1</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Andamento <span class="float-right badge bg-warning">15</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Atrasado(s) <span class="float-right badge bg-danger">7</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Finalizados <span class="float-right badge bg-success">359</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-widget widget-user-2">
              
              <div class="widget-user-header bg-info">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="../View/dist/img/user7-128x1282.jpg" alt="User Avatar">
                </div>
                
                <h3 class="widget-user-username">Nilda Pires</h3>
                <h5 class="widget-user-desc"><b>Pedagógia</b></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <p style="text-align: center;">
                      <b>Escola - Herminio Viana </b>
                    </p>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Novo(s) <span class="float-right badge bg-primary">31</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Andamento <span class="float-right badge bg-warning">5</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Atrasado(s) <span class="float-right badge bg-danger">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Finalizados <span class="float-right badge bg-success">842</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            
          </div>


         </div-->

                    <!--div class="progress-group">
                      Novos Chamados
                      <span class="float-right"><b><?php echo  $quant_novas; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo $porcentagem_novas."%" ?>"></div>
                      </div>
                    </div>
                    

                    <div class="progress-group">
                      Chamados em Atrasados
                      <span class="float-right"><b><?php echo  $quant_atraso; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?php echo $porcentagem_atraso."%" ?>"></div>
                      </div>
                    </div>

                    
                    <div class="progress-group">
                      Resolvidos
                      <span class="float-right"><b><?php echo  $quant_resolvido; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $porcentagem_resolvidos."%" ?>"></div>
                      </div>
                    </div>

                    
                    <div class="progress-group">
                      Chamados em Andamento
                      <span class="float-right"><b><?php echo  $quant_andamento; ?></b>/<?php echo  $quant_total; ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php echo $porcentagem_andamento."%" ?>"></div>
                      </div>
                    </div-->
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->



    <!-- Main content -->

    <!--section class="content">

      <div class="container-fluid">

       <div class="row">
    

            

            
         
       </div>  

    </div>

  </section-->

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



 <?php 

    include 'rodape.php';

 ?>