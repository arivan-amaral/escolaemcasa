<?php 
function capa_turma($conexao,$idescola,$idturma){

?>


 <tr >
  <td colspan="6"  style='border:none;border:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
      <p class=TableParagraph  style='margin-top:.8pt;margin-right:
      64.55pt;margin-bottom:0cm;margin-left:65.15pt;margin-bottom:.0001pt;
       '><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>Professor: </span></b></p>
  </td>
 </tr>
 <tr style='width:80%'>

  <td  colspan='1' valign=top style=' border:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:8.0pt;font-family:"Times New Roman",serif'>N°</span></p>
  </td>

  <td  valign=top style='width:584.25pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  
  <p class=TableParagraph align=right style='margin-top:3.3pt;margin-right:
  2.0pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:
  center'><b><span lang=PT style='font-size:8.0pt;font-family:"Arial",sans-serif'>
  ALUNO(A)
</span></b></p>
  </td>

  <td  valign=top style='width:60.25pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  
  <p class=TableParagraph align=right style='margin-top:3.3pt;margin-right:
  2.0pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:
  center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>
    SEXO
  </span></b></p>
  </td>

  <td  valign=top style='width:184.25pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  
  <p class=TableParagraph align=right style='margin-top:3.3pt;margin-right:
  2.0pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:
  center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>
    DATA DE NASCIMENTO
  </span></b></p>
  </td>

  <td  valign=top style='width:184.25pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  
  <p class=TableParagraph align=right style='margin-top:3.3pt;margin-right:
  2.0pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:
  center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>DATA DE ENTRADA</span></b></p>
  </td>

  <td  valign=top style='width:184.25pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  
  <p class=TableParagraph align=right style='margin-top:3.3pt;margin-right:
  2.0pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:
  center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>DATA DE SAÍDA</span></b></p>
  </td>

  <td  valign=top style='width:184.25pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  
  <p class=TableParagraph align=right style='margin-top:3.3pt;margin-right:
  2.0pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:
  center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>OBSERVAÇÃO</span></b></p>
  </td>


  


 </tr>

 <tr >
  
 

<?php
$conta_aluno=1; 
$matricula_aluno="";

  $matricula="";
  $datasaida="";
  $data_matricula="";
$res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola);
 foreach ($res_alunos as $key => $value) {

  $idaluno=$value['idaluno'];
  $datasaida=$value['datasaida'];
  $data_matricula=$value['data_matricula'];
  $nome_aluno=$value['nome_aluno'];
  $sexo_aluno=$value['sexo'];
  $data_nascimento=$value['data_nascimento'];
  $matricula_aluno=$value['matricula'];

  if ($conta_aluno%2==0) {
    $cor_linha="#E0E0E0";
  }else{
    $cor_linha="white";

  }

  if ($data_nascimento !='') {
    $data_nascimento=converte_data($data_nascimento);
  }

// pesquisar_aluno_da_turma_ata_resultado_final


 
      if ($datasaida!="") {
        $datasaida=converte_data($datasaida);
      }     
      if ($data_matricula!="") {
        $data_matricula=converte_data($data_matricula);
      }
  
?>
 <tr style=''>
 
 
      <td style='background-color: <?php echo "$cor_linha"; ?>; border-top:solid black 1.0pt;border-left:
      solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
      padding:0cm 0cm 0cm 0cm;height:11.3pt'>

      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:3.65pt;margin-bottom:.0001pt;'><span lang=PT style='font-size:
      8.0pt;text-align:
  center'><?php echo "$conta_aluno"; ?></span></p>
      </td>

      <td  valign=top style='border:solid black 1.0pt; 
      padding:0cm 0cm 0cm 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt;text-align:
  center'><?php echo "$nome_aluno"; ?></span></p>
      </td>

      <td  valign=top style='border:solid black 1.0pt; 
      padding:0cm 0cm 0cm 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt;text-align:
  center'><?php echo "$sexo_aluno"; ?></span></p>
      </td>

      <td  valign=top style='border:solid black 1.0pt; 
      padding:0cm 0cm 0cm 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt;text-align:
  center'><?php echo "$data_nascimento"; ?></span></p>
      </td>

      <td  valign=top style='border:solid black 1.0pt; 
      padding:0cm 0cm 0cm 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt;text-align:
  center'><?php echo "$data_matricula"; ?></span></p>
      </td>

      <td  valign=top style='border:solid black 1.0pt; 
      padding:0cm 0cm 0cm 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt;text-align:
  center'><?php echo "$datasaida"; ?></span></p>
      </td>

      <td  valign=top style='border:solid black 1.0pt; 
      padding:0cm 0cm 0cm 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt;text-align:
  center'><?php echo ""; ?></span></p>
      </td>


     

 </tr>

<?php 
$conta_aluno++; 

}

?>

 <tr style='height:10.55pt'>
  <td width=321 colspan=4 valign=top style='border:solid black 1.0pt;
  padding:0pt 0pt 10pt 0pt;height:10.55pt'>
  
  <p class=TableParagraph align=center style='margin-top:1.45pt;margin-left:4.85pt;margin-bottom:1pt;margin-top:7pt;
  text-align:center'>
  _____________________________________________<br>
  <span lang=PT style='font-size:10.0pt'>Assinatura do Coordenador
</span></p>
  </td>  

  <td width=321 colspan=10 valign=top style='border:solid black 1.0pt;
  padding:0pt 0pt 10pt 0pt;height:10.55pt'>

  <p class=TableParagraph align=center style='margin-top:1.45pt;margin-left:4.85pt;margin-bottom:1pt;margin-top:7pt;
  text-align:center'>
  _____________________________________________<br>
  <span lang=PT style='font-size:10.0pt'>Assinatura do Professor</span>
</p>
 

 
  </td>

 </tr>
 
  


<?php 
}
?>