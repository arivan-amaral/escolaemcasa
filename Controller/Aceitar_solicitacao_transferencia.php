<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Escola.php';


try {

    $profissional_resposta=$_SESSION['idfuncionario'];

 
    $matricula_aluno=$_POST["matricula_aluno"];
    $idaluno=$_POST["idaluno"];
    $idsolicitacao=$_POST["idsolicitacao"];
    $aceitar_ano_letivo=$_POST["aceitar_ano_letivo"];
    $aceitar_idescola_destino=$_POST["aceitar_idescola_destino"];
    $aceitar_idescola_origem=$_POST["aceitar_idescola_origem"];
    $aceitar_turno=$_POST["aceitar_turno"];
    $vaga_escola=$_POST["vaga_escola"];
    $aceitar_nova_turma=$_POST["aceitar_nova_turma"];
    $turma_id_origem=$_POST["turma_id_origem"];
    if (isset($_POST['etapa'])) {
      $etapa=$_POST['etapa'];
    }else{
      $etapa=NULL;

    }
    // $turma_id_origem=$_POST["turma_id_origem"];
    // aceitar_idescola_destino
    // idaluno
    
    if ($vaga_escola>0) {
        $aceita=1;
        $procedimento="TRANSFERIDO REDE";
        $data_saida=date("Y-m-d");
         mudar_situacao_transferencia_aluno_aceita($conexao,$matricula_aluno,$procedimento,$data_saida);
        //transferencia
        $aluno_id=$idaluno;
        $turma_id=$aceitar_nova_turma;
        $turma_id_anterior=$turma_id_origem;
        
        $matricula_situacao="MATRICULADO";
        $matricula_concluida="N";
        $matricula_datamatricula=date("Y-m-d");
        $matricula_ativa="S";
        $matricula_tipo="N";
        $calendario_ano=$aceitar_ano_letivo;
        $turma_escola=$aceitar_idescola_destino;
        $turno_nome=$aceitar_turno;

        rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$turma_escola,$turno_nome,$etapa);

        aceitar_solicitacao_transferencia($conexao,$profissional_resposta,$idsolicitacao,$aceita);
        

        
        


        $nova_turma=$_POST["aceitar_nova_turma"];

        $nova_escola=$_POST["aceitar_idescola_destino"];

         $antiga_escola=$_POST["aceitar_idescola_origem"];
         $antiga_turma=$_POST["turma_id_origem"];
         $ano_nota=$_POST["aceitar_ano_letivo"];
  migrar_notas_transferencia($conexao,$nova_turma,$nova_escola, $aluno_id , $antiga_escola, $antiga_turma, $ano_nota);
        echo "Ação concluída"; 
    }else{
    echo "SEM VAGA NA TURMA "; 

    }
              

} catch (Exception $e) {
   echo "ERRO: $e";
    
}

?>