<?php 
    session_start();
    set_time_limit(0);
    include_once '../Model/Conexao.php';
    include_once '../Model/Aluno.php';
    include_once "Conversao.php";

//     ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
 

function obterDatasEntrePeriodo($dataInicial, $dataFinal) {
    // Converte as datas para o formato do objeto DateTime
    $dataInicial = new DateTime($dataInicial);
    $dataFinal = new DateTime($dataFinal);

    // Incrementa um dia na data inicial para garantir que ela esteja incluída no resultado
    //  $dataInicial->modify('-1 day');
    $dataFinal->modify('+1 day');

    // Cria um intervalo de datas usando a data inicial, a data final e o passo de 1 dia
    $intervalo = new DateInterval('P1D');
    $periodo = new DatePeriod($dataInicial, $intervalo, $dataFinal);

    // Inicializa um array para armazenar as datas
    $datas = [];

    // Itera sobre o período e adiciona cada data ao array
    foreach ($periodo as $data) {
        $datas[] = $data->format('Y-m-d');
    }

    return $datas;
}

 

    // try {
    $quantidade_falta = $_GET['falta'];

    $ano_letivo = $_SESSION['ano_letivo'];
    $idturma = $_GET['idturma'];
    
    $campo_turma=($_GET['idturma']);
    $delimit=",";

    // $turma=explode($delimit,$campo_turma);
    // $turma_aux="";


    

    $idescola = $_GET['idescola'];
    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];

     $data_inicio = new DateTime("$data_inicial");
     $data_fim = new DateTime("$data_final");
     $dateInterval = $data_inicio->diff($data_fim);
     $total= $dateInterval->days;
      

 if ($idescola =='Todas') {
	$idescola=" and escola.idescola >0 ";
}else{
	$idescola=" and escola.idescola = $idescola ";

}


 
if ($idturma =='' || $idturma =='Todas') {
    $idturma=" and ecidade_matricula.turma_id >0 ";
}else{
    
    $idturma=" and ecidade_matricula.turma_id IN($campo_turma) ";
    

}


// if ($idturma =='Todas') {
// 	$idturma=" and turma.idturma >0 ";
// }else{
// 		$idturma=" and turma.idturma = $idturma ";


// }

 
       
$array_datas = obterDatasEntrePeriodo($data_inicial, $data_final);

 
    $resultado=$conexao->query("
    SELECT
    aluno.aluno_transpublico, 
    aluno.linha_transporte,
    aluno.imagem_carteirinha_transporte ,
    aluno.nome AS nome_aluno,
    aluno.whatsapp,
    aluno.whatsapp_responsavel,
    aluno.sexo,
    aluno.data_nascimento,
    aluno.idaluno,
    aluno.email,
    aluno.status AS status_aluno,
    aluno.senha,
    turma.nome_turma,
    turma.idturma as turma_id,
    ecidade_matricula.matricula_codigo AS matricula,
    ecidade_matricula.turma_escola AS 'escola_id',
    ecidade_matricula.matricula_datamatricula AS data_matricula,
    ecidade_matricula.datasaida AS datasaida
FROM ecidade_matricula
INNER JOIN aluno ON ecidade_matricula.aluno_id = aluno.idaluno
INNER JOIN turma ON ecidade_matricula.turma_id = turma.idturma
INNER JOIN escola ON ecidade_matricula.turma_escola = escola.idescola
WHERE
   ecidade_matricula.calendario_ano = '$ano_letivo'
  AND ecidade_matricula.matricula_ativa = 'S'
 $idescola $idturma
ORDER BY escola.nome_escola, turma.nome_turma, aluno.nome ASC");




    $result="
  <table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Aluno</th>
                        <th>Ação</th>
                        <th>Faltas Consecutivas</th>
                        <th>Total no período</th>
                                            
                    </tr>
                </thead>
                <tbody>";
    $conta_aluno=1;

     foreach ($resultado as $key => $value) {

       $nome_aluno=($value['nome_aluno']);
       $whatsapp=($value['whatsapp']);
       $whatsapp_responsavel=($value['whatsapp_responsavel']);
       $nome_turma=($value['nome_turma']);
       $id=$value['idaluno'];
       $idaluno=$value['idaluno'];
       $status_aluno=$value['status_aluno'];
       $email=$value['email'];
       $senha=$value['senha'];
       $matricula_aluno=$value['matricula'];
       $turma_id=$value['turma_id'];
       $escola_id=$value['escola_id'];

       

        $faltas_aluno=0;
        $total_faltas_aluno=0;

   // echo "($faltas_aluno<=$quantidade_falta)";

           foreach ($array_datas as $key => $datas) {
          // echo "w$faltas_aluno <br>";
               // if ($faltas_aluno<=$quantidade_falta) {
                  
                   $res_faltas=$conexao->query("SELECT * FROM frequencia WHERE ano_frequencia='$ano_letivo' and
                    data_frequencia ='$datas' and aluno_id=$idaluno and turma_id=$turma_id and escola_id=$escola_id  and  presenca !=1 limit 1 ");

                // if ($_SESSION['nivel_acesso_id'] ==100) {
                  
                        
                   // $result.="SELECT * FROM frequencia WHERE ano_frequencia='$ano_letivo' and
                   // data_frequencia ='$datas' and aluno_id=$idaluno and turma_id=$turma_id and escola_id=$escola_id  and  presenca !=1 limit 1; <br>";

                // }
                 // $conta_faltas=0;
                 //   foreach ($res_faltas as $key => $value) {
                 //       $faltas_aluno++;
                 //        $conta_faltas++;

                 //      $total_faltas_aluno++;
                 //   }
                 //   if ($conta_faltas==0) {
                 //     $faltas_aluno=0;

                 //   }

                   if (count($res_faltas->fetchAll())>0) {
                      $faltas_aluno++;
                      $total_faltas_aluno++;
                   }

                   else if ($faltas_aluno < $quantidade_falta ) {
                     
                        $faltas_aluno=0;
                   }
               // }

  
       } 



     if ($faltas_aluno>=$quantidade_falta) {

            $result.="
               <tr> 
                   <td>
                        
                 $conta_aluno 
                    
                  </td> <td>
                        
                 $id - $nome_aluno
                 <br>
                 $nome_turma
                 <b>CONTATO:</b><br>
                 <b class='text-primary'>$whatsapp</b>/<br>
                 <b class='text-primary'>$whatsapp_responsavel</b>/<br>
                    
                  </td>
                  <td> <a href='cadastrar_registro_ligacao.php?nome_aluno=$nome_aluno&data_inicial=$data_inicial&data_final=$data_final&idaluno=$idaluno&quantidade_falta=$quantidade_falta&escola_id=$escola_id&turma_id=$turma_id' class='btn btn-success' target='_blank' >Registrar chamada</a> 
                  </td>
                  <td>
                    $quantidade_faltas ou +
                  </td>  
                   <td>
                    $total_faltas_aluno
                  </td>
               ";
    $conta_aluno++;
     
     }

    $faltas_aluno=0;
    }




    
    echo "$result </tbody></table>";
     
     // } catch (Exception $e) {
     //    echo $e;
     // }


     

    ?>