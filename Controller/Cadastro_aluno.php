<?php session_start();
include'../Model/Conexao.php';
include'../Model/Aluno.php';
include'../Model/Turma.php';
include'Conversao.php';

try {

    $nome=$_POST['nome'];
    $sexo=$_POST['sexo'];
    if ( $_POST['email'] !='') {
         $email=$_POST['email'];
    }else{
         $email=date("d").date("m").date("Y").rand();

    }
    $filiacao1=$_POST['filiacao1'];
    $filiacao2=$_POST['filiacao2'];
    $senha='lem12345';
    $whatsapp=converte_telefone($_POST['whatsapp']);
    $whatsapp_responsavel=converte_telefone($_POST['whatsapp_responsavel']);
    $data_nascimento=$_POST['data_nascimento'];

    $codigo_inep=$_POST['codigo_inep'];
    $bolsa_familia=$_POST['bolsa_familia'];
    $tipo_responsavel=$_POST['tipo_responsavel'];
    $raca_aluno=$_POST['raca_aluno'];
    $estado_civil_aluno=$_POST['estado_civil_aluno'];
    $tipo_sanguinio_aluno=str_replace('mais', '+',$_POST['tipo_sanguinio_aluno']);

    $profissao=$_POST['profissao'];
    $situacao_documentacao=$_POST['situacao_documentacao'];
    $tipo_certidao=$_POST['tipo_certidao'];
    $numero_termo=$_POST['numero_termo'];
    $folha=$_POST['folha'];
    $uf_cartorio=$_POST['uf_cartorio'];
    $municipio_cartorio=$_POST['uf_municipio_cartorio'];
    $nome_cartorio=$_POST['cartorio'];
    $numero_indentidade=$_POST['numero_indentidade'];
    $uf_identidade=$_POST['uf_identidade'];
    $orgao_emissor_indentidade=$_POST['orgao_emissor_indentidade'];
    if ($_POST['data_expedicao']!="") {
         $data_expedicao=$_POST['data_expedicao'];
    }else{
        $data_expedicao=null;
    }

    $categoria_cnh=$_POST['categoria_cnh'];
    $observacao=$_POST['observacao'];

    $numero_nis=converte_telefone($_POST['numero_nis']);
    $numero_cnh=converte_telefone($_POST['numero_cnh']);
    $cartao_sus=converte_telefone($_POST['cartao_sus']);
    $cpf=converte_telefone($_POST['cpf']);


    $necessidade_especial=$_POST['necessidade_especial'];
    $apoio_pedagogico=$_POST['apoio_pedagogico'];
    $tipo_diagnostico=$_POST['tipo_diagnostico'];
    $cpf_filiacao1=converte_telefone($_POST['cpf_filiacao1']);
    $cpf_filiacao2=converte_telefone($_POST['cpf_filiacao2']);
    
    $endereco=$_POST['endereco'];

    $complemento=$_POST['complemento'];
    $numero_endereco=$_POST['numero_endereco'];
    $uf_endereco=$_POST['uf_endereco'];
    $municipio_endereco=$_POST['municipio_endereco'];
    $bairro_endereco=$_POST['bairro_endereco'];
    $zona_endereco=$_POST['zona_endereco'];
    $cep_endereco=$_POST['cep_endereco'];
    $nacionalidade=$_POST['nacionalidade'];
    $pais=$_POST['pais'];

    $naturalidade=$_POST['naturalidade'];
    $localidade=$_POST['localidade'];
    $transposte_escolar=$_POST['transposte_escolar'];
    $poder_publico_responsavel=$_POST['poder_publico_responsavel'];
    $recebe_escolaridade_outro_espaco=$_POST['recebe_escolaridade_outro_espaco'];
    $matricula_certidao=$_POST['matricula_certidao'];
    $uf_municipio_cartorio=$_POST['uf_municipio_cartorio'];
    $cartorio=$_POST['cartorio'];

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
        $uf_identidade,
        $orgao_emissor_indentidade,
        $data_expedicao,
        $numero_cnh,
        $categoria_cnh,
        $cpf,
        $cartao_sus,
        $observacao,

        $necessidade_especial,
        $apoio_pedagogico,
        $tipo_diagnostico,
        $cpf_filiacao1,
        $cpf_filiacao2,
        $endereco,
        $complemento,
        $numero_endereco,
        $uf_endereco,
        $municipio_endereco,
        $bairro_endereco,
        $zona_endereco,
        $cep_endereco,
        $nacionalidade,
        $pais,
        $naturalidade,
        $localidade,
        $transposte_escolar,
        $poder_publico_responsavel,
        $recebe_escolaridade_outro_espaco,
        $matricula_certidao,
        $uf_municipio_cartorio,
        $cartorio
    );


    $escola_id=$_POST['escola'];
    $turma_id=$_POST['turma'];
    $aluno_id= $conexao->lastInsertId();
    $ano=date("Y");
    $calendario_ano=date("Y");
    cadastrar_ano_letivo($conexao,$escola_id, $turma_id, $aluno_id, $ano);
    $matricula_tipo="N";
    $turno_nome=$_POST['turno'];
    cadastrar_ecidade_matricula($conexao, $aluno_id, $turma_id, $observacao, $matricula_tipo, $calendario_ano, $escola_id, $turno_nome);

$matricula_codigo= $conexao->lastInsertId();
$matriculamov_descr="ALUNO MATRICULADO NA TURMA";
$matriculamov_procedimento="MATRICULAR ALUNO";
$escola_nome="";

cadastrar_ecidade_movimentacao_escolar($conexao,$matricula_codigo,$aluno_id,$turma_id,$calendario_ano,$escola_id,$escola_nome,$matriculamov_procedimento,$matriculamov_descr);
 	

    echo "certo";
} catch (Exception $e) {
    echo $e;
 	 //$_SESSION['status']=0;
	// header("location:../View/cadastro_aluno.php");
}
?>