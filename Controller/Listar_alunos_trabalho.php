<?php
session_start();
    if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
    include("../Model/Aluno.php");
    include("../Model/Trabalho.php");
    include("Conversao.php");

try {
  // sleep(1);
  
    $idtrabalho = $_GET["idtrabalho"];
    $iddisciplina = $_GET["iddisciplina"];
    $idturma = $_GET["idturma"];
    $idescola = $_GET["idescola"];

    
 // $res_alunos=  listar_aluno_da_turma_professor($conexao,$idturma,$idescola);
    if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
             $res_alunos=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    }else{
             $res_alunos=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
    }

    $return="";
                    foreach ($res_alunos as $key => $value) {
                         $id=$value['idaluno'];
                         $nome=$value['nome_aluno'];
                  
                        $return.="<a href='ver_trabalho_entregue.php?idaluno=$id&idtrabalho=$idtrabalho&iddisciplina=$iddisciplina&idturma=$idturma'>
                        $nome<br>";
                        
                        $result_recebido=ver_trabalhos_entregues($conexao,$id, $idtrabalho);
                        $cont=0;
                        foreach ($result_recebido as $key_recebido => $value_recebido) {
                           $cont++;
                           $data_entrega=$value_recebido['data_entrega'];
                           $data_recebido=$value_recebido['data_recebido'];
                           $data_inicio = new DateTime($data_entrega);
                           $data_fim = new DateTime($data_recebido);
                           // Resgata diferença entre as datas
                           $dateInterval = $data_inicio->diff($data_fim);


                           $cal_data=floor(strtotime($data_entrega) - strtotime($data_recebido));
                          
                          // $data_recebido='2021-02-08 23:59:00';

                          if ($cal_data >= -80000  ) {
                            $return.=" 
                            <div class='time-label'>
                               <span class='bg-blue'>Recebido:".data($data_recebido)."</span>
                             </div>";
                             
                           }else {
                            // $return.=" 
                            // <div class='time-label'>
                            //    <span class='bg-blue'>Recebido:".data($data_recebido)."</span>
                            //  </div>";

                            $return.=" 
                              <div class='time-label'>
                                 <span class='bg-red'>Recebido com atraso  :".data($data_recebido)."</span>
                               </div>";
                            
                           }

                           break;
                        }


                        if($cont==0){
                             $return.=" 
                            <div class='time-label'>
                               <span class='bg-warning'>NADA RECEBIDO</span>
                             </div>";
                           }
                        $return.="</a> <br>";

                    }

echo $return;
  
} catch (Exception $e) {
    echo "Erro desconhecido";
}
?>