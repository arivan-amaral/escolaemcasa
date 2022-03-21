<?php 
function ata_resultados_finais($conexao,$idescola,$idturma,$idserie,$ano_letivo){

?>


 <tr style='width:100%'>
 
  <td width=19 valign=top style='width:14.15pt;border:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph style='margin-top:0cm'><span lang=PT
  style='font-size:8.0pt;font-family:"Times New Roman",serif'>&nbsp;</span></p>
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
  $res_disc=listar_disciplina_para_ata($conexao,$idescola,$idturma,$ano_letivo);
  $conta_disciplina=0;
  $array_disciplina=array();
  $array_nome_sigla_disciplina=array();
  $carga_horaria='';
  foreach ($res_disc as $key => $value) {
    $iddisciplina=$value['iddisciplina'];
    $carga_horaria=$value['carga_horaria'];
    
    if ($idserie > 7 && $idserie <12 && $value['nome_disciplina']=='CIÊNCIAS') {
      $nome_disciplina="Ciências Físicas e Biológicas";
      $abreviacao="CFB";
    }else{

    $nome_disciplina=$value['nome_disciplina'];
    $abreviacao=$value['abreviacao'];
    }


    $array_disciplina[$conta_disciplina]=$iddisciplina;
    $array_nome_sigla_disciplina[$abreviacao]=$nome_disciplina;
    $conta_disciplina++;
?>
  <td width=42 valign=top style='width:31.15pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:5.75pt;margin-bottom:.0001pt'><b><span lang=PT
  style='font-size:7.0pt;font-family:"Arial",sans-serif'><?php echo strtoupper($abreviacao); ?></span></b></p>
  <p class=TableParagraph style='margin-top:3.3pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:9.65pt;margin-bottom:.0001pt'><b><span lang=PT

  style='font-size:7.0pt;font-family:"Arial",sans-serif'><?php echo $carga_horaria; ?></span></b></p>
  </td>

  <!--  <td width=42 valign=top style='width:31.15pt;border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:5.75pt;margin-bottom:.0001pt'><b><span lang=PT
  style='font-size:7.0pt;font-family:"Arial",sans-serif'>mnbnbh<?php echo strtoupper($abreviacao); ?></span></b></p>
  <p class=TableParagraph style='margin-top:3.3pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:9.65pt;margin-bottom:.0001pt'><b><span lang=PT

  style='font-size:7.0pt;font-family:"Arial",sans-serif'>160</span></b></p>
  </td>
   -->
<?php 

}
?>

 
  
  <td  style='border:solid black 1.0pt;
  border-left:none;padding:0cm 0cm 0cm 0cm;height:21.9pt'>
  <p class=TableParagraph align=center style='margin-top:.8pt;margin-right:
  10.25pt;margin-bottom:0cm;margin-left:11.6pt;margin-bottom:.0001pt;
  text-align:center'><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>RF</span></b></p>
  </td>
 </tr>

 <tr >
  <td width=19  valign=top style='width:14.15pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:none;border-right:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
  <p class=TableParagraph style='margin-top:.8pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:3.15pt;margin-bottom:.0001pt'><b><span lang=PT
  style='font-size:7.0pt;font-family:"Arial",sans-serif'>Nº</span></b></p>
  </td>
  <td colspan="<?php echo $conta_disciplina+2; ?>"  style='border:none;border:solid black 1.0pt;
  padding:0cm 0cm 0cm 0cm;height:10.95pt'>
      <p class=TableParagraph  style='margin-top:.8pt;margin-right:
      64.55pt;margin-bottom:0cm;margin-left:65.15pt;margin-bottom:.0001pt;
       '><b><span lang=PT style='font-size:7.0pt;font-family:"Arial",sans-serif'>Nome
      do Aluno.</span></b></p>
  </td>

<?php
$conta_aluno=1; 
$matricula_aluno="";
// echo"    SELECT 
// aluno.nome as 'nome_aluno',
// aluno.sexo,
// aluno.data_nascimento,
// aluno.idaluno,
// turma.nome_turma,

// ecidade_matricula.matricula_codigo as 'matricula',
// ecidade_matricula.matricula_datamatricula as 'data_matricula',
// ecidade_matricula.datasaida as 'datasaida'
// FROM
//  ecidade_matricula,
// aluno,turma,escola

// where

// ecidade_matricula.aluno_id= aluno.idaluno AND
// ecidade_matricula.turma_id = turma.idturma and 
// ecidade_matricula.turma_escola = escola.idescola and 
// ecidade_matricula.calendario_ano ='2021' and 
 
// ecidade_matricula.turma_escola=$idescola and
// ecidade_matricula.matricula_situacao !='CANCELADO' and
// ecidade_matricula.turma_id=$idturma  ORDER by aluno.nome ASC";
if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
  $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
}else{
  $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
 }


 foreach ($res_alunos as $key => $value) {

  $idaluno=$value['idaluno'];
  $nome_aluno=$value['nome_aluno'];
  $matricula_aluno=$value['matricula'];

  if ($conta_aluno%2==0) {
    $cor_linha="#E0E0E0";
  }else{
    $cor_linha="white";

  }

// pesquisar_aluno_da_turma_ata_resultado_final
  $res_movimentacao=pesquisar_aluno_da_turma_ata_resultado_final($conexao,$matricula_aluno,$_SESSION['ano_letivo']);

  $data_evento="";
  $descricao_procedimento="";
  $procedimento="";
  $matricula="";
  foreach ($res_movimentacao as $key => $value) {
      $datasaida=($value['datasaida']);
      // $matricula=($value['matricula']);
      // $data_evento=converte_data($value['data_evento']);
      // $descricao_procedimento=$value['descricao_procedimento'];
      $procedimento=$value['procedimento'];
      
      if ($datasaida!="") {
        $datasaida=converte_data($datasaida);
      }
  }

?>
 <tr style=' '>
 
  <?php 
 
  if ($procedimento!='') {
  
  ?>
      <td width=19 valign=top style='background-color: <?php echo "$cor_linha"; ?>; width:14.15pt;border:solid black 1.0pt;padding:0cm 0cm 0cm 0cm;height:11.3pt'>

      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:3.65pt;margin-bottom:.0001pt'>
      <span lang=PT style='font-size:
      8.0pt'><?php echo "$conta_aluno"; ?>
    </span></p>
      </td>

      <td  valign=top style='border:solid black 1.0pt; 
      padding:0cm 0cm 0cm 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt'><?php echo "$nome_aluno"; ?></span></p>
      </td>


     <td colspan='100%' valign=top style='border:solid black 1.0pt;
     ;padding:0cm 0cm 10pt 0cm;height:11.3pt;background-color: <?php echo "$cor_linha"; ?>;'>
      <p class=TableParagraph style='margin-top:1.8pt;margin-right:0cm;margin-bottom:
      0cm;margin-left:2.75pt;margin-bottom:.0001pt'><span lang=PT style='font-size:
      8.0pt'><?php echo" $procedimento  $datasaida "; ?></p>
      </td> 

  <?php
    $conta_aluno++; 
   }else{
  ?>
  <td width=19 valign=top style='width:14.15pt;border:solid black 1.0pt;  background:<?php echo "$cor_linha"; ?>;padding:0cm 0cm 0cm 0cm; '>

  <p class=TableParagraph style='margin-left:5.3pt'><span lang=PT
  style='font-size:8.0pt'><?php echo "$conta_aluno"; ?></span></p>
  </td>

  <td width=246 valign=top style='width:184.25pt;border:solid black 1.0pt;
  background:<?php echo "$cor_linha"; ?>;padding:0cm 0cm 0cm 0cm;'>
  <p class=TableParagraph style='margin-left:2.75pt'><span lang=PT
  style='font-size:8.0pt'><?php echo $nome_aluno; ?></span></p>
  </td>
  
<?php

      $iddisciplina="";
      $media_aprovacao=false;
      $aprovacao_conselho=false;
      foreach ($array_disciplina as $key => $value) {
           $media_aprovacao=false;
           $aprovacao_conselho=false;
            
            $iddisciplina=$array_disciplina[$key];
         
  ?>
          <td width=42 valign=top style='width:31.15pt;border:solid black 1.0pt;
          background:<?php echo "$cor_linha"; ?>;padding:0cm 0cm 0cm 0cm;'>
          <p class=TableParagraph align=center style='margin-right:
          2.7pt;margin-bottom:0cm;margin-left:3.35pt;text-align:
          center'><span lang=PT style='font-size:8.0pt'>
        <?php
        if ($idserie>3) {
  
             $result_nota_aula1=pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,1);

             $nota_tri_1=0;
             $nota_av3_1='';
             $nota_rp_1='';
             foreach ($result_nota_aula1 as $key => $value) {
               if ($value['avaliacao']!='RP') {
                 $nota_tri_1+=$value['nota'];
               }
            // ***************************************
               if ($value['avaliacao']=='av3') {
                 $nota_av3_1=$value['nota'];
               }
               if ($value['avaliacao']=='RP') {
                 $nota_rp_1=$value['nota'];
               }
             }
        
      $nota_tri_1=calculos_media_notas($nota_tri_1,$nota_rp_1,$nota_av3_1);

            //echo "$nota_tri_1";
            ?>



 <?php
  
      $result_nota_aula2=pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,2);


      $conexao->query("
        SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
        escola_id=$idescola and
        turma_id=$idturma and
        disciplina_id=$iddisciplina and 
        periodo_id=2 and aluno_id=$idaluno  group by avaliacao,periodo_id, nota");


      $nota_tri_2=0;
      $nota_av3_2='';
      $nota_rp_2='';
      foreach ($result_nota_aula2 as $key => $value) {

        if ($value['avaliacao']!='RP') {
          $nota_tri_2+=$value['nota'];


        }
          // ***************************************
        if ($value['avaliacao']=='av3') {
          $nota_av3_2=$value['nota'];

        }

        if ($value['avaliacao']=='RP') {
          $nota_rp_2=$value['nota'];


        }

      }

    
      $nota_tri_2=calculos_media_notas($nota_tri_2,$nota_rp_2,$nota_av3_2);
     

    // echo "$nota_tri_2";
     ?>



      <?php

   $result_nota_aula3=pesquisa_nota_por_periodo($conexao,$idescola,$idturma,$iddisciplina,$idaluno,3);


   $nota_tri_3=0;
   $nota_av3_3='';
   $nota_rp_3='';
   foreach ($result_nota_aula3 as $key => $value) {

         if ($value['avaliacao']!='RP') {
           $nota_tri_3+=$value['nota'];
         }
           // ***************************************
         if ($value['avaliacao']=='av3') {
           $nota_av3_3=$value['nota'];
         }

         if ($value['avaliacao']=='RP') {
           $nota_rp_3=$value['nota'];
         }

   }

  // if ($nota_tri_3<5 && $nota_rp_3!='' && $nota_rp_3>$nota_av3_3) {
  //   $nota_tri_3=($nota_tri_3-$nota_av3_3)+$nota_rp_3;
  // }
      $nota_tri_3=calculos_media_notas($nota_tri_3,$nota_rp_3,$nota_av3_3);
  
  $media=($nota_tri_3+$nota_tri_2+$nota_tri_1)/3;
 //arivan
  $media=number_format($media, 1, '.', ',');
  if ($media >= 5) {
      echo number_format($media, 1, '.', ',');
      $media_aprovacao=true;
      $aprovacao_conselho=false;


  }else{
      $res_conselho=buscar_aprovar_concelho($conexao,$idescola,$idturma,$iddisciplina,$idaluno);
      $conta_aprovado=count($res_conselho);
      
       if ($conta_aprovado>0 ) {
          $media_conselho=number_format('5', 1, '.', ',');
          echo "<b>$media_conselho</b>";
          
          $media_aprovacao=false;
          $aprovacao_conselho=true;
      }else{
          echo number_format($media, 1, '.', ',');
          $media_aprovacao=false;

      }

  }

}//se serie for menor que 3
else{
  echo "Apr";
  $media_aprovacao=true;

}
?>
      </span></p>
          </td>
<?php 
  }
?>
  <td width=45 valign=top style='width:34.0pt;border: solid black 1.0pt;
  background:<?php echo "$cor_linha"; ?>;padding:0cm 0cm 0cm 0cm;'>
  <p class=TableParagraph align=center style='margin-top:1.85pt;margin-right:
  10.25pt;margin-bottom:0cm;margin-left:11.6pt;
  text-align:center'><span lang=PT style='font-size:8.0pt'>
<?php 
    if($idserie<3){
        echo "<b style='color: green;'>Apr</b>";

    }elseif ($aprovacao_conselho == true) {
         echo "<b style='color: blue;'>Apc </b>";
    }elseif ($media_aprovacao == true) {
         echo "<b style='color: green;'>Apr</b>";
    }elseif ($media_aprovacao == false){
      $media_aprovacao=false;
         echo "<b style='color: red;'>Rep</b>";

    }
?>


</span></p>
  </td>
 </tr>

<?php 
$conta_aluno++; 

}

}//else se não houve movimentação escolar
?>

 <tr style='height:10.55pt'>
  <td width=321 colspan=4 valign=top style='border:solid black 1.0pt;
  padding:0pt 0pt 10pt 0pt;height:10.55pt'>
  <p class=TableParagraph align=center style='margin-top:1.45pt;margin-left:1.85pt;margin-bottom:5pt;
  text-align:center'><span lang=PT style='font-size:10.0pt'>Assinatura dos professores:</span></p>
  </td>  

  <td width=321 colspan=10 valign=top style='border:solid black 1.0pt;
  padding:0pt 0pt 10pt 0pt;height:10.55pt'>
  <p class=TableParagraph align=center style='margin-top:1.45pt;margin-left:4.85pt;margin-bottom:5pt;
  text-align:center'><span lang=PT style='font-size:10.0pt'>Convenções:</span>
</p>
 <p style='margin-top:1.45pt;margin-left:4.85pt;margin-bottom:5pt;padding:0pt 0pt 10pt 5pt;'> 
  <?php 
    $conta_dis=1;
    foreach ($array_nome_sigla_disciplina as $key => $value) {
      echo "<span lang=PT style='font-size:8.0pt'> $key - $value &nbsp;&nbsp;&nbsp;</span>";
      if ($conta_dis%2==0) {
       echo "<br>";
      }
      $conta_dis++;
    }
    echo "<span lang=PT style='font-size:8.0pt'> APC -Aprovado pelo conselho &nbsp;&nbsp;  </span>";
    echo "<span lang=PT style='font-size:8.0pt'> APR -Aprovado &nbsp;&nbsp;</span>";
    echo "<span lang=PT style='font-size:8.0pt'> REP -REPROVADO &nbsp;&nbsp;</span>";

  ?>
</p>

  <p  align=center style='border-top: 1px solid black; margin-top:1.45pt;margin-left:0.85pt;margin-bottom:5pt;
  text-align:center'></p>  
  <p  align=center style=' font-size:8.0pt margin-top:1.45pt;margin-left:0.85pt;margin-bottom:5pt;
  text-align:center'>

  E, para constar, foi lavrada esta Ata. <br>
  ___________________________________________<br>
Luís Eduardo Magalhães - BA, <?php echo date("d/m/Y"); ?>
</p> 
  </td>
  <!-- <td width=404 colspan=10  style='border:solid black 1.0pt;
  border-left:none;padding:100pt;height:10.55pt'>
  <p class=TableParagraph align=center style='margin-top:1.45pt;margin-left:1.85pt;margin-bottom:.0001pt;
  text-align:center'>Convenções:</span></p>
  </td> -->
 </tr>
 
  


<?php 
}
?>