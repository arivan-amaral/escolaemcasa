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

$idfuncionario=$_SESSION['idfuncionario'];


 $res_escola= escola_associada($conexao,$idfuncionario);
  $lista_escola_associada=""; 
$sql_escolas="AND ( escola_id = -1 ";
$sql_escolas_enviada="AND ( escola_id_origem = -1 ";
foreach ($res_escola as $key => $value) {
    $id=$value['idescola'];
   $nome_escola=($value['nome_escola']);
    $sql_escolas.=" OR escola_id = $id ";
    $sql_escolas_enviada.=" OR escola_id_origem = $id ";

    $lista_escola_associada.= "
         <option value='$id'>$nome_escola </option>

     ";
}


?>
<style type="text/css">

    .nome_linha{
      margin-top: 1mm;
      color: white;
      font-size: 1.5em;
      font-weight: bold;
    }

  .div_carteirinha b{
    color: black;
    text-transform: uppercase;
  }
    .dados_aluno {
      margin-top: 3mm;    
    }

    .dados_aluno b{
      color: white;
    }    

    .content-wrapper{
      background-color: white;
    }

    .div_carteirinha{
      border-radius: 5%;
      width: 135.6mm;
      height: 83.98mm ;
      background-image: url("imagens/2023.png");
  
      background-size: 480px;
      background-repeat: no-repeat;

    }

    .imagem_perfil img{
      margin-left: 3mm;

      margin-right:2px ;
      border: 2px solid white;
      border-radius: 10%;
      width: 27.6mm;
      height: 38.98mm ;
 
    }

    .imagem_perfil{
/*      border: 2px solid white;*/
      border-radius: 10%;

      margin-top: 7mm;
      width: 105.6mm;
      height: 40.98mm ;
/*      background-color: #a7a7a7;*/
      font-size: 16px;
      background-size: contain;
      background-repeat: no-repeat;

    }


.outros_dados_aluno br {

    display: block;
    margin: -12px 0px 3px 40px;
    height: 8px;
    content: "A";

}

p.outros_dados_aluno {

font-size: 8pt;     

   
}

.validade {
 padding: 15px 0px 0px 20px;
font-size: 12pt;     

}
.nome_aluno {
font-size: 18pt;     

}

   

@media print {
  .no-print, .no-print *
  {
      display: none !important;
  }
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */

  .grafico {
    display: block;
  }
 }



body {
  font-family: Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  background-color: #f0f0f0;
}

.custom-checkbox {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 18px;
  user-select: none;
}

.custom-checkbox input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #fff;
  border: 2px solid #e74c3c;
  border-radius: 50%;
}

.custom-checkbox input:checked ~ .checkmark {
  background-color: #e74c3c;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.custom-checkbox input:checked ~ .checkmark:after {
  display: block;
}

.custom-checkbox .checkmark:after {
  left: 9px;
  top: 5px;
  width: 6px;
  height: 12px;
  border: solid white;
  border-width: 0 3px 3px 0;
  transform: rotate(45deg);
}

</style>

<script src="ajax.js?<?php echo rand(); ?>"></script>

<div class="content-wrapper" style="min-height: 529px;">
 
    <div class="row no-print">

      <div class="col-md-1"></div>
      <div class="col-md-5">
   
        <div class="form-group">
 
          <label for="exampleInputEmail1">Escolha a escola</label>
               
          <select class="form-control form-lg select2" id="idescola" onchange="listar_turma_escola_carterinha();" required="">
              
              <?php 
                echo "$lista_escola_associada";

              ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
          <label for="exampleInputEmail1">Escolha a turma</label>
          <select class="form-control form-lg select2" id="turma_carterinha"  required="">
          </select>

      </div>

  <div class="col-md-2">
          <br>
              <a class="btn btn-primary" onclick="lista_carteirinha_escola();">Buscar</a>


      </div>



  </div>
 
  <div class="no-print">
    <center>OU</center>
  </div>
  <br>
  <div class="row no-print">
    
    <div class="col-md-1"></div>
    <div class="col-md-7">
          <input class="form-control " id="nome_aluno" placeholder="Pesquisar por nome do aluno">
      
    </div>
    <div class="col-md-3">
         
                <a class="btn btn-warning" onclick="pesquisar_por_nome_carteirinha_escola();">Buscar Por nome</a>


        </div>
  </div>
<br>
<br>
<div class="row no-print">
  <div class="col-md-1"></div>
  <div class="col-md-3">
     <a class="btn btn-danger"  >Excluir selecionados</a>

  </div>  

  <div class="col-md-3">
     <a class="btn btn-default"  >Imprimir selecionados</a>

  </div>
  
</div>
  <div id="resultado_carteirinha" class="grafico">
    

  </div>


<script type="text/javascript">
  setTimeout(lista_carteirinha_escola(), 100);
  setTimeout(listar_turma_escola_carterinha(), 150);
</script>

<?php 
    include_once 'rodape.php';
  ?>