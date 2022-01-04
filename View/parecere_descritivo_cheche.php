<?php
  include"../Controller/Conversao.php";
  include"../Model/Coordenador.php";
  include"../Model/Aluno.php";
 
 function parecere_descritivo_cheche($conexao,$idescola,$idturma,$iddisciplina,$idserie,$nome_escola,$nome_aluno,$nome_turma,$idaluno){
?>

<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0  
 style=' border-collapse:collapse;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 3.5pt 0cm 3.5pt'>

 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:20.25pt'>
  <td width=936 nowrap colspan=7 valign=bottom style='width:701.7pt;border:
  solid windowtext 1.0pt;border-bottom:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:20.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:20.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>PREFEITURA DE LUIS EDUARDO MAGALHÃES</b></span><span
  style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
  mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
  mso-fareast-language:PT-BR;mso-no-proof:yes'> </span>

  <span style='mso-ignore:vglayout;
  position:absolute;z-index:251660288;left:0px;margin-left:15px;margin-top:
  9px;width:49px;height:53px'><img width=49 height=53
  src="regitro_conteudo_arquivos/image002.jpg" v:shapes="Imagem_x0020_2"></span><span
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
 <tr style='mso-yfti-irow:2;height:18.75pt'>
  <td width=936 colspan=7 style='width:701.7pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:18.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:16.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>OBJETOS DE CONHECIMENTOS</b><o:p></o:p></span></p>
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
  color:black;mso-fareast-language:PT-BR'><b>ESCOLA MUNICIPAL: <?php echo"$nome_escola"; ?></b> <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:15.0pt'>
  <td width=936 colspan=7 valign=bottom style='width:701.7pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>PERÍODO <?php echo $_SESSION['ano_letivo']; ?></b><o:p></o:p></span></p>
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

<tr style='mso-yfti-irow:6;height:15.0pt'>
   <td width=406 colspan=2 valign=bottom style='width:304.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
  mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
  color:black;mso-fareast-language:PT-BR'><b>ALUNO: <?php echo"$nome_aluno"; ?></b> <o:p></o:p></span></p>
  </td>

 </tr>




 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - DIAGNÓSTICO INICIAL<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>
    <?php 
    $parecer_descritivo='';
    $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola);

    foreach ($pes as $chave => $linha) {
      $iddisciplina=$linha['iddisciplina'];
      $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'DIAGNÓSTICO INICIAL',$idaluno,6);
      foreach ($resultado as $key => $value) {
        $parecer_descritivo=$value['parecer_descritivo'];
      }
    }
      echo "$parecer_descritivo";

    ?>
  </o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - 1º TRIMESTRE DIDÁTICO<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>

    <?php 
    $parecer_descritivo="";
    // $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola);

    // foreach ($pes as $chave => $linha) {
    //   $iddisciplina=$linha['iddisciplina'];
    //   $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno);
    //   foreach ($resultado as $key => $value) {
    //     $parecer_descritivo="".$value['parecer_descritivo'];
    //   }
    
    // }   
 
    // $pes2=listar_disciplina_da_turma($conexao,$idturma,$idescola);
    // foreach ($pes2 as $chave => $linha) {
    //   $iddisciplina=$linha['iddisciplina'];
    //   $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av2',$idaluno);
    //   foreach ($resultado as $key => $value) {
    //     $parecer_descritivo.=". ".$value['parecer_descritivo'];
    //   }
    
    // }


    $pes3=listar_disciplina_da_turma($conexao,$idturma,$idescola);
    foreach ($pes3 as $chave => $linha) {
      $iddisciplina=$linha['iddisciplina'];

      if ($parecer_descritivo =="") {
        
        $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av3',$idaluno,1);

        foreach ($resultado as $key => $value) {
          $parecer_descritivo=" ".$value['parecer_descritivo'];
        }

      }
    
    }


    if ($parecer_descritivo=="") {

      $pes_pare=listar_disciplina_da_turma($conexao,$idturma,$idescola);
      foreach ($pes_pare as $chave => $linha) {
        $iddisciplina=$linha['iddisciplina'];
        
        $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno,1);
        foreach ($resultado as $key => $value) {
          $parecer_descritivo=" ".$value['parecer_descritivo'];
        }
      
      }

    }

if (isset($_GET['token'])) {
  echo "SELECT * FROM nota WHERE
      disciplina_id=$iddisciplina and 
      escola_id=$idescola and 
      turma_id=$idturma and avaliacao='$avaliacao' and aluno_id=$idaluno and parecer_descritivo!='' and periodo_id=1 group by parecer_descritivo limit 1  ";

}

echo "$parecer_descritivo";

    ?>
  </o:p></span></p>
  </td>
 </tr>

 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - 2º TRIMESTRE DIDÁTICO<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p> 

<?php 

    $parecer_descritivo="";
    $pes_periodo2=listar_disciplina_da_turma($conexao,$idturma,$idescola);
    foreach ($pes_periodo2 as $chave => $linha) {
      $iddisciplina=$linha['iddisciplina'];
      $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av3',$idaluno,2);
      foreach ($resultado as $key => $value) {
        $parecer_descritivo=$value['parecer_descritivo'];
      }
    
    }


    if ($parecer_descritivo=="") {
      $pes_pare=listar_disciplina_da_turma($conexao,$idturma,$idescola);
      foreach ($pes_pare as $chave => $linha) {
        $iddisciplina=$linha['iddisciplina'];
        $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno,2);
        foreach ($resultado as $key => $value) {
          $parecer_descritivo=" ".$value['parecer_descritivo'];
        }
      
      }

    }

echo "$parecer_descritivo";
?>
  </o:p></span></p>
  </td>
 </tr>

 <tr style='mso-yfti-irow:11;height:15.75pt'>
  <td width=400 nowrap colspan=8 style='width:942.5pt;border:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  mso-fareast-font-family:"Times New Roman";color:black;mso-fareast-language:
  PT-BR'>PARECER DESCRITIVO - 3º TRIMESTRE DIDÁTICO<o:p></o:p></span></b></p>
  </td>
  <td width=8 style='width:6.1pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:15.75pt'>
  <td width=400 nowrap colspan=8 valign=bottom style='width:942.5pt;
  border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
  mso-border-top-alt:windowtext 1.0pt;mso-border-left-alt:windowtext 1.0pt;
  mso-border-bottom-alt:windowtext .5pt;mso-border-right-alt:black 1.0pt;
  mso-border-style-alt:solid;background:white;padding:0cm 3.5pt 0cm 3.5pt;
  height:15.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
  "Times New Roman";color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p>

    <?php 

          $parecer_descritivo="";
        $pes_periodo3=listar_disciplina_da_turma($conexao,$idturma,$idescola);
        foreach ($pes_periodo3 as $chave => $linha) {
          $iddisciplina=$linha['iddisciplina'];
          $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av3',$idaluno,3);
          foreach ($resultado as $key => $value) {
            $parecer_descritivo=" ".$value['parecer_descritivo'];
          }
        
        }

        if ($parecer_descritivo=="") {
          $pes_pare=listar_disciplina_da_turma($conexao,$idturma,$idescola);
          foreach ($pes_pare as $chave => $linha) {
            $iddisciplina=$linha['iddisciplina'];
            $resultado=listar_todas_avaliacao_lancada_parecer($conexao,$idescola,$idturma,$iddisciplina,'av1',$idaluno,3);
            foreach ($resultado as $key => $value) {
              $parecer_descritivo=" ".$value['parecer_descritivo'];
            }
          
          }

        }

    echo "$parecer_descritivo";
    ?>
   </o:p></span></p>
  </td>
 </tr>

</table>

 
</div>




<?php 
  }
?>