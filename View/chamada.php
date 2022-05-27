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



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

       <div class="row">
            <!-- small card -->
            <?php
            //------------------------Verificar Atrasos de Novos cadastros-------------------
                  $res_atualizar_chamado = buscar_chamada($conexao,11);
                  foreach ($res_atualizar_chamado as $key => $value) {
                    $id_chamado = $value['id'];
                    $data_previsão = new DateTime();
                    $res_verificar_chat_chamado = pesquisa_chat($conexao,$id_chamado);
                    foreach ($res_verificar_chat_chamado as $key => $value) {
                      $data_previsão = new DateTime($value['data']);  
                    }
                    
                    $data = new datetime('now');
                      if ($data_previsão < $data) {
                      $intvl = $data_previsão->diff($data);
                      if ($intvl->days > 2) {
                        $quant_dias = 0;
                        for ($i=1; $i < 4; $i++) { 
                          $data_especifica = date('d-m-Y',strtotime("+ $i days", strtotime('$data_previsão')));
                          $diasemana_numero = date('w',strtotime('$data_especifica'));
                          if ($diasemana_numero == 0 || $diasemana_numero == 6) {}else{
                            $quant_dias +=1;
                          }
                        }
                        if ($quant_dias >= 3) {
                          atualizar_chamado($conexao,$id_chamado);
                        }
                      }


                      }
                  }

                  $res_atualizar_chamado = buscar_chamada_em_andamento($conexao,11);
                  foreach ($res_atualizar_chamado as $key => $value) {
                    $id_chamado = $value['id'];
                    $jarespondeu = $value['func_respondeu_id'];
                    $data_previsão = new DateTime($value['data_previsao']);  
                    $data = new datetime('now');
                    if ($jarespondeu > 0) {
                      if ($data_previsão < $data) {
                      $intvl = $data_previsão->diff($data);
                      if ($intvl->days > 0) {
                        $quant_dias = 0;
                        for ($i=1; $i < 2; $i++) { 
                          $data_especifica = date('d-m-Y',strtotime("+ $i days", strtotime('$data_previsão')));
                          $diasemana_numero = date('w',strtotime('$data_especifica'));
                          if ($diasemana_numero == 0 || $diasemana_numero == 6) {}else{
                            $quant_dias +=1;
                          }
                        }
                        if ($quant_dias >= 1) {
                          atualizar_chamado($conexao,$id_chamado);
                        }
                      }


                      }
                    }
                    
                  }
                  //----------------------------------------------------------
              // escola cadastrada
                $id_escola = 0;
                $quantidade_pendente_escola = 0 ;
                $quantidade_atraso_escola = 0 ;
                $quantidade_tota_escolal = 0 ;
                $quantidade_andamento_escola = 0 ;
                $quantidade_resolvidos_escola = 0 ;

                $res_id_escola = buscar_id_escola($conexao,$_SESSION['idfuncionario']);
                foreach ($res_id_escola as $key => $value) {
                  $id_escola = $value['escola_id'];
                }
    
                $res_quant_escola = quantidade_chamada_pendente_escola($conexao,11,$id_escola);
                foreach ($res_quant_escola as $key => $value) {
                  $quantidade_pendente_escola = $value['chamada'];
                }
                $res_quant2_escola = quantidade_chamada_total_escola($conexao,11,$id_escola);
                foreach ($res_quant2_escola as $key => $value) {
                  $quantidade_total_escola = $value['chamada'];
                }
                $res_quant3_escola = quantidade_chamada_finalizadas_escola($conexao,11,$id_escola);
                foreach ($res_quant3_escola as $key => $value) {
                  $quantidade_resolvidos_escola = $value['chamada'];
                }
                $res_quant4_escola = quantidade_chamada_andamento_escola($conexao,11,$id_escola);
                foreach ($res_quant4_escola as $key => $value) {
                  $quantidade_andamento_escola = $value['chamada'];
                }
                $res_quant5_escola = quantidade_chamada_atraso_escola($conexao,11,$id_escola);
                foreach ($res_quant5_escola as $key => $value) {
                  $quantidade_atraso_escola = $value['chamada'];
                }
                echo "<div class='col-sm-4'>
                        <div class='card bg-light mb-3' style='max-width: 20rem;' align='center'>
                          <div class='card-header'>
                            <!--h3 class='text-center'>Setor: </h3-->
                            <h3 class='text-center' style='background-color: #E5E7E9'>
                            <strong>Minha Escola</strong></h3>
                            
                            <h4 class='text-center'>
                              Total de Chamados: $quantidade_total_escola
                            </h4>
                       
                            <p class='btn btn btn-primary' >$quantidade_pendente_escola
                            &nbsp;&nbsp; Novos Chamados &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;</p><br>
                            <p class='btn btn btn-warning'>$quantidade_andamento_escola 
                            &nbsp;&nbsp; Em Andamento &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br>
                            <p class='btn btn btn-danger'>$quantidade_atraso_escola
                            &nbsp;&nbsp; Atrasados&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;</p><br>
                            <p class='btn btn btn-success'>$quantidade_resolvidos_escola
                            &nbsp;&nbsp; Chamados Resolvidos</p> 
                          </div>

                          <form method='POST' action='lista_chamada.php'>
                            <input type='hidden' name='setor' id='setor' value='11'>
                            <input type='hidden' name='escola' id='escola' value='$id_escola'>
                            <button class='btn btn-block btn-light'>
                              Ver Chamadas 
                            </button>
                          </form>
                        </div>
                      </div>";
                
                
              
              // setores cadastrados
              $res_setores = buscar_setor_funcionario($conexao,$_SESSION['idfuncionario']);
              foreach ($res_setores as $key => $value) {
                $quantidade_pendente = 0 ;
                $quantidade_atraso = 0 ;
                $quantidade_total = 0 ;
                $quantidade_andamento = 0 ;
                $quantidade_resolvidos = 0 ;
                $setor_id = $value['setor_id'];
                $res_setor = buscar_setor_id($conexao,$setor_id);
                foreach ($res_setor as $key => $value) {
                  $id_setor = $value['id'];
                  $nome = $value['nome'];
                  //------------------------Verificar Atrasos-------------------
                  $res_atualizar_chamado = buscar_chamada($conexao,$setor_id);
                  foreach ($res_atualizar_chamado as $key => $value) {
                    $id_chamado = $value['id'];
                    $data_previsão = new DateTime();
                    $res_verificar_chat_chamado = pesquisa_chat($conexao,$id_chamado);
                    foreach ($res_verificar_chat_chamado as $key => $value) {
                      $data_previsão = new DateTime($value['data']);  
                    }
                    
                    $data = new datetime('now');
                      if ($data_previsão < $data) {
                      $intvl = $data_previsão->diff($data);
                      if ($intvl->days > 2) {
                        $quant_dias = 0;
                        for ($i=1; $i < 4; $i++) { 
                          $data_especifica = date('d-m-Y',strtotime("+ $i days", strtotime('$data_previsão')));
                          $diasemana_numero = date('w',strtotime('$data_especifica'));
                          if ($diasemana_numero == 0 || $diasemana_numero == 6) {}else{
                            $quant_dias +=1;
                          }
                        }
                        if ($quant_dias >= 3) {
                          atualizar_chamado($conexao,$id_chamado);
                        }
                      }


                      }
                  }

                  $res_atualizar_chamado = buscar_chamada_em_andamento($conexao,$setor_id);
                  foreach ($res_atualizar_chamado as $key => $value) {
                    $id_chamado = $value['id'];
                    $jarespondeu = $value['func_respondeu_id'];
                    $data_previsão = new DateTime($value['data_previsao']);  
                    $data = new datetime('now');
                    if ($jarespondeu > 0) {
                      if ($data_previsão < $data) {
                      $intvl = $data_previsão->diff($data);
                      if ($intvl->days > 0) {
                        $quant_dias = 0;
                        for ($i=1; $i < 2; $i++) { 
                          $data_especifica = date('d-m-Y',strtotime("+ $i days", strtotime('$data_previsão')));
                          $diasemana_numero = date('w',strtotime('$data_especifica'));
                          if ($diasemana_numero == 0 || $diasemana_numero == 6) {}else{
                            $quant_dias +=1;
                          }
                        }
                        if ($quant_dias >= 1) {
                          atualizar_chamado($conexao,$id_chamado);
                        }
                      }


                      }
                    }
                  }
                  //----------------------------------------------------------
                  $res_quant = quantidade_chamada_pendente($conexao,$id_setor);
                  foreach ($res_quant as $key => $value) {
                    $quantidade_pendente = $value['chamada'];
                  }
                  $res_quant2 = quantidade_chamada_total($conexao,$id_setor);
                  foreach ($res_quant2 as $key => $value) {
                    $quantidade_total = $value['chamada'];
                  }
                  $res_quant3 = quantidade_chamada_finalizadas($conexao,$id_setor);
                  foreach ($res_quant3 as $key => $value) {
                    $quantidade_resolvidos = $value['chamada'];
                  }
                  $res_quant4 = quantidade_chamada_andamento($conexao,$id_setor);
                  foreach ($res_quant4 as $key => $value) {
                    $quantidade_andamento = $value['chamada'];
                  }
                  $res_quant5 = quantidade_chamada_atraso($conexao,$id_setor);
                  foreach ($res_quant5 as $key => $value) {
                    $quantidade_atraso = $value['chamada'];
                  }
                  echo "<div class='col-sm-4'>
                          <div class='card bg-light mb-3' style='max-width: 20rem;' align='center'>
                            <div class='card-header'>
                              <!--h3 class='text-center'>Setor: </h3-->
                              <h3 class='text-center' style='background-color: #E5E7E9'>
                              <strong>$nome</strong></h3>
                              
                              <h4 class='text-center'>
                                Total de Chamados: $quantidade_total
                              </h4>
                         
                              <p class='btn btn btn-primary' >$quantidade_pendente
                              &nbsp;&nbsp; Novos Chamados &nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;&nbsp;&nbsp;</p><br>
                              <p class='btn btn btn-warning'>$quantidade_andamento 
                              &nbsp;&nbsp; Em Andamento &nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br>
                              <p class='btn btn btn-danger'>$quantidade_atraso
                              &nbsp;&nbsp; Atrasados&nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;</p><br>
                              <p class='btn btn btn-success'>$quantidade_resolvidos
                              &nbsp;&nbsp; Chamados Resolvidos</p> 
                            </div>

                            <form method='POST' action='lista_chamada.php'>
                              <input type='hidden' name='setor' id='setor' value='$id_setor'>
                              <button class='btn btn-block btn-light'>
                                Ver Chamadas 
                              </button>
                            </form>
                          </div>
                        </div>";
                
                }
              }
            ?>
            

            
         
       </div>  

    </div>

  </section>

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