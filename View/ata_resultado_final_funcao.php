<?php 
function ata_resultados_finais($conexao){

?>
<table class='MsoNormalTable'>


 <tr style='height:21.9pt'>
 
  <td width=19 valign=top style='width:14.15pt;border:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=246 valign=top style='width:184.25pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph align=right style='margin-top:.8pt;margin-right:2.05pt;
  margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:right'><b><span
  lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>Disciplinas</span></b></p>
  <p class=TableParagraph align=right style='margin-top:3.3pt;margin-right:
  2.0pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:
  right'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>Carga
  Horária</span></b></p>
  </td>

 <?php 
  $res_disc=listar_disciplina_para_boletim($conexao,73469);
  $conta_parecer=0;
  $linha=0;

  foreach ($res_disc as $key => $value) {
    $iddisciplina=$value['iddisciplina'];
    $nome_disciplina=$value['nome_disciplina'];
?>
  <td width=42 valign=top style='width:31.15pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:5.75pt;margin-bottom:.0001pt'><b><span lang=PT
  style='font-size:7.0pt;font-family:"Arial",sans-serif'><?php echo $nome_disciplina; ?></span></b></p>
  <p class=TableParagraph style='margin-top:3.3pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:9.65pt;margin-bottom:.0001pt'><b><span lang=PT

  style='font-size:7.0pt;font-family:"Arial",sans-serif'>160</span></b></p>
  </td>
<?php 

}
?>

 
  
  <td width=45 valign=top style='width:34.0pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph align=center style='margin-top:.8pt;margin-right:
  10.25pt;margin-bottom:0cm;margin-left:11.6pt;margin-bottom:.0001pt;
  text-align:center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>RF</span></b></p>
  </td>
 </tr>

 <tr >
  <td width=19 valign=top style='width:14.15pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:3.15pt;margin-bottom:.0001pt'><b><span lang=PT
  style='font-size:7.0pt;font-family:"Arial",sans-serif'>Nº</span></b></p>
  </td>
  <td width=246 valign=top style='width:184.25pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph align=center style='margin-top:.8pt;margin-right:
  64.55pt;margin-bottom:0cm;margin-left:65.15pt;margin-bottom:.0001pt;
  text-align:center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>Nome
  do Aluno</span></b></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=41 colspan=2 valign=top style='width:31.1pt;border:none;border-right:
  solid black 1.0pt;padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:11.3pt'>
  <td width=19 valign=top style='width:14.15pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-left:5.3pt'><span lang=PT
  style='font-size:6.0pt'>1</span></p>
  </td>
  <td width=246 valign=top style='width:184.25pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-left:2.75pt'><span lang=PT
  style='font-size:6.0pt'>ALINE RAFAELA GOMES IGNÁCIO</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph align=center style='margin-top:1.85pt;margin-right:
  2.7pt;margin-bottom:0cm;margin-left:3.35pt;margin-bottom:.0001pt;text-align:
  center'><span lang=PT style='font-size:6.0pt'>8.60</span></p>
  </td>
  <td width=41 colspan=2 valign=top style='width:31.1pt;border:none;border-right:
  solid black 1.0pt;background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-left:9.7pt'><span lang=PT
  style='font-size:6.0pt'>7.47</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph align=right style='margin-right:8.8pt;text-align:
  right'><span lang=PT style='font-size:6.0pt'>8.30</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph align=center style='margin-top:1.85pt;margin-right:
  2.45pt;margin-bottom:0cm;margin-left:3.35pt;margin-bottom:.0001pt;text-align:
  center'><span lang=PT style='font-size:6.0pt'>8.13</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-left:9.85pt'><span lang=PT
  style='font-size:6.0pt'>8.60</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph align=center style='margin-top:1.85pt;margin-right:
  2.3pt;margin-bottom:0cm;margin-left:3.35pt;margin-bottom:.0001pt;text-align:
  center'><span lang=PT style='font-size:6.0pt'>8.60</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph align=right style='margin-right:8.7pt;text-align:
  right'><span lang=PT style='font-size:6.0pt'>7.93</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph align=right style='margin-right:8.65pt;text-align:
  right'><span lang=PT style='font-size:6.0pt'>5.93</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-left:9.95pt'><span lang=PT
  style='font-size:6.0pt'>8.27</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border:none;border-right:solid black 1.0pt;
  background:#E0E0E0;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph align=center style='margin-top:1.85pt;margin-right:
  10.25pt;margin-bottom:0cm;margin-left:11.6pt;margin-bottom:.0001pt;
  text-align:center'><span lang=PT style='font-size:6.0pt'>Apr</span></p>
  </td>
 </tr>
 <tr style='height:11.3pt'>
  <td width=19 valign=top style='width:14.15pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:3.65pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
  6.0pt'>18</span></p>
  </td>
  <td width=246 valign=top style='width:184.25pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
  6.0pt'>MARIA VITORIA FERREIRA</span></p>
  </td>
  <td width=461 colspan=12 valign=top style='width:345.45pt;border:none;
  border-right:solid black 1.0pt;padding:0cm 0cm 0cm 0cm;height:11.3pt'>
  <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
  6.0pt'>TRANSFERIDO FORA<span style='letter-spacing:.05pt'> </span>em
  19/03/2020</span></p>
  </td>
 </tr>
 <tr style='height:10.55pt'>
  <td width=321 colspan=4 valign=top style='width:240.85pt;border:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.55pt'>
  <p class=TableParagraph align=center style='margin-top:1.45pt;margin-right:
  100.2pt;margin-bottom:0cm;margin-left:100.85pt;margin-bottom:.0001pt;
  text-align:center'><span lang=PT style='font-size:6.0pt'>Observações:</span></p>
  </td>
  <td width=404 colspan=10 valign=top style='width:303.0pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:10.55pt'>
  <p class=TableParagraph align=center style='margin-top:1.45pt;margin-right:
  101.05pt;margin-bottom:0cm;margin-left:102.1pt;margin-bottom:.0001pt;
  text-align:center'><span lang=PT style='font-size:6.0pt'>Convenções:</span></p>
  </td>
 </tr>
 <tr style='height:8.95pt'>
  <td width=321 colspan=4 rowspan=8 valign=top style='width:240.85pt;
  border:solid black 1.0pt;border-top:none;padding:0cm 0cm 0cm 0cm;height:8.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=151 colspan=4 valign=top style='width:113.25pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:8.95pt'>
  <p class=TableParagraph style='margin-top:3.45pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.8pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>LPOR - LINGUA PORTUGUESA</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:8.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:8.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=125 colspan=3 valign=top style='width:93.45pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:8.95pt'>
  <p class=TableParagraph style='margin-top:3.45pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:3.4pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>A - ARTES</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:8.95pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:6.3pt'>
  <td width=151 colspan=4 valign=top style='width:113.25pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.8pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>EF - EDUCAÇÃO FISICA</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=125 colspan=3 valign=top style='width:93.45pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:3.4pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>ER - ENSINO RELIGIOSO</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:6.3pt'>
  <td width=151 colspan=4 valign=top style='width:113.25pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.8pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>GEO - GEOGRAFIA</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=125 colspan=3 valign=top style='width:93.45pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:3.4pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>HIS - HISTÓRIA</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:6.3pt'>
  <td width=151 colspan=4 valign=top style='width:113.25pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.8pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>MAT - MATEMÁTICA</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=125 colspan=3 valign=top style='width:93.45pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:3.4pt;margin-bottom:.0001pt;line-height:4.55pt'><span
  lang=PT style='font-size:4.0pt'>CFB - CIÊNCIAS FISICAS E BIOLÓGICAS</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:6.3pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:3.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:20.15pt'>
  <td width=151 colspan=4 valign=top style='width:113.25pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:20.15pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.8pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
  4.0pt'>LEM INGLÊS - LINGUA ESTRANGEIRA MODERNA ING</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:20.15pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;padding:0cm 0cm 0cm 0cm;
  height:20.15pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=125 colspan=3 valign=top style='width:93.45pt;border:none;
  padding:0cm 0cm 0cm 0cm;height:20.15pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:20.15pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:21.0pt'>
  <td width=151 colspan=4 valign=top style='width:113.25pt;border:none;
  border-bottom:solid black 1.0pt;padding:0cm 0cm 0cm 0cm;height:21.0pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:4.0pt'>&nbsp;</span></p>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:4.0pt'>&nbsp;</span></p>
  <p class=TableParagraph style='margin-top:.2pt'><span lang=PT
  style='font-size:4.5pt'>&nbsp;</span></p>
  <p class=TableParagraph style='margin-top:.05pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:2.8pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
  4.0pt'>Apr - APROVADO      Rep - REPROVADO</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-bottom:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:21.0pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=42 valign=top style='width:31.15pt;border:none;border-bottom:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:21.0pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=125 colspan=3 valign=top style='width:93.45pt;border:none;
  border-bottom:solid black 1.0pt;padding:0cm 0cm 0cm 0cm;height:21.0pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
  <td width=45 valign=top style='width:34.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0cm 0cm 0cm 0cm;
  height:21.0pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:6.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:11.7pt'>
  <td width=404 colspan=10 valign=top style='width:303.0pt;border:none;
  border-right:solid black 1.0pt;padding:0cm 0cm 0cm 0cm;height:11.7pt'>
  <p class=TableParagraph align=center style='margin-top:2.85pt;margin-right:
  101.05pt;margin-bottom:0cm;margin-left:102.1pt;margin-bottom:.0001pt;
  text-align:center'><span lang=PT style='font-size:6.0pt'>E, para constar, foi
  lavrada esta Ata.</span></p>
  </td>
 </tr>
 <tr style='height:57.6pt'>
  <td width=404 colspan=10 valign=top style='width:303.0pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:57.6pt'>
  <p class=TableParagraph style='margin-top:1.75pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:74.6pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
  6.0pt'>LUIS EDUARDO MAGALHAES, 23 de novembro de 2021</span></p>
  <p class=TableParagraph style='margin-top:1.75pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:74.6pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
  6.0pt'>&nbsp;</span></p>
  </td>
 </tr>
 <tr height=0>
  <td width=19 style='border:none'></td>
  <td width=245 style='border:none'></td>
  <td width=41 style='border:none'></td>
  <td width=15 style='border:none'></td>
  <td width=26 style='border:none'></td>
  <td width=39 style='border:none'></td>
  <td width=37 style='border:none'></td>
  <td width=39 style='border:none'></td>
  <td width=36 style='border:none'></td>
  <td width=40 style='border:none'></td>
  <td width=38 style='border:none'></td>
  <td width=39 style='border:none'></td>
  <td width=29 style='border:none'></td>
  <td width=45 style='border:none'></td>
 </tr>
</table>

</div>

<span lang=PT style='font-size:1.0pt;font-family:"Arial MT",sans-serif'><br
clear=all style='page-break-before:auto'>
</span>

<div class=WordSection3>

<p class=MsoNormal style='margin-top:.25pt'><span style='position:relative;
z-index:-1660650496'><span style='position:absolute;left:399px;top:-65px;
width:121px;height:2px'><img width=121 height=2
src="ata_ecidade_arquivos/image003.gif"></span></span><span style='position:
relative;z-index:-1660649984'><span style='position:absolute;left:588px;
top:-65px;width:121px;height:2px'><img width=121 height=2
src="ata_ecidade_arquivos/image004.gif"></span></span></p>

<span lang=PT style='font-size:7.0pt;font-family:"Arial MT",sans-serif'><br
clear=all>
</span>

<p class=MsoBodyText style='margin-top:.45pt;margin-right:0cm;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt'></p>

</div>
<?php 
}
?>