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

    if ($_POST['matricula_codigo'] !='' && $_POST['quantidade_vagas_restante']>0) {
        $matricula_codigo=$_POST['matricula_codigo'];
        $turno=$_POST['turno'];
        $turma_escola=$_POST['escola'];
        $turma_id=$_POST['turma'];
   
        if ($_POST['etapa']!="") {
            $etapa=$_POST['etapa'];
                  $conexao->exec("UPDATE ecidade_matricula SET 
                matricula_datamatricula= '$data_matricula',
                turno_nome='$turno',
                turma_escola=$turma_escola,
                turma_id=$turma_id,
                etapa =$etapa

                 WHERE matricula_codigo=$matricula_codigo  limit 1
        ");
        }else{
              $conexao->exec("UPDATE ecidade_matricula SET 
                     matricula_datamatricula= '$data_matricula',
                     turno_nome='$turno',
                     turma_escola=$turma_escola,
                     turma_id=$turma_id

                      WHERE matricula_codigo=$matricula_codigo  limit 1
     ");
        }
        
 

   

    }else{

         $conexao->exec("UPDATE ecidade_matricula SET 
            matricula_datamatricula= '$data_matricula' WHERE aluno_id=$idaluno and calendario_ano='$calendario_ano' limit 1
    ");
    }

    echo "certo";
 
} catch (Exception $e) {
    echo "Matricula: $data_matricula";
    echo $e;
     //$_SESSION['status']=0;
    // header("location$../View/cadastro_aluno.php");
}
?>