    <?php 
    session_start();
    set_time_limit(0);
    include_once '../Model/Conexao.php';
    include_once '../Model/Aluno.php';
    include_once "Conversao.php";


    try {
    $quantidade_falta = $_GET['falta'];
    $ano_letivo = $_SESSION['ano_letivo'];
    $idturma = $_GET['idturma'];
    $idturma = $_GET['idturma'];
    
    $serie_seguimento=verifica_seguimento($conexao,$idturma);
    $seguimento=$serie_seguimento['seguimento'];
    $idserie=$serie_seguimento['serie_id'];

    $idescola = $_GET['idescola'];
    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];

     $data_inicio = new DateTime("$data_inicial");
     $data_fim = new DateTime("$data_final");
     $dateInterval = $data_inicio->diff($data_fim);
     $total= $dateInterval->days;
      


        $data_aux=$data_inicio;

        $array_datas = array();
        for ($i=0; $i <= $total ; $i++) { 
           $stringDate = $data_aux->format('Y-m-d'); 
           $array_datas[$i]=$stringDate ;
           $data_aux->modify('+1day');
        
        }


    // echo "$idturma<br>";
    // echo "$idescola";
     if ($_SESSION['ano_letivo']==$_SESSION['ano_letivo_vigente']) {
       $resultado=listar_aluno_da_turma_ata_resultado_final($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
     }else{
       $resultado=listar_aluno_da_turma_ata_resultado_final_matricula_concluida($conexao,$idturma,$idescola,$_SESSION['ano_letivo']);
     }
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
       $data_nascimento=converte_data($value['data_nascimento']);
       $senha=$value['senha'];
       $matricula_aluno=$value['matricula'];
        $faltas_aluno=0;

     if ( $quantidade_falta=="Total" ) {

        if ( ($seguimento!='' && $seguimento <3) || $idserie <8 ) {


            // foreach ($array_datas as $key => $datas) {
              
                    $res_cont=$conexao->query("SELECT COUNT(*) as 'quantidade',data_frequencia FROM frequencia WHERE ano_frequencia='$ano_letivo' and aluno_id=$idaluno and turma_id=$idturma and escola_id=$idescola and  presenca in(0)   and
                     (data_frequencia BETWEEN '$data_inicial' and '$data_final') GROUP BY data_frequencia");
                        
                        $quantidade_f=0;
                        foreach ($res_cont as $keyInf => $valueInf) {
                           $faltas_aluno+=$valueInf['quantidade'];
                        }
            
                
            // }
            //$faltas_aluno="Total fund1 e infantil seg $seguimento $idserie ";


        }else if ( ($seguimento!='' && $seguimento <3)  || ( $idserie >7 && $idserie<16)) {
           
           $res_pre=$conexao->query("SELECT count(*) AS'quantidade' from frequencia where presenca=0 and aluno_id=$idaluno and escola_id=$idescola and turma_id=$idturma and data_frequencia BETWEEN '$data_inicial' and '$data_final' ");

               foreach ($res_pre as $keyPre => $valuePre) {
                    $faltas_aluno=$valuePre['quantidade'];
               }


        }
            // $faltas_aluno="Total fund2 ";


    }else{

           foreach ($array_datas as $key => $datas) {
               if ($faltas_aluno<=$quantidade_falta) {
                   $res=$conexao->query("SELECT * FROM frequencia WHERE ano_frequencia='$ano_letivo' and
                    data_frequencia ='$datas' and aluno_id=$idaluno and turma_id=$idturma and escola_id=$idescola and  presenca in(0) and presenca not in(1) limit 1 ");
                  
                   if (count($res->fetchAll())>0) {
                      $faltas_aluno++;
                   }else{
                        $faltas_aluno=0;
                   }
               }

               
        }

           // if ($faltas_aluno>=$quantidade_falta) {
           //   break;
           // }
       }



    if ($faltas_aluno>=$quantidade_falta || $quantidade_falta=='Total') {

            $result.="
               <tr> 
                   <td>
                        
                 $conta_aluno
                    
                  </td>           <td>
                        
                 $id - $nome_aluno
                    
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
     
     } catch (Exception $e) {
        echo $e;
     }


     

    ?>