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
$data_aux=$data_inicial;
 for ($i=1; $i <= $total ; $i++) { 
   $data_aux= incrementar_dia_data($data_aux,1);
     echo "$data_aux + $i<br>";
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