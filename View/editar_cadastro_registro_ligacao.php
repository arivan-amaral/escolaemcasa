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

  $idcoordenador=$_SESSION['idfuncionario'];

}
  $idcoordenador=$_SESSION['idfuncionario'];
  include_once "cabecalho.php";
  include_once "alertas.php";
 
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  include_once '../Controller/Conversao.php';

  include_once '../Model/Conexao.php';

  include_once '../Model/Setor.php';
  include_once '../Model/Chamada.php';
  include_once '../Model/Escola.php';
  include_once '../Model/Turma.php';
  include_once '../Model/Coordenador.php';

if ($_COOKIE['dia_doservidor_publico2']<2 && date("m-d")=="10-28") {
?>
    <script>
     function dia_doservidor_publico(){
         Swal.fire({
           title: "Parabéns!",
           imageUrl: 'dia_doservidor_publico.png',
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

              echo " ( ".$_SESSION['idfuncionario'].")".$_SESSION['nome'];  

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
  <h2>CADASTRAR <span class="text-danger">NOVO</span> REGISTRO DE LIGAÇÃO</h2>
   
<?php 
$idbusca_ativa=$_GET['id'];


$res=$conexao->query("SELECT COUNT(*) AS quantidade_ligacao,
  escola_id,
  periodo_inicial,
  periodo_final,
  turma_id,
   aluno_id,
  busca_ativa.id, descricao_chamada,quem_atendeu,
 aluno.nome as nome_aluno , quantidade_faltas , escola.nome_escola as nome_escola, turma.nome_turma, busca_ativa.ficai
    FROM busca_ativa, registro_ligacao_busca_ativa,escola,aluno,turma,funcionario WHERE
    registro_ligacao_busca_ativa.busca_ativa_id = busca_ativa.id and 
busca_ativa.escola_id = escola.idescola and 
registro_ligacao_busca_ativa.funcionario_id=funcionario.idfuncionario and 
busca_ativa.turma_id = turma.idturma and 
busca_ativa.aluno_id= aluno.idaluno and busca_ativa.id = $idbusca_ativa ORDER by busca_ativa.id desc LIMIT 500");



foreach ($res as $key => $value) {
  $id=$value['id'];
  $quantidade_ligacao=$value['quantidade_ligacao'];

    $idaluno=$value['aluno_id'];
    $idescola=$value['escola_id'];
    $idturma=$value['turma_id'];
    $nome_aluno=$value['nome_aluno'];
  $quantidade_faltas=$value['quantidade_faltas'];
    $nome_escola=$value['nome_escola'];
    $nome_turma=$value['nome_turma'];
    $ficai=$value['ficai'];
    $descricao_chamada=$value['descricao_chamada'];
    $quem_atendeu=$value['quem_atendeu'];
    $data_inicial=$value['periodo_inicial'];
    $data_final=$value['periodo_final'];

    if ($ficai==1) {
       $ficai="SIM";
    }else{
       $ficai="Não";

    }
  }
?>

<form action="../Controller/Cadastrar_novo_registro_ligacao.php" method="post">
  

        <div class="row">
   
        <div class="col-sm-2">
           <label for="exampleInputEmail1">ID</label><br>
        
           <input type="text"  class="form-control"  name="idaluno" value="<?php echo $idaluno ?>" readonly  >  
           <input type="text"  class="form-control"  name="escola_id" value="<?php echo $idescola ?>" readonly  >  
           <input type="text"  class="form-control"  name="turma_id" value="<?php echo $idturma ?>" readonly  >  
           <input type="text"  class="form-control"  name="busca_ativa_id" value="<?php echo $idbusca_ativa ?>" readonly  >  
          </div>       
          <div class="col-sm-6">
           <label for="exampleInputEmail1">Aluno</label><br>
        
           <input type="text" class="form-control"  name="nome_aluno" value="<?php echo $nome_aluno ?>" readonly  >  
          </div>
        </div>
        <div class="row">

 
        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">Período inicial</label>
           <input type="date" class="form-control"  name="data_inicial" value="<?php echo $data_inicial ?>" readonly> 
          </div>
        </div>  

        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">Período final</label>
           <input type="date" class="form-control"  name="data_final" value="<?php echo $data_final ?>" readonly> 
          </div>
        </div>  
              
        <div class="col-sm-2">
          <div class="form-group">
           <label for="exampleInputEmail1">Quantidade faltas</label>
           <input type="text" class="form-control"  name="quantidade_faltas" value="<?php echo $quantidade_faltas ?>" readonly> 
          </div>
        </div>        

        <div class="col-sm-3">
          <div class="form-group">
           <label for="exampleInputEmail1">DATA HORA LIGAÇÃO</label>
           <input type="datetime" class="form-control"  name="quantidade_fadataltas" value="<?php echo date("Y-m-d H:i:s") ?>" readonly> 
          </div>
        </div>
      
    </div>
    <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
           <label for="exampleInputEmail1">Quem atendeu</label>
           <input class="form-control"  name="quem_atendeu" > 
          </div>
        </div> 
    </div>

        <div class="col-sm-4">
          <div class="form-group">
           <label for="exampleInputEmail1">Descrição da chamada</label>
           <textarea class="form-control"  name="descricao_chamada" ></textarea>
          </div>
        </div> 
    </div>


    <div class="row">
        <!-- <div class="col-sm-1"></div> -->
        <div class="col-sm-4">
           <label for="exampleInputEmail1">Busca exitosa</label><br>
        
           Sim<input type="radio"   name="exitosa" value="1" checked >  
           Não<input type="radio"   name="exitosa" value="0">  
          </div>
        </div>     
<br>
<br>
<br>
        <div class="row">
        <!-- <div class="col-sm-1"></div> -->
<?php 
if ($quantidade_ligacao >=3) {
?>
        <div class="col-sm-4">
           <label for="exampleInputEmail1" class="text-danger">FICAI</label><br>
        
           Sim<input type="radio"   name="ficai" value="1"  >  
           Não<input type="radio"   name="ficai" value="0" checked>  
          </div>

<?php } ?>

        </div> 

<br>
<br>
<br>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
               <button  type="submit" class="btn btn-block btn-success">Enviar</button>

           </div>
          </div>
          
        </div>

        
    </div>

 
            
</div>
 
 
</form>

 
 <?php 

    include_once 'rodape.php';

 ?>