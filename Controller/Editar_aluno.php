<?php session_start();
include'../Model/Conexao.php';
include'../Model/Aluno.php';
include'../Model/Turma.php';
include'../Model/Escola.php';
include'Conversao.php';

try {
 
    $idaluno=($_POST['idaluno']);
    $nome=trim($_POST['nome']);
    $sexo=$_POST['sexo'];
    // $quantidade_vagas_restante=$_POST['quantidade_vagas_restante'];

    if ( $_POST['email'] !='') {
         $email=$_POST['email'];
    }else{
        $primeiroNome = explode(" ",$nome);
         $email=$primeiroNome[0].".".$primeiroNome[1]."".rand(0,100);
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
    // $uf_cartorio=$_POST['uf_cartorio'];
    if (isset($_POST['municipio_cartorio'])) {
        // code...
    $municipio_cartorio=$_POST['municipio_cartorio'];
    }else{
    $municipio_cartorio=null;

    }
    $nome_cartorio=$_POST['cartorio'];
    $numero_indentidade=$_POST['numero_indentidade'];
    $uf_identidade=$_POST['uf_identidade'];
    $orgao_emissor_indentidade=$_POST['orgao_emissor_indentidade'];
    

    if($profissao==""){
        $profissao=null;
    }
    if($situacao_documentacao==""){
        $situacao_documentacao=null;
    }
    if($tipo_certidao==""){
        $tipo_certidao=null;
    }
    if($numero_termo==""){
        $numero_termo=null;
    }
    if($folha==""){
        $folha=null;
    }
  

    if($nome_cartorio==""){
        $nome_cartorio=null;
    }
    if($numero_indentidade==""){
        $numero_indentidade=null;
    }
    if($uf_identidade==""){
        $uf_identidade=null;
    }
    if($orgao_emissor_indentidade==""){
        $orgao_emissor_indentidade=null;
    }
    if ($_POST['data_expedicao']!="") {
         $data_expedicao=$_POST['data_expedicao'];
    }else{
        $data_expedicao='0000-00-00';
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
    $uf_cartorio=$_POST['uf_cartorio'];

    if($uf_cartorio==""){
        $uf_cartorio=null;
    }
    $cartorio=$_POST['cartorio'];

    $nome_responsavel=$_POST['nome_responsavel'];
    $cpf_responsavel=$_POST['cpf_responsavel'];
    $data_matricula = $_POST['data_matricula'];

    if($endereco==""){
        $endereco=null;
    }

    if($complemento==""){
        $complemento=null;
    }
    if($numero_endereco==""){
        $numero_endereco=null;
    }
    if($uf_endereco==""){
        $uf_endereco=null;
    }
    if($municipio_endereco==""){
        $municipio_endereco=null;
    }
    if($bairro_endereco==""){
        $bairro_endereco=null;
    }
    if($zona_endereco==""){
        $zona_endereco=null;
    }
    if($cep_endereco==""){
        $cep_endereco=null;
    }
    if($nacionalidade==""){
        $nacionalidade=null;
    }
    if($pais==""){
        $pais=null;
    }

    if($naturalidade==""){
        $naturalidade=null;
    }
    if($localidade==""){
        $localidade=null;
    }
    if($transposte_escolar==""){
        $transposte_escolar=null;
    }
    if($poder_publico_responsavel==""){
        $poder_publico_responsavel=null;
    }
    if($recebe_escolaridade_outro_espaco==""){
        $recebe_escolaridade_outro_espaco=null;
    }
    if($matricula_certidao==""){
        $matricula_certidao=null;
    }
 
    if($cartorio==""){
        $cartorio=null;
    }

    if($nome_responsavel==""){
        $nome_responsavel=null;
    }
    if($cpf_responsavel==""){
        $cpf_responsavel=null;
    }
// ___________________________________________________

    $turma_id_anterior=null;
    $matricula_situacao='MATRICULADO';
    $matricula_concluida='N';
    
        $matricula_datamatricula=$_POST['data_matricula'];
        // code...


    $matricula_ativa='S';
    $matricula_tipo='N';
    $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
    $calendario_ano=$_SESSION['ano_letivo_vigente'];
// _________________________________________________________


    // editar_dados_aluno($conexao,$nome,
    //     $sexo,
    //     $email,
    //     $filiacao1,
    //     $filiacao2,
    //     $senha,
    //     $whatsapp,
    //     $whatsapp_responsavel,
    //     $data_nascimento,

    //     $numero_nis,
    //     $codigo_inep,
    //     $bolsa_familia,
    //     $tipo_responsavel,
    //     $raca_aluno,
    //     $estado_civil_aluno,
    //     $tipo_sanguinio_aluno,
    //     $profissao,
    //     $situacao_documentacao,
    //     $tipo_certidao,
    //     $numero_termo,
    //     $folha,
    //     $uf_cartorio,
    //     $municipio_cartorio,
    //     $nome_cartorio,
    //     $numero_indentidade,
    //     $uf_identidade,
    //     $orgao_emissor_indentidade,
    //     $data_expedicao,
    //     $numero_cnh,
    //     $categoria_cnh,
    //     $cpf,
    //     $cartao_sus,
    //     $observacao,

    //     $necessidade_especial,
    //     $apoio_pedagogico,
    //     $tipo_diagnostico,
    //     $cpf_filiacao1,
    //     $cpf_filiacao2,
    //     $endereco,
    //     $complemento,
    //     $numero_endereco,
    //     $uf_endereco,
    //     $municipio_endereco,
    //     $bairro_endereco,
    //     $zona_endereco,
    //     $cep_endereco,
    //     $nacionalidade,
    //     $pais,
    //     $naturalidade,
    //     $localidade,
    //     $transposte_escolar,
    //     $poder_publico_responsavel,
    //     $recebe_escolaridade_outro_espaco,
    //     $matricula_certidao,
    //     $uf_municipio_cartorio,
    //     $cartorio,
    //     $idaluno,
    //     $nome_responsavel,
    //     $cpf_responsavel
    // );

    $conexao->exec("UPDATE aluno SET 
            nome= '$nome', sexo='$sexo', email='$email', filiacao1='$filiacao1', filiacao2='$filiacao2', whatsapp = '$whatsapp', whatsapp_responsavel='$whatsapp_responsavel', data_nascimento='$data_nascimento', numero_nis= '$numero_nis', codigo_inep='$codigo_inep', bolsa_familia='$bolsa_familia', tipo_responsavel='$tipo_responsavel', raca_aluno= '$raca_aluno', estado_civil_aluno='$estado_civil_aluno', tipo_sanguinio_aluno='$tipo_sanguinio_aluno', profissao= '$profissao', situacao_documentacao='$situacao_documentacao', tipo_certidao='$tipo_certidao', numero_termo='$numero_termo', folha='$folha', uf_cartorio='$uf_cartorio', uf_municipio_cartorio='$municipio_cartorio', nome_cartorio='$nome_cartorio', numero_indentidade='$numero_indentidade', uf_identidade='$uf_identidade', orgao_emissor_indentidade='$orgao_emissor_indentidade', data_expedicao='$data_expedicao', numero_cnh='$numero_cnh', categoria_cnh='$categoria_cnh', cpf='$cpf', cartao_sus='$cartao_sus', observacao='$observacao', 
    necessidade_especial='$necessidade_especial',
     apoio_pedagogico='$apoio_pedagogico',
     tipo_diagnostico='$tipo_diagnostico',
     cpf_filiacao1='$cpf_filiacao1',
     cpf_filiacao2='$cpf_filiacao2',
     endereco='$endereco',
     complemento='$complemento',
     numero_endereco='$numero_endereco',
     uf_endereco='$uf_endereco',
     municipio_endereco='$municipio_endereco',
     bairro_endereco='$bairro_endereco',
     zona_endereco='$zona_endereco',
     cep_endereco='$cep_endereco',
     nacionalidade='$nacionalidade',
     pais='$pais',
     naturalidade='$naturalidade',
     localidade='$localidade',
     transposte_escolar='$transposte_escolar',
     poder_publico_responsavel='$poder_publico_responsavel',
     recebe_escolaridade_outro_espaco='$recebe_escolaridade_outro_espaco',
     matricula_certidao='$matricula_certidao',
     municipio_cartorio='$municipio_cartorio',
     cartorio='$cartorio',
     nome_responsavel= '$nome_responsavel',
     cpf_responsavel = '$cpf_responsavel'

     WHERE idaluno=$idaluno

    ");
   $conexao->exec("UPDATE ecidade_matricula SET 
            matricula_datamatricula= '$data_matricula' WHERE aluno_id=$idaluno and calendario_ano='$calendario_ano'
    ");
 // echo "
 // r- $nome<br>
 //         r- $sexo<br>
 //         r- $email<br>
 //         r- $filiacao1<br>
 //         r- $filiacao2<br>
 //         r- $senha<br>
 //         r- $whatsapp<br>
 //         r- $whatsapp_responsavel<br>
 //         r- $data_nascimento<br>

 //         r- $numero_nis<br>
 //         r- $codigo_inep<br>
 //         r- $bolsa_familia<br>
 //         r- $tipo_responsavel<br>
 //         r- $raca_aluno<br>
 //         r- $estado_civil_aluno<br>
 //         r- $tipo_sanguinio_aluno<br>
 //         r- $profissao<br>
 //         r- $situacao_documentacao<br>
 //         r- $tipo_certidao<br>
 //         r- $numero_termo<br>
 //         r- $folha<br>
 //         r- $uf_cartorio<br>
 //         r- $municipio_cartorio<br>
 //         r- $nome_cartorio<br>
 //         r- $numero_indentidade<br>
 //         r- $uf_identidade<br>
 //         r- $orgao_emissor_indentidade<br>
 //         r- $data_expedicao<br>
 //         r- $numero_cnh<br>
 //         r- $categoria_cnh<br>
 //         r- $cpf<br>
 //         r- $cartao_sus<br>
 //         r- $observacao<br>

 //         r- $necessidade_especial<br>
 //         r- $apoio_pedagogico<br>
 //         r- $tipo_diagnostico<br>
 //         r- $cpf_filiacao1<br>
 //         r- $cpf_filiacao2<br>
 //         r- $endereco<br>
 //         r- $complemento<br>
 //         r- $numero_endereco<br>
 //         r- $uf_endereco<br>
 //         r- $municipio_endereco<br>
 //         r- $bairro_endereco<br>
 //         r- $zona_endereco<br>
 //         r- $cep_endereco<br>
 //         r- $nacionalidade<br>
 //         r- $pais<br>
 //         r- $naturalidade<br>
 //         r- $localidade<br>
 //         r- $transposte_escolar<br>
 //         r- $poder_publico_responsavel<br>
 //         r- $recebe_escolaridade_outro_espaco<br>
 //         r- $matricula_certidao<br>
 //         r- $uf_municipio_cartorio<br>
 //         r- $cartorio<br>
 //         rid- $idaluno<br>
 //         r- $nome_responsavel<br>
 //         r- $cpf_responsavel<br>
 //    ";
 

    echo "certo";
 
} catch (Exception $e) {
    echo $e;
     //$_SESSION['status']=0;
    // header("location$../View/cadastro_aluno.php");
}
?>