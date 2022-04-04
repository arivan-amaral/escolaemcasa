<?php session_start();
include '../Model/Conexao.php';


$quantidade_falta = $_GET['falta'];
$data_inicial = $_GET['data_inicial'];
$data_final = $_GET['data_final'];


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