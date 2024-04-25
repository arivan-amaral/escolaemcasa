<?php
session_start();

###################################################
if (!isset($_SESSION['idfuncionario'])) {
  //header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];

}
  include_once "cabecalho.php";
  include_once "alertas.php";
 
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Controller/Conversao.php';

  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
  include_once '../Model/Coordenador.php';

  include_once '../Model/Setor.php';
  include_once '../Model/Chamada.php';
  include_once '../Model/Escola.php';


?>

<style>
.quadro {
  background-image: url(imagens/logo_educalem_natal.png);
  background-repeat: no-repeat;

  background-position: center;
   
      background-size: 100% 100%;
}


 </style>

<style>

.checkbox-btn {
  display: inline-block;
  position: relative;
}

.checkbox-btn__label {
  display: inline-block;
  position: relative;
  font-size: 16px;
  line-height: 32px;
  padding-left: 40px;
  cursor: pointer;
}

.checkbox-btn__image {
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
  width: 32px;
  height: 32px;
  background-image: url("imagens/excel.png");
  background-size: cover;
  opacity: 0.5;
}

.checkbox-btn__image_pdf {
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
  width: 32px;
  height: 32px;
  background-image: url("imagens/pdf.png");
/*  background-size: cover;
  opacity: 0.5;*/
}

.checkbox-btn__image::before {
  content: "";
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.checkbox-btn input[type="checkbox"] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.checkbox-btn input[type="checkbox"]:checked ~ .checkbox-btn__image {
  opacity: 1;
}
</style>
 


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="ajax.js?<?php echo rand(); ?>"></script>


<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-1">
          </div>
          <div class="col-sm-12 alert alert-info">

            <h1 class="m-0"><b>

           RELATÓRIO DE ALUNO AEE</b></h1>

          </div><!-- /.col -->

          

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Inicio -Content Wrapper. Contains page content -->
  <div class="container">
 
   
   <br>
    <div class="row" hidden>
      <div class="col-sm-3" style="margin-left: 20px;" >
          <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.idaluno" id="idaluno">
          <label class="form-check-label" for="flexCheckDefault">
            ID Aluno
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.nome" id="nome" checked>
          <label class="form-check-label" for="flexCheckDefault">
            Nome
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="filiacao1" id="filiacao1">
          <label class="form-check-label" for="flexCheckDefault">
            1° Filiação
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="filiacao2" id="filiacao2">
          <label class="form-check-label" for="flexCheckDefault">
            2° Filiação
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="cartao_sus" id="cartao_sus">
          <label class="form-check-label" for="flexCheckDefault">
            Cartão Sus
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.whatsapp" id="whatsapp" checked>
          <label class="form-check-label" for="flexCheckDefault">
            Whatsapp
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.whatsapp_responsavel" id="whatsapp_responsavel">
          <label class="form-check-label" for="flexCheckDefault">
            Whatsapp do Responsável
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.bairro_endereco" id="bairro">
          <label class="form-check-label" for="flexCheckDefault">
            Bairro
          </label>
        </div>
         <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.endereco" id="endereco">
          <label class="form-check-label" for="flexCheckDefault">
            Endereço
          </label>
        </div>
        <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="escola.nome_escola" id="nome_escola" checked>
          <label class="form-check-label" for="flexCheckDefault">
            Nome da Escola
          </label>
        </div>
        <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="turma.nome_turma" id="nome_turma" checked>
          <label class="form-check-label" for="flexCheckDefault">
            Nome da Turma
          </label>
        </div>
        <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.bolsa_familia" id="bolsa_familia">
          <label class="form-check-label" for="flexCheckDefault">
            Recebe Bolsa Familia
          </label>
        </div>
        <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.data_nascimento" id="data_nascimento"checked>
          <label class="form-check-label" for="flexCheckDefault">
            Data de Nascimento
          </label>
        </div>

        <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.cpf" id="cpf">
          <label class="form-check-label" for="flexCheckDefault">
            Cpf Aluno
          </label>
        </div>        

        <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.cep_endereco" id="cep_endereco">
          <label class="form-check-label" for="flexCheckDefault">
            Cep
          </label>
        </div>

        <div class="form-check" style="display: none;">
          <input class="form-check-input" type="checkbox" value="aluno.raca_aluno" id="raca_aluno">
          <label class="form-check-label" for="flexCheckDefault">
            Raça
          </label>
        </div>
      </div>
      
        <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">ESPECIAL</label>
           <select class="form-control"  id="necessidade_especial" name="necessidade_especial" >
             <option value='sim'>Sim </option>
           </select> 
          </div>
        </div>         

        <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">SEXO</label>
           <select class="form-control"  id="sexo" name="sexo" >
             <option value='todos'>Todos</option>
             <option value='M'>Masculino</option>
             <option value='F'>Feminino</option>
           </select> 
          </div>
        </div>  

        <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">Ordenação</label>
           <select class="form-control"  id="ordenacao" name="ordenacao" >
             <option value='turma.nome_turma'>Nome Turma</option>
             <option value='aluno'>Nome aluno</option>
             <option value='endereco'>Endereço</option>
        
           </select> 
          </div>
        </div> 

        
        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">ESCOLA</label>
           <select class="form-control select2"  id="escola" name="escola" >
            <!-- <option value="Todas">TODAS</option> -->
            <?php  
       
              $res_escola= escola_associada($conexao,$idcoordenador);
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

              echo "$lista_escola_associada";

            ?>
            
          
           </select> 
          </div>
        </div> 

        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">Operador Idade</label>
           <select class="form-control"  id="operacao_cond_idade" name="operacao_cond_idade" >
             
            <option value=">=">Idade maior ou igual</option>
            <option value="<=">Idade menor ou igual</option>
            <option value="=">Idade igual</option>
                      
           </select> 
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">Idade</label>
           <input class="form-control"  type="number" id="operacao_idade" name="operacao_idade" value="1">  
          </div>
        </div>


        <div class="col-sm-4">
          <br>
          <div class="checkbox-btn">
            <input type="checkbox" id="baixar_excel" name="baixar_excel">
            <label for="baixar_excel" class="checkbox-btn__label">
              <span class="checkbox-btn__image"></span>
              Baixar em excel?
            </label>
          </div>

        </div>
        <div class="col-sm-4">
        
          <div class="checkbox-btn">
        
           <br>
              <a href=""><img src="imagens/pdf.png" alt="" width="40" height="40"> Baixar em pdf</a>
             
           
          </div>

        </div>

        <div class="col-sm-10">
          <div class="form-group">
          <a style="margin-top: 30PX;" class="btn btn-block btn-primary" onclick="pesquisa_relatorio_filtros()">Pesquisar</a>
          </div>
        </div>
      </div>
  <br>
  <div class="table-responsive" id="resultado">
 
  </div>
  
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
            
</div>

<script type="text/javascript">
  const checkboxBtn = document.querySelector('.checkbox-btn input[type="checkbox"]');

  checkboxBtn.addEventListener('change', () => {
    const checkboxImage = checkboxBtn.parentNode.querySelector('.checkbox-btn__image');
    if (checkboxBtn.checked) {
      checkboxImage.style.opacity = 1;
    } else {
      checkboxImage.style.opacity = 0.5;
    }
  });

</script>
 <?php 

    include_once 'rodape.php';

 ?>