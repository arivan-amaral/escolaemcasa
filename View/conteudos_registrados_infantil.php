<?php
 function diario_conteudo_infantil($conexao,$idescola,$idturma,$idserie, $iddisciplina,$nome_professor,$nome_turma,$nome_escola,$data_inicial,$data_final,$periodo,$ano_letivo){
?>

<div class=WordSection1>

<table class='MsoNormalTable' style="width: 100%;">

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:20.25pt'>
  <td width=936 nowrap colspan=7 valign=bottom style='width:701.7pt;border:
  solid windowtext 1.0pt;border-bottom:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:20.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b><?php echo $_SESSION['ORGAO']; ?></b></span><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR;mso-no-proof:yes'> </span>

  <span style='mso-ignore:vglayout;
  position:absolute;z-index:251660288;left:0px;margin-left:15px;margin-top:
  9px;width:49px;height:53px'><img width=49 height=53
  src="imagens/logo.png" v:shapes="Imagem_x0020_2"></span><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR'><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:15.0pt'>
  <td width=936 colspan=7 style='width:701.7pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:15.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>SECRETARIA MUNICIPAL DE EDUCAÇÃO</b><o:p></o:p></span></p>
  </td>
 </tr>

 <tr style='mso-yfti-irow:3;height:15.0pt'>
  <td width=936 colspan=7 style='width:701.7pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:14.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:15.0pt'>
  <td width=936 colspan=7 valign=bottom style='width:701.7pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>ESCOLA MUNICIPAL: <?php echo $nome_escola; ?></b> <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:15.0pt'>
  <td width=936 colspan=7 valign=bottom style='width:701.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>PERÍODO: <?php 
  echo converte_data($data_inicial) ." - ". converte_data($data_final); ?></b><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:15.0pt'>
    <td width=161 colspan=2 valign=bottom style='width:120.5pt;border:solid windowtext 1.0pt;
      border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
      style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
      color:black;mso-fareast-language:PT-BR'><b>ANO:</b><span style='mso-spacerun:yes'>
      </span><o:p></o:p></span></p>
    </td>
  <td width=406 colspan=2 valign=bottom style='width:304.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>TURMA: <?php echo"$nome_turma"; ?></b> <o:p></o:p></span></p>
  </td>
  <td width=369 colspan=3 valign=bottom style='width:276.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>TURNO:</b><span
  style='mso-spacerun:yes'></span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:15.0pt'>
  <td width=936 colspan=7 valign=bottom style='width:701.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:8.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
 </tr> 
 <tr style='mso-yfti-irow:8;height:15.0pt'>
  <td width=567 nowrap colspan=4 style='width:15.0cm;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>COMPONENTE CURRICULAR:</b>
<?php 

  $res_disciplinas=listar_disciplina_professor_regente($conexao,$idserie,$idturma,$idescola,$ano_letivo);
  $disciplinas_regente_abreviacao =array();
  
  $nome_disciplina="";

  foreach ($res_disciplinas as $key => $value) {
    $disciplina_id=$value['disciplina_id'];

    $nome_disciplina.=$value['nome_disciplina'];
    $abreviacao=$value['abreviacao'];
    //echo "$nome_disciplina, ";
    $disciplinas_regente_abreviacao[$disciplina_id]=$abreviacao;

    
  }
  echo wordwrap($nome_disciplina, 108, "<br />\n", true);
 ?>
</span></p>
  </td>
  <td width=180 nowrap colspan=2 valign=bottom style='width:134.7pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b><!-- AULAS PREVISTAS: --></b><o:p></o:p></span></p>
  </td>
  <td width=189 nowrap style='width:5.0cm;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b><!-- AULAS DADAS: --></b> <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:15.0pt'>
  <td width=161 nowrap colspan=2 style='width:120.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>UNIDADE: 

      <?php 
     echo "$periodo";
  
    ?>

  </b><o:p></o:p></span></p>
  </td>
  <td width=406 nowrap colspan=2 style='width:304.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>PROFESSOR (A): <?php echo "$nome_professor"; ?><o:p></o:p></span></p>
  </td>
  <td width=180 nowrap colspan=2 style='width:134.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=189 nowrap valign=bottom style='width:5.0cm;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
   padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
  </td>
 </tr>


 <tr style='mso-yfti-irow:10;height:15.75pt'>
  <td width=66 nowrap style='width:49.65pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>Data<o:p></o:p></span></p>
  </td>
  <td width=94 nowrap style='width:70.85pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>Campo do dia<o:p></o:p></span></p>
  </td>

    <td   nowrap style='border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>RESPONSÁVEL<o:p></o:p></span></p>
  </td>
  <td width=406 nowrap colspan=5 style=' border-top:1.0pt;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>
 <?php //echo "$nome_disciplina"; ?>
 Conteúdos desenvolvidos
  <o:p></o:p></span></p>
  </td>
 
 </tr>

<?php
$disciplinas=" ( disciplina_id=40 or disciplina_id=43 or  disciplina_id=41 ) ";
$descricao="";
 
$result_conteudo= $conexao->query("SELECT * FROM conteudo_aula where  turma_id=$idturma and escola_id=$idescola  and data BETWEEN '$data_inicial' and '$data_final' order by data asc ");
$conta=1;
$array_datas = array();
$abreviacao_displina_da_data = array();
 $idconteudo_prof="id IN(0";
foreach ($result_conteudo as $key => $value) {
  $idconteudo=$value['id'];
  $idconteudo_prof.=",".$value['id'];

  $disciplina_id=$value['disciplina_id'];
  
  $data_conte_bd=$value['data'];
  if (!array_key_exists($data_conte_bd,$array_datas)) {
    $array_datas[$data_conte_bd]="". $value['descricao'];
      
   
    // $array_abreviacao_displina_da_data[$data_conte_bd]="". $value['descricao'];
  }else if(!in_array($value['descricao'], $array_datas)){
    $array_datas[$data_conte_bd].="; ". $value['descricao'];
     

  }

   if (!array_key_exists($disciplina_id,$abreviacao_displina_da_data  )) {
      $abreviacao_displina_da_data[$data_conte_bd][$disciplina_id]=$disciplinas_regente_abreviacao[$disciplina_id];
   }
}
 $idconteudo_prof.=") ";


foreach ($array_datas as $key => $value) {
  $data_conteudo=converte_data($key);
  $descricao=$value;
?>
 <tr style='mso-yfti-irow:11;height:15.0pt'>
      <td width=66 nowrap valign=bottom style='width:49.65pt;border:solid windowtext 1.0pt;
      border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
      solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
      0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
      line-height:normal'><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
      color:black;mso-fareast-language:PT-BR'><?php echo "$data_conteudo"; ?><o:p></o:p></span></p>
      </td>

  
      <td width=94  style='width:304.75pt;border-top:none;
      border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
      mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
      style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
      color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
        <?php
        $abrev="";
        //var_dump($abreviacao_displina_da_data);

        foreach ($abreviacao_displina_da_data[$key] as $chave => $value) {
             $abrev.= $value .", ";
             
             

        }
          echo $abrev; 

    ?></o:p></span></p>
      </td>  



       <td nowrap valign=bottom style=' border:solid windowtext 1.0pt;
      border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
      solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
      0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal   style='margin-bottom:0cm; 
      line-height:normal'><span style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
      color:black;mso-fareast-language:PT-BR'>
      <?php 
              $result_funcionario_conteudo= $conexao->query("SELECT * FROM 
          funcionario,conteudo_aula
         where 
        ( funcionario_id=idfuncionario or  professor_id=idfuncionario )and   $idconteudo_prof  limit 5 ");
        foreach ($result_funcionario_conteudo as $key => $value) {
          $nome_funcionario=$value['nome'];
          echo "<b>$nome_funcionario</b> <br>";
        }
       ?>


      <o:p></o:p></span></p>
      </td>
      <td  colspan=5 style=' border-top:1.0pt;
      border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
      mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
      mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
      padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
      <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
      style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
      mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
      color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
        <?php 
        if (isset($_GET['teste'])) {
          echo "SELECT * FROM conteudo_aula where $disciplinas and turma_id=$idturma and escola_id=$idescola  and data BETWEEN '$data_inicial' and '$data_final' order by data asc && $descricao ";
        }else{
          
        echo"$descricao"; 
        }

        ?>

      </o:p></span></p>
      </td>

     
 </tr>
<?php 
$conta++;
}
?>
 


 <tr style='mso-yfti-irow:15;height:15.0pt'>
  <td width=356 nowrap colspan=3 valign=bottom style='width:266.85pt;
  border:none;border-left:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>_____________________&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=248 nowrap colspan=2 valign=bottom style='width:186.15pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'>_____/______/_______<o:p></o:p></span></p>
  </td>
  <td width=332 nowrap colspan=2 valign=bottom style='width:248.7pt;border:
  none;border-right:solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'><span style='margin-left: 80px;'>______________________</span></td>
 </tr>
 <tr style='mso-yfti-irow:16;mso-yfti-lastrow:yes;height:15.0pt'>
  <td width=356 nowrap colspan=3 valign=bottom style='width:266.85pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>ASSINATURA DO COORDENADOR</b><o:p></o:p></span></p>
  </td>
  <td width=248 nowrap colspan=2 valign=bottom style='width:186.15pt;
  border:none;border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>DATA</b><o:p></o:p></span></p>
  </td>
  <td width=332 nowrap colspan=2 valign=bottom style='width:248.7pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:9.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>ASSINATURA DO PROFESSOR</b><o:p></o:p></span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=66 style='border:none'></td>
  <td width=94 style='border:none'></td>
  <td width=195 style='border:none'></td>
  <td width=211 style='border:none'></td>
  <td width=37 style='border:none'></td>
  <td width=143 style='border:none'></td>
  <td width=189 style='border:none'></td>
 </tr>
 
</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

</div>


<?php 
}
?>