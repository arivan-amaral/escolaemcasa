<?php 

function diario_frequencia_pagina_final_infantil($conexao,$idescola,$idturma,$iddisciplina,$inicio,$fim,
  $conta_aula,$conta_data,$limite_data,$limite_aula,$periodo_id,$idserie,$descricao_trimestre,$data_inicio_trimestre,$data_fim_trimestre){


/*
  ($conta_aula+$inicio,
    $conta_data+$inicio,
    $limite_data+$inicio,
    $limite_aula+$inicio,

    $periodo_id,$idserie,$data_inicio_trimestre,$data_fim_trimestre)

    */
  
  $nome_disciplina='';

  if ($idserie>2 && $iddisciplina==1000) {
    
      $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (1,5, 6,7,14, 35,47)");

  }elseif ($idserie==1 && $iddisciplina==1000) {
      $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,43,44)");
      
    
  }elseif ($idserie==2 && $iddisciplina==1000) {
      $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina in (40,42,44)");
    
  }else{
      $result_disc = $conexao->query("SELECT * FROM disciplina where iddisciplina=$iddisciplina");

  }

  foreach ($result_disc as $key => $value) {
    $nome_disciplina.=$value['nome_disciplina'].", ";
  }


$tipo_ensino="";

if ($idserie <3) {
  $tipo_ensino="Educação Infantil";

}elseif ($idserie >=3 && $idserie <8) {
  $tipo_ensino="Ensino Fundamental - Anos Iniciais";

}else if($idserie > 8 && $idserie <=11){
  $tipo_ensino="Ensino Fundamental - Anos Finais";

}else{
  $tipo_ensino="Educação de Jovens e Adultos";

}


?>


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
  src="imagens/logo.png" v:shapes="Imagem_x0020_6"></span><span
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
  color:black;mso-fareast-language:PT-BR; margin-left: 300px;'>DIÁRIO DE CLASSE <o:p></o:p></span></b></p>
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
  PT-BR'>TIPO DE ENSINO:  <?php echo "".$tipo_ensino; ?> <o:p></o:p></span></b></p>
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
  PT-BR'>PERIODO LETIVO <?php echo $_SESSION['ano_letivo']; ?><o:p></o:p></span></b></p>
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
//   if ($periodo_id==1) {
//     $data_inicio_trimestre=$_SESSION['inicio_periodo'];
//     $data_fim_trimestre=$_SESSION['fim_periodo'];
//     echo "I TRIMESTRE ".converte_data($data_inicio_trimestre)." ".converte_data($data_fim_trimestre);
// }elseif ($periodo_id==2) {
//     $data_inicio_trimestre="2021-07-27";
//     $data_fim_trimestre="2021-10-01";
//     echo "II TRIMESTRE ".converte_data($data_inicio_trimestre)." a ".converte_data($data_fim_trimestre);


// }elseif ($periodo_id==3) {
//     $data_inicio_trimestre="2021-10-04";
//     $data_fim_trimestre="2021-12-21";
//     echo "III TRIMESTRE ".converte_data($data_inicio_trimestre)." a ".converte_data($data_fim_trimestre);
  
// }
    echo " $descricao_trimestre ".converte_data($data_inicio_trimestre)." a ".converte_data($data_fim_trimestre);

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
   
  <td width=21 nowrap rowspan=2 style='width:15.4pt; border-top:none;border-left:
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

  <td width=261 nowrap rowspan=2 style='width:195.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>ALUNO(A)<o:p></o:p></span></b></p>
  </td>

  <td width=548 nowrap colspan="100%" style='width:150.7pt;border:none;border-bottom:
  solid windowtext 1.0pt;border-top:
  solid windowtext 1.0pt;mso-border-left-alt:solid windowtext 1.0pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>Aula/Data<o:p></o:p></span></b></p>

  </td>




 
<!-- arghg -->
<!--   <td width=164 nowrap colspan=5 style='width:13.2pt;border-bottom:
  solid windowtext 1.0pt;border-left:
  solid windowtext 1.0pt;
  border-top:solid windowtext 1.0pt;padding:0cm 3.5pt 0cm 3.5pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>Rendimento<o:p></o:p></span></b></p>
  </td> -->
  <td width=60 nowrap rowspan=2 style='width:12.0pt; border-top::solid windowtext 1.0pt; border-left:
  solid windowtext 1.0pt;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-rotate:90;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><div class="Namerotate" ><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>FALTAS<o:p></o:p></span></div></p>
  </td> 


 </tr>

 <tr style='mso-yfti-irow:11;height:58.75pt'>

  
  <?php
  // disciplina_id=$iddisciplina and 
$result_data_aula=$conexao->query("
SELECT data_frequencia,aula FROM frequencia WHERE
escola_id=$idescola and
turma_id=$idturma and

data_frequencia BETWEEN '$data_inicio_trimestre' and '$data_fim_trimestre' group by data_frequencia, aula order by data_frequencia,aula asc limit $inicio,$fim ");
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
      line-height:normal'><div class="Namerotate"><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
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
      line-height:normal'><div class="Namerotate"><span style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'><?php echo converte_data($data_frequencia); ?></div></span></p>
  </td>
  
<?php
  }

  $conta_data++;

 } 





//referes as datas das aulas
for ($i=$conta_data; $conta_data<$limite_data ; $i++) { 
 
   if ($conta_data%2==0) {
     
  ?>
  
  
  <td width=41 nowrap style='width:18.8pt;border:1.0pt solid black;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt;background:#D9D9D9;'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><div class="Namerotate"><span style='font-size:6.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
      color:black;mso-fareast-language:PT-BR'>  </div></span></p>
  </td>
  
<?php
  } else{ 
?>
  
  <td width=41 nowrap style='width:18.8pt;border:1.0pt solid black;mso-border-right-alt:solid windowtext .5pt;padding:0cm 0pt 0cm 0pt;mso-rotate:90;height:0.25pt'>
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
<?php
// disciplina_id=$iddisciplina and 
$result_nota_aula=$conexao->query("
SELECT avaliacao,periodo_id,data_nota FROM nota_parecer WHERE
escola_id=$idescola and
turma_id=$idturma and

periodo_id=$periodo_id  group by avaliacao,periodo_id,data_nota limit 3");

$array_data_nota=array();
$array_avaliacao=array();
$conta_nota=1;

foreach ($result_nota_aula as $key => $value) {
  $data_nota=$value['data_nota'];
  $avaliacao=$value['avaliacao'];

  $array_data_nota[$conta_nota]=$data_nota;
  $array_avaliacao[$conta_nota]=$avaliacao;
  ?>

 

<?php 
    $conta_nota++;
  }


 for($i=$conta_nota; $i < 4; $i++) {   
?>

  
<?php 
  }
 ?>


<!--  
 <td width=41 nowrap rowspan=2 style='width:30.8pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  mso-rotate:90;height:48.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><div class="Namerotate"><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
  color:black;mso-fareast-language:PT-BR'>RU<o:p></o:p></span></div></b></p>
  </td> -->

 </tr>


 

<!-- ******************** ARIVAN COMECO DAS LINHAS ************************** -->

 
<?php


if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
  $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
}else{
  $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
 }


  $conta=1;
 foreach ($res_alunos as $key => $value) {

  $idaluno=$value['idaluno'];
  $nome_aluno=strtoupper($value['nome_aluno']);
  $nome_turma=$value['nome_turma'];
  $matricula_aluno=$value['matricula'];
  $data_matricula=$value['data_matricula'];
  
  // $result= listar_aluno_da_turma_coordenador($conexao,$idturma,$idescola);
  // $conta=1;
  //             foreach ($result as $key => $value) {
  //               $nome_aluno=utf8_decode($value['nome_aluno']);
  //               $nome_turma=($value['nome_turma']);
  //               $idaluno=$value['idaluno'];
  //               $status_aluno=$value['status_aluno'];
  //               $email=$value['email'];
  //               $senha=$value['senha'];
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
// disciplina_id=$iddisciplina and
$presenca="-";
$conta_presenca=1;
 foreach ($array_aula as $key => $value) {
    $aula=$array_aula[$key];
    $data_frequencia=$array_data_aula[$key];

    // $res_pre=$conexao->query("SELECT presenca from frequencia where presenca=1 and aluno_id=$idaluno and  turma_id=$idturma and data_frequencia='$data_frequencia' and aula='$aula' ");

    //  foreach ($res_pre as $key_res_pre => $value_res_pre) {
    //   $presenca=".";
    //  }


    $res_pre=$conexao->query("SELECT presenca from frequencia where  aluno_id=$idaluno 
       and turma_id=$idturma and data_frequencia>='$data_matricula' and  data_frequencia='$data_frequencia' and aula='$aula'  ");
      
      $presenca="-";
      foreach ($res_pre as $key => $value) {
        
        if ($value['presenca']==1) {
            $presenca=".";
        }else if ($value['presenca']==0){
            $presenca="F";
        }
           
      }

   
  ?>
  

  <td width=10 nowrap valign=top style='border: 1.0pt solid black;
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
 for ($i=$conta_presenca; $i < $limite_data ; $i++) {
   
  ?>
  

  <td width=10 nowrap valign=top style='border: 1.0pt solid black;background:
    white;height:13.5pt'>
    <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
    line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
    mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
    color:black;mso-fareast-language:PT-BR'></span></b></p>
  </td>
    
  <?php
   } 
?>
  
<!-- arivan 11122021 -->

             <!--  <td width=10 nowrap valign=top style='width:10.8pt;border:1.0pt solid black;  background: white;padding:0cm 3.5pt 0cm 3.5pt;height:13.5pt'>
               <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
               line-height:normal'><b><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
               mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Arial;
               color:black;mso-fareast-language:PT-BR'> -->  


<?php
 // disciplina_id=$iddisciplina and 
// faltas trimestre 1

$res_fre_t1=$conexao->query("
SELECT count(*) as 'quantidade' FROM frequencia WHERE
escola_id=$idescola and
turma_id=$idturma and

presenca=0 and data_frequencia>='$data_matricula' and data_frequencia BETWEEN '$data_inicio_trimestre' and '$data_fim_trimestre' and aluno_id=$idaluno ");

$quantidade_falta1=0;
foreach ($res_fre_t1 as $key => $value) {
  $quantidade_falta1=$value['quantidade'];
}

//echo "$quantidade_falta1";
?>
             <!-- </span></b></p> -->
             <!-- </td> -->
<?php

 echo"</tr>";
 $conta++;


}
?>




</table>


</div>

<!-- ********************************************** -->


<?php 

}

?>