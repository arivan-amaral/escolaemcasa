<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Coordenador.php';
try {
  $idfuncionario=$_SESSION['idfuncionario'];

  $idescola=$_GET['idescola'];
  if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
    $res=listar_turmas_inicial_coordenador($conexao,$idescola,$_SESSION['ano_letivo']);
  }elseif ($_SESSION['ano_letivo']==2021) {
    $res=listar_turmas_coordenador_remoto($conexao,$idescola,$_SESSION['ano_letivo']);
  }else{
    $res=listar_turmas_coordenador($conexao,$idescola,$_SESSION['ano_letivo']);
  }

  $result="";
  $turno="";
  $conta=1;
  foreach ($res as $key => $value) {

    $idturma=$value['idturma'];
    $idserie=$value['idserie'];
    $seguimento=$value['seguimento'];

    $nome_serie=$value['nome_serie'];
    $nome_turma=($value['nome_turma']);
    $idescola=($value['idescola']);
    $nome_escola=($value['nome_escola']);
    if (isset($value['turno'])) {
        $turno=($value['turno']);
    }else{
      $turno="REMOTO";
    }
    
    if (isset($_SESSION['idfuncionario']))  {
                              // if (isset($_SESSION['idcoordenador']))  {
      $result.= "
      <div class='card card-primary'>

      <div class='card-header'>
      <h4 class='card-title w-100'>
      <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$idturma' aria-expanded='false' target='_blank'> ". $nome_turma ." - <b class='text-black'> [ $turno ]</b>  <i class='right fas fa-angle-left'></i> ($conta)
      </a>
      </h4>
      </div>
      <div id='collapseOne$idturma' class='collapse' data-parent='#accordion' style=''>
      <div class='card-body'>
      

      

       

      <a   href='coordenador_relatorio_video_aluno.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat' target='_blank'>
      <i class='fa fa-play'></i> 
      VER RELATÓRIO DE VÍDEOS DE ALUNO
      </a> 


      ";

      if ($idserie<8 || ($seguimento !='' && $seguimento <3) || ( $idserie==16 && $seguimento <3)) {

          $result.= "
            <a   href='impressao_diario_frequencia.php?iddisciplina=1000&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat' target='_blank'>
            <i class='fa fa-calendar'></i> 
            FICHA DE RENDIMENTO TRI I
            </a> 

            <a   href='impressao_diario_frequencia.php?iddisciplina=1000&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-secondary btn-block btn-flat' target='_blank'>
            <i class='fa fa-calendar'></i> 
            FICHA DE RENDIMENTO TRI II
            </a>   
            <a   href='impressao_diario_frequencia.php?iddisciplina=1000&idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-secondary btn-block btn-flat' target='_blank'>
            <i class='fa fa-calendar'></i> 
            FICHA DE RENDIMENTO TRI III
            </a>  "; 
      }




     $result.= "
   <a   href='relatorio_trimestral.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-danger btn-block btn-flat' target='_blank'>
      <i class='fa fa-GRAFIC'></i> 
       RELATÓRIO TRIMESTRAL
      </a> 

      <a   href='relatorio_frequencia.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat' target='_blank'>
      <!-- i class='fa fa-play'></i --> 
      RELATÓRIO DE FREQUÊNCIA
      </a>  


      
      <a   href='listar_alunos_da_turma.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat' target='_blank'>
      <i class='fa fa-users'></i> 
      LISTAR ALUNOS DA TURMA
      </a> 


      ";
      // if ($idserie<8 || ($seguimento !='' && $seguimento <3)) {


          $result.= "<a href='diario_conteudo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-secondary btn-block btn-flat' target='_blank'>
          <i class='fa fa-edit'></i> 
          CONTEÚDOS DE AULAS TRIMESTRE I
          </a> 
          <a href='diario_conteudo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=2' class='btn btn-secondary btn-block btn-flat' target='_blank'>
          <i class='fa fa-edit'></i> 
          CONTEÚDOS DE AULAS  TRIMESTRE II
          </a>

          <a href='diario_conteudo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=3' class='btn btn-secondary btn-block btn-flat' target='_blank'>
          <i class='fa fa-edit'></i> 
          CONTEÚDOS DE AULAS  TRIMESTRE III
          </a> ";
    // }


      if ($idserie<3) {
        $result.="<a href='parecer_descritivo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat' target='_blank'>
        <i class='fa fa-edit'></i> 
        PARECER DESCRITIVO
        </a> ";
                                            // code...
      }

      if ($idserie>2 && $idserie< 8 || ($seguimento==2)) {
        $result.="<a href='habilidade.php?idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1' class='btn btn-warning btn-block btn-flat' target='_blank'>
        <i class='fa fa-card'></i> 
        HABILIDADES
        </a>";
      }

      $result.="<a   href='boletim.php?idturma=$idturma&idescola=$idescola&idserie=$idserie&periodo_id=1&tokem_teste=reee' class='btn btn-secondary btn-block btn-flat' target='_blank'>
      <i class='fa fa-calendar'></i> 
      BOLETIM
      </a>      
      ";
      
      $result.="
      <br>
      <form action='ata_resultado_final.php' method='post' target='_blank'>
      <input type='hidden' name='idserie' value='$idserie'>
      <input type='hidden' name='idturma' value='$idturma'>
      <input type='hidden' name='idescola' value='$idescola'>

      <input type='hidden' name='nome_escola' value='$nome_escola'>
      <input type='hidden' name='nome_turma' value='$nome_turma'>
      <button  class='btn btn-secondary btn-block btn-flat'>
      <i class='fa fa-print'></i> 
      ATA DE RESULTADOS FINAIS
      </button> 
      </form>  
<BR>
      <a  href='acompanhamento_pedagogico.php?idprofessor=$idfuncionario&disc=1&turm=$idturma&turma=$nome_turma&disciplina=OCORRÊNCIAS&idescola=$idescola&idserie=$idserie' class='btn btn-warning btn-block btn-flat' target='_blank'>
        <i class='fa fa-card'></i> 
        OCORRÊNCIA
        </a>
      <br>






      ";

      $result.="
      
      <form action='capa_turma.php' method='post' target='_blank'>
      <input type='hidden' name='idturma' value='$idturma'>
      <input type='hidden' name='idescola' value='$idescola'>

      <input type='hidden' name='nome_escola' value='$nome_escola'>
      <input type='hidden' name='nome_turma' value='$nome_turma'>
      <button  class='btn btn-secondary btn-block btn-flat'>
      <i class='fa fa-print'></i> 
      CAPA DA TURMA
      </button> 
      </form>   
      <br>




      ";
      $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

      foreach ($pes as $chave => $linha) {
        $idprofessor=($linha['idprofessor']);
        $nome_disciplina=($linha['nome_disciplina']);
        $iddisciplina=$linha['iddisciplina'];
        $nome=$linha['nome'];

        $result.= "
        
        <a   href='ver_conteudo_disciplina.php?idprofessor=$idprofessor&iddisciplina=$iddisciplina&idturma=$idturma&nome_disciplina=$nome_disciplina&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat' target='_blank'>
        <i class='fa fa-book'></i> 
        $nome_disciplina -> $nome
        </a>      
        
        ";
      } 

      $result.="
      </div>
      </div>
      </div>";                  
    }
  $conta++;
  }
  echo "$result";
} catch (Exception $e) {
  echo "$e";
}
?>