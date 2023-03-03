<?php
session_start();

include_once '../Model/Conexao.php';
include_once "cabecalho.php";
include_once "alertas.php";

include_once "barra_horizontal.php";
include_once 'menu.php';
include_once '../Controller/Conversao.php';
include_once '../Model/Escola.php';
include_once '../Model/Turma.php';
include_once '../Model/Serie.php';
include_once '../Model/Coordenador.php';
include_once '../Model/Aluno.php';
include_once '../Model/Estado.php';
?>
<style type="text/css">


  .div_carteirinha b{
    color: black;
    text-transform: uppercase;
  }
    .dados_aluno {
      margin-top: 15mm;    
    }

    .dados_aluno b{
      color: white;
    }    

    .content-wrapper{
      background-color: white;
    }

    .div_carteirinha{
      width: 135.6mm;
      height: 83.98mm ;
      background-image: url("imagens/carteirinha.png");
      font-size: 16px;
      background-size: contain;
      background-repeat: no-repeat;

    }
    .imagem_perfil img{
      margin-right:1px ;
      border: 2px solid white;
      border-radius: 10%;
      width: 27.6mm;
      height: 38.98mm ;
 
    }

    .imagem_perfil{
      border: 2px solid white;
      border-radius: 10%;

      margin-top: 15mm;
      width: 105.6mm;
      height: 40.98mm ;
      background-color: #a7a7a7;
      font-size: 16px;
      background-size: contain;
      background-repeat: no-repeat;

    }

@media print {

    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
  }

</style>

<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">
 
        <div class="row">
            <div class="col-sm-12  ">
                <h1 class="m-1">CARTEIRINHA DE TRANSPORTE </h1>

            </div>

           
        </div>



<?php for ($i=1; $i <100 ; $i++) { 
?>

        <br>
        <div class="row">
            <div class="col-sm-5 div_carteirinha ">
                  <div class="row">

                        <div class="col-sm-1"></div>
                        
                        <div class="col-sm-3 imagem_perfil" >
                          <img src="imagens/avatar_carteirinha.png" alt="">
                        </div>
                        
                        <div class="col-sm-8 dados_aluno">
                          <b class="nome_aluno">ARIVAN DO AMARAL LISBOA</b><br>
                          <b  class="outros_dados_aluno">RESPONSÁVEL:</b><br>
                          <b  class="outros_dados_aluno">DATA NASC:</b><br>
                          <b  class="outros_dados_aluno">MATRÍCULA:</b><br>
                          <b  class="outros_dados_aluno">CPF/RG:</b><br>
                          <b  class="outros_dados_aluno">TIPO SANGUÍNHO:</b><br>
                          <b class="outros_dados_aluno">TELEFONE:</b><br>

                        </div>

                  </div>
                       

            </div>             
            
            <div class="col-sm-1 "></div>

            <div class="col-sm-5 div_carteirinha ">
                  <div class="row">

                        <div class="col-sm-1"></div>
                        
                        <div class="col-sm-3 imagem_perfil" >
                          <img src="imagens/avatar_carteirinha.png" alt="">
                        </div>
                        
                        <div class="col-sm-8 dados_aluno">
                          <b >RESPONSÁVEL:</b><br>
                          <b>DATA NASC:</b><br>
                          <b>MATRÍCULA:</b><br>
                          <b>CPF/RG:</b><br>
                          <b>TIPO SANGUÍNHO:</b><br>
                          <b>TELEFONE:</b><br>

                        </div>

                  </div>
                       

            </div> 


            
        </div>     



    <?php 
    if ($i%4==0) {
     echo "<div class='pagebreak'> </div>";
    }
  }
    include_once 'rodape.php';
  ?>