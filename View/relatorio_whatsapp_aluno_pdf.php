<?php 

 include("mpdf/mpdf60/mpdf.php");

include'../Model/Conexao.php';
include'../Controller/Conversao.php';

 $html = "
 <html>
 <body style='font-family:arial;''>

   <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
   <tr  style='text-align: center;'>

   <td colspan='3' width='500' style='padding-left:10px;padding-bottom:10px;'>
       
       <td>
         <img src='imagens/logo.png' width='150' height='150'> <div style='height: 500px;
  border-left: 2px solid;'></div>
       </td>
       <td width='800' style='font-size:14px;'>
         <h4> PREFEITURA DE <br> LUÍS EDURDO MAGALHÃES - BA</h4>
       </td>
    </td>
   </tr>
   <tr>
    <td>
     <H2>RELATÓRIO DE ALUNO SEM TELEFONE/WHATSAPP CADASTRADO</H2>
    </td>
   </tr>
 </table>
  <hr>  

  <br>
  <br>
  <br>
<table border='2' >
  <thead>
  <th>
  ID
  </th>
  <th>
  DADOS PESSOAIS
  </th>
  <th>
    CADASTRADO
  </th>
  </thead>
  <tbody>

";

$conta=1;
$res=$conexao->query("SELECT * from aluno,escola,ano_letivo,turma where 
  ano_letivo.aluno_id = idaluno and 
  ano_letivo.escola_id = escola.idescola and
  turma_id=turma.idturma
 order by escola.nome_escola asc, turma.nome_turma asc, aluno.nome asc limit 15000,5000");

foreach ($res as $key => $value) {
  $idaluno = $value['idaluno'];
  $nome = $value['nome'];
  $whatsapp = $value['whatsapp'];
  $nome_escola = $value['nome_escola'];
  $nome_turma = $value['nome_turma'];
  
  $html.="
      <tr border='2'>
          <td>$idaluno</td> 
          <td>
            <b>$nome</b><br>
           Telefone: $whatsapp<br>
          </td>
          <td>
           <b> $nome_escola</b><br>
           $nome_turma

           <br>
          </td>
      <tr>";
$conta++;

}

$html.="
<BR>
      <tr>

      
        <td>
        </TD>

      <TD>
         <b><h3 COLOR='RED'>TOTAL: ".--$conta." </h3></b>
        </td>
      </tr>";



$html.="
  </tbody>
</table>

<table align='center' style='color:#444;font-size:12px; padding-top:100px;position:absolute;
    bottom:0;
    width:100%;'>
          <tr>
              <td align='center' width='300' style='border-top: none;'>
          
                
              </td>
          </tr>
  
</table>
</body>
</html>
    


</body>
</html>";


 $mpdf=new mPDF(); 

 // $mpdf->SetDisplayMode('fullpage');

 // $css = file_get_contents("css/estilo.css");

 // $mpdf->WriteHTML($css,1);

 $mpdf->WriteHTML($html);

 $mpdf->Output();
 // $mpdf->Output('teste.pdf');

 

 

 



exit;

?>