<?php
session_start();
include '../Model/Conexao.php';



try {
	$idserie=$_GET['idserie'];
	$result="";
	if (mb_strpos($idserie, '/') !== false) {
		$array_serie=explode('/', $idserie);
		$turma_id=$array_serie[0];
		$idserie=$array_serie[1];
		
		if ($idserie==16) {

	  		$result="<label for='exampleInputEmail1'>Escolha a etapa </label>
	                <select class='form-control' name='etapa'  required>
	                <option></option>";
			$res=$conexao->query("SELECT * FROM etapa_multissereada WHERE turma_id=$turma_id");
			foreach ($res as $key => $value) {
				$idetapa=$value['id'];
				$nome_etapa=$value['etapa'];
				$result.="
				<option value='$idetapa'>$nome_etapa</option>
				";
			}

	        $result.="</select>";
		}
	}

	echo "$result";
} catch (Exception $e) {
	echo $e;
}

?>