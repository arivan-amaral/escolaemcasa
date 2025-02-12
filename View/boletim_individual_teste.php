<?php 
// header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
//  exit; 
session_start();
  include"../Controller/Conversao.php";
  include"../Model/Conexao.php";
  include"../Model/Aluno.php";
  include"../Model/Escola.php";
  include"../Model/Turma.php";
  include"../Model/Professor.php";

  include"boletim_maternall_II.php";
   include"boletim_serie_1ano_id_3.php";

  include"boletim_fundamental_II_teste.php.php";
  // include"boletim_fundamental_II_novo.php";
  include"../Controller/Cauculos_notas.php";

include_once"cabecalho_boletim.php";

  
  

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$idaluno=$_GET['idaluno'];
$numero=$_GET['numero'];
$nome_aluno=$_GET['nome_aluno'];
$nome_escola=$_GET['nome_escola'];
$nome_turma=$_GET['nome_turma'];

if (isset($_GET['ano'])) {
  $ano_letivo = $_GET['ano'];

}else{
  $ano_letivo = $_SESSION['ano_letivo'];

}

?>


<p class="no-print">
  <br>
  <br>
  
<a href='#'class="btn btn-block btn-primary " onclick='print();'>IMPRIMIR</a> 

</p>


<?php
  $nome_professor= "";
if ($idserie==3) {


  $res=listar_nome_professor_turma($conexao,$idaluno,$ano_letivo);
  $conta_virgula=0;
  foreach ($res as $key => $value) {
    if($conta_virgula>0){
      $nome_professor.= ", ";
    }
   $nome_professor.= $value['nome_professor'];
   $conta_virgula++;
  }
  $nome_professor.= ".";

     boletim_1ano($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno, $nome_escola,$nome_turma,$nome_professor,$ano_letivo);
 
}else if ($idserie >3 && $idserie <8) {
   boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$ano_letivo);


}else if ($idserie<3){


        $res=listar_nome_professor_turma($conexao,$idaluno,$ano_letivo);
        $conta_virgula=0;
        foreach ($res as $key => $value) {
          if($conta_virgula>0){
            $nome_professor.= ", ";
          }
         $nome_professor.= $value['nome_professor'];
         $conta_virgula++;
        }
        $nome_professor.= ".";

         boletim_maternal_1_2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno ,$nome_escola,$nome_turma,$nome_professor,$ano_letivo);
        $nome_professor='';
        



}else if ($idserie >= 8) {
    //echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";

    boletim_fund2_novo($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$ano_letivo);
            
}

 
?>


 

</body>
</html>