<?php session_start();
include '../Model/Conexao.php';
include '../Model/Aluno.php';
include"Conversao.php";


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
 for ($i=1; $i <= $total ; $i++) { 
    $data_aux->modify('+1day');
    // echo $stringDate = $data_aux->format('Y-m-d'); 
    // echo "<br>";
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
                    <th>#</th>
                                        
                </tr>
            </thead>
            <tbody>";

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

 $result.="
           <tr> 
               <td>
                    
             $nome_aluno
                
              </td>
            
              <td>
#
              </td>
           ";
  
 
}

echo "$result";
 
 } catch (Exception $e) {
 	echo $e;
 }


 

?>