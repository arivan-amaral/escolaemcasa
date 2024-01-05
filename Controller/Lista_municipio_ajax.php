<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Questionario.php';
include_once 'Conversao.php';
include_once '../Model/Estado.php';


 // $resposta_discursiva = escape_mimic($_GET['texto']);
$idestado = $_GET['idestado'];
$nome_campo_id = $_GET['nome_campo_id'];
 
try {
	$result="
	<div class='form-group'>
		<label for='exampleInputEmail1'>Município</label>
		<select type='text' class='form-control'  name='$nome_campo_id' >
		    <option></option>";
	$pesquisa_cidadade=listar_cidade_por_idestado($conexao,$idestado);
	foreach ($pesquisa_cidadade as $key => $value) {
		$id=$value['id'];
		$nome_cidade=$value['nome'];
		$result.="<option value='$id'>$nome_cidade</option>";	
	}
	$result.="
	   </select>
	</div>";
	echo $result;
	
} catch (Exception $e) {
	echo "erro: $e";
}
		
?>