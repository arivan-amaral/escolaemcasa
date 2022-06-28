<?php 
set_time_limit(0);
session_start();
  include"../Controller/Conversao.php";
  include"../Model/Conexao.php";
  include"../Model/Aluno.php";
  include"../Model/Escola.php";
  include"../Model/Turma.php";
  include"../Model/Professor.php";

  include"boletim_maternall_II.php";
  include"boletim_serie_1ano_id_3.php";
  include"boletim_fundamental_II.php";
  include"boletim_fundamental_turma.php";
  include"teste_boletim.php";
  include"../Controller/Cauculos_notas.php";
  //include('mpdf/mpdf60/mpdf.php');

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$res_escola=buscar_escola_por_id($conexao,$idescola);
$nome_escola="";
$nome_turma="";

foreach ($res_escola as $key => $value) {
  $nome_escola=$value['nome_escola'];
}
$res_turma=lista_de_turmas_por_id($conexao,$idturma);

foreach ($res_turma as $key => $value) {
  $nome_turma=$value['nome_turma'];
}

include_once"cabecalho_boletim.php";
?>

<!-- ################################################################################ -->
<p class="no-print">
  <br>
  <br>
  
<a href='#'class="btn btn-block btn-primary " onclick='print();'>IMPRIMIR</a> 

</p>
<!-- <h1>PÁGINA EM MANUTENÇÃO</h1> -->

   
<!-- <a href="#" onclick="demoFromHTML();">BAIXAR BOLETINS</a> -->
<div id="employee_detail">

<?php
$numero=1; 

if ($idserie==3) {

    if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
      $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    }else{
      $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
     }

    
    $nome_professor= "";
    foreach ($res_alunos as $key => $value) {
      $idaluno=$value['idaluno'];
      $nome_aluno=strtoupper($value['nome_aluno']);
      if ($numero==1) {
        
        $res=listar_nome_professor_turma_ministrada($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
        $conta_virgula=0;
        foreach ($res as $key => $value) {
          if($conta_virgula>0){
            $nome_professor.= ", ";
          }
         $nome_professor.= $value['nome_professor'];
         $conta_virgula++;
        }
        $nome_professor.= ".";
      }

       boletim_fund_turma($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$_SESSION['ano_letivo']);
      
      $numero++;
    }

}
else if ($idserie >3 && $idserie <=8) {
    

    if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
      $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    }else{
      $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
     }

      foreach ($res_alunos as $key => $value) {
        $idaluno=$value['idaluno'];
        $nome_aluno=strtoupper($value['nome_aluno']);

            echo "" .$numero ."";
            boletim_fund_turma($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$_SESSION['ano_letivo']);

         
         
        $numero++;
      }
       


}else if ($idserie<3){

 // echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";
  $numero=1;
    if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
  $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
}else{
  $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
 }

    // $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
    $nome_professor= " ";
    foreach ($res_alunos as $key => $value) {
      $idaluno=$value['idaluno'];
      $nome_aluno=strtoupper($value['nome_aluno']);

       $res=listar_nome_professor_turma_ministrada($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
        $conta_virgula=0;
        foreach ($res as $key => $value) {
          if($conta_virgula>0){
            $nome_professor.= ", ";
          }
         $nome_professor.= $value['nome_professor'];
         $conta_virgula++;
        }
        $nome_professor.= ".";

        
        echo "$numero";
        boletim_fund_turma($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$_SESSION['ano_letivo']);
        $nome_professor='';
        
      $numero++;
     
    }

}else if ($idserie > 8) {
    $numero=1;
      if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
          $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
      }else{
          $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
      }

      // $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
      foreach ($res_alunos as $key => $value) {
        $idaluno=$value['idaluno'];
        $nome_aluno=strtoupper($value['nome_aluno']);
          boletim_fund_turma($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$_SESSION['ano_letivo']);
       

        $numero++;
      }
      
}

?>
</div>



</body>
</html>