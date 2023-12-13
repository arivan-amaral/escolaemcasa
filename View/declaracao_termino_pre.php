 <?php 
  function gerar_declaracao_terminalidade($conexao, $aluno_id, $escola_id, $turma_id, $serie_id,$ano_letivo){

$nome_escola="";
$nome_turma="";
$nome_aluno="";

$result_ecidade_matricula=$conexao->query("SELECT
           turma.nome_turma,
           escola.nome_escola,
           escola.idescola,
           serie.nome as 'nome_serie',
           ecidade_matricula.matricula_codigo as 'matricula',
           ecidade_matricula.matricula_datamatricula as 'data_matricula',
           ecidade_matricula.datasaida as 'datasaida',
           ecidade_matricula.turma_escola as 'idescola',
           ecidade_matricula.turma_id as 'idturma',
           turma.serie_id as 'idserie',
           ecidade_matricula.calendario_ano as 'calendario_ano'

           FROM
             ecidade_matricula,
             turma,escola,serie
           where
       
             turma.serie_id = serie.id and 
             ecidade_matricula.aluno_id = $aluno_id and 
             ecidade_matricula.calendario_ano = $ano_letivo and 
             ecidade_matricula.turma_id = turma.idturma and 
             ecidade_matricula.turma_escola = escola.idescola and 
             ecidade_matricula.matricula_situacao !='CANCELADO'
             ORDER by ecidade_matricula.calendario_ano desc");
              $nome_escola="";
              $nome_turma="";
              $nome_serie="";
             foreach ($result_ecidade_matricula as $key => $value) {
                $nome_escola=$value['nome_escola'];
                $nome_turma=($value['nome_turma']);
                $nome_serie=$value['nome_serie'];
             }

?>

<?php 
  $res_aluno= pesquisar_dados_aluno_por_id($conexao,$aluno_id);
  $nome_aluno='';
    $naturalidade='';
    $uf_naturalidade='';
    $data_nascimento= '';
    $filiacao1='';
    $filiacao2='';
  foreach ($res_aluno as $key => $value) {
    $nome_aluno=$value['nome'];
    $naturalidade=$value['naturalidade'];
    $estado= $value['uf_endereco'];
    /*)if (ctype_digit($cidade_municipio)) {
      $res_nome_cidade = listar_cidade_por_id($conexao,$cidade_municipio);
      foreach ($res_nome_cidade as $keyC => $valueC) {
        $nome_cidade = $valueC['nome'];
      }
    }*/

    
    $localidade_id=$value['localidade'];
    $localidade="";
    $res_estado=listar_estado_por_id($conexao,$localidade_id);
    foreach ($res_estado as $key => $value2) {
      $localidade=$value2['nome'];
    }
    $uf_naturalidade=$value['uf_cartorio'];
    $data_nascimento= converte_data(trim($value['data_nascimento']));
    $filiacao1=$value['filiacao1'];
    $filiacao2=$value['filiacao2'];
  
         $result_ecidade_matricula=$conexao->query("SELECT
                    turma.nome_turma,
                    escola.nome_escola,
                    escola.idescola,
                    serie.nome as 'nome_serie',
                    ecidade_matricula.turno_nome as 'turno_nome',
                    ecidade_matricula.matricula_codigo as 'matricula',
                    ecidade_matricula.matricula_datamatricula as 'data_matricula',
                    ecidade_matricula.datasaida as 'datasaida',
                    ecidade_matricula.turma_escola as 'idescola',
                    ecidade_matricula.turma_id as 'idturma',
                    turma.serie_id as 'idserie',
                    ecidade_matricula.calendario_ano as 'calendario_ano'

                    FROM
                      ecidade_matricula,
                      turma,escola,serie
                    where
                
                      turma.serie_id = serie.id and 
                      ecidade_matricula.aluno_id = $aluno_id and 
                      ecidade_matricula.calendario_ano = $ano_letivo and 
                      ecidade_matricula.turma_id = turma.idturma and 
                      ecidade_matricula.turma_escola = escola.idescola and 
                      ecidade_matricula.turma_escola = $escola_id and 
                      ecidade_matricula.matricula_situacao !='CANCELADO'
                      ORDER by ecidade_matricula.calendario_ano desc");
                       $nome_escola="";
                       $nome_turma="";
                       $nome_serie="";
                       $turno="";
                      foreach ($result_ecidade_matricula as $key => $value) {
                         $nome_escola=$value['nome_escola'];
                         $nome_turma=($value['nome_turma']);
                         $nome_serie=$value['nome_serie'];
                         $turno=$value['turno_nome'];
                      }

}
?>

<div class="content-wrapper" style="min-height: 529px;">
 <section class="content">
    <div class="container-fluid" style="border: 3px solid black;">
<br>
 <!-- <H1 class="no-print"> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->

 <div class=WordSection1>

 <table>

  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.75pt'>
   <td width='100%' nowrap rowspan=1 valign=top style='width:102.6pt;border:solid windowtext 1.0pt;
   border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
   solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
   0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
   <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
   line-height:normal'>

   <span style='mso-ignore:vglayout'>
   <table cellpadding=0 cellspacing=0 align=left>
    <tr>
     <td width=11 height=2></td>
    </tr>
    <tr>
     <td></td>
     <td>
      <img width=90 height=105 src="imagens/logo.png">
    </td>
    </tr>
   </table>

   </span>
   <span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
   "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'><o:p>&nbsp;</o:p></span></p>
   </td>

   <td  colspan="12" valign=top style='border:1pt;border:
   solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;padding:9pt 3.5pt 0cm 3.5pt;text-align: center;
   height:15.75pt'>
   <p class=MsoNormal style='margin-bottom:5pt;line-height:normal'><b><span
   style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
   mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'><?php echo $_SESSION['ORGAO']; ?><o:p></o:p></span></b></p>

     <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
     style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
     mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
     color:black;mso-fareast-language:PT-BR'><?php echo "$nome_escola"; ?><o:p></o:p></span></b></p>

   <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
   style='font-size:12.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
   mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>TURMA: <?php echo "$nome_turma"; ?><o:p></o:p></span></b></p>

  <!--  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
   style='font-size:10.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
   mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
   color:black;mso-fareast-language:PT-BR'>ESCOLAONEROCOSTA@HOTMAIL.COM - 
   <a
   href="http://luiseduardomagalhaes.ba.gov.br/">http://luiseduardomagalhaes.ba.gov.br/</a><o:p></o:p></span></b></p> -->
   <br>
   </td>
  </tr>
  <tr>
  <td colspan="2" >
    <br>
    <br>
    <br>
    <br>
  <p class="text-justify">









                                  <p class="MsoNormal" style="text-align: center; "><b><span style="font-size: 24pt; line-height: 107%; font-family: " source="" sans="" pro",="" sans-serif;="" background-image:="" initial;="" background-position:="" background-size:="" background-repeat:="" background-attachment:="" background-origin:="" background-clip:="" initial;"=""><br></span></b></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"></p><div style="text-align: center; text-indent: -0.666667px;"><span id="docs-internal-guid-06891f45-7fff-4fd8-3fb0-5ef60b2488a1">

                                   <span style="font-size: 20pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline;  text-align: center;"><b>
                                     DECLARAÇÃO DE TERMINALIDADE 
                                     <?php 
                                       if ($serie_id==1) {
                                         echo "DA EDUCAÇÃO INFANTIL – ETAPA MATERNAL";
                                       } else if ($serie_id==2) {
                                         echo "DA EDUCAÇÃO INFANTIL – ETAPA PRÉ-ESCOLA";
                                       } else if ($serie_id==7) {
                                         echo "DA EDUCAÇÃO FUNDAMENTAL – ETAPA 5º ANO";
                                       } else if ($serie_id==11 || $serie_id==15) {
                                         echo "DA EDUCAÇÃO FUNDAMENTAL – ETAPA 9º ANO";
                                       }  
                                     ?>
                                   </b>
                                   </span>
</span><br></div><b>

  <span style="font-size: 18pt; font-family: " source="" sans="" pro",="" sans-serif;"="">
                                  <!--[if !supportLineBreakNewLine]--><br>
                                  <!--[endif]--></span></b><span style="font-size: 16pt; font-family: " source="" sans="" pro",="" sans-serif;"=""><o:p></o:p></span><p></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p><p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:0cm;margin-bottom:21.3pt;margin-left:15.85pt;text-align:center;"><b><span style="font-size:18.0pt;line-height:107%;sans-serif;"><br></span></b></p>
                                  <p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size: 18pt; font-family: " source="" sans="" pro",="" sans-serif;"=""><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">Declaro para fins de comprovação que</span>&nbsp;<?php echo $nome_aluno; ?>,&nbsp;</span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">nascido (a) em <?php echo $data_nascimento; ?>, </span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">filho (a) de     <?php
                                if ($filiacao1 !='' && $filiacao2 !='') {
                                  echo $filiacao1." e ". $filiacao2 ; 
                                }elseif ($filiacao1 !='' && $filiacao2 =='') {
                                  echo $filiacao1."  "; 
                                }elseif ($filiacao1 =='' && $filiacao2 !='') {
                                  echo " ". $filiacao2." "; 
                                }

                                ?>, </span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap; text-align: left;">concluiu  <?php 
                                    $res_serie=trim(substr($nome_turma, 0, -1));
                                    if ($res_serie =='MATERNAL I') {
                                      echo "no ".$res_serie;
                                      $cursar="o MATERNAL II do Ensino Infantil";
                                    }elseif ($res_serie =='MATERNAL II') {
                                      echo "no ".$res_serie;
                                      
                                      $cursar="o PRE I do Ensino Infantil";
                                    
                                    }elseif ($res_serie =='PRE I') {
                                      echo "no ".$res_serie;

                                      $cursar="o PRE II do Ensino Infantil";

                                    }elseif ($res_serie =='PRE II') {
                                      echo "no ".$res_serie;
                                     $cursar="o 1° ano do Ensino Fundamental 1";
                                    } 
                                    else if ($serie_id==7) {
                                      echo " O 5º ANO ";

                                      $cursar=" o 6º ano do Ensino Fundamental 2";
                                     

                                    }  
                                    else if ($serie_id==11) {
                                      echo " O 9º ANO ";

                                     $cursar= " o ensino médio ";

                                    }   
                                    else if ($serie_id==15) {
                                      echo " O 9º ANO ";

                                     $cursar= " o ensino médio ";
                                    } 


                                  ?>  no ano letivo <?php echo "$ano_letivo"; ?>, no  <?php echo $nome_escola; ?>. </span><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: 18pt; white-space: pre-wrap;">Estando apto a cursar <?php echo $cursar; ?>.</span></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size: 18pt; font-family: " source="" sans="" pro",="" sans-serif;"=""><b><br></b></span></p>
                   
                   <p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-size: 18pt; font-family:  sans-serif;"><b><br></b></span></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><br></p><p class="MsoNormal" style="margin: 0cm 3.25pt 22.55pt 19.6pt; text-align: justify; text-indent: -0.5pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><br></p>

     
    <p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:14.0pt;line-height:111%;font-family:" arial",sans-serif;"=""><b><br></b></span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:14.0pt;line-height:111%;font-family:" arial",sans-serif;"=""><b><br></b></span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"><span style="font-size:14.0pt;line-height:111%;font-family:" arial",sans-serif;"=""><b> </b> </span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.25pt;margin-bottom:22.55pt;margin-left:19.6pt;text-align:justify;text-justify:inter-ideograph;text-indent:-.5pt;line-height:111%;"></p><div style="text-align: center;"><span style="font-family: Arial, sans-serif; font-size: 9pt; text-indent: -0.5pt;"></span></div><span style="font-family: Arial, sans-serif; font-size: 9pt; text-align: left;"><div style="text-align: center;"><span style="font-size: 14pt; text-indent: -0.5pt;"><!-- OBS.: Declaro que ... --><p></p><p></p>
           

                               <div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;"><br></span></div><div style="text-align: center;"><span style="font-size: 1rem;">______________________________</span></div><div style="text-align: center;"><span style="font-size: 1rem;"><span style="font-family: Arial, sans-serif; font-size: 9pt; text-indent: -0.5pt;"><?php echo $_SESSION['CIDADE'] ?>, <?php echo date("d/m/Y"); ?> </span></span></div><p></p><p><br></p>
                                  </span></div></span>
                            
</p>
</td>
</tr>
</table>
</div>



</div>
</section>
</div>






 

<?php  

}

 ?>