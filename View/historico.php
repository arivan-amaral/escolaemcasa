<?php 
include '../Model/Escola.php';
include '../Model/Aluno.php';
function hitorico_aluno($conexao,$idaluno,$idserie,$idescola){
$nome_escola ="";
$res_escola = pesquisar_escola2($conexao,$idescola);
foreach ($res_escola as $key => $value) {
  $nome_escola = $value['nome_escola'];
}
$res_aluno = pesquisar_aluno2($conexao,$idaluno);
$nome_aluno = "";
$naturalidade = "";
$data_nascimento = "";
$filiado1 = "";
$filiado2 = "";
foreach ($res_aluno as $key => $value) {
  $idaluno = $value['idaluno'];
  $nome_aluno = $value['nome'];
  $naturalidade = $value['naturalidade'];
  $data = new DateTime($value['data_nascimento']);
  $data_nascimento = $data->format('d/m/Y');
        
  $filiado1 = $value['filiacao1'];
  $filiado2 = $value['filiacao2'];
}
?>
<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=748
 style='width:561.2pt;margin-left:-.15pt;border-collapse:collapse'>
 <tr style='height:19.5pt'>
  <td width=748 colspan=30 valign=top style='width:561.2pt;border:solid black 1.0pt;
  border-bottom:none;padding:0cm 3.5pt 0cm 3.5pt;height:19.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:13.0pt'>PREFEITURA
  MUNICIPAL LUÍS EDUARDO MAGALHÃES - BA</span></b></p>
  </td>
 </tr>
 <tr style='height:36.0pt'>
  <td width=748 nowrap colspan=30 valign=top style='width:561.2pt;border:none;
    0cm 3.5pt;height:36.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='position:absolute;
  z-index:251657216;left:0px;margin-left:8px;margin-top:0px;width:60px;
  height:62px'>
  <img width=60 height=62 src="imagens/logo.png"></span>
</p>
  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0>
   <tr style='height:36.0pt'>
    <td width=741 valign=top style='width:1000.0pt;border-top:none;border-left:
    solid black 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
    padding:0cm 0cm 0cm 121.5pt;height:36.0pt'>
    <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;
    line-height:normal;text-align:center;'>
    <span style='font-size:11.5pt;font-family:"Arial",sans-serif;text-align:center;'> 
    SECRETARIA MUNICIPAL DA EDUCAÇÃO<br>
    </span><b><span style='font-size:11.5pt;font-family:"Comic Sans MS"'><?php echo $nome_escola; ?></span></b></p>
    </td>
   </tr>
  </table>
  </td>
 </tr>
 <tr style='height:16.5pt'>
  <td width=185 colspan=3 valign=bottom style='width:138.4pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=564 colspan=27 valign=top style='width:422.8pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:8.5pt;font-family:"Comic Sans MS"'>NOME
  DO(A) ALUNO(A): <?php echo"$idaluno - $nome_aluno"; ?></span></b><b><span style='font-size:9.5pt;font-family:"Comic Sans MS"'></span></b></p>
  </td>
 </tr>
 <tr style='height:13.5pt'>
  <td width=185 colspan=3 valign=top style='width:138.4pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.5pt;font-family:"Arial",sans-serif'>Filiação:</span></p>
  </td>
  <td width=374 colspan=17 valign=top style='width:280.5pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.5pt;font-family:"Arial",sans-serif'>Naturalidade:
  <?php echo $naturalidade; ?></span></p>
  </td>
  <td width=190 colspan=10 valign=top style='width:142.3pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  9.5pt;line-height:normal'><span style='font-size:9.5pt;font-family:"Arial",sans-serif'>Data
  de nasc.:<?php echo $data_nascimento; ?></span></p>
  </td>
 </tr>
 <tr style='height:13.5pt'>
  <td width=559 colspan=20 valign=top style='width:418.9pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.5pt;font-family:"Arial",sans-serif'>Filiação 1: <?php echo $filiado1; ?></span></p>
  </td>
  <td width=190 colspan=10 valign=top style='width:142.3pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.5pt;font-family:"Arial",sans-serif'>Aut. Ou
  Rec. Port.</span></p>
  </td>
 </tr>
 <tr style='height:15.6pt'>
  <td width=559 colspan=20 valign=top style='width:418.9pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:15.6pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.5pt;font-family:"Arial",sans-serif'>Filiação 2: <?php echo $filiado2; ?></span></p>
  </td>
  <td width=190 colspan=10 valign=top style='width:142.3pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.6pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.5pt;font-family:"Arial",sans-serif'>D. O. :</span></p>
  </td>
 </tr>




 <!-- ######################## CABEÇALHO ANOS DO HISTORICO ###################### -->

 <tr style='height:15.0pt'>
  <td width=748 colspan=30 valign=top style='width:561.2pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:10.5pt;
  font-family:"Arial",sans-serif'>HISTÓRICO ESCOLAR - ENSINO FUNDAMENTAL</span></b></p>
  </td>
 </tr>
 <tr style='height:12.2pt'>
 
  <td width=20 rowspan=2 valign=bottom style='width:15.3pt;border:solid black 1.0pt;
  border-top:none;height:12.2pt;margin-top:50px;'>
  <p class=MsoNormal><b><span style='font-size:9.5pt;font-family:"Arial",sans-serif'>
    Componentes
  Curriculares</span></b></p>
  </td>
  <td width=164 colspan=2 rowspan=2 valign=top style='width:123.1pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt;'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  15.05pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>Base
  Nacional Comum</span></b></p>
  </td>
  <td width=132 colspan=6 valign=top style='width:98.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  30.1pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>C.
  B. A.</span></b></p>
  </td>
  <td width=62 colspan=3 rowspan=2 valign=top style='width:46.75pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>3º
  ano</span></b></p>
  </td>
  <td width=77 colspan=3 rowspan=2 valign=top style='width:57.85pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  15.05pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>4º
  ano</span></b></p>
  </td>
  <td width=62 colspan=3 rowspan=2 valign=top style='width:46.75pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>5º
  ano</span></b></p>
  </td>
  <td width=61 colspan=3 rowspan=2 valign=top style='width:45.75pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>6º
  ano</span></b></p>
  </td>
  <td width=54 colspan=3 rowspan=2 valign=top style='width:40.65pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>7º
  ano</span></b></p>
  </td>
  <td width=61 colspan=3 rowspan=2 valign=top style='width:45.75pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>8º
  ano</span></b></p>
  </td>
  <td width=54 colspan=3 rowspan=2 valign=top style='width:40.65pt;border-top:
  none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>9º
  ano</span></b></p>
  </td>
 </tr>
 <tr style='height:12.2pt'>
  <td width=62 colspan=3 valign=top style='width:46.8pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>1º
  ano</span></b></p>
  </td>
  <td width=69 colspan=3 valign=top style='width:51.85pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.55pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>2º
  ano</span></b></p>
  </td>
 </tr>
 <tr style='height:12.2pt'>
  <td width=164 colspan=3 valign=top style='width:123.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt;border-left:solid black 1.0pt;'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  15.0pt;line-height:normal'><i><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>Áreas
  de Conhecimento</span></i></p>
  </td>
  <td width=20 valign=top style='width:15.3pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=28 valign=top style='width:21.35pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=14 valign=top style='width:10.15pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=28 valign=top style='width:21.35pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=28 valign=top style='width:21.35pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=14 valign=top style='width:10.15pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=28 valign=top style='width:21.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=28 valign=top style='width:21.35pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=28 valign=top style='width:21.35pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=14 valign=top style='width:10.15pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=14 valign=top style='width:10.15pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
  <td width=14 valign=top style='width:10.15pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>N</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CH</span></b></p>
  </td>
  <td width=20 valign=top style='width:15.25pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>F</span></b></p>
  </td>
 </tr>


 <!-- ############################## DISCIPLINAS HISTORICO ############################### -->
  <?php 
  $res_disc=lista_disciplina_historico($conexao);
  foreach ($res_disc as $key => $value) {
    $iddisciplina=$value['iddisciplina'];
    $nome_disciplina=$value['nome_disciplina'];

    ?>
 <tr style='height:12.2pt'>
  <td width=164 colspan=3 valign=top style='width:123.1pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;border-left:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.5pt;font-family:"Arial",sans-serif'><?php echo $nome_disciplina ?></span></p>
  </td>
  <?php 
   
    for ($i=3; $i <= 11 ; $i++) { 
   //   // code...
     $res_notas=$conexao->query("SELECT * FROM
     historico
     where 
     disciplina_id=$iddisciplina and
     serie_id=$i and
     aluno_id=$idaluno");

   
     $conta_notas=0;
      foreach ($res_notas as $key => $value) {
        $nota_final=$value['nota_final'];
        $nota_final=number_format($nota_final, 1, '.', ',');
        $conta_notas++;
      ?>

            <td width=20 valign=bottom style='width:15.3pt;border-top:none;border-left:
            none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
            color:black'>&nbsp;<?php echo "$nota_final"; ?></span></p>
            </td>
      <?php 
        } 
       
        for ($j=$conta_notas; $j <= 2; $j++) { 
      ?>
            <td width=20 valign=bottom style='width:15.3pt;border-top:none;border-left:
            none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
            padding:0cm 3.5pt 0cm 3.5pt;height:12.2pt'>
            <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
            normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
            color:black'>&nbsp;<?php echo $i ;?>0</span></p>
            </td>
      <?php 
        } 
   }


    
    echo"</tr>";
 
}
?>


 <!-- ############################## BASE DIVERSIFICADA ############################### -->

 <tr style='height:9.75pt'>
  <td width=185 colspan=3 valign=top style='width:138.4pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:9.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  30.1pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>Base
  Diversificada</span></b></p>
  </td>

  

  <?php 
    for ($i=0; $i < 27 ; $i++) { 

  ?>
  <td width=20 valign=bottom style='width:15.3pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:9.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;-</span></p>
  </td>

  <?php 
  } 
  ?>
 </tr>


 <?php 
 $res_disc_diversificada=lista_disciplina_historico_base_diversificada($conexao);
 foreach ($res_disc_diversificada as $key => $value) {
   $iddisciplina=$value['iddisciplina'];
   $nome_disciplina=$value['nome_disciplina'];

   ?>
 <tr style='height:12.0pt'>
  <td width=185 colspan=3 valign=top style='width:138.4pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.5pt;font-family:"Arial",sans-serif'><?php echo $nome_disciplina ?></span></p>
  </td>
  <?php 
    for ($i=3; $i <= 11 ; $i++) { 
       
       $res_notas_divers=$conexao->query("SELECT * FROM
       historico
       where 
       disciplina_id=$iddisciplina and
       serie_id=$idserie and
       aluno_id=$idaluno");

      
       $conta_notas_divers=0;
        foreach ($res_notas_divers as $key => $value) {
          $nota_final=$value['nota_final'];
          $nota_final=number_format($nota_final, 1, '.', ',');
          $conta_notas_divers++;
    ?>

    <td width=20 valign=bottom style='width:15.3pt;border-top:none;border-left:
    none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
    padding:0cm 3.5pt 0cm 3.5pt;height:9.75pt'>
    <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
    color:black'>&nbsp;<?php echo "$nota_final"; ?></span></p>


  <?php 
    }
  
    for ($j=$conta_notas_divers; $j <= 2; $j++) { 
      // code...
    
  ?>
  
  <td width=20 valign=bottom style='width:15.3pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;0</span></p>
  </td>
  <?php 

  }
}
   ?>


 </tr>

<?php 
}
 ?>



 <!-- ######################## CARGA HORARIA TOTAL HISTORICO ######################### -->

 <tr style='height:11.45pt'>
  <td width=185 colspan=3 valign=top style='width:138.4pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  15.05pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>CARGA
  HORÁRIA TOTAL</span></b></p>
  </td>
  <?php 
    for ($i=0; $i <9 ; $i++) { 
   
   ?>
  <td width=62 colspan=3 valign=bottom style='width:46.8pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>

<?php } ?>
 </tr>



 <tr style='height:41.85pt'>
  <td width=748 colspan=30 valign=top style='width:561.2pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:41.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:7.0pt'>O Sistema Municipal de Ensino de Luís
  Eduardo Magalhães, conforme resolução n°006/2011, publicado no diário oficial
  do municipal n° 566 de 13/12/2011, do Conselho Municipal de Educação adota o
  Ciclo Básico de Alfabetização, com dois anos de duração, sem retenção ou
  promoção, no decorrer deste.</span></p>
  </td>
 </tr>


 <!-- ############################## MOVIMENTAÇÃO ESCOLAR ############################## -->

 <tr style='height:14.25pt'>
  <td width=748 colspan=30 valign=top style='width:561.2pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:14.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.5pt'>ESTUDOS
  REALIZADOS - ENSINO FUNDAMENTAL</span></b></p>
  </td>
 </tr>
 <tr style='height:14.25pt'>
  <td width=79 colspan=2 valign=top style='width:59.05pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:14.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.5pt'>ANO</span></b></p>
  </td>
  <td width=106 valign=top style='width:79.35pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:14.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.5pt'>ANO/SÉRIE</span></b></p>
  </td>
  <td width=354 colspan=16 valign=top style='width:265.25pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:14.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  85.85pt;line-height:normal'><b><span style='font-size:9.5pt'>ESTABELECIMENTO
  DE ENSINO</span></b></p>
  </td>
  <td width=156 colspan=8 valign=top style='width:116.9pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:14.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.5pt'>CIDADE</span></b></p>
  </td>
  <td width=54 colspan=3 valign=top style='width:40.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:14.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.5pt'>UF</span></b></p>
  </td>
 </tr>
 <tr style='height:11.25pt'>
  <td width=79 colspan=2 valign=bottom style='width:59.05pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=106 valign=bottom style='width:79.35pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=354 colspan=16 valign=bottom style='width:265.25pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=156 colspan=8 valign=bottom style='width:116.9pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=54 colspan=3 valign=bottom style='width:40.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 


 <tr style='height:14.1pt'>
  <td width=748 colspan=30 valign=top style='width:561.2pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:14.1pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.5pt'>Rendimento Escolar do(a) aluno(a) - Ano
  letivo de:_ até _ Ano turmaTurno:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></p>
  </td>
 </tr>

 <!-- ####################### ESPECIE DE BOLETIM COM OBSERVAÇÃO ###################### -->

 <tr style='height:13.35pt'>
  <td width=185 colspan=3 rowspan=2 valign=top style='width:138.4pt;border:
  solid black 1.0pt;border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:13.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  52.7pt;line-height:normal'><b><span style='font-size:10.5pt'>DISCIPLINA</span></b></p>
  </td>
  <td width=83 colspan=4 valign=top style='width:62.05pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  15.05pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>I
  unidade</span></b></p>
  </td>
  <td width=98 colspan=4 valign=top style='width:73.2pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  15.05pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>II
  unidade</span></b></p>
  </td>
  <td width=91 colspan=4 valign=top style='width:68.0pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  15.05pt;line-height:normal'><b><span style='font-size:7.5pt;font-family:"Arial",sans-serif'>III
  unidade</span></b></p>
  </td>
  <td width=293 colspan=15 valign=top style='width:219.55pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:7.5pt;
  font-family:"Arial",sans-serif'>OBSERVAÇÕES</span></b></p>
  </td>
 </tr>



 <tr style='height:11.45pt'>
  <td width=49 colspan=2 valign=top style='width:36.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.5pt;line-height:normal'><span style='font-size:7.5pt'>Nota</span></p>
  </td>
  <td width=34 colspan=2 valign=top style='width:25.4pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:7.5pt'>Faltas</span></p>
  </td>
  <td width=49 colspan=2 valign=top style='width:36.6pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.5pt;line-height:normal'><span style='font-size:7.5pt'>Nota</span></p>
  </td>
  <td width=49 colspan=2 valign=top style='width:36.6pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:7.5pt'>Faltas</span></p>
  </td>
  <td width=42 colspan=2 valign=top style='width:31.4pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.5pt;line-height:normal'><span style='font-size:7.5pt'>Nota</span></p>
  </td>
  <td width=49 colspan=2 valign=top style='width:36.6pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
  7.5pt;line-height:normal'><span style='font-size:7.5pt'>Faltas</span></p>
  </td>
  <td width=293 colspan=15 rowspan=13 valign=top style='width:219.55pt;
  border-top:none;border-left:none;border:solid black 1.0pt;border-right:
  solid black 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:11.45pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.5pt'>A partir
  de 2007 a Rede Municipal adotou o Ensino<br>
  Fundamental de 9 anos.</span></p>
  </td>
 </tr>
 <tr style='height:12.0pt'>
  <td width=185 colspan=3 valign=top style='width:138.4pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.5pt;font-family:"Arial",sans-serif'><!-- Língua
  Portuguesa --></span></p>
  </td>
  <td width=49 colspan=2 valign=bottom style='width:36.65pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=34 colspan=2 valign=bottom style='width:25.4pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=49 colspan=2 valign=bottom style='width:36.6pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=49 colspan=2 valign=bottom style='width:36.6pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=42 colspan=2 valign=bottom style='width:31.4pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=49 colspan=2 valign=bottom style='width:36.6pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>

 
 



 <!-- ############################## RODAPÉ ################################# -->
 <tr style='height:22.05pt'>
  <td width=748 colspan=30 valign=top style='width:561.2pt;border:solid black 1.0pt;
  border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:22.05pt'>
  <!-- <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.5pt'>tificCeramos que o(a) aluno(a) </span><b><span
  style='font-size:9.5pt'>Aluno </span></b><span style='font-size:8.5pt'>concluiu
  no ano de 2017 o <b><u>°&nbsp;Ano</u> </b>do Ensino Fundamental de 9 anos,
  conforme Histórico Escolar.</span></p> -->
  </td>
 </tr>
 <tr style='height:124.5pt'>
  <td width=378 nowrap colspan=0 valign=top style='width:283.8pt;border:none;
  border-right:solid black 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:124.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='position:absolute;z-index:251658240;margin-left:0px;
  margin-top:0px;width:3px;height:7px'><img width=3 height=7
  src="hitorico_arquivos/image002.png"></span></p>
  
  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0>
   <tr style='height:124.5pt;'>
    <td width=377 valign=bottom style='width:283.0pt;border:solid black 1.0pt;
    border-top:none;padding:0cm 0cm 0cm 0cm;height:124.5pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:
    .0001pt;text-align:center;line-height:normal'><span style='font-size:6.5pt'>Carimbo
    e Ass. do(a) diretor(a)</span></p>
    </td>
   </tr>
  </table>
  </td>

  <td width=370 colspan=18 valign=bottom style='width:277.4pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:124.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:6.5pt'>Carimbo e
  Ass. do(a) secretário escolar(a)</span></p>
  </td>
 </tr>
 <tr style='height:13.5pt'>
  <td width=378 colspan=1 valign=top style='width:283.8pt;border-top:solid black 1.0pt;
  border-left:solid black 1.0pt;border-bottom:none;border-right:none;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:6.5pt'>Secretaria Municipal de Educação -
  Fone/Fax: (77) 3639-2353</span></p>
  </td>
  <td width=370 colspan=18 style='width:277.4pt;border:none;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:10.0pt;font-family:"Times New Roman",serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>

 <tr style='height:14.85pt'>
  <td width=378 colspan=12 valign=top style='width:283.8pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;padding:0cm 3.5pt 0cm 3.5pt;height:14.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:6.5pt'><a
  href="mailto:estatisticasme@hotmail.com"><span style='color:windowtext;
  text-decoration:none'>email: estatisticasme@hotmail.com</span></a></span></p>
  </td>
  <td width=370 colspan=18 valign=top style='width:277.4pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:14.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:6.5pt'>Luís
  Eduardo Magalhães-BA, <?php   echo date("d/m/Y"); ?></span></p>
  </td>
 </tr>

</table>

<p class=MsoNormal>&nbsp;</p>

</div>

<?php 

}

?>