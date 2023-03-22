<?php 
 function boletim_1ano($conexao,$idescola,$idturma,$idserie,$idaluno,$numero,$nome_aluno,$nome_escola,$nome_turma,$nome_professor,$ano_letivo){

//teste webhook teste 2

  $res_calendario=listar_data_periodo($conexao,$ano_letivo);
  foreach ($res_calendario as $key => $value) {
  
      if ($value['periodo_id']==1) {
          $data_inicio_trimestre1=$value['inicio'];
          $data_fim_trimestre1=$value['fim'];
      }elseif ($value['periodo_id']==2){
          $data_inicio_trimestre2=$value['inicio'];
          $data_fim_trimestre2=$value['fim'];
      }elseif ($value['periodo_id']==3){
          $data_inicio_trimestre3=$value['inicio'];
          $data_fim_trimestre3=$value['fim'];
      }

    
  }
  
?>

      <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0  
       style='width:100%;margin-left:9.0pt;border-collapse:collapse;mso-yfti-tbllook:
       1184;mso-padding-alt:0cm 3.5pt 0cm 3.5pt'>
       

       <tr style='mso-yfti-irow:4;height:15.0pt'>
        <td width=84 nowrap colspan=2 style='width:63.0pt;border:solid windowtext 1.0pt;
        mso-border-alt:solid windowtext .5pt;padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
        line-height:normal'>


        <span style='mso-ignore:vglayout;
        position:absolute;z-index:251660288;left:0px;margin-left:65px;margin-top:
        -9px;width:44px;height:60px'><img width=44 height=60
        src="imagens/logo.png"
        v:shapes="Imagem_x0020_2"></span> <b><span style='font-family:"Arial Black",sans-serif;
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
        <td  nowrap colspan=7 style='width:100%;border:solid windowtext 1.0pt;
        border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
        padding:0cm 3.5pt 0cm 3.5pt;height:15.0pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
        style='font-family:"Arial Black",sans-serif;mso-fareast-font-family:"Times New Roman";
        mso-bidi-font-family:Calibri;color:black;mso-fareast-language:PT-BR; text-transform: uppercase;'>Aluno: <o:p> <?php echo $nome_aluno; ?></o:p></span></b></p>
        </td>
        <td width=10 colspan=2 style='width:7.3pt;padding:0cm 3.5pt 0cm 3.5pt;
        height:15.0pt'></td>
        <![if !supportMisalignedRows]>
        <td style='height:15.0pt;border:none' width=0 height=20></td>
        <![endif]>
       </tr>

       <tr style='mso-yfti-irow:5;height:15.0pt'>
        <td  nowrap colspan=7 style='width:100%;border:solid windowtext 1.0pt;
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
        <td    colspan=7 style='border:solid windowtext 1.0pt;
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
              parecer_disciplina.serie_base_id=3 and modalidade_id =$idmodalidade  and parecer_disciplina.ano=$ano_letivo order by modalidade_id asc");   
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
          parecer_disciplina.serie_base_id=3 and modalidade_id =$idmodalidade  and parecer_disciplina.ano=$ano_letivo  order by modalidade_id asc");   

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
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
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
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
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
            SELECT * FROM nota_parecer WHERE
            escola_id=$idescola and
            turma_id=$idturma and
            ano_nota=$ano_letivo and
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
        <td width=670 nowrap colspan=4 style='width:502.15pt;border-top:none;
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
        mso-fareast-language:PT-BR'>&nbsp;

          <?php
          // faltas trimestre 1


          $res_fre_t1=$conexao->query("
          SELECT data_frequencia FROM frequencia WHERE
          escola_id=$idescola and
          turma_id=$idturma and
          presenca=0 and data_frequencia BETWEEN '$data_inicio_trimestre1' and '$data_fim_trimestre1' and aluno_id=$idaluno  group by data_frequencia");
          // disciplina_id=$iddisciplina and 
          $quantidade_falta1=0;
          foreach ($res_fre_t1 as $key => $value) {
            $quantidade_falta1++;
          }

          echo "$quantidade_falta1";
          ?>


        <o:p></o:p></span></p>
        </td>
        <td width=54 nowrap valign=bottom style='width:40.85pt;border-top:none;
        border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        mso-border-bottom-alt:solid windowtext 1.0pt;mso-border-right-alt:solid windowtext .5pt;
        background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'>&nbsp;

        <?php
        // faltas trimestre 2


        $res_fre_t2=$conexao->query("
        SELECT data_frequencia FROM frequencia WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        presenca=0 and data_frequencia BETWEEN '$data_inicio_trimestre2' and '$data_fim_trimestre2' and aluno_id=$idaluno  group by data_frequencia");
        // disciplina_id=$iddisciplina and 
        $quantidade_falta2=0;
        foreach ($res_fre_t2 as $key => $value) {
          $quantidade_falta2++;
        }

        echo "$quantidade_falta2";
        ?>
        <o:p></o:p></span></p>
        </td>
        <td width=58 nowrap valign=bottom style='width:43.45pt;border-top:none;
        border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
        background:white;padding:0cm 3.5pt 0cm 3.5pt;height:15.75pt'>
        <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
        style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
        mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:black;
        mso-fareast-language:PT-BR'>&nbsp;
     <?php
        // faltas trimestre 3


        $res_fre_t3=$conexao->query("
        SELECT data_frequencia FROM frequencia WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        presenca=0 and data_frequencia BETWEEN '$data_inicio_trimestre3' and '$data_fim_trimestre3' and aluno_id=$idaluno  group by data_frequencia");
        // disciplina_id=$iddisciplina and 
        $quantidade_falta3=0;
        foreach ($res_fre_t3 as $key => $value) {
          $quantidade_falta3++;
        }

        echo "$quantidade_falta3";
        ?>





        <o:p></o:p></span></p>
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



      </table>

  
       <!-- *********************** RODAPÉ *********************************************************** -->



<?php 
}
?>