<?php
session_start();
include_once 'cabecalho.php';
include_once 'barra_horizontal.php';
include_once "menu.php";
include_once "alertas.php";
if (!isset($_SESSION['usuariobd'])) {
  // Se não estiver definida, atribui o valor padrão 'educ_lem'
  $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd = $_SESSION['usuariobd'];
include_once "../Model/Conexao_" . $usuariobd . ".php";
include_once "../Controller/Conversao.php";
include_once "../Model/Serie.php";
include_once "../Model/Escola.php";
include_once "../Model/Estado.php";
include_once "../Model/Turma.php";
include_once "../Model/Coordenador.php";
include_once "../Model/Aluno.php";
$idcoordenador = $_SESSION['idfuncionario'];
$ano_letivo_vigente = $_SESSION['ano_letivo_vigente'];

$idaluno = $_POST['aluno_id'];



if ($_SESSION['nivel_acesso_id'] == 100) {
  $disabled = '';
} else {
  $disabled = 'readonly';
}

$data_matricula = '';

$res_data = data_matricula_ativa($conexao, $idaluno);
foreach ($res_data as $key => $value) {
  $data_matricula = data_simples($value['matricula_datamatricula']);
}

$res = pesquisar_aluno2($conexao, $idaluno);
$nome = "";
$sexo = "";
$email = "";
$filiacao1 = "";
$filiacao2 = "";
$documento = "";
$whatsapp = "";
$codigo_inep = "";
$numero_nis = "";
$data_nascimento = "";
$tipo_responsavel = "";
$raca_aluno = "";
$estado_civil_aluno = "";
$tipo_sanguinio_aluno = "";
$cpf_filiacao1 = "";
$cpf_filiacao2 = "";
$situacao_documentacao = "";
$tipo_certidao = "";
$endereco = "";
$complemento = "";
$numero_endereco = "";
$uf_endereco = "";
$municipio_endereco = "";
$bairro_endereco = "";
$zona_endereco = "";
$cep_endereco = "";
$nacionalidade = "";
$pais = "";
$naturalidade = "";
$localidade = "";
$transposte_escolar = "";
$poder_publico_responsavel = "";
$recebe_escolaridade_outro_espaco = "";
$matricula_certidao = "";
$uf_municipio_cartorio = "";
$cartorio = "";
$cartao_sus = "";
$profissao = "";
$bolsa_familia = "";
$folha = "";
$uf_cartorio = "";
$municipio_cartorio = "";
$nome_cartorio = "";
$numero_indentidade = "";
$uf_identidade = "";
$orgao_emissor_indentidade = "";
$data_expedicao = "";
$numero_cnh = "";
$categoria_cnh = "";
$observacao = "";
$necessidade_especial = "";
$apoio_pedagogico = "";
$tipo_diagnostico = "";
$tipo_deficiencia = "";
$outrosDeficiencia = "";
$tipo_certidao = "";
$numero_termo = "";
$data_expedicao = "";
$cpf = "";
$whatsapp_responsavel = "";
$nome_responsavel = "";
$cpf_responsavel = "";
$caminho_foto_carteirinha = "";


foreach ($res as $key => $value) {
  $nome = $value['nome'];
  $data_nascimento = $value['data_nascimento'];
  $codigo_inep = $value['codigo_inep'];
  $sexo = $value['sexo'];
  $email = $value['email'];
  $filiacao1 = $value['filiacao1'];
  $filiacao2 = $value['filiacao2'];
  $cpf_filiacao1 = $value['cpf_filiacao1'];
  $cpf_filiacao2 = $value['cpf_filiacao2'];
  $whatsapp = $value['whatsapp'];
  $whatsapp_responsavel = $value['whatsapp_responsavel'];
  $numero_nis = $value['numero_nis'];
  $tipo_responsavel = $value['tipo_responsavel'];
  $raca_aluno = $value['raca_aluno'];
  $estado_civil_aluno = $value['estado_civil_aluno'];
  $tipo_sanguinio_aluno = $value['tipo_sanguinio_aluno'];

  $endereco = $value['endereco'];
  $complemento = $value['complemento'];
  $numero_endereco = $value['numero_endereco'];
  $uf_endereco = $value['uf_endereco'];
  $municipio_endereco = $value['municipio_endereco'];
  $bairro_endereco = $value['bairro_endereco'];
  $zona_endereco = $value['zona_endereco'];
  $cep_endereco = $value['cep_endereco'];
  $nacionalidade = $value['nacionalidade'];
  $pais = $value['pais'];
  $naturalidade = $value['naturalidade'];
  $localidade = $value['localidade'];
  $transposte_escolar = $value['transposte_escolar'];
  $poder_publico_responsavel = $value['poder_publico_responsavel'];
  $recebe_escolaridade_outro_espaco = $value['recebe_escolaridade_outro_espaco'];
  $profissao = $value['profissao'];
  $situacao_documentacao = $value['situacao_documentacao'];
  $matricula_certidao = $value['matricula_certidao'];
  $uf_municipio_cartorio = $value['uf_municipio_cartorio'];
  $cartorio = $value['cartorio'];
  $cartao_sus = $value['cartao_sus'];
  $bolsa_familia = $value['bolsa_familia'];
  $folha = $value['folha'];
  $uf_cartorio = $value['uf_cartorio'];
  $municipio_cartorio = $value['municipio_cartorio'];
  $nome_cartorio = $value['nome_cartorio'];
  $numero_indentidade = $value['numero_indentidade'];
  $uf_identidade = $value['uf_identidade'];
  $orgao_emissor_indentidade = $value['orgao_emissor_indentidade'];
  $data_expedicao = $value['data_expedicao'];
  $numero_cnh = $value['numero_cnh'];
  $categoria_cnh = $value['categoria_cnh'];
  $observacao = $value['observacao'];
  $necessidade_especial = $value['necessidade_especial'];
  $apoio_pedagogico = $value['apoio_pedagogico'];
  $tipo_diagnostico = $value['tipo_diagnostico'];
  $tipo_deficiencia = $value['tipo_deficiencia'];
  $outrosDeficiencia = $value['outrosDeficiencia'];
  $matricula_certidao = $value['matricula_certidao'];
  $tipo_certidao = $value['tipo_certidao'];
  $numero_termo = $value['numero_termo'];
  $data_expedicao = $value['data_expedicao'];
  $cpf = $value['cpf'];
  $nome_responsavel = $value['nome_responsavel'];
  $cpf_responsavel = $value['cpf_responsavel'];

  $caminho_foto_carteirinha = $value['imagem_carteirinha_transporte'];
}

$res_editar_curso = verificar_matricula_ativa($conexao, $idaluno, $ano_letivo_vigente);
$escola_id = '';
$turno = '';
$serie_id = '';
$turma_id = '';
$etapa = '';
$data_matricula = '';
$matricula_codigo = '';

foreach ($res_editar_curso as $key => $value) {
  $escola_id = $value['turma_escola'];
  $turno = $value['turno_nome'];
  $serie_id = $value['serie_id'];
  $turma_id = $value['turma_id'];
  $etapa = $value['etapa'];
  $data_matricula = $value['matricula_datamatricula'];
  $matricula_codigo = $value['matricula_codigo'];
}

?>

<script src="ajax.js?<?php echo rand(); ?>"></script>
<!-- Main Sidebar Container -->
<div class="content-wrapper">
  <!-- ####################### CORPO ################################################# -->
  <!-- <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->

  <div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
      <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
        <li class="pt-2 px-3">
          <h3 class="card-title">EDITANDO DADOS DO ALUNO</h3>
        </li>

        <li class="nav-item">
          <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Dados Pessoais</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Endereço</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Documentos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Curso</a>
        </li>

      </ul>
    </div>

    <form id="form1" name="form1" method="POST" enctype="multipart/form-data">

      <?php
      if ($caminho_foto_carteirinha != "") {
        // code...
        $caminho_foto_carteirinha = "imagem_carteirinha_transporte/" . $caminho_foto_carteirinha;
      } else {
        $caminho_foto_carteirinha = "imagens/user.png";
      }
      ?>
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">

          <div class="tab-pane fade  active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
            <div class="card-body">

              <style type="text/css">
                .imagem_perfil img {
                  margin-right: 1px;
                  border: 2px solid black;
                  border-radius: 10%;
                  width: 27.6mm;
                  height: 38.98mm;

                }
              </style>
              <div class="row">
                <div class="col-sm-12 imagem_perfil">
                  <!-- <canvas id="canvas" width="640" height="480"></canvas> -->

                  <img src="<?php echo $caminho_foto_carteirinha; ?>" id="imagem_aluno">

                  <input type="hidden" name="croppedImage" id="croppedImage">

                </div>

                <!-- <button type="button"   data-toggle='modal' data-target='#modal-editar-imagem-aluno'>WEbCAM</button>

                        <br> -->
                <label>Adicionar Foto (por arquivo)</label>
                <div class="form-group">
                  <input type="file" accept="image/*" id="files" name="imagem_aluno" class="form-control" required="">
                </div>


                <script>
                  document.getElementById("files").onchange = function() {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                      // get loaded data and render thumbnail.
                      document.getElementById("imagem_aluno").src = e.target.result;
                    };

                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                  };
                </script>

              </div>

              <div class="row">

                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Código INEP</label>
                    <input type="text" class="form-control" id="codigo_inep" name="codigo_inep" value='<?php echo $codigo_inep; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">N° Nis</label>
                    <input type="text" class="form-control" id="numero_nis" name="numero_nis" value='<?php echo $numero_nis;  ?>' required="">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bolsa Familia</label><br>
                    <select class="form-control" name="bolsa_familia" id="bolsa_familia" required>
                      <option></option>
                      <?php
                      if ($bolsa_familia == "N") {
                        echo "
                                <option value='N' selected>Não</option>
                                <option value='S'>Sim</option>";
                      } else {
                        echo "<option value='S' selected>Sim</option>
                              <option value='N' >Não</option>";
                      }
                      ?>

                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Local de procedência </label>
                    <select name="local_procedencia" id="local_procedencia" class="form-control">
                      <option value="Escola da rede">Escola da REDE</option>
                      <option value="Escola da fora">Escola de FORA</option>

                    </select>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">id</label>
                    <input type="text" class="form-control" name="idaluno" value="<?php echo $idaluno; ?>" readonly>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value='<?php echo $nome; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nascimento</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="data_nascimento" value='<?php echo $data_nascimento; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Idade</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="idade" required="" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="email" value='<?php echo $email; ?>'>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Whatsapp aluno</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="whatsapp" value='<?php echo $whatsapp; ?>' onkeypress="$(this).mask('(00) 0000-00009')">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Whatsapp responsável</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="whatsapp_responsavel" value='<?php echo $whatsapp_responsavel; ?>' onkeypress="$(this).mask('(00) 0000-00009')">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Necessidade especial</label><br>
                    <select class="form-control" name="necessidade_especial">
                      <option selected value='<?php echo $necessidade_especial ?>'><?php echo $necessidade_especial ?></option>
                      <option value='N'>NÃO</option>
                      <option value='S'>SIM</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Apoio Pedagógico</label><br>
                    <select class="form-control" name="apoio_pedagogico">
                      <option value='apae'>APAE</option>
                      <option value='amalem'>AMALEM</option>
                      <option value='nap'>NAP</option>
                      <option value='aee'>AEE</option>
                      <option value='particular'>Particular</option>
                      <option value='nao_necessita'>Não necessita</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo De Diagnóstico</label><br>
                    <select class="form-control" name="tipo_diagnostico">
                      <option selected></option>
                      <option value='SEM DIAGNÓSTICO'>SEM DIAGNÓSTICO</option>
                      <option value='FICHA DE AVALIAÇÃO'>FICHA DE AVALIAÇÃO</option>
                      <option value='LAUDO TÉCNICO'>LAUDO TÉCNICO</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo de deficiência</label><br>
                    <select class="form-control" id="tipo_deficiencia" name="tipo_deficiencia" onchange="mostrarCampoOutros()">
                      <option value="deficiecia_intelectual">Deficiência intelectual</option>
                      <option value="deficiencia_fisica">Deficiência física</option>
                      <option value="deficiencia_auditiva">Deficiência auditiva</option>
                      <option value="surdez">Surdez</option>
                      <option value="baixa_visao">Baixa visão</option>
                      <option value="cegueira">Cegueira</option>
                      <option value="surdo_cegueira">Surdo/Cegueira</option>
                      <option value="altas_habilidades">Altas habilidades ou superdotação</option>
                      <option value="tea">Transtorno do Espectro autista (TEA)</option>
                      <option value="tod">Transtorno opositor desafiador (TOD)</option>
                      <option value="tdah">Transtorno com défict de atenção com hiperatividade (TDAH)</option>
                      <option value="dislexia">Dislexia</option>
                      <option value="disgrafia">Disgrafia</option>
                      <option value="disortografia">Disortografia</option>
                      <option value="sindrome_down">Síndrome de Down</option>
                      <option value="paralisia_cerebral">Paralisia Cerebral</option>
                      <option value="hidrocefalia">Hidrocefalia</option>
                      <option value="microcefalia">Microcefalia</option>
                      <option value="nenhuma">nenhuma</option>
                      <option value="outros">outros</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3" id="outros_campo" style="display: none;">
                  <div class="form-group">
                    <label for="outrosDeficiencia">Outros tipos de deficiência</label><br>
                    <input type="text" class="form-control" name="outrosDeficiencia" id="outrosDeficiencia">
                  </div>
                  <script>
                    function mostrarCampoOutros() {
                      var select = document.getElementById("tipo_deficiencia");
                      var outrosCampo = document.getElementById("outros_campo");

                      if (select.value === "outros") {
                        outrosCampo.style.display = "block";
                      } else {
                        outrosCampo.style.display = "none";
                      }
                    }
                  </script>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 alert alert-secondary">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo responsável</label><br>
                    <select class="form-control" required name="tipo_responsavel">
                      <option selected value='<?php echo $tipo_responsavel; ?>'><?php echo $tipo_responsavel ?></option>
                      <option value="MÃE">MÃE</option>
                      <option value="PAI">PAI</option>
                      <option value="OUTRO">OUTRO</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Raça do aluno</label><br>
                    <select class="form-control" name="raca_aluno" required>
                      <option selected value='<?php echo $raca_aluno; ?>'><?php echo $raca_aluno ?></option>
                      <option value="Não Declarada">Não Declarada</option>
                      <option value="Branco">Branco</option>
                      <option value="Negro">Negro</option>
                      <option value="Pardo">Pardo</option>
                      <option value="Amarelo">Amarelo</option>
                      <option value="Indigena">Indigena</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estado Civil do aluno</label><br>
                    <select class="form-control" name="estado_civil_aluno" required>
                      <option selected value='<?php echo $estado_civil_aluno; ?>'><?php echo $estado_civil_aluno ?></option>
                      <option value="Solteiro">Solteiro</option>
                      <option value="Casado">Casado</option>
                      <option value="Divorciado">Divorciado</option>
                      <option value="Viúvo">Viúvo</option>

                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo Sanguineo do aluno</label><br>
                    <select class="form-control" required name="tipo_sanguinio_aluno">
                      <option selected value='<?php echo $tipo_sanguinio_aluno; ?>'><?php echo $tipo_sanguinio_aluno ?></option>
                      <option value="Amais">A+</option>
                      <option value="A-">A-</option>
                      <option value="Bmais">B+</option>
                      <option value="B-">B-</option>
                      <option value="ABmais">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="Omais">O+</option>
                      <option value="O-">O-</option>

                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sexo do aluno</label><br>
                    <select class="form-control" required id='sexo' name="sexo">
                      <option selected value='<?php echo $sexo; ?>'><?php if ($sexo == 'M') {
                                                                      echo "Masculino";
                                                                    } else {
                                                                      echo "Feminino";
                                                                    }  ?></option>
                      <option value="M">Masculino</option>
                      <option value="F">Feminino</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome do responsável</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nome_responsavel" required="" value="<?php echo $nome_responsavel; ?>">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cpf do responsável</label>
                    <input type="text" id="RegraValida" name="cpf_responsavel" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" value="<?php echo $cpf_responsavel; ?>" required>
                    <span class="text-success" id="status_cpf"></span>
                  </div>
                </div>
              </div>
              <label for="exampleInputEmail1">
                <h5>Filiação 1</h5>
              </label>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome filiação 1</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="filiacao1" value='<?php echo $filiacao1 ?>' required="">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cpf filiação 1</label>

                    <input type="text" id="RegraValida" name="cpf_filiacao1" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" value="<?php echo $cpf_filiacao1; ?>" required>
                  </div>
                </div>
              </div>
              <label for="exampleInputEmail1">
                <h5>Filiação 2</h5>
              </label>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome filiação 2</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="filiacao2" value='<?php echo $filiacao2 ?>' required="">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cpf filiação 2</label>
                    <input type="text" id="RegraValida" name="cpf_filiacao2" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" value="<?php echo $cpf_filiacao2; ?>" required>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="endereco" value='<?php echo $endereco; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Complemento</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" value='<?php echo $complemento; ?>'>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Número</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="numero_endereco" value='<?php echo $numero_endereco; ?>' required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Uf</label>
                    <select type="text" class="form-control" id="exampleInputEmail1" name="uf_endereco" required="" onchange="pesquisar_municipio(this.value,'municipio_endereco');">
                      <option value="5">Bahia</option>
                      <?php
                      $resultado_estado = listar_estado($conexao);
                      foreach ($resultado_estado as $key => $value) {
                        $idestado = $value['id'];
                        $nome_estado = $value['nome'];
                        if ($idestado == $uf_endereco) {
                          echo "<option value='$idestado' selected>$nome_estado</option>";
                        } else {
                          echo "<option value='$idestado' >$nome_estado</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-3" id="municipio_endereco">
                  <!-- municipio aqui -->
                  <div class='form-group'>
                    <label for='exampleInputEmail1'>Município</label>
                    <select type='text' class='form-control' name='municipio_endereco'>
                      <option value="515">Luís Eduardo Magalhães</option>

                      <?php
                      $pesquisa_cidadade = listar_cidade_por_idestado($conexao, 5);
                      foreach ($pesquisa_cidadade as $key => $value) {
                        $id = $value['id'];
                        $nome_cidade = $value['nome'];
                        if ($id == $municipio_endereco) {
                          echo "<option value='$id' selected>$nome_cidade</option>";
                        } else {
                          echo "<option value='$id' >$nome_cidade</option>";
                        }
                      }

                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bairro</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="bairro_endereco" value='<?php echo $bairro_endereco; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Zona</label><br>
                    <select class="form-control" name="zona_endereco">
                      <option selected value='<?php echo $zona_endereco; ?>'><?php echo  $zona_endereco; ?></option>
                      <option value="Urbana">Urbana</option>
                      <option value="Rural">Rural</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cep</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="cep_endereco" value='<?php echo $cep_endereco ?>' required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nacionalidade</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nacionalidade" value='<?php echo $nacionalidade; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">País</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="pais" value='<?php echo $pais; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Naturalidade</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="naturalidade" value='<?php echo $naturalidade; ?>' required="">
                  </div>
                </div>
                <div class="col-sm-3">

                  <div class="form-group">
                    <!-- <label for="exampleInputEmail1">localidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="localidade" value='$localidade;' >-->
                  </div>


                  <label for="exampleInputEmail1">Estado onde nasceu</label>

                  <select class="form-control" id="exampleInputEmail1" name="localidade">
                    <option></option>
                    <?php
                    $pesquisa_cidadade = listar_estado($conexao);
                    foreach ($pesquisa_cidadade as $key => $value) {
                      $id = $value['id'];
                      $nome_cidade = $value['nome'];
                      if ($id == $localidade) {
                        echo "<option value='$id' selected >$nome_cidade</option>";
                      } else {

                        echo "<option value='$id'>$nome_cidade</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Transporte Escolar Público</label><br>
                    <select class="form-control" name="transposte_escolar">
                      <option selected value='<?php echo $transposte_escolar; ?>'><?php echo $transposte_escolar  ?></option>
                      <option value="NÃO-UTILIZADO">Não Utilizado</option>
                      <option value="RODOVIÁRIO-VANS/KOMBI">RODOVIÁRIO-VANS/KOMBI</option>
                      <option value="RODOVIÁRIO-MICROONIBUS">RODOVIÁRIO-MICROONIBUS</option>
                      <option value="RODOVIÁRIO-OUTRO">RODOVIÁRIO-OUTRO</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Poder Público Responsável</label><br>
                    <select class="form-control" name="poder_publico_responsavel">
                      <option selected value='<?php echo $poder_publico_responsavel; ?>'><?php echo $poder_publico_responsavel ?></option>
                      <option value="Municipal">Municipal</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Recebe Escolarização Em Outro Espaço</label><br>
                    <select class="form-control" required name="recebe_escolaridade_outro_espaco">

                      <?php
                      if ($recebe_escolaridade_outro_espaco == "S") {
                        echo "
                                  <option value='S'selected>Sim</option>
                                  <option value='N'>Não</option>";
                      } else {
                        echo "
                                  <option value='N'selected>Não</option>
                                  <option value='S'>Sim</option>";
                      }
                      ?>

                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Profissão do aluno</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="profissao" value='<?php echo $profissao ?>'>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Situação Da Documentação</label><br>
                    <select class="form-control" required name="situacao_documentacao">
                      <option selected value='<?php echo  $situacao_documentacao; ?>'><?php echo  $situacao_documentacao ?></option>
                      <option value="Aluno Possui Documentação">Aluno Possui Documentação</option>
                      <option value="Aluno Não Possui Documentação">Aluno Não Possui Documentação</option>

                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Matrícula da certidão </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="matricula_certidao" value='<?php echo $matricula_certidao ?>' required="">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo De Certidão</label>
                    <select type="text" class="form-control" name="tipo_certidao">


                      <?php
                      if ($tipo_certidao == "N") {
                        echo "
                                <option value='C'>CERTIDÃO CASAMENTO</option>
                                <option value='N' selected>CERTIDÃO NASCIMENTO</option>";
                      } else {
                        echo "
                                <option value='C' selected>CERTIDÃO CASAMENTO</option>
                                <option value='N' >CERTIDÃO NASCIMENTO</option>";
                      }
                      ?>


                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Número Do Termo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="numero_termo" value='<?php echo $numero_termo ?>' required="">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Folha</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="folha" value='<?php echo $folha ?>' required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">UF cartorio</label><br>
                    <select class="form-control" required name="uf_cartorio" onchange="pesquisar_municipio(this.value,'uf_municipio_cartorio');">
                      <option value=''></option>
                      <?php
                      $idestado_cartorio = "";
                      $resultado_estado = listar_estado($conexao);
                      foreach ($resultado_estado as $key => $value) {
                        $idestado_cartorio = $value['id'];
                        $nome_estado = $value['nome'];
                        if ($idestado_cartorio == $uf_cartorio) {
                          echo "<option value='$idestado_cartorio' selected>$nome_estado</option>";
                        } else {
                          echo "<option value='$idestado_cartorio' >$nome_estado</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4" id="uf_municipio_cartorio">
                  <!-- municipio aqui -->
                  <div class='form-group'>
                    <label for='exampleInputEmail1'>Município</label>
                    <select type='text' class='form-control' name='municipio_cartorio'>
                      <option></option>

                      <?php
                      $pesquisa_cidadade = listar_cidade_por_idestado($conexao, $idestado_cartorio);
                      foreach ($pesquisa_cidadade as $key => $value) {
                        $idmunicipo_cartorio = $value['id'];
                        $nome_cidade = $value['nome'];
                        if ($idmunicipo_cartorio == $uf_municipio_cartorio) {
                          echo "<option value='$idmunicipo_cartorio' selected>$nome_cidade</option>";
                        } else {
                          echo "<option value='$idmunicipo_cartorio' >$nome_cidade</option>";
                        }
                      }

                      ?>
                    </select>
                  </div>
                </div>

              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Cartórios</label><br>
                  <input name="cartorio" class="form-control" value='<?php echo $cartorio; ?>' required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">N° Identidade</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="numero_indentidade" value='<?php echo $numero_indentidade; ?>'>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Uf Identidade</label>
                  <select class="form-control" name="uf_identidade">
                    <option></option>

                    <?php
                    $resultado_estado = listar_estado($conexao);
                    foreach ($resultado_estado as $key => $value) {
                      $idestado_rg = $value['id'];
                      $nome_estado = $value['nome'];
                      if ($uf_identidade == $idestado_rg) {
                        echo "<option value='$idestado_rg' selected> $nome_estado</option>";
                      } else {
                        echo "<option value='$idestado_rg'> $nome_estado</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Orgão Emissor</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="orgao_emissor_indentidade" value='<?php echo $orgao_emissor_indentidade ?>'>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Data Expedição Identidade</label>
                  <input type="date" class="form-control" id="exampleInputEmail1" name="data_expedicao" value='<?php echo $data_expedicao; ?>'>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">N° CNH</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="numero_cnh" value='<?php echo $numero_cnh; ?>'>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Categoria CNH</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="categoria_cnh" value='<?php echo $categoria_cnh; ?>'>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Cpf</label>
                  <input type="text" id="RegraValida" value="<?php echo $cpf; ?>" name="cpf" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" required>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="exampleInputEmail1">Cartão Sus</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="cartao_sus" value='<?php echo $cartao_sus; ?>' required="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Observações</label>
                  <textarea rows="3" class="form-control" id="exampleInputEmail1" name="observacao" value='<?php echo $observacao ?>' required=""><?php echo $observacao ?></textarea>
                </div>
              </div>
            </div>


          </div>




          <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
            <div class="card-body">

              <script>
                document.getElementById("idserie").onchange = function() {
                  var value = document.getElementById("idserie").value;
                };
              </script>

              <?php

              if ($escola_id != '') {
                echo "<input type='hidden' name='matricula_codigo' value='$matricula_codigo'>";
              } else {
                echo "<input type='hidden' name='matricula_codigo' value=''>";
              }
              ?>
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Escola</label>
                    <select class="form-control" name="escola" id="escola" onchange="lista_turma_escola_por_serie_cadatro_aluno();">
                      <option></option>
                      <?php
                      // $res_escola=lista_escola($conexao);

                      $res_escola = escola_associada($conexao, $idcoordenador);
                      foreach ($res_escola as $key => $value) {
                        $idescola = $value['idescola'];
                        $nome_escola = $value['nome_escola'];
                        if ($idescola == $escola_id) {
                          echo "<option value='$idescola' selected>$nome_escola </option>";
                        } else {

                          echo "<option value='$idescola'>$nome_escola </option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Turno</label>

                    <select class="form-control" name="turno" id="turno" onchange="lista_turma_escola_por_serie_cadatro_aluno();">
                      <option value="<?php echo "$turno"; ?>"><?php echo "$turno"; ?></option>
                      <option value="MATUTINO">MATUTINO</option>
                      <option value="VESPERTINO">VESPERTINO</option>
                      <option value="NOTURNO">NOTURNO</option>
                      <option value="INTEGRAL">INTEGRAL</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Série</label>
                    <select class="form-control" name="serie" id="idserie" onchange="lista_turma_escola_por_serie_cadatro_aluno();">
                      <!--    <select class="form-control"  name="serie" id="idserie" onchange="listar_turmas_por_serie(this.value);"> -->
                      <option></option>

                      <?php
                      $res_serie = lista_todas_series($conexao);
                      foreach ($res_serie as $key => $value) {
                        $id = $value['id'];
                        $nome_serie = $value['nome'];
                        if ($id == $serie_id) {
                          echo "<option value='$id' selected>$nome_serie </option>";
                        } else {

                          echo "<option value='$id'>$nome_serie </option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>



                <div class="col-sm-4">
                  <div class="form-group">
                    <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
                    <select class='form-control' name='turma' id='idturma' onchange=" listar_etapas_cad_aluno();quantidade_vaga_turma_cadastro_aluno();">
                      <?php

                      // $result=lista_de_turmas_das_escolas($conexao,$serie_id,$escola_id,$turno,$ano_letivo_vigente);

                      //  foreach ($result as $key => $value) {
                      //    $idturma=$value['idturma'];
                      //    $nome_turma=$value['nome_turma'];
                      //    if ($turma_id==$idturma) {
                      //    echo "<option value='$idturma' selected> $nome_turma</option>";

                      //    }else{

                      //    echo "<option value='$idturma'> $nome_turma</option>";
                      //    }
                      //  }
                      ?>

                    </select>
                  </div>
                </div>

                <span id="etapa">
                  <?php

                  if ($serie_id == 16) {
                    $result = "<label for='exampleInputEmail1'>Escolha a etapa </label>
                                             <select class='form-control' name='etapa'   required>
                                             <option></option>";
                    $res = $conexao->query("SELECT * FROM etapa_multissereada WHERE turma_id=$turma_id");
                    foreach ($res as $key => $value) {
                      $idetapa = $value['id'];
                      $nome_etapa = $value['etapa'];
                      if ($etapa == $idetapa) {
                        $result .= "<option value='$idetapa' selected>$nome_etapa</option>
                                    ";
                      }
                      $result .= "
                                  <option value='$idetapa'>$nome_etapa</option>
                                  ";
                    }

                    $result .= "</select>";
                    echo "$result";
                  } else {
                    echo "<input type='hidden' name='etapa' value=''>";
                  }
                  ?>

                </span>


                <div class="col-sm-3">
                  <div class="form-group">
                    <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>
                    <?php


                    // $quantidade_vaga_total=0;
                    // $quantidade_vaga_restante=0;

                    //   $res_quantidade= quantidade_vaga_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente);
                    //   foreach ($res_quantidade as $key => $value) {
                    //      $quantidade_vaga_total=$value['quantidade_vaga'];
                    //   }

                    //   $res_quantidade_vaga_restante= quantidade_aluno_na_turma($conexao,$escola_id,$turma_id,$turno,$ano_letivo_vigente);
                    //   foreach ($res_quantidade_vaga_restante as $key => $value) {
                    //      $quantidade_vaga_restante=$value['quantidade'];
                    //   }
                    //  $quantidade_vaga_restante=$quantidade_vaga_total-$quantidade_vaga_restante;


                    ?>
                    <input type="text" name="quantidade_vagas_restante" id="quantidade_vagas_restante" value="<?php echo $quantidade_vaga_restante ?>" readonly class="form-control">

                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class='text-danger'>Data Matrícula <b class="text-danger">*</b></label>

                    <input type="date" class="form-control" id="data_matricula" name="data_matricula" required <?php echo $disabled; ?> value="<?php echo $data_matricula; ?>">

                  </div>
                </div>
              </div>


              <br>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <button type="button" class="btn btn-block btn-success " id="btnSend" name="btnSend" onclick="editar_aluno();">Editar Aluno</button>

                  </div>
                </div>
              </div>

            </div>
            <!-- /.card -->

          </div>

    </form>
  </div>
  <!-- /.card -->

</div>

</div>

<div class="modal fade" id="modal-editar-imagem-aluno">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">AJUSTES NA IMAGEM!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!-- <canvas id="croppedCanvas"></canvas>
           <video id="video" width="180" height="180" autoplay></video>

           <button type="button" id="snap" >Tirar Foto</button>
           <canvas id="canvas" width="640" height="480"></canvas> -->
        <!-- /corpo -->
      </div>
      <button type="button" class="btn btn-primary" data-dismiss="modal">
        <font style="vertical-align: inherit;">
          <font style="vertical-align: inherit;">OK</font>
        </font>
      </button>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- ######################################################################## -->
<?php include_once "rodape.php"; ?>