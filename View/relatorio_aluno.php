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
          <div class="col-sm-12 alert alert-warning">

            <h1 class="m-0"><b>

           <?php
              if (isset($nome_escola_global)) {
                echo $_SESSION['NOME_APLICACAO']; 
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Inicio -Content Wrapper. Contains page content -->
  <div class="container">
  <h2>RELATÓRIO DE ALUNO</h2>

  <div class="row">
  <div class="col-sm-2" style="margin-left: 20px;">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.idaluno" id="idaluno">
      <label class="form-check-label" for="idaluno">
        ID Aluno
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.nome" id="nome">
      <label class="form-check-label" for="nome">
        Nome
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="filiacao1" id="filiacao1">
      <label class="form-check-label" for="filiacao1">
        1° Filiação
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="filiacao2" id="filiacao2">
      <label class="form-check-label" for="filiacao2">
        2° Filiação
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="cartao_sus" id="cartao_sus">
      <label class="form-check-label" for="cartao_sus">
        Cartão Sus
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.tamanho_uniforme" id="tamanho_uniforme">
      <label class="form-check-label" for="tamanho_uniforme">
        Uniforme
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.whatsapp" id="whatsapp">
      <label class="form-check-label" for="whatsapp">
        Whatsapp
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.whatsapp_responsavel" id="whatsapp_responsavel">
      <label class="form-check-label" for="whatsapp_responsavel">
        Whatsapp do Responsável
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.raca_aluno" id="raca_aluno">
      <label class="form-check-label" for="raca_aluno">
        Raça
      </label>
    </div>
  </div>

  <div>
    <!-- Segunda coluna -->
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.bairro_endereco" id="bairro">
      <label class="form-check-label" for="bairro">
        Bairro
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.endereco" id="endereco">
      <label class="form-check-label" for="endereco">
        Endereço
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="escola.nome_escola" id="nome_escola">
      <label class="form-check-label" for="nome_escola">
        Nome da Escola
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="turma.nome_turma" id="nome_turma">
      <label class="form-check-label" for="nome_turma">
        Nome da Turma
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.bolsa_familia" id="bolsa_familia">
      <label class="form-check-label" for="bolsa_familia">
        Recebe Bolsa Familia
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.data_nascimento" id="data_nascimento">
      <label class="form-check-label" for="data_nascimento">
        Data de Nascimento
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.cpf" id="cpf">
      <label class="form-check-label" for="cpf">
        CPF Aluno
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.numero_nis" id="numero_nis">
      <label class="form-check-label" for="numero_nis">
        NIS
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="aluno.cep_endereco" id="cep_endereco">
      <label class="form-check-label" for="cep_endereco">
        CEP
      </label>
    </div>
  </div>
</div>
<br>

        <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">ESPECIAL</label>
           <select class="form-control"  id="necessidade_especial" name="necessidade_especial" >
             <option value='todos'>Ambos</option>
             <option value='sim'>Sim </option>
             <option value='nao'>Não</option>
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

        <div class="col-sm-8">
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