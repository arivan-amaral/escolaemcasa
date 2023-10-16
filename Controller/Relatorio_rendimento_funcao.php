<?php 
set_time_limit(0);
session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Coordenador.php';
include_once '../Model/Turma.php';
include_once '../Model/Aluno.php';
include_once '../Model/Escola.php';
include_once 'Cauculos_notas.php';
include_once 'Conversao.php';

$idturma=$_GET['idturma'];
$idescola=$_GET['idescola'];


if ($_GET['periodo'] == 'todos') {
    $idperiodo="1,2,3";

}else{
  $idperiodo=$_GET['periodo'];

}
$ano_letivo=$_SESSION['ano_letivo'];
$idturmas=" IN(-1";
$idturma_aux=" IN(-1";




  if (isset($_GET['idturma'])) {
    $idturma = $_GET['idturma'];

    // Explode a string em um array usando a vírgula como delimitador
    $valoresSelecionados = explode(',', $idturma);

    $idturma_aux.=",".$valoresSelecionados[0];

    foreach ($valoresSelecionados as $value) {
      $idturmas.=",".$value;
    }


  }

  $idturma_aux.=") ";
  $idturmas.=") ";

  $res_periodo=listar_data_por_periodo($conexao,$ano_letivo,$idperiodo);
  $nome_periodo="";

  foreach ($res_periodo as $key => $value) {
    $nome_periodo.=$value['descricao'].",";
  }

  $res2=lista_de_turmas_relatorio($conexao,$ano_letivo,$idturmas,$idescola);
  $nome_turma="";
  $quantidade_vaga=0;
  foreach ($res2 as $key => $value) {
    $nome_turma.=$value['nome_turma'].", ";
    $quantidade_vaga+=$value['quantidade_vaga'];
  }




    $res_calendario=listar_data_periodo($conexao,$ano_letivo);
    $data_inicio_trimestre1="";
    $data_fim_trimestre1="";    
    $data_inicio_trimestre2="";
    $data_fim_trimestre2="";

    $data_inicio_trimestre3="";
    $data_fim_trimestre3="";
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
 style='margin-left:20.9pt;border-collapse:collapse;mso-padding-alt:2.75pt 2.75pt 2.75pt 2.75pt'>
 <tr style='height:19.8pt'>
  <td width=810 colspan=29 valign=top style='width:607.45pt;border:solid black 1.0pt;
  mso-border-alt:solid black .5pt;background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt;
  height:19.8pt'>
  <p class=TableContents align=center style='text-align:center'><b><span
  style='font-size:10.0pt;color:black;mso-color-alt:windowtext'>FICHA DE
  DESEMPENHO ESCOLAR POR TURMA - <?php  echo $ano_letivo; ?></span></b></p>
  </td>
 </tr>
 <tr style='height:11.25pt'>
  <td width=187 colspan=5 valign=top style='width:140.15pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt;height:11.25pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>PERIODO DE REFERENCIA</span></b></p>
  </td>
  <td width=201 colspan=8 valign=top style='width:150.4pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt;height:11.25pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>ANO</span></b></p>
  </td>
  <td width=158 colspan=8 valign=top style='width:118.8pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt;height:11.25pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>TURMA</span></b></p>
  </td>
  <td width=264 colspan=8 valign=top style='width:198.1pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt;height:11.25pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>GRAU</span></b></p>
  </td>
 </tr>
 <tr style='height:27.1pt'>
  <td width=187 colspan=5 valign=top style='width:140.15pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.1pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
  <td width=201 colspan=8 valign=top style='width:150.4pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.1pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
  <td width=158 colspan=8 valign=top style='width:118.8pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.1pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
  <td width=264 colspan=8 valign=top style='width:198.1pt;border:solid black 1.0pt;
  border-top:none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:
  solid black .5pt;mso-border-right-alt:solid black .5pt;padding:2.75pt 2.75pt 2.75pt 2.75pt;
  height:27.1pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
 </tr>
 <tr>
  <td width=810 colspan=29 valign=top style='width:607.45pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>APROVEITAMENTO POR DISCIPLINA</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=94 valign=top style='width:70.85pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:none;
  mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'>DISCIPLINA</span></b></p>
  </td>


  <!-- //disciplinas -->
  <?php 
  $res_disc=listar_disciplina_para_relatorio($conexao,$idturma_aux,$idescola,$ano_letivo);

   
  $conta_parecer=0;
  $linha=0;
  $resultado_final=true;
  $resultado_conselho=false;
  
  $conta_dis=0;
  $conta_conselho=0;
  $conta_apr=0;


  $qnt_displina=0;
  $array_disciplina = array();
  foreach ($res_disc as $key => $value) {
    $iddisciplina=$value['iddisciplina'];
    $nome_disciplina=$value['nome_disciplina'];
    $conta_dis++;
    $qnt_displina++;
    $array_disciplina[$iddisciplina]=$nome_disciplina;

  ?>



  <td width=76 colspan=3 valign=top style='width:2.0cm;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'><?php   echo $nome_disciplina; ?></span></b></p>
  </td>

<?php  } ?>
 </tr>



 <tr style='mso-yfti-irow:5'>
  <td width=94 valign=top style='width:70.85pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:none;
  mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black'>RESULTADO</span></b></p>
  </td>

    <?php 

        for ($i=0; $i < $qnt_displina; $i++) { 
     ?>
  <td width=40 valign=top style='width:30.3pt;border-top:none;border-left:solid black 1.0pt;
  border-bottom:solid black 1.0pt;border-right:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;
  mso-border-bottom-alt:solid black .5pt;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>N</span></b></p>
  </td>
  <td width=35 colspan=2 valign=top style='width:26.4pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>%</span></b></p>
  </td>
    <?php   } ?>

 </tr>



 <tr style='mso-yfti-irow:6;height:27.1pt'>
  <td width=94 valign=top style='width:70.85pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:none;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.1pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black'>APROVADOS</span></b></p>
  </td>
    <?php 
      
     $total_aprovados_geral=0;
     $total_reprovados_geral=0;
     $array_reprovados_disciplina=array();
     $array_aprovados_disciplina=array();
     $mult_displina=$qnt_displina;

    $res_disc=listar_disciplina_para_relatorio($conexao,$idturma_aux,$idescola,$ano_letivo);

  foreach ($res_disc as $key => $value) {
      $iddisciplina=$value['iddisciplina'];
      $total_disciplina=0;
    
        $res_aluno=$conexao->query("
          SELECT
          aluno.aluno_transpublico, 
          aluno.linha_transporte,
          aluno.imagem_carteirinha_transporte ,
          aluno.nome AS nome_aluno,
          aluno.sexo,
          aluno.data_nascimento,
          aluno.idaluno,
          aluno.email,
          aluno.status AS status_aluno,
          aluno.senha,
          turma.nome_turma,
          ecidade_matricula.matricula_codigo AS matricula,
          ecidade_matricula.matricula_datamatricula AS data_matricula,
          ecidade_matricula.datasaida AS datasaida
      FROM ecidade_matricula
      INNER JOIN aluno ON ecidade_matricula.aluno_id = aluno.idaluno
      INNER JOIN turma ON ecidade_matricula.turma_id = turma.idturma
      INNER JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
      WHERE ecidade_matricula.turma_escola = $idescola
        AND ecidade_matricula.turma_id $idturmas
        AND ecidade_matricula.calendario_ano = '$ano_letivo'
        AND ecidade_matricula.matricula_ativa='S'
      ORDER BY aluno.nome ASC");

      foreach ($res_aluno as $key => $value) {
        $idaluno=$value['idaluno'];
       
        if (!array_key_exists($iddisciplina,$array_reprovados_disciplina)) {
          $array_reprovados_disciplina[$iddisciplina]=0;
        }
        
        if (!array_key_exists($iddisciplina,$array_aprovados_disciplina)) {
          $array_aprovados_disciplina[$iddisciplina]=0;
        }
      
        $result_nota_aula1=$conexao->query("
                  SELECT avaliacao,periodo_id,nota FROM nota_parecer WHERE
                  escola_id=$idescola and
                  turma_id $idturmas and
                  disciplina_id=$iddisciplina and 
                  ano_nota=$ano_letivo and
                  periodo_id IN($idperiodo) and aluno_id=$idaluno  group by avaliacao,periodo_id,nota,nota ");


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
              $nota_tri_1=number_format($nota_tri_1, 1, '.', ',');

                if (!array_key_exists($iddisciplina,$array_reprovados_disciplina)) {
                  $array_reprovados_disciplina[$iddisciplina]=0;
                }

              if ($nota_tri_1>=5) {
                $total_disciplina++;
                $total_aprovados_geral++;
                $array_aprovados_disciplina[$iddisciplina]=$total_disciplina;


              }else{
              
                $array_reprovados_disciplina[$iddisciplina]=$array_reprovados_disciplina[$iddisciplina]+1;
                $total_reprovados_geral++;

              }

  }
            


     

    ?>
  
  <td width=40 valign=top style='width:30.3pt;border-top:none;border-left:solid black 1.0pt;
  border-bottom:solid black 1.0pt;border-right:none;mso-border-left-alt:solid black .5pt;
  mso-border-bottom-alt:solid black .5pt;padding:2.75pt 2.75pt 2.75pt 2.75pt;
  height:27.15pt'>
  <p class=TableContents style='layout-grid-mode:char'><span style='color:black'><o:p>&nbsp;
   <?php  echo $total_disciplina; ?></o:p></span></p>
  </td>


  <td width=35 colspan=2 valign=top style='width:26.4pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.15pt'>
  <p class=TableContents style='layout-grid-mode:char'><span style='color:black'><o:p>&nbsp;<?php echo porcentagem($total_disciplina,$quantidade_vaga); ?>%</o:p></span></p>
  </td>
<?php   } ?>
  
 </tr>



 <tr style='mso-yfti-irow:7;height:27.15pt'>
  <td width=94 valign=top style='width:70.85pt;border-top:none;border-left:
  solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:none;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.15pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black'>REPROVADOS</span></b></p>
  </td>


<?php 
  $res_disc_resultado=listar_disciplina_para_relatorio($conexao,$idturma_aux,$idescola,$ano_letivo);
 
 
foreach ($res_disc_resultado as $key_disc=> $value_disc) {
  $iddisc=$value_disc['iddisciplina'];
 

?>

  <td width=35 colspan=2 valign=top style='width:26.4pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.15pt'>
  <p class=TableContents style='layout-grid-mode:char'><span style='color:black'><o:p>&nbsp;
    <?php 
      if (array_key_exists($iddisc,$array_reprovados_disciplina)) {
          echo $array_reprovados_disciplina[$iddisc];
      }else{
        echo "0";
      }

    ?>
  </o:p></span></p>
  </td>

  <td width=35 colspan=2 valign=top style='width:26.4pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:27.15pt'>
  <p class=TableContents style='layout-grid-mode:char'><span style='color:black'><o:p>&nbsp;
<?php  //var_dump($array_reprovados_disciplina);
   echo  porcentagem($array_reprovados_disciplina[$iddisc],$quantidade_vaga) ?>%
  </o:p></span></p>
  </td>

<?php   } ?>


 </tr>




 <tr>
  <td width=149 colspan=3 valign=top style='width:111.85pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>FLUXO DE ALUNOS</span></b></p>
  </td>
  <td width=661 colspan=26 valign=top style='width:495.6pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>APROVEITAMENTO POR TURMA</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=149 colspan=3 valign=top style='width:111.85pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'>MATRICULADOS</span></b></p>
  </td>
  <td width=114 colspan=6 valign=top style='width:85.2pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'>APROVADOS</span></b></p>
  </td>
  <td width=125 colspan=4 valign=top style='width:93.5pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'>REPROVADOS</span></b></p>
  </td>
  <td width=94 colspan=4 valign=top style='width:70.7pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'>EVADIDOS</span></b></p>
  </td>
  <td width=119 colspan=7 valign=top style='width:89.0pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'>TRANSFERÊNCIAS</span></b></p>
  </td>
  <td width=210 colspan=5 valign=top style='width:157.2pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:6.0pt;color:black;
  mso-color-alt:windowtext'>EFETIVOS</span></b></p>
  </td>
 </tr>
 <tr style='height:22.5pt'>
  <td width=149 colspan=3 rowspan=2 style='width:111.85pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=47 colspan=3 valign=top style='width:35.35pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>N</span></b></p>
  </td>
  <td width=66 colspan=3 valign=top style='width:49.85pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>%</span></b></p>
  </td>
  <td width=56 colspan=2 valign=top style='width:42.3pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>N</span></b></p>
  </td>
  <td width=68 colspan=2 valign=top style='width:51.2pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>%</span></b></p>
  </td>
  <td width=41 colspan=2 valign=top style='width:30.95pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>N</span></b></p>
  </td>
  <td width=53 colspan=2 valign=top style='width:39.75pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>%</span></b></p>
  </td>
  <td width=62 colspan=3 valign=top style='width:46.7pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>N</span></b></p>
  </td>
  <td width=56 colspan=4 valign=top style='width:42.3pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>%</span></b></p>
  </td>
  <td width=61 colspan=3 valign=top style='width:45.55pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>N</span></b></p>
  </td>
  <td width=149 colspan=2 valign=top style='width:111.65pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:22.5pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>%</span></b></p>
  </td>
 </tr>
 <tr style='height:21.75pt'>
  <td width=47 colspan=3 valign=top style='width:35.35pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=66 colspan=3 valign=top style='width:49.85pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=56 colspan=2 valign=top style='width:42.3pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=68 colspan=2 valign=top style='width:51.2pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=41 colspan=2 valign=top style='width:30.95pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=53 colspan=2 valign=top style='width:39.75pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=62 colspan=3 valign=top style='width:46.7pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=56 colspan=4 valign=top style='width:42.3pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=61 colspan=3 valign=top style='width:45.55pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
  <td width=149 colspan=2 valign=top style='width:111.65pt;border:solid black 1.0pt;
  border-top:none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:
  solid black .5pt;mso-border-right-alt:solid black .5pt;padding:2.75pt 2.75pt 2.75pt 2.75pt;
  height:21.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black'>*</span></b></p>
  </td>
 </tr>




 <tr>
  <td width=149 colspan=3 valign=top style='width:111.85pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>CARIMBO DA ESCOLA</span></b></p>
  </td>
  <td width=238 colspan=10 valign=top style='width:178.7pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>ASSINATURA E CARIMBO DO(A) DIRETOR(A)</span></b></p>
  </td>
  <td width=213 colspan=11 valign=top style='width:159.7pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-top-alt:solid black .5pt;mso-border-top-alt:solid black .5pt;
  mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>ASSINATURA E CARIMBO DO(A) SECRETÁRIO(A)</span></b></p>
  </td>
  <td width=210 colspan=5 valign=top style='width:157.2pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#729FCF;padding:2.75pt 2.75pt 2.75pt 2.75pt'>
  <p class=TableContents><b><span style='font-size:8.0pt;color:black;
  mso-color-alt:windowtext'>DATA</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-lastrow:yes;height:29.7pt'>
  <td width=149 colspan=3 valign=top style='width:111.85pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:29.7pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
  <td width=238 colspan=10 valign=top style='width:178.7pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:29.7pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
  <td width=213 colspan=11 valign=top style='width:159.7pt;border-top:none;
  border-left:solid black 1.0pt;border-bottom:solid black 1.0pt;border-right:
  none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:solid black .5pt;
  padding:2.75pt 2.75pt 2.75pt 2.75pt;height:29.7pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
  <td width=210 colspan=5 valign=top style='width:157.2pt;border:solid black 1.0pt;
  border-top:none;mso-border-left-alt:solid black .5pt;mso-border-bottom-alt:
  solid black .5pt;mso-border-right-alt:solid black .5pt;padding:2.75pt 2.75pt 2.75pt 2.75pt;
  height:29.7pt'>
  <p class=TableContents style='layout-grid-mode:char'><o:p>&nbsp;</o:p></p>
  </td>
 </tr>

</table>


