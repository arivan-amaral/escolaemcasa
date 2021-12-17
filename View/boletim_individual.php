<?php 
// header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
//  exit;
  include"../Controller/Conversao.php";
  include"../Model/Conexao.php";
  include"../Model/Aluno.php";
  include"../Model/Escola.php";
  include"../Model/Turma.php";
  include"../Model/Professor.php";

  include"boletim_maternall_II.php";
  include"boletim_individual_1_ano_serie3.php";
  include"boletim_fundamental_II.php";
  include"../Controller/Cauculos_notas.php";
  
  

$idescola=$_GET['idescola'];
$idturma=$_GET['idturma'];
$idserie=$_GET['idserie'];
$idaluno=$_GET['idaluno'];
$numero=$_GET['numero'];
$nome_aluno=$_GET['nome_aluno'];
$nome_escola=$_GET['nome_escola'];
$nome_turma=$_GET['nome_turma'];


?>



<?php
  $nome_professor= "";
if ($idserie==3) {


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

     boletim_1ano($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno, $nome_escola,$nome_turma,$nome_professor);

}else if ($idserie >3 && $idserie <=8) {
   boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma);


}else if ($idserie<3){


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
        



}else if ($idserie > 8) {
    //echo "<H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR>";

    boletim_fund2($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma);
            
}

echo"
 

<a href='#' onclick='print();'>IMPRIMIR BOLETIM - $nome_aluno</a> <br><br>";

?>



<script type="text/javascript">
  

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
       let imgWidth = 220; // Largura em mm de um a4
       let pageHeight = 297; // Altura em mm de um a4

       let imgHeight = canvas.height * imgWidth / canvas.width;
       let heightLeft = imgHeight;
       let position = 15;
       let pdf = new jsPDF('p', 'mm');
       let fix_imgWidth = 25; // Vai subindo e descendo esses valores ate ficar como queres
       let fix_imgHeight = 10; // Vai subindo e descendo esses valores ate ficar como queres

       pdf.addImage(imgData, 'PNG', 20, position, imgWidth, imgHeight);
       heightLeft -= pageHeight;

       while (heightLeft >= 0) {
         position = heightLeft - imgHeight;
         pdf.addPage();
         pdf.addImage(imgData, 'PNG', 15, position, imgWidth + fix_imgWidth, imgHeight + fix_imgHeight);
         heightLeft -= pageHeight;
       }

       pdf.save(filename);
     })

   }

</script>

</body>
</html>