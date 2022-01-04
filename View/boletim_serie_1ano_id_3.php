<?php 
 function boletim_1ano($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$nome_professor,$ano_letivo){
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
      <link rel=File-List
      href="Acompanhamento%20do%20Rendimento%20do%20Aluno_arquivos/filelist.xml">
      <link rel=Edit-Time-Data
      href="Acompanhamento%20do%20Rendimento%20do%20Aluno_arquivos/editdata.mso">

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
        
        .positionRi2 {
          position: absolute;
          top: 10px;
          left: 5px;
          /*right:0; */
          width: 200px;
          height: 150px;
          /*border: 3px solid #73AD21;*/
        }
        
        .positionRi3 {
          position: absolute;
          top: 10px;
          left: 5px;
          /*right:0; */
          width: 200px;
          height: 150px;
          /*border: 3px solid #73AD21;*/
        }

        /* START - LANDSCAPE */
        @media print {
          body {
            background: none;
            -ms-zoom: 1.665;
          }
          div.portrait, div.landscape {
            margin-left: 100;
            /*margin-right: 100;*/
            padding: 0;
            border: none;
            background: none;
            size: 4in 6in landscape;
          }
          div.landscape {
            transform: rotate(270deg) translate(-280mm, 0);
            transform-origin: 0 0;
          }
        
        }
        /* END LANDSCAPE */
        
        </style>


      <link rel=themeData
      href="Acompanhamento%20do%20Rendimento%20do%20Aluno_arquivos/themedata.thmx">
      <link rel=colorSchemeMapping
      href="Acompanhamento%20do%20Rendimento%20do%20Aluno_arquivos/colorschememapping.xml">

      <style>
      <!--
       /* Font Definitions */
       @font-face
      	{font-family:"Cambria Math";
      	panose-1:2 4 5 3 5 4 6 3 2 4;
      	mso-font-charset:0;
      	mso-generic-font-family:roman;
      	mso-font-pitch:variable;
      	mso-font-signature:3 0 0 0 1 0;}
      @font-face
      	{font-family:Calibri;
      	panose-1:2 15 5 2 2 2 4 3 2 4;
      	mso-font-charset:0;
      	mso-generic-font-family:swiss;
      	mso-font-pitch:variable;
      	mso-font-signature:-469750017 -1073732485 9 0 511 0;}
      @font-face
      	{font-family:"Arial Black";
      	panose-1:2 11 10 4 2 1 2 2 2 4;
      	mso-font-charset:0;
      	mso-generic-font-family:swiss;
      	mso-font-pitch:variable;
      	mso-font-signature:-1610612049 1073772795 0 0 159 0;}
      @font-face
      	{font-family:"Tw Cen MT Condensed";
      	panose-1:2 11 6 6 2 1 4 2 2 3;
      	mso-font-charset:0;
      	mso-generic-font-family:swiss;
      	mso-font-pitch:variable;
      	mso-font-signature:7 0 0 0 3 0;}
       /* Style Definitions */
       p.MsoNormal, li.MsoNormal, div.MsoNormal
      	{mso-style-unhide:no;
      	mso-style-qformat:yes;
      	mso-style-parent:"";
      	margin-top:0cm;
      	margin-right:0cm;
      	margin-bottom:8.0pt;
      	margin-left:0cm;
      	line-height:107%;
      	mso-pagination:widow-orphan;
      	font-size:11.0pt;
      	font-family:"Calibri",sans-serif;
      	mso-ascii-font-family:Calibri;
      	mso-ascii-theme-font:minor-latin;
      	mso-fareast-font-family:Calibri;
      	mso-fareast-theme-font:minor-latin;
      	mso-hansi-font-family:Calibri;
      	mso-hansi-theme-font:minor-latin;
      	mso-bidi-font-family:"Times New Roman";
      	mso-bidi-theme-font:minor-bidi;
      	mso-fareast-language:EN-US;}
      span.SpellE
      	{mso-style-name:"";
      	mso-spl-e:yes;}
      span.GramE
      	{mso-style-name:"";
      	mso-gram-e:yes;}
      .MsoChpDefault
      	{mso-style-type:export-only;
      	mso-default-props:yes;
      	font-family:"Calibri",sans-serif;
      	mso-ascii-font-family:Calibri;
      	mso-ascii-theme-font:minor-latin;
      	mso-fareast-font-family:Calibri;
      	mso-fareast-theme-font:minor-latin;
      	mso-hansi-font-family:Calibri;
      	mso-hansi-theme-font:minor-latin;
      	mso-bidi-font-family:"Times New Roman";
      	mso-bidi-theme-font:minor-bidi;
      	mso-fareast-language:EN-US;}
      .MsoPapDefault
      	{mso-style-type:export-only;
      	margin-bottom:8.0pt;
      	line-height:107%;}
      @page WordSection1
      	{size:595.3pt 841.9pt;
      	margin:70.85pt 3.0cm 70.85pt 3.0cm;
      	mso-header-margin:35.4pt;
      	mso-footer-margin:35.4pt;
      	mso-paper-source:0;}
      div.WordSection1
      	{page:WordSection1;}
      -->
      </style>

      </head>

      <body lang=PT-BR style='tab-interval:35.4pt;word-wrap:break-word'>


      <div class=WordSection1>

      <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=844
       style='width:633.05pt;margin-left:9.0pt;border-collapse:collapse;mso-yfti-tbllook:
       1184;mso-padding-alt:0cm 3.5pt 0cm 3.5pt'>
       

       <tr style='mso-yfti-irow:4;height:15.0pt'>
        <td width=84 nowrap colspan=2 style='width:63.0pt;border:solid windowtext 1.0pt;
        mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'>


        <span style='mso-ignore:vglayout;
        position:absolute;z-index:251660288;left:0px;margin-left:65px;margin-top:
        -9px;width:44px;height:60px'><img width=44 height=60
        src="Acompanhamento%20do%20Rendimento%20do%20Aluno_arquivos/image002.png"
        v:shapes="Imagem_x0020_2"></span><![endif]><b><span style='font-family:"Arial Black",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
        color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-family:"Arial Black",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
        color:black;mso-fareast-language:PT-BR'><o:p>&nbsp;</o:p></span></b></p>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-family:"Arial Black",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
        color:black;mso-fareast-language:PT-BR'><o:p>&nbsp;</o:p></span></b></p>
        </td>
        <td width=750 colspan=5 valign=bottom style='width:562.75pt;border:solid windowtext 1.0pt;
        border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
        solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:18.0pt;font-family:"Arial Black",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
        color:black;mso-fareast-language:PT-BR'>Acompanhamento do Rendimento do Aluno
        / <?php echo $ano_letivo; ?><o:p></o:p></span></b></p>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-family:"Arial Black",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
        color:black;mso-fareast-language:PT-BR'><o:p>&nbsp;</o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='font-size:10.0pt;font-family:"Times New Roman",serif;mso-fareast-font-family:
        "Times New Roman";mso-fareast-language:PT-BR'><o:p>&nbsp;</o:p></span></p>
        </td>
        <![if !supportMisalignedRows]>
        <td style='height:15.0pt;border:none' width=0 height=20></td>
        <![endif]>
       </tr>
       <tr style='mso-yfti-irow:5;height:15.0pt'>
        <td width=834 nowrap colspan=7 style='width:625.75pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-family:"Arial Black",sans-serif;mso-fareast-font-family:"Times New Roman";
        mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'>Aluno: <o:p> <?php echo $nome_aluno; ?></o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.0pt'></td>
        <![if !supportMisalignedRows]>
        <td style='height:15.0pt;border:none' width=0 height=20></td>
        <![endif]>
       </tr>

       <tr style='mso-yfti-irow:5;height:15.0pt'>
        <td width=834 nowrap colspan=7 style='width:625.75pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-family:"Arial Black",sans-serif;mso-fareast-font-family:"Times New Roman";
        mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'>Escola: <o:p> <?php echo $nome_escola; ?></o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.0pt'></td>
        <![if !supportMisalignedRows]>
        <td style='height:15.0pt;border:none' width=0 height=20></td>
        <![endif]>
       </tr>


       <tr style='mso-yfti-irow:6;height:15.0pt'>
        <td width=834 nowrap colspan=7 style='border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .1pt;mso-border-alt:solid windowtext .1pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:10.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-family:"Arial ",sans-serif;mso-fareast-font-family:"Times New Roman";
        mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'><o:p>Professores: <?php echo $nome_professor; ?></o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.0pt'></td>
        <![if !supportMisalignedRows]>
        <td style='height:15.0pt;border:none' width=0 height=20></td>
        <![endif]>
       </tr>
       <tr style='mso-yfti-irow:7;height:15.75pt'>
        <td width=44 nowrap style='width:33.3pt;border:solid windowtext 1.0pt;
        border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
        solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
        0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-family:"Arial Black",sans-serif;mso-fareast-font-family:"Times New Roman";
        mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'>Nº<o:p> <?php echo $numero; ?></o:p></span></b></p>
        </td>
        <td width=790 nowrap colspan=6 style='width:592.45pt;border-top:none;
        border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
        mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-family:"Arial Black",sans-serif;mso-fareast-font-family:"Times New Roman";
        mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR'>Ano: <?php echo $ano_letivo; ?><span
        style='mso-spacerun:yes'>
        </span>Turma: <?php echo $nome_turma; ?><span style='mso-spacerun:yes'>
        </span>Turno:<o:p></o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.75pt'></td>
        <![if !supportMisalignedRows]>
        <td style='height:15.75pt;border:none' width=0 height=21></td>
        <![endif]>
       </tr>
       <tr style='mso-yfti-irow:8;height:19.5pt;mso-row-margin-right:.45pt'>
        <td width=670 nowrap colspan=3 style='width:502.15pt;border-top:none;
        border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
        border-right:solid black 0pt;background:white;padding:0cm 3.5pt 0cm 3.5pt;
        height:19.5pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:14.0pt;font-family:"Tw Cen MT Condensed",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
        color:black;mso-fareast-language:PT-BR'>PARECER DAS HABILIDADES DESENVOLVIDAS<o:p></o:p></span></b></p>
        </td>

        <td width=52 nowrap style='width:38.85pt;border-top:none;border-left:none;
        border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-bottom-alt:solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:19.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'><o:p></o:p></span></b></p>
        </td>

        <td width=54 nowrap style='width:40.85pt;border:none;border-bottom:solid windowtext 1.0pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:19.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>I TRIM.<o:p></o:p></span></b></p>
        </td>
        <td width=58 nowrap style='width:43.45pt;border:solid windowtext 1.0pt;
        border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:19.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>II TRIM.<o:p></o:p></span></b></p>
        </td>  

        <td width=58 nowrap style='width:43.45pt;border:solid windowtext 1.0pt;
        border-top:none;padding:0cm 3.5pt 0cm 3.5pt;height:19.5pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-size:8.0pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
        "Times New Roman";color:black;mso-fareast-language:PT-BR'>III TRIM.<o:p></o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:19.5pt'></td>

       </tr>


          <?php 

          $res_modalidade=$conexao->query("SELECT * FROM modalidade_parecer order by id asc");          
          foreach ($res_modalidade as $key => $value) {
            $idmodalidade=$value['id'];
            $nome_modalidade=$value['descricao'];

            $res_rowspan=$conexao->query("SELECT count(*) as 'quantidade' FROM parecer_disciplina,serie
              WHERE 
              parecer_disciplina.serie_base_id=serie.id AND
              parecer_disciplina.serie_base_id=3 and modalidade_id =$idmodalidade  order by modalidade_id asc");   
              $rowspan=1;
              foreach ($res_rowspan as $key => $value) {
                $rowspan+=$value['quantidade'];
              }

          ?>

       <tr style=''>

          <td width=44 nowrap rowspan="<?php echo $rowspan; ?>" style='width:33.3pt;border-top:none;
          border-left:solid windowtext 1.0pt;border-bottom:solid black 1.0pt;
          border-right:solid windowtext 1.0pt;background:#DDEBF7;padding:0cm 3.5pt 0cm 3.5pt;
          mso-rotate:90;height:15.0pt'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
          line-height:normal'><b><div class="Namerotate"><span style='font-size:10.0pt;font-family:"Arial Black",sans-serif;
          mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
          color:black;mso-fareast-language:PT-BR'>
            
            <?php echo  $nome_modalidade;  ?>

          <o:p></o:p></span></div></b></p>
          </td>



          <?php 

          $res_parec1=$conexao->query("SELECT parecer_disciplina.descricao,parecer_disciplina.id FROM parecer_disciplina,serie
          WHERE 
          parecer_disciplina.serie_base_id=serie.id AND
          parecer_disciplina.serie_base_id=3 and modalidade_id =$idmodalidade  order by modalidade_id asc");   

          foreach ($res_parec1 as $key => $value) {
            $parecer_disciplina_id=$value['id'];
            $descricao=$value['descricao'];
          ?>
       <tr>

          <td width=625 nowrap colspan=2 style='width:468.85pt;border:none;border-bottom:
          solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
          background:#DDEBF7;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
          <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
          style='font-size:9.5pt;font-family:"Arial",sans-serif;mso-fareast-font-family:
          "Times New Roman";color:black;mso-fareast-language:PT-BR'>
         <o:p>

            <?php
                echo "$descricao";
              

            ?>
              
            </o:p></span></p>
          </td>

       
          <td width=54 nowrap style='width:40.85pt;border-top:none;border-left:none;
          border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
          background:#DDEBF7;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
          line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
          "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
          color:black;mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
          </td>
          <td width=58 nowrap style='width:43.45pt;border-top:none;border-left:none;
          border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
          background:#DDEBF7;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
          line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
          "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
          color:black;mso-fareast-language:PT-BR'><o:p>
            <?php

            $result_nota_aula1=$conexao->query("
            SELECT * FROM nota WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            avaliacao='av3' and periodo_id=1 and parecer_disciplina_id=$parecer_disciplina_id and aluno_id=$idaluno ");
            $nota_tri_1='';
            foreach ($result_nota_aula1 as $key => $value) {
            $nota_tri_1=$value['sigla'];
            }

            echo "$nota_tri_1";
            ?>
          </o:p></span></p>
          </td>  

          <td width=58 nowrap style='width:43.45pt;border-top:none;border-left:none;
          border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
          background:#DDEBF7;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
          line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
          "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
          color:black;mso-fareast-language:PT-BR'><o:p>
            
            <?php

            $result_nota_aula2=$conexao->query("
            SELECT * FROM nota WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            avaliacao='av3' and periodo_id=2 and parecer_disciplina_id=$parecer_disciplina_id and aluno_id=$idaluno ");
            $nota_tri_2='';
            foreach ($result_nota_aula2 as $key => $value) {
            $nota_tri_2=$value['sigla'];
            }

            echo "$nota_tri_2";
            ?>

          </o:p></span></p>
          </td>

          <td width=58 nowrap style='width:43.45pt;border-top:none;border-left:none;
          border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
          mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;
          background:#DDEBF7;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
          <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
          line-height:normal'><span style='mso-ascii-font-family:Calibri;mso-fareast-font-family:
          "Times New Roman";mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;
          color:black;mso-fareast-language:PT-BR'><o:p>
            
            <?php

            $result_nota_aula3=$conexao->query("
            SELECT * FROM nota WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            avaliacao='av3' and periodo_id=3 and parecer_disciplina_id=$parecer_disciplina_id and aluno_id=$idaluno ");
            $nota_tri_3='';
            foreach ($result_nota_aula3 as $key => $value) {
            $nota_tri_3=$value['sigla'];
            }
 
            echo "$nota_tri_3";
            ?>

          </o:p></span></p>
          </td>
         
       </tr>
         <?php 

         }
         ?>


    </tr>

<?php 
  }
?>




       <tr style='mso-yfti-irow:75;height:15.75pt;mso-row-margin-right:.45pt'>
        <td width=670 nowrap colspan=3 style='width:502.15pt;border-top:none;
        border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
        border-right:solid black 1.0pt;background:#D9D9D9;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.75pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial Black",sans-serif;
        mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:Calibri;
        color:black;mso-fareast-language:PT-BR'>TOTAL DE FALTAS</span></b><b><span
        style='font-size:9.0pt;font-family:"Arial Black",sans-serif;mso-fareast-font-family:
        "Times New Roman";mso-bidi-font-family:Calibri;color:black;mso-fareast-language:
        PT-BR'><o:p></o:p></span></b></p>
        </td>
        <td width=52 nowrap valign=bottom style='width:38.85pt;border-top:none;
        border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-bottom-alt:solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;
        background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
        </td>
        <td width=54 nowrap valign=bottom style='width:40.85pt;border-top:none;
        border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-bottom-alt:solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;
        background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
        </td>
        <td width=58 nowrap valign=bottom style='width:43.45pt;border-top:none;
        border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'>&nbsp;<o:p></o:p></span></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.75pt'></td>
        <td style='mso-cell-special:placeholder;border:none;padding:0cm 0cm 0cm 0cm'
        width=1><p class='MsoNormal'>&nbsp;</td>
        <![if !supportMisalignedRows]>
        <td style='height:15.75pt;border:none' width=0 height=21></td>
        <![endif]>
       </tr>










       <!-- *********************** RODAPÉ *********************************************************** -->
       <tr style='mso-yfti-irow:76;mso-yfti-lastrow:yes;height:15.75pt'>
        <td width=834 nowrap colspan=7 valign=bottom style='width:625.75pt;
        border-top:none;border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
        border-right:solid black 1.0pt;mso-border-top-alt:solid windowtext 1.0pt;
        background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'><b>LEGENDA:</b><span style='mso-spacerun:yes'> </span>&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;Sim
        (S)<span style='mso-spacerun:yes'> </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Não (N)<span
        style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desenvolvimento (D) <span
        style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Não Trabalhado (NT)<o:p></o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.75pt'></td>

        <td style='height:15.75pt;border:none' width=0 height=21></td>
       
       </tr>

       <tr height=0>
        <td width=44 style='border:none'></td>
        <td width=40 style='border:none'></td>
        <td width=586 style='border:none'></td>
        <td width=52 style='border:none'></td>
        <td width=54 style='border:none'></td>
        <td width=58 style='border:none'></td>
        <td width=1 style='border:none'></td>
        <td width=9 style='border:none'></td>
        <td width=1 style='border:none'></td>
        <td style='border:none' width=0><p class='MsoNormal'>&nbsp;</td>
       </tr>

      </table>

      <p class=MsoNormal><o:p>&nbsp;</o:p></p>
       <!-- *********************** RODAPÉ *********************************************************** -->

      </div>

      </body>

      </html>
<?php 
}
?>