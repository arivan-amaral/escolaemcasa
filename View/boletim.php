<?php 
  include"../Controller/Conversao.php";
  include"../Model/Conexao.php";
  include"../Model/Aluno.php";
  include"../Model/Escola.php";
  include"../Model/Turma.php";
  include"../Model/Professor.php";

  include"boletim_maternall_II.php";
  include"boletim_serie_1ano_id_3.php";
  include"boletim_fundamental_II.php";
  include('mpdf/mpdf60/mpdf.php');

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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>

<style type="text/css">
@media print {
    html, body {
        margin: 0;
        padding: 0;
        border: 0;
    }
    #printable {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 14px;
    }
    #printable ~ * {
        display: none;
    }

    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}


#employee_detail {
    page-break-inside: avoid !important;
    margin: 4px 0 4px 0;  /* to keep the page break from cutting too close to the text in the div */
  }



</style>
</head>
<body >
   
   <a href="#" onclick="demoFromHTML();">IMPRIMIR</a> 
<div id="employee_detail">

<?php
if ($idserie==3) {
  //echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";

    $numero=1;
    $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
    $nome_professor= "";

    foreach ($res_alunos as $key => $value) {
      $idaluno=$value['idaluno'];
      $nome_aluno=$value['nome_aluno'];
      if ($numero==1) {
        
        $res=listar_nome_professor_turma($conexao,$idaluno);
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

      boletim_1ano($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno, $nome_escola,$nome_turma,$nome_professor);
      // break;
  //echo"<a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma'>IMPRIMIR - $nome_aluno</a> <br><br>";
echo"<br>";
      
      $numero++;
    }

}
else if ($idserie >3 && $idserie <=8) {
    
  
      $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
      foreach ($res_alunos as $key => $value) {
        $idaluno=$value['idaluno'];
        $nome_aluno=$value['nome_aluno'];


          boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma);

         if ($numero%2==0 ) {
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo"<br> ";
            
         
          }

          // echo"<a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma'>IMPRIMIR - $nome_aluno</a> <br><br>";
        $numero++;
      }


}else if ($idserie<3){

 // echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";
  $numero=1;
    $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
    $nome_professor= " ";
    foreach ($res_alunos as $key => $value) {
      $idaluno=$value['idaluno'];
      $nome_aluno=$value['nome_aluno'];

        $res=listar_nome_professor_turma($conexao,$idaluno);
        $conta_virgula=0;
        foreach ($res as $key => $value) {
          if($conta_virgula>0){
            $nome_professor.= ", ";
          }
         $nome_professor.= $value['nome_professor'];
         $conta_virgula++;
        }
        $nome_professor.= ".";

        boletim_maternal_1_2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno ,$nome_escola,$nome_turma,$nome_professor);
        $nome_professor='';
        
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";

        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        echo"<br>";
        
        // echo"<a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma'>IMPRIMIR - $nome_aluno</a> <br><br>";
      $numero++;
      //break;
    }
echo"<div class='pagebreak'> </div>";

}else if ($idserie > 8) {
    //echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";
    $numero=1;
      $res_alunos=listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
      foreach ($res_alunos as $key => $value) {
        $idaluno=$value['idaluno'];
        $nome_aluno=$value['nome_aluno'];
          $html.=boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma);
       
        if ($numero%2==0) {
           echo "<br>";
           echo "<br>";
        
         }

        // echo"<a href='boletim_individual.php?idescola=$idescola&idturma=$idturma&idserie=$idserie&idaluno=$idaluno&numero=$numero&nome_aluno=$nome_aluno&nome_escola=$nome_escola&nome_turma=$nome_turma'>IMPRIMIR - $nome_aluno</a> <br><br>";
        $numero++;
      }
      
}

?>
</div>

</body>

<script type='text/javascript'>
  

   window.html2canvas = html2canvas;

   




function demoFromHTML() {

     const html_source = document.getElementById('employee_detail'); // O id do elemento que contém o Html que quer imprimir.
     const filename = 'boletim.pdf';


     html2canvas(html_source).then(function(canvas) {
       /*
       [210,297] Sao os números (largura e altura do papel a4) que eu encontrei para trabalhar com eles.
       Se você puder encontrar números oficiais do jsPDF, usa.
        */
       let imgData = canvas.toDataURL('image/png');
       let imgWidth = 250; // Largura em mm de um a4
       let pageHeight = 297; // Altura em mm de um a4

       let imgHeight = canvas.height * imgWidth / canvas.width;
       let heightLeft = imgHeight;
       let position = 15;
       let pdf = new jsPDF('p', 'mm');
       let fix_imgWidth = 15; // Vai subindo e descendo esses valores ate ficar como queres
       let fix_imgHeight = 55; // Vai subindo e descendo esses valores ate ficar como queres

       pdf.addImage(imgData, 'PNG', 15, position, imgWidth, imgHeight);
       heightLeft -= pageHeight;

       while (heightLeft >= 0) {
         position = heightLeft - imgHeight;
         pdf.addPage();
          console.log(position);
         pdf.addImage(imgData, 'PNG', 1, position, 210 + fix_imgWidth, imgHeight + fix_imgHeight);
         heightLeft -= pageHeight;
       }

       pdf.save(filename);
     })

   }

</script>

</html>