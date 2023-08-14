
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
     <a class="btn btn-default" onclick="pesquisa_id_carterinha_aluno()" >Imprimir selecionados</a>

  </div>
  
</div>
  <div id="resultado_carteirinha" class="grafico">
    <?php




    $idfuncionario=$_SESSION['idfuncionario'];
    $nome_aluno=$_GET['nome_aluno'];

    $idaluno=$_GET['idaluno'];

    $resultado=pesquisar_id_carteirinha_escola($conexao,$nome_aluno, $_SESSION['ano_letivo_vigente'],$idaluno);

      $result="";
      $conta=1;
    foreach ($resultado as $key => $value) {

      $nome_aluno=verificarNome($value['nome_aluno']);
      $nome_turma=($value['nome_turma']);
      $nome_escola=($value['nome_escola']);
      $id=$value['idaluno'];
      $idaluno=$value['idaluno'];
      $status_aluno=$value['status_aluno'];
      $email=$value['email'];
      $whatsapp_responsavel=$value['whatsapp_responsavel'];
      $nome_responsavel=$value['nome_responsavel'];
      $data_nascimento=converte_data($value['data_nascimento']);
     
      $matricula_aluno=$value['matricula'];
      $linha_transporte=$value['linha_transporte'];
      
      $caminho_foto_carteirinha="".$value['imagem_carteirinha_transporte'];

    if ($caminho_foto_carteirinha !="") {
        // code...
      $caminho_foto_carteirinha="imagem_carteirinha_transporte/".$caminho_foto_carteirinha;
    }else{
       $caminho_foto_carteirinha="imagens/avatar_carteirinha.png"; 

    }
    if ($conta%2!=0) {

        $result.="<br>
            <div class='row'>";
    }



        $result.="<div class='col-sm-6 div_carteirinha '>
                    <div class='row'>

                      <div class='col-sm-6' ></div>
                    
                      <div class='col-sm-6 nome_linha' >
                         LINHA: $linha_transporte
                      </div>
                    </div>

                      <div class='row'>

                    
                            
                            
                            <div class='col-sm-2 imagem_perfil' >
                              <img src='$caminho_foto_carteirinha' >
                            </div>
                            <div class='col-sm-1' ></div>
                            <div class='col-sm-9 dados_aluno'>
                                <b class='nome_aluno'>$nome_aluno</b><br>
                              <p class='outros_dados_aluno'> 
                              <b>$nome_escola</b> <br>
                              <b>TURMA: $nome_turma</b><br>
                              <b>RESPONSÁVEL: $nome_responsavel </b><br>
                              <b>DATA NASC: $data_nascimento</b><br>
                              <b>MATRÍCULA: $matricula_aluno</b><br>
                              <b>CPF/RG:</b><br>
                              <b>TIPO SANGUINEO: </b><br>
                              <b>TELEFONE: $whatsapp_responsavel</b>
                            </p>
                             

                            </div>

                      </div> 
              
                        <label class='custom-checkbox no-print'>
                            <input type='checkbox' class='no-print' name='carterinha_aluno$id' value='$id'>
                            <span class='checkmark'></span>Selecionar
                        </label>           

                </div>";            

                          
                


    if ($conta%2==0) {
       $result.="       
            </div> "; // code...
    }






       
        if ($conta%8==0) {
        $result.="<div class='pagebreak'> </div>";
        }



        $conta++;
      }

      echo "$result";
    ?>

  </div>



<?php 
    include_once 'rodape.php';
  ?>