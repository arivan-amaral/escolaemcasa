<?php 
set_time_limit(0);
// session_start();
//include'../Model/Conexao.php';
include'../Model/Aluno.php';
include'../Model/Turma.php';
include'Conversao.php';



    $servername = "35.247.201.56";
    $username = "root";
    $password = "BDWRe85Oam8D";

// $password = "BDWRe85Oam8D";


    //instancia objeto PDO, conectando no MySQL
    $conexao = new PDO("mysql:host=$servername;dbname=educalem", $username, $password);
    // apresenta o erro PDO 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {

$indice=$_GET['indice'];
$limite=$_GET['limite'];

$conta=0;
$res_alunos_ecidade=$conexao->query("SELECT 

   aluno_nome as 'nome',
   aluno_sexo as 'sexo',
   aluno_email as 'email',
   aluno_mae  as 'filiacao1',
   aluno_pai as 'filiacao2',
   aluno_telef as 'whatsapp',
   aluno__celularresponsavel as 'whatsapp_responsavel',
   aluno_nasc as 'data_nascimento',

    aluno_codigoinep as 'codigo_inep',
    aluno_bolsafamilia as 'bolsa_familia',
    aluno_filiacao as 'tipo_responsavel',
    aluno_raca as 'raca_aluno',
    aluno_estciv as 'estado_civil_aluno',
    aluno__tiposanguineo as 'tipo_sanguinio_aluno',

   aluno_profis as 'profissao',
   aluno__situacaodocumentacao  as 'situacao_documentacao',
    aluno_certidaotipo as 'tipo_certidao',
    
   aluno_certidaonum as 'numero_termo',
    
    aluno_certidaofolha as 'folha',
    ufcert as 'uf_cartorio',
    municcert as 'uf_municipio_cartorio',

    
    aluno_ident as 'numero_indentidade',
    ufident as 'uf_identidade',
    orgemissrg as 'orgao_emissor_indentidade',
    aluno_identdtexp as 'data_expedicao',
    aluno_categoria as 'categoria_cnh',
    aluno_obs as 'observacao',

    aluno_nis as 'numero_nis',
    aluno_cnh as 'numero_cnh',
    aluno__cartaosus as 'cartao_sus',
    aluno_cpf as 'cpf',


    aluno_atenddifer as 'necessidade_especial',

    aluno_ender as 'endereco',

    aluno_compl as 'complemento',
   aluno_numero as 'numero_endereco',
    ufend as 'uf_endereco',
    municend as 'municipio_endereco',
    aluno_bairro as 'bairro_endereco',
    aluno_zona as 'zona_endereco',

    aluno_cep as 'cep_endereco',
   
    aluno_pais as 'pais',
   
    aluno_transporte as 'transposte_escolar',

    aluno__certidaomatricula as 'matricula_certidao',
    aluno_censoufcert as 'uf_municipio_cartorio',

    aluno_codigo as 'idaluno',
    aluno_censocartorio,
    aluno_nomeresp,
    ufnat 
 FROM ecidademigrado_alunos limit $indice,$limite");






foreach ($res_alunos_ecidade as $key => $value) {
    $nome=$value['nome'];

    // $email=$value['email'];
     $email="";
    if ($email=="") {
        $primeiroNome = explode(" ",$nome);
         $email=$primeiroNome[0].".".$primeiroNome[1]."".rand();
    }else{
         $email=rand();

    }
    $nome_cartorio=$value['aluno_censocartorio'];
    $artorio=$value['aluno_censocartorio'];
    // $nome_cartorio=$value['cartorio'];
     $apoio_pedagogico='';
    $tipo_diagnostico='';
     $cpf_filiacao1='';
     $cpf_filiacao2='';
     $poder_publico_responsavel='';
    $recebe_escolaridade_outro_espaco='';
    $nacionalidade='Brasileira';
    // $nacionalidade=$value['nacionalidade'];
    $naturalidade=$value['ufnat'];
    $localidade='';
    // $localidade=$value['localidade'];

//###########################################
    $matricula_certidao=$value['matricula_certidao'];
    $nome=$value['nome'];
    $sexo=$value['sexo'];
    $filiacao1=$value['filiacao1'];
    $filiacao2=$value['filiacao2'];
    $whatsapp=$value['whatsapp'];
    $whatsapp_responsavel=$value['whatsapp_responsavel'];
    $data_nascimento=$value['data_nascimento'];

    $codigo_inep=$value['codigo_inep'];
    $bolsa_familia=$value['bolsa_familia'];
    $tipo_responsavel=$value['tipo_responsavel'];
    $raca_aluno=$value['raca_aluno'];
    $estado_civil_aluno=$value['estado_civil_aluno'];
    $tipo_sanguinio_aluno=str_replace('mais', '+',$value['tipo_sanguinio_aluno']);

    $profissao=$value['profissao'];
    $situacao_documentacao=$value['situacao_documentacao'];
    $tipo_certidao=$value['tipo_certidao'];
    $numero_termo=$value['numero_termo'];
    $folha=$value['folha'];
    $uf_cartorio=$value['uf_cartorio'];
    $municipio_cartorio=$value['uf_municipio_cartorio'];
    
    $numero_indentidade=$value['numero_indentidade'];
    $uf_identidade=$value['uf_identidade'];
    $orgao_emissor_indentidade=$value['orgao_emissor_indentidade'];
    $data_expedicao=$value['data_expedicao'];
    $categoria_cnh=$value['categoria_cnh'];
    $observacao=$value['observacao'];

    $numero_nis=converte_telefone($value['numero_nis']);
    $numero_cnh=converte_telefone($value['numero_cnh']);
    $cartao_sus=converte_telefone($value['cartao_sus']);
    $cpf=converte_telefone($value['cpf']);


    $necessidade_especial=$value['necessidade_especial'];
 
    
    $endereco=$value['endereco'];

    $complemento=$value['complemento'];
    $numero_endereco=$value['numero_endereco'];
    $uf_endereco=$value['uf_endereco'];
    $municipio_endereco=$value['municipio_endereco'];
    $bairro_endereco=$value['bairro_endereco'];
    $zona_endereco=$value['zona_endereco'];
    $cep_endereco=$value['cep_endereco'];
    $pais=$value['pais'];

 $cartorio=$value['aluno_censocartorio'];
 $nome_responsavel=$value['aluno_nomeresp'];
 $cpf_responsavel='';
$transposte_escolar=$value['transposte_escolar'];
   
    $uf_municipio_cartorio=$value['uf_municipio_cartorio'];
    $idaluno=$value['idaluno'];

    $aluno_existe=0;
    $res_existe_aluno= meus_dados_aluno($conexao,$idaluno);
    
    foreach ($res_existe_aluno as $key => $value) {
        $aluno_existe++;
    }



    if ($aluno_existe==0) {
    $senha='lem12345';
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
 $cartorio,
 $nome_responsavel,
 $cpf_responsavel
);

    echo "$conta - cadastrado <br>";
}


else{
    /*editar_dados_aluno($conexao,$nome,
    $sexo,
    $email,
    $filiacao1,
    $filiacao2,
 
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
 $cartorio,
 $idaluno,

 $nome_responsavel,
 $cpf_responsavel
);
*/
    //echo "$conta - ATUALIZADO <br> ";
}

$conta++;
}

echo "<a href='../Controller/MIgracao_ecidade_cadastro%20aluno.php?indice=".($indice+$limite)."&limite=100'>Proximo: ".($indice+$limite)."</a>";
   // $aluno_id= $conexao->lastInsertId();
 	//associar_aluno($conexao, date("Y"), $turma, $aluno_id,  $escola);
 	//$_SESSION['status']=1; 	 
 	//header("location:../View/cadastro_aluno.php");
        //
} catch (Exception $e) {
    echo $e;
 	 //$_SESSION['status']=0;
	// header("location:../View/cadastro_aluno.php");
}
?>