    <?php 
    ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    session_start();
    set_time_limit(0);
    include_once '../Model/Conexao.php';
    include_once '../Model/Aluno.php';
    include_once "Conversao.php";


    // try {
    $quantidade_falta = $_GET['falta'];
    $ano_letivo = $_SESSION['ano_letivo'];
    $idturma = $_GET['idturma'];
    $idturma = $_GET['idturma'];
    

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
if ($idturma =='Todas') {
	$idturma=" and turma.idturma >0 ";
}else{
		$idturma=" and turma.idturma = $idturma ";


}


        $data_aux=$data_inicio;

        $array_datas = array();
        for ($i=0; $i <= $total ; $i++) { 
           $stringDate = $data_aux->format('Y-m-d'); 
           $array_datas[$i]=$stringDate ;
           $data_aux->modify('+1day');
        
        }
 

    $resultado=$conexao->query("
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
ORDER BY aluno.nome ASC");




    $result="
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Aluno</th>
                        <th>Faltas</th>
                                            
                    </tr>
                </thead>
                <tbody>";
    $conta_aluno=1;

     foreach ($resultado as $key => $value) {

       $nome_aluno=($value['nome_aluno']);
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

   

           foreach ($array_datas as $key => $datas) {
             
               if ($faltas_aluno<=$quantidade_falta) {
                   $res=$conexao->query("SELECT * FROM frequencia WHERE ano_frequencia='$ano_letivo' and
                    data_frequencia ='$datas' and aluno_id=$idaluno and turma_id=$turma_id and escola_id=$escola_id  and  presenca !=1 limit 1 ");
                  
                   if (count($res->fetchAll())>0) {
                      $faltas_aluno++;
                   }else{
                        $faltas_aluno=0;
                   }
               }

  
       }



    if ($faltas_aluno>=$quantidade_falta || $quantidade_falta=='total') {

            $result.="
               <tr> 
                   <td>
                        
                 $conta_aluno
                    
                  </td>           <td>
                        
                 $id - $nome_aluno
                 <br>
                 $nome_turma
                    
                  </td>
                  <td> <a href='cadastrar_registro_ligacao.php?nome_aluno=$nome_aluno&data_inicial=$data_inicial&data_final=$data_final&idaluno=$idaluno&quantidade_falta=$quantidade_falta' class='btn btn-success' >Registrar chamada</a> 
                  </td>
                  <td>
                    $faltas_aluno
                  </td>
               ";
    $conta_aluno++;
     
    }

    $faltas_aluno=0;
    }




    
    echo "$result";
     
     // } catch (Exception $e) {
     //    echo $e;
     // }


     

    ?>