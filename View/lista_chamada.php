<?php 
session_start();
if (!isset($_SESSION['idfuncionario'])) {
 header("location:index.php?status=0");

}else{

  $idcoordenador=$_SESSION['idfuncionario'];
  $idfuncionario=$_SESSION['idfuncionario'];

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
include_once '../Model/Setor.php';
include_once '../Model/Chamada.php';

 $escola_id= $_GET['escola'];

 

 if (isset($_GET['setor'])) {
  $setor_id=$_GET['setor'];
 }else{
  $setor_id='';
 }


if (isset($_GET['status'])) {
  $status=$_GET['status'];
}else{
  $status='';
}

 $nome_setor = "";
 $quant_total = 0;
 $quant_finalizada = 0;
 $res_quantidade_resolvida = quantidade_chamada_finalizadas($conexao,$setor_id);
 foreach ($res_quantidade_resolvida as $key => $value) {
   $quant_finalizada = $value['chamada'];
 }
 $res_quantidade_total =  quantidade_chamada_total($conexao,$setor_id);
 foreach ($res_quantidade_total as $key => $value) {
   $quant_total = $value['chamada'];
 }
 $res_nome_setor = buscar_setor_id($conexao,$setor_id);
 foreach ($res_nome_setor as $key => $value) {
   $nome_setor = $value['nome'];
 }
?>

 

<script src="ajax.js?<?php echo rand(); ?>"></script>



<div class="content-wrapper" >

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <!-- update by Rivaldo / alert-danger  -->
        <div class="col-sm-12 alert alert-primary"> 
          <center>
            <h1 class="m-0"><b>
        <?php  echo"$nome_setor - $quant_total Chamados "; ?>
         </b></h1>
        </center>

      </div><!-- /.col -->

      

    </div><!-- /.row -->

  </div><!-- /.container-fluid -->
</div>

<!-- /.content-header -->




<!-- Main content -->

<section class="content">

<div class="container-fluid">

      <?php 
echo "
    <div class='row g-2'>
        <div class='col-md-2 col-sm-6'>
            <a href='#' class='btn btn-primary w-100' onclick=listar_chamados('$setor_id','esperando_resposta') >
                $quantidade_pendente &nbsp;&nbsp; Novos Chamados
            </a>
        </div>
        <div class='col-md-2 col-sm-6'>
            <a  class='btn btn-warning w-100' onclick=listar_chamados('$setor_id','em_andamento') >
                $quantidade_andamento &nbsp;&nbsp; Em Andamento
            </a>
        </div>
        <div class='col-md-2 col-sm-6'>
            <a href='#' class='btn btn-danger w-100' onclick=listar_chamados('$setor_id','atrasado') >
                $quantidade_atraso &nbsp;&nbsp; Atrasados
            </a>
        </div>
        <div class='col-md-2 col-sm-6'>
            <a  class='btn btn-success w-100' onclick=listar_chamados('$setor_id','finalizado') >
                $quantidade_resolvidos &nbsp;&nbsp; Chamados Resolvidos
            </a>
        </div>
 
    </div>
";



       ?>
<div class='card-body'>
  <table class='table table-bordered'>
    <thead>
       <tr>
         <th style="text-align: center;">Status</th>
         <th>Informações</th>
         <th>Opção</th>

       </tr>
     </thead>
     <tbody id="tabela_chamados">
    
    </tbody>
  </table>
  <br>

    </div>
  </div>
</div>


</div>

</section>

</div>
<script type="text/javascript">
  window.onload = function() {
    setTimeout(function() {
      listar_chamados(<?php echo $setor_id; ?>, <?php echo $status; ?>);
    }, 100);
  };
</script>

<?php 

include_once 'rodape.php';

?>