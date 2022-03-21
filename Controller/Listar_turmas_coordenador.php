<?php session_start();
include'../Model/Conexao.php';
include'../Model/Coordenador.php';
try {
  

  $idescola=$_GET['idescola'];
  if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
    $res=listar_turmas_inicial_coordenador($conexao,$idescola,$_SESSION['ano_letivo']);
  }else{
    $res=listar_turmas_coordenador($conexao,$idescola,$_SESSION['ano_letivo']);
  }

  $result="";
  $turno="";
  foreach ($res as $key => $value) {

    $idturma=$value['idturma'];
    $idserie=$value['idserie'];

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
      <a class='d-block w-100 collapsed' data-toggle='collapse' href='#collapseOne$idturma' aria-expanded='false' target='_blank'> ". $nome_turma ." - <b class='text-black'> [ $turno ]</b>  <i class='right fas fa-angle-left'></i>
      </a>
      </h4>
      </div>
      <div id='collapseOne$idturma' class='collapse' data-parent='#accordion' style=''>
      <div class='card-body'>
      

      

      <a   href='coordenador_relatorio_video_aluno.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat' target='_blank'>
      <i class='fa fa-play'></i> 
      VER RELATÓRIO DE VÍDEOS DE ALUNO
      </a>  


      
      <a   href='listar_alunos_da_turma.php?idturma=$idturma&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat' target='_blank'>
      <i class='fa fa-users'></i> 
      LISTAR ALUNOS DA TURMA
      </a> 


      <a href='diario_conteudo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat' target='_blank'>
      <i class='fa fa-edit'></i> 
      CONTEÚDOS DE AULAS
      </a> ";
      if ($idserie<3) {
        $result.="<a href='parecer_descritivo.php?idturma=$idturma&idescola=$idescola&idserie=$idserie' class='btn btn-secondary btn-block btn-flat' target='_blank'>
        <i class='fa fa-edit'></i> 
        PARECER DESCRITIVO
        </a> ";
                                            // code...
      }

      if ($idserie>2 && $idserie< 8) {
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
      <button  class='btn btn-danger btn-block btn-flat'>
      <i class='fa fa-print'></i> 
      ATA DE RESULTADOS FINAIS
      </button> 
      </form>   
      <br>

      ";

      $result.="
      
      <form action='capa_turma.php' method='post' target='_blank'>
      <input type='hidden' name='idturma' value='$idturma'>
      <input type='hidden' name='idescola' value='$idescola'>

      <input type='hidden' name='nome_escola' value='$nome_escola'>
      <input type='hidden' name='nome_turma' value='$nome_turma'>
      <button  class='btn btn-danger btn-block btn-flat'>
      <i class='fa fa-print'></i> 
      CAPA DA TURMA
      </button> 
      </form>   
      <br>

      ";
      $pes=listar_disciplina_da_turma($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);

      foreach ($pes as $chave => $linha) {
        $nome_disciplina=($linha['nome_disciplina']);
        $iddisciplina=$linha['iddisciplina'];
        $nome=$linha['nome'];

        $result.= "
        
        <a   href='ver_conteudo_disciplina.php?iddisciplina=$iddisciplina&idturma=$idturma&nome_disciplina=$nome_disciplina&nome_turma=$nome_turma&idescola=$idescola&idserie=$idserie' class='btn btn-info btn-block btn-flat' target='_blank'>
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
  }
  echo "$result";
} catch (Exception $e) {
  echo "$e";
}
?>