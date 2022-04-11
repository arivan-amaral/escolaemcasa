<?php session_start();
include '../Model/Conexao.php';
include"Conversao.php";


$quantidade_falta = $_GET['falta'];
$data_inicial = $_GET['data_inicial'];
$data_final = $_GET['data_final'];

 $data_inicio = new DateTime("$data_inicial");
 $data_fim = new DateTime("$data_final");
 $dateInterval = $data_inicio->diff($data_fim);
 $total= $dateInterval->days;
  
  
 
  

echo "Total: $total <br>";

$data_aux=$data_inicio;
 for ($i=1; $i <= $total ; $i++) { 
    $data_aux->modify('+1day');
    echo $stringDate = $data_aux->format('Y-m-d'); 
    echo "<br>";
 }

 try {
$result="
            <thead>
                <tr>
                    <th></th>
                                        
                </tr>
            </thead>
            <tbody>";
 $result.="
           <tr> 
                <td>
                    
                   </div>
                 </div>
            <br>
                
              </td>
            <td>
                
            </td>
            <td>";
  
 
 
 } catch (Exception $e) {
 	echo $e;
 }


 

?>