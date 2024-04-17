<?php session_start();
if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
include_once '../Model/Aluno.php';
include_once '../Model/Turma.php';
include_once '../Model/Escola.php';
include_once 'Conversao.php';

try {
 
    $nome_identificacao_social=$_POST['nome_identificacao_social'];

    $nome=trim($_POST['nome']);
    $data_nascimento=$_POST['data_nascimento'];


    if (!isset($_POST['etapa'])) {
        $etapa = null;
    }else{
        $etapa = $_POST['etapa'];
    }


    $res_aluno_existente=$conexao->query("SELECT * FROM aluno WHERE data_nascimento='$data_nascimento' and nome='$nome'");
    $res_aluno_existente=$res_aluno_existente->fetchAll();
    if (count($res_aluno_existente)==0) {
            $sexo=$_POST['sexo'];
            $quantidade_vagas_restante=$_POST['quantidade_vagas_restante'];

            if ( $_POST['email'] !='') {
                 $email=$_POST['email'];
            }else{
                $primeiroNome = explode(" ",$nome);
                 $email=$primeiroNome[0].".".$primeiroNome[1]."".rand(101,199);
            }
            $filiacao1=$_POST['filiacao1'];
            $filiacao2=$_POST['filiacao2'];
            $senha='lem12345';
            $whatsapp=converte_telefone($_POST['whatsapp']);
            $whatsapp_responsavel=converte_telefone($_POST['whatsapp_responsavel']);

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
            $outros_campo=$_POST['outros_campo'];
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
            $uf_municipio_cartorio=$_POST['uf_cartorio'];
            // $uf_municipio_cartorio=$_POST['uf_municipio_cartorio'];
            $cartorio=$_POST['cartorio'];
          
            $nome_responsavel=$_POST['nome_responsavel'];
            $cpf_responsavel=converte_telefone($_POST['cpf_responsavel']); 

            $escola_id=$_POST['escola'];
            $turma_id=$_POST['turma'];
            $turno_nome=$_POST['turno'];
            if (isset($_POST['data_matricula'])) {
                $matricula_datamatricula=$_POST['data_matricula'];
                // code...
            }else{
                $matricula_datamatricula=date('Y-m-d');

            }
        // _________________________________________________________

            $turma_id_anterior=null;
            $matricula_situacao='MATRICULADO';
            $matricula_concluida='N';
            
            $matricula_ativa='S';
            $matricula_tipo='N';
            $ano_letivo_vigente=$_SESSION['ano_letivo_vigente'];
            $calendario_ano=$_SESSION['ano_letivo_vigente'];
        // _________________________________________________________


        if ($quantidade_vagas_restante>0) {//vindo da interface

            ###########################################################################################
            $quantidade_vaga_total=0;
            $quantidade_vaga_restante=0;

              $res_quantidade= quantidade_vaga_turma($conexao,$escola_id,$turma_id,$turno_nome,$ano_letivo_vigente);
              foreach ($res_quantidade as $key => $value) {
                 $quantidade_vaga_total=$value['quantidade_vaga'];
              }

              $res_quantidade_vaga_restante= quantidade_aluno_na_turma($conexao,$escola_id,$turma_id,$turno_nome,$ano_letivo_vigente);
              foreach ($res_quantidade_vaga_restante as $key => $value) {
                 $quantidade_vaga_restante=$value['quantidade'];
              }
             $quantidade_vaga_restante=$quantidade_vaga_total-$quantidade_vaga_restante;
            ###########################################################################################
            

            if(isset($_FILES['laudo']) && $_FILES['laudo']['size'] > 0) {
                echo saveFile($_FILES['laudo']);
            }

            ###########################################################################################

            if ($quantidade_vagas_restante>0) { //buscando novamente antes de inserir

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
                $outros_campo,
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
                $cpf_responsavel,
                $nome_identificacao_social

            );


           
            $aluno_id= $conexao->lastInsertId();
            $ano=date("Y");
            $calendario_ano=date("Y");
            cadastrar_ano_letivo($conexao,$escola_id, $turma_id, $aluno_id, $ano);
            $matricula_tipo="N";
            // cadastrar_ecidade_matricula($conexao, $aluno_id, $turma_id, $observacao, $matricula_tipo, $calendario_ano, $escola_id, $turno_nome);
            

        rematricular_aluno($conexao,$aluno_id,$turma_id,$turma_id_anterior,$matricula_situacao,$matricula_concluida,$matricula_datamatricula,$matricula_ativa,$matricula_tipo,$calendario_ano,$escola_id,$turno_nome,$etapa);

        $matricula_codigo= $conexao->lastInsertId();
        $matriculamov_descr="ALUNO MATRICULADO NA TURMA";
        $matriculamov_procedimento="MATRICULAR ALUNO";
        $escola_nome="";

        cadastrar_ecidade_movimentacao_escolar($conexao,$matricula_codigo,$aluno_id,$turma_id,$calendario_ano,$escola_id,$escola_nome,$matriculamov_procedimento,$matriculamov_descr);

            echo "certo";
        }//fim desse => if ($quantidade_vagas_restante>0) { //buscando novamente antes de inserir
        else{echo "erro";}


        }//vindo da interface
        else{
            echo "erro";
        }

    }//fim if (count($res_aluno_existente)==0) {
    else{
        echo "Erro: ALUNO JÁ EXISTENTE ";

    }

} catch (Exception $e) {
    echo $e;
     //$_SESSION['status']=0;
    // header("location:../View/cadastro_aluno.php");
}
?>