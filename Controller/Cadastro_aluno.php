<?php session_start();
include'../Model/Conexao.php';
include'../Model/Aluno.php';
include'../Model/Turma.php';
try {
 	  

        $nome=$_POST['nome'];
        $sexo=$_POST['sexo'];
        $email=$_POST['email'];
        $filiacao1=$_POST['filiacao1'];
        $filiacao2=$_POST['filiacao2'];
        $senha=$_POST['senha'];
        $whatsapp=$_POST['whatsapp'];
        $whatsapp_responsavel=$_POST['whatsapp_responsavel'];
        $data_nascimento=$_POST['data_nascimento'];

        $numero_nis=$_POST['numero_nis'];
        $codigo_inep=$_POST['codigo_inep'];
        $bolsa_familia=$_POST['bolsa_familia'];
        $tipo_responsavel=$_POST['tipo_responsavel'];
        $raca_aluno=$_POST['raca_aluno'];
        $estado_civil_aluno=$_POST['estado_civil_aluno'];
        $tipo_sanguinio_aluno=$_POST['tipo_sanguinio_aluno'];
        $profissao=$_POST['profissao'];
        $situacao_documentacao=$_POST['situacao_documentacao'];
        $tipo_certidao=$_POST['tipo_certidao'];
        $numero_termo=$_POST['numero_termo'];
        $folha=$_POST['folha'];
        $uf_cartorio=$_POST['uf_cartorio'];
        $municipio_cartorio=$_POST['municipio_cartorio'];
        $nome_cartorio=$_POST['nome_cartorio'];
        $numero_indentidade=$_POST['numero_indentidade'];
        $uf_identidae=$_POST['uf_identidae'];
        $orgao_emissor_indentidade=$_POST['orgao_emissor_indentidade'];
        $data__expedicao=$_POST['data__expedicao'];
        $numero_cnh=$_POST['numero_cnh'];
        $categoria_cnh=$_POST['categoria_cnh'];
        $cpf=$_POST['cpf'];
        $cartao_sus=$_POST['cartao_sus'];
        $observacao=$_POST['observacao'];
   
   cadastro_aluno($conexao,$nome,
    $sexo,
    $email,
    $filiacao1,
    $filiacao2,
    $senha,
    $whatsapp,
    $whatsapp_responsavel,
    $data_nascimento,

    $numero_nis,
    $codigo_inep,
    $bolsa_familia,
    $tipo_responsavel,
    $raca_aluno,
    $estado_civil_aluno,
    $tipo_sanguinio_aluno,
    $profissao,
    $situacao_documentacao,
    $tipo_certidao,
    $numero_termo,
    $folha,
    $uf_cartorio,
    $municipio_cartorio,
    $nome_cartorio,
    $numero_indentidade,
    $uf_identidae,
    $orgao_emissor_indentidade,
    $data__expedicao,
    $numero_cnh,
    $categoria_cnh,
    $cpf,
    $cartao_sus,
    $observacao);




    $aluno_id= $conexao->lastInsertId();
 	associar_aluno($conexao, date("Y"), $turma, $aluno_id,  $escola);
 	$_SESSION['status']=1; 	 
 	header("location:../View/cadastro_aluno.php");
 } catch (Exception $e) {
 	 $_SESSION['status']=0;
	 header("location:../View/cadastro_aluno.php");
 }
?>