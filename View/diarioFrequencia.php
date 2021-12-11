<?php 
function diario_frequencia($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,$conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre){
  $nome_disciplina='';
  $tipo_ensino="";

if ($idserie <3) {
  $tipo_ensino="Educação Infantil";
}if ($idserie >=3 && $idserie <8) {
  $tipo_ensino="Ensino Fundamental - Anos Iniciais";
}else if($idserie >= 8 && $idserie <=11){
  $tipo_ensino="Ensino Fundamental - Anos Finais";

}else if ($idserie>11) {
  $tipo_ensino="Educação de Jovens e Adultos";

}



$result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina=$iddisciplina");
foreach ($result_disc as $key => $value) {
  $nome_disciplina=$value['nome_disciplina'];
}
?>


<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta charset="UTF-8">
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="pla_arquivos/filelist.xml">
<link rel=Edit-Time-Data href="pla_arquivos/editdata.mso">

<style>
.Namerotate {
  display:inline-block;
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
  -webkit-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  transform: rotate(270deg);
  
}

.tblborder, .tblborder td, .tblborder th{
  border-collapse:collapse;
  border:1px solid #000;
}

.tblborder td, .tblborder th{
  padding:20px 10px;
}

.positionRi {
  position: absolute;
  top: 10px;
  left: 5px;
  /*right:0; */
  width: 200px;
  height: 150px;
  /*border: 3px solid #73AD21;*/
}

</style>

<link rel=dataStoreItem href="pla_arquivos/item0001.xml"
target="pla_arquivos/props002.xml">
<link rel=themeData href="pla_arquivos/themedata.thmx">
<link rel=colorSchemeMapping href="pla_arquivos/colorschememapping.xml">
</head>

<body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>

<div class=WordSection1>

    <!-- FECHANDO A LINHA NO TOPO DO NOME PREFEITURA -->

<table  class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 
  style='width: 100%;'>
  
<!-- <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=1091
 style='page-break-after: always; page-break-inside: auto; width:818.05pt;border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 3.5pt 0cm 3.5pt; border: 1px solid black;'>
 --> 
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.0pt'>
 
 <td width=11 nowrap valign=bottom style='width:15.4pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  
  
  <td width=824 nowrap colspan=30 valign=bottom style='width:618.25pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt;'>
  <p  style='margin-bottom:0cm;line-height:normal'>


    <span style='mso-ignore:vglayout;
  position:absolute;z-index:251659264;margin-top:0px;
  width:68px;height:75px'><img width=68 height=75
  src="pla_arquivos/image001.png" v:shapes="Imagem_x0020_6"></span><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></p><br>
  
    <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
        style='mso-cellspacing:0cm;mso-yfti-tbllook:1184;mso-padding-alt:0cm 0cm 0cm 0cm; '>
        <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
            line-height:normal'><b><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
            mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
            color:black;mso-fareast-language:PT-BR;margin-left: 100px;'>
            PREFEITURA MUNICIPAL LUÍS EDUARDO MAGALHÃES <o:p></o:p></span></b>
        </p>
        
        </tr>
    </table>

    </td>

 
 </tr>
 
 

 <tr style='mso-yfti-irow:2;height:18.0pt'>

  <td width=824 nowrap colspan=25 valign=bottom style='width:618.25pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR; margin-left: 300px;'>DIÁRIO DE CLASSE - FREQUÊNCIA E
  RENDIMENTO<o:p></o:p></span></b></p>
  </td>

 </tr>


  <tr style='mso-yfti-irow:2;height:18.0pt'>
 
  <td width=824 nowrap colspan=25 valign=bottom style='width:618.25pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:18.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR; margin-left: 300px;'><o:p></o:p></span></b></p>
  </td>

 </tr>



 <tr style='mso-yfti-irow:4;height:12.0pt'>
  <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>

  <td width=808 nowrap colspan=29 style='width:606.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
  PT-BR'>ESCOLA MUNICIPAL:<span style='mso-spacerun:yes'>
<?php 
$result_escola= $conexao->query("SELECT * FROM escola where idescola =$idescola");
foreach ($result_escola as $key => $value) {
  $nome_escola=$value['nome_escola'];
  echo "$nome_escola";
}

?>

   </span><o:p></o:p></span></b></p>
  </td>

 </tr>


 <tr style='mso-yfti-irow:5;height:12.0pt'>
  <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=808 nowrap colspan=29 style='width:606.25pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
  PT-BR'>ENDEREÇO:<span style='mso-spacerun:yes'> </span><o:p></o:p></span></b></p>
  </td>

 </tr>




 <tr style='mso-yfti-irow:6;height:12.0pt'>
  <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=457 nowrap colspan=11 style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
  PT-BR'>TIPO DE ENSINO: <?php echo $tipo_ensino; ?><o:p></o:p></span></b></p>
  </td>
  <td width=351 nowrap colspan=18 style='width:263.6pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  class=SpellE><span style='font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>Codigo</span></span><span
  style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
  PT-BR'> U.E.<span style='mso-spacerun:yes'> </span><o:p></o:p></span></p>
  </td>

 </tr>



 <tr style='mso-yfti-irow:7;height:12.0pt'>
  <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=457 nowrap colspan=11 style='width:342.65pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
  PT-BR'>ANO: <o:p>
<?php 
$result_escola= $conexao->query("SELECT * FROM serie where id =$idserie");
foreach ($result_escola as $key => $value) {
  $nome_serie=$value['nome'];
  echo "$nome_serie";
}

?>

  </o:p></span></b></p>
  </td>
  <td width=351 nowrap colspan=18 style='width:263.6pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='font-family:"Tw Cen MT Condensed",sans-serif;mso-fareast-font-family:
  "Times New Roman";mso-bidi-font-family:Arial;color:black;mso-fareast-language:
  PT-BR'>PERIODO LETIVO 2021<o:p></o:p></span></b></p>
  </td>

 </tr>



 <tr style='mso-yfti-irow:8;height:15.0pt'>
  <td width=21 nowrap style='width:15.4pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 nowrap style='width:195.55pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>COMPONENTE CURRICULAR: <b> <?php echo $nome_disciplina; ?></b> </span></p>
  </td>
  
 </tr>



 <tr style='mso-yfti-irow:9;height:16.5pt'>
  <td width=21 nowrap style='width:15.4pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 3.5pt 0cm 3.5pt;
  height:16.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 nowrap style='width:195.55pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>UNIDADE: 
  <?php 
  if ($periodo_id==1) {
    $data_inicio_trimestre="2021-05-03";
    $data_fim_trimestre="2021-07-09";
    echo "I TRIMESTRE ".converte_data($data_inicio_trimestre)." ".converte_data($data_fim_trimestre);
}elseif ($periodo_id==2) {
    $data_inicio_trimestre="2021-07-27";
    $data_fim_trimestre="2021-10-01";
    echo "II TRIMESTRE ".converte_data($data_inicio_trimestre)." ".converte_data($data_fim_trimestre);


}elseif ($periodo_id==3) {
    $data_inicio_trimestre="2021-10-04";
    $data_fim_trimestre="2021-12-21";
    echo "III TRIMESTRE ".converte_data($data_inicio_trimestre)." ".converte_data($data_fim_trimestre);
  
}

?>
<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap style='width:14.8pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:16.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  
  


  

 </tr>



 <tr style='mso-yfti-irow:10;height:12.0pt'>
   
  <td width=21 nowrap rowspan=3 style='width:15.4pt; border-top:none;border-left:
    solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
    padding:0cm 3.5pt 0cm 3.5pt;mso-rotate:90;height:12.0pt'>

    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'>
        <div class="Namerotate" >
          <span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
        color:black;mso-fareast-language:PT-BR'>  
      </span></div>
    </p>
  </td>

  <td width=261 nowrap rowspan=3 style='width:195.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>ALUNO(A)<o:p></o:p></span></b></p>
  </td>

  <td width=548 nowrap colspan="<?php echo $limite_aula; ?>" style='width:150.7pt;border:none;border-bottom:
  solid windowtext 1.0pt;border-top:
  solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>Aula/Data<o:p></o:p></span></b></p>

  </td>




 
<!-- arghg -->



 </tr>

 <tr style='mso-yfti-irow:11;height:58.75pt'>


  <?php
$result_data_aula=$conexao->query("
SELECT * FROM frequencia WHERE
escola_id=$idescola and
turma_id=$idturma and
disciplina_id=$iddisciplina and 
data_frequencia BETWEEN '$data_inicio_trimestre' and '$data_fim_trimestre' group by aula,data_frequencia order by data_frequencia asc limit $inicio,$fim ");
$array_data_aula=array();
$array_aula=array();
foreach ($result_data_aula as $key => $value) {
  $data_frequencia=$value['data_frequencia'];
  $aula=$value['aula'];

    $array_data_aula[$conta_data]=$data_frequencia;
    $array_aula[$conta_data]=$aula;

   if ($conta_data%2==0) {
     
  ?>
  
  <td style='border:solid windowtext 1.0pt;
      border-left:none;background:#D9D9D9;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:6.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo "".converte_data($data_frequencia); ?> </div></span></p>
  </td>
  
<?php
  } else{ 
?>
  
  <td style='border:solid windowtext 1.0pt;
      border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:6.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo converte_data($data_frequencia); ?></div></span></p>
  </td>
  
<?php
  }

  $conta_data++;

 } 






for ($i=$conta_data; $conta_data<$limite_data ; $i++) { 
 
   if ($conta_data%2==0) {
     
  ?>
  
  <td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt;
      border-left:none;background:#D9D9D9;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate">
        <span style='font-size:6.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'>   </span></div></p>
  </td>
  
<?php
  } else{ 
?>
  
  <td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt;
      border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:6.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'>  </div></span></p>
  </td>
  
<?php
  }

  $conta_data++;

 } 

?>

<!-- verifica as datas da avaliações -->
 </tr>


 <tr style='mso-yfti-irow:12;height:72.25pt'>


<?php
$result_aula=$conexao->query("
SELECT * FROM frequencia WHERE
escola_id=$idescola and
turma_id=$idturma and
disciplina_id=$iddisciplina and 
data_frequencia BETWEEN '$data_inicio_trimestre' and '$data_fim_trimestre' limit  $inicio,$fim");

foreach ($result_aula as $key => $value) {
   if ($conta_aula%2==0) {
?>
  
 <td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt;
      border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;background:
  #D9D9D9;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo "Aula $conta_aula"; ?> </div></span></p>
  </td>

  
<?php
  }else{
?>
 <td  style='border:solid windowtext 1.0pt;
      border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo "Aula $conta_aula"; ?> </div></span></p>
  </td>

  
<?php
  }

  $conta_aula++;
} 



for ($i=$conta_aula; $i < $limite_aula ; $i++) { 
   if ($conta_aula%2==0) {
?>
  
 <td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt;
      border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;background:
  #D9D9D9;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo "Aula $conta_aula"; ?> </div></span></p>
  </td>

  
<?php
  }else{
?>
 <td width=41 nowrap style='width:18.8pt;border:solid windowtext 1.0pt;
      border-left:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-alt:
      solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo "Aula $conta_aula"; ?> </div></span></p>
  </td>

  
<?php
  }

  $conta_aula++;
} 
 
?>
 

  



  <!-- ARIVAN FIM AULA 75  -->


 </tr>


<!-- ************************************************ARIVAN COMECO DAS LINHAS******************************************* -->

 
<?php
  $result= listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
  $conta=1;
              foreach ($result as $key => $value) {
                $nome_aluno=utf8_decode($value['nome_aluno']);
                $nome_turma=($value['nome_turma']);
                $idaluno=$value['idaluno'];
                $status_aluno=$value['status_aluno'];
                $email=$value['email'];
                $senha=$value['senha'];
?>

<tr style='mso-yfti-irow:13;height:13.5pt'>
  <td width=21 style='width:15.4pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  mso-border-right-alt:solid windowtext 1.0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:13.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>


  <?php echo "$conta"; ?> 

  <o:p></o:p></span></p>
  </td>

  <td width=261 nowrap valign=bottom style='width:235.55pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt;font-size:9.0pt'>

  <?php echo "$nome_aluno"; ?> 
  </td>


<?php
$presenca=".";
$conta_presenca=1;
 foreach ($array_aula as $key => $value) {
    $aula=$array_aula[$key];
    $data_frequencia=$array_data_aula[$key];

    $res_pre=$conexao->query("SELECT presenca from frequencia where presenca=1 and aluno_id=$idaluno and disciplina_id=$iddisciplina and turma_id=$idturma and data_frequencia='$data_frequencia' and aula='$aula' ");
     
    if ($res_pre->rowCount()>0) {
      $presenca=".";
    }else{
      $presenca="";
       $presenca="-";

    }
   
  ?>
  

  <td width=10 nowrap valign=top style='border:solid windowtext 1.0pt;
    border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:
    solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background:
    white;height:13.5pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;
    line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
    color:black;mso-fareast-language:PT-BR'><?php echo $presenca; ?></span></b></p>
    </td>
    
  <?php
  $conta_presenca++;
  } 


//
 for ($i=$conta_presenca; $i < $limite_aula; $i++) {
   
  ?>
  

  <td width=10 nowrap valign=top style='border:solid windowtext 1.0pt;
    border-top:none;mso-border-left-alt:solid windowtext 1.0pt;mso-border-bottom-alt:
    solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;background:
    white;height:13.5pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
    color:black;mso-fareast-language:PT-BR'>  </span></b></p>
  </td>
    
  <?php
   } 
   ?>
       
      <?php


 echo"</tr>";
 $conta++;



}
?>




</table>


</div>

<!-- ********************************************** -->
</body>

</html>

<?php 

}

?>