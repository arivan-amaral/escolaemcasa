    <?php session_start();
    include '../Model/Conexao.php';
    include '../Model/Aluno.php';
    include"Conversao.php";


    $ano_letivo = $_SESSION['ano_letivo'];

    $idturma = $_GET['idturma'];
    $idescola = $_GET['idescola'];
    $quantidade_falta = $_GET['falta'];
    $data_inicial = $_GET['data_inicial'];
    $data_final = $_GET['data_final'];

     $data_inicio = new DateTime("$data_inicial");
     $data_fim = new DateTime("$data_final");
     $dateInterval = $data_inicio->diff($data_fim);
     $total= $dateInterval->days;
      

     try {


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
                        <th>Aluno</th>
                        <th>Faltas consecutivas</th>
                                            
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
       foreach ($array_datas as $key => $datas) {
           if ($faltas_aluno<$quantidade_falta) {
               $res=$conexao->query("SELECT * FROM frequencia WHERE ano_frequencia='$ano_letivo' and
                data_frequencia ='$datas' and aluno_id=$idaluno and turma_id=$idturma and escola_id=$idescola and  presenca in(0) and presenca not in(1) limit 1 ");
               // echo "SELECT * FROM frequencia WHERE ano_frequencia='$ano_letivo' and
               //  data_frequencia ='$datas' and aluno_id=$idaluno and turma_id=$idturma and escola_id=$idescola and  presenca in(0) and presenca not in(1) limit 1; <br><br>";
               if (count($res->fetchAll())>0) {
                  $faltas_aluno++;
               }else{
                    $faltas_aluno=0;
               }
           }

           if ($faltas_aluno>=$quantidade_falta) {
             break;
           }
       }

    if ($faltas_aluno>=$quantidade_falta) {

            $result.="
               <tr> 
                   <td>
                        
                 $conta_aluno
                    
                  </td>           <td>
                        
                 $nome_aluno
                    
                  </td>
                
                  <td>
                    $faltas_aluno
                  </td>
               ";
     
    }

    $faltas_aluno=0;
    $conta_aluno++;
    }
    echo "$result";
     
     } catch (Exception $e) {
     	echo $e;
     }


     

    ?>