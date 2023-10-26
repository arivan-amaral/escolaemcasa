<?php
session_start();


if (!isset($_SESSION['idfuncionario'])) {
  header("location:index.php?status=0");
} else {

  $idcoordenador = $_SESSION['idfuncionario'];
}
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
include_once "../Model/Serie.php";
include_once "../Model/Escola.php";
include_once "../Model/Estado.php";
include_once "../Model/Coordenador.php";




if ($_SESSION['nivel_acesso_id'] == 100) {
  $disabled = '';
} else {
  $disabled = 'disabled';
}

$campos = array('id', 'cpf_aluno', 'cadunico', 'nivel_escolar_id', 'bairro_id', 'tipo_responsavel', 'sexo_aluno', 'bolsa_familia', 'telefone1', 'telefone2', 'data_hora', 'protocolo', 'bairro_mora_existe', 'enviado', 'idaluno', 'nome_aluno', 'data_nascimento', 'endereco', 'numero', 'complemento', 'nome_mae', 'nome_pai', 'nome_responsavel', 'cpf_responsavel', 'bolsa_familia', 'protocolo', 'bairro_id', 'escola_id', 'serie_id', 'turno_id', 'confirmado', 'nome_turno', 'nome_escola', 'nome_serie');

foreach ($campos as $value) {
  if (empty($_GET[$value])) {
    ${$value} = null;
  } else {
    ${$value} = $_GET[$value];
  }
}


?>

<script src="ajax.js?<?php echo rand(); ?>"></script>
<!-- Main Sidebar Container -->
<div class="content-wrapper">
  <!-- ####################### CORPO ################################################# -->
  <!-- <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->
  <form name="form1" id="form1">


    <div class="card card-primary card-tabs">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
          <li class="pt-2 px-3">
            <h3 class="card-title">CADASTRAR ALUNO</h3>
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


      <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
          <div class="tab-pane fade  active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
            <div class="card-body">


              <div class="row">
                <div class="col-sm-1">
                  <img src="imagens/user.png" class="img-thumbnail" alt="...">
                </div>

                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Código INEP</label>
                    <input type="text" class="form-control" id="codigo_inep" name="codigo_inep" required="">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">N° Nis</label>
                    <input type="text" class="form-control" id="numero_nis" name="numero_nis" required="" value="<?php echo "$cadunico"; ?>">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bolsa familia</label><br>
                    <select class="form-control" name="bolsa_familia" id="bolsa_familia" required>
                      <option></option>
                      <?php

                      if ($bolsa_familia == "Sim") {
                        echo "<option value='S' selected>Sim</option>";
                      } else if ($bolsa_familia == "Não") {
                        echo " <option value='N' selected>Não</option>";
                      }
                      ?>
                      <option value="S">Sim</option>
                      <option value="N">Não</option>

                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Local de procedência </label>
                    <select name="local_procedencia" id="local_procedencia" class="form-control">
                      <option value="Escola da fora">Escola de FORA</option>
                      <option value="Aluno novo">Aluno novo</option>

                    </select>
                  </div>
                </div>

              </div>



              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" id="nome" name="nome" required="" value="<?php echo $nome_aluno; ?>">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nascimento <b class="text-danger">*</b></label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required="" onchange="idade_aluno();" value="<?php echo $data_nascimento; ?>">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Idade</label>
                    <input type="text" class="form-control" id="idade" name="idade" required="" disabled>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email </label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="email">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Whatsapp aluno</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="whatsapp" onkeypress="$(this).mask('(00) 0000-00009')" value="<?php echo "$telefone2"; ?>">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Whatsapp responsável</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="whatsapp_responsavel" onkeypress="$(this).mask('(00) 0000-00009')" value="<?php echo "$telefone1"; ?>">
                  </div>
                </div>
              </div>


              <div class="row">

                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Necessidade especial</label><br>
                    <select class="form-control" name="necessidade_especial">
                      <option value='N'>NÃO</option>
                      <option value='S'>SIM</option>
                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Apoio pedagógico</label><br>
                    <select class="form-control" name="apoio_pedagogico">
                      <option></option>
                      <option value='SEM APOIO PEDAGÓGICO'>SEM APOIO PEDAGÓGICO</option>
                      <option value="COM APOIO PEDAGÓGICO">COM APOIO PEDAGÓGICO</option>
                      <option value="COM APOIO PEDAGÓGICO (OUTRO ESTABELECIMENTO)">COM APOIO PEDAGÓGICO (OUTRO ESTABELECIMENTO)</option>
                    </select>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo de diagnóstico</label><br>
                    <select class="form-control" name="tipo_diagnostico">
                      <option></option>

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
                </div><br>
                
                <div class="row">
                  <div class="col-sm-12 alert alert-secondary">
                  </div>
                </div>

                <div class="row">

                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tipo responsável</label><br>
                      <select class="form-control" required name="tipo_responsavel">
                        <?php echo " <option value='$tipo_responsavel' >$tipo_responsavel</option>"; ?>"
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
                        <option selected value="Não Declarada">Não Declarada</option>
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
                        <option selected></option>

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
                        <?php
                        if ($sexo_aluno == 'Masculino') {
                          echo " <option value='M'>$sexo_aluno</option>";
                        } else if ($sexo_aluno == 'Feminino') {
                          echo " <option value='F'>$sexo_aluno</option>";
                        }


                        ?>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>

                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome do responsável <b class="text-danger">*</b></label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nome_responsavel" required="" value="<?php echo $nome_responsavel; ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cpf do responsável </label>
                      <input type="text" id="RegraValida" name="cpf_responsavel" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" required value="<?php echo $cpf_responsavel; ?>">
                      <span class="text-success" id="status_cpf"></span>
                    </div>
                  </div>
                  <!-- <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsável</label>
                        </div>
                      </div> -->
                </div>





                <label for="exampleInputEmail1">
                  <h5>Filiação 1 </h5>
                </label>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome filiação 1 </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="filiacao1" required="" value="<?php echo $nome_mae; ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cpf filiação 1 </label>
                      <input type="text" id="RegraValida" value="" name="cpf_filiacao1" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" required>
                      <span class="text-success" id="status_cpf"></span>
                    </div>
                  </div>
                  <!-- <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsável</label>
                        </div>
                      </div> -->
                </div>
                <label for="exampleInputEmail1">
                  <h5>Filiação 2 </h5>
                </label>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome filiação 2 </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="filiacao2" required="" value="<?php echo $nome_pai; ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cpf filiação 2 </label>
                      <input type="text" id="RegraValida" value="" name="cpf_filiacao2" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" required>

                    </div>
                  </div>
                  <!-- <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsável</label>
                        </div>
                      </div> -->
                </div>

              </div>
            </div>


            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Endereço</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="endereco" required="" value="<?php echo $endereco; ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Complemento</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" value="<?php echo $complemento; ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Número</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="numero_endereco" required="" value="<?php echo $numero; ?>">
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
                          echo "<option value='$idestado'>$nome_estado</option>";
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
                        <option value="<?php echo $_SESSION["IDCIDADE"] ?>"><?php echo $_SESSION["CIDADE"] ?></option>
                        <?php
                        $pesquisa_cidadade = listar_cidade_por_idestado($conexao, 5);
                        foreach ($pesquisa_cidadade as $key => $value) {
                          $id = $value['id'];
                          $nome_cidade = $value['nome'];
                          echo "<option value='$id'>$nome_cidade</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Bairro</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="bairro_endereco" required="">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Zona</label><br>
                      <select class="form-control" name="zona_endereco">
                        <option selected></option>
                        <option value="Urbana">Urbana</option>
                        <option value="Rural">Rural</option>


                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cep</label>
                      <input type="number" class="form-control" id="exampleInputEmail1" name="cep_endereco" required="" value="">
                    </div>
                  </div>
                </div>



                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nacionalidade</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nacionalidade" required="" value="Brasileira">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">País</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="pais" required="" value="Brasil">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Naturalidade</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="naturalidade" required="">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Estado onde nasceu</label>

                      <select class="form-control" id="exampleInputEmail1" name="localidade">
                        <option></option>
                        <?php
                        $pesquisa_cidadade = listar_estado($conexao);
                        foreach ($pesquisa_cidadade as $key => $value) {
                          $id = $value['id'];
                          $nome_cidade = $value['nome'];
                          echo "<option value='$id'>$nome_cidade</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Transporte Escolar Público</label><br>
                      <select class="form-control" name="transposte_escolar">

                        <option selected>Não Utilizado</option>
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
                        <option value="Municipal">Municipal</option>




                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Recebe Escolarização Em Outro Espaço</label><br>
                      <select class="form-control" required name="recebe_escolaridade_outro_espaco">

                        <option value="N">Não</option>
                        <option value="S">Sim</option>

                      </select>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Profissão do aluno</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="profissao">
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
                      <input type="text" class="form-control" id="exampleInputEmail1" name="matricula_certidao" required>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tipo De Certidão</label>
                      <select type="text" class="form-control" name="tipo_certidao">
                        <option value="N">CERTIDÃO NASCIMENTO</option>
                        <option value="C">CERTIDÃO CASAMENTO</option>

                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Número Do Termo</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="numero_termo" required="">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Folha</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="folha" required="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">UF cartorio</label><br>
                      <select class="form-control" required name="uf_cartorio" onchange="pesquisar_municipio(this.value,'uf_municipio_cartorio');">
                        <option></option>
                        <?php
                        $resultado_estado = listar_estado($conexao);
                        foreach ($resultado_estado as $key => $value) {
                          $idestado = $value['id'];
                          $nome_estado = $value['nome'];
                          echo "<option value='$idestado'> $nome_estado</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-4" id="uf_municipio_cartorio">
                    <!-- municipio aqui -->
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cartório</label><br>
                      <input name="cartorio" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">N° Identidade</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="numero_indentidade">
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
                          $idestado = $value['id'];
                          $nome_estado = $value['nome'];
                          echo "<option value='$idestado'> $nome_estado</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Orgão Emissor</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="orgao_emissor_indentidade">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Data Expedição Identidade</label>
                      <input type="date" class="form-control" id="exampleInputEmail1" name="data_expedicao">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">N° CNH</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="numero_cnh">
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Categoria CNH</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="categoria_cnh">
                    </div>
                  </div>


                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cpf</label>
                      <input type="text" id="RegraValida" name="cpf" onkeyup="javascript: fMasc( this, mCPF ); ValidaCPF();" class="form-control" maxlength="14" required value="<?php echo $cpf_aluno ?>">
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cartão Sus</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="cartao_sus" required="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Observações</label>
                      <textarea rows="3" class="form-control" id="exampleInputEmail1" name="observacao" required=""></textarea>
                    </div>
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
                          echo "<option value='$idescola'>$nome_escola </option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Turno</label>

                      <select class="form-control" name="turno" id="turno" onchange="lista_turma_escola_por_serie_cadatro_aluno();">
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
                          echo "<option value='$id'>$nome_serie </option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>



                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
                      <select class='form-control' name='turma' id='idturma' onchange=" listar_etapas_cad_aluno();quantidade_vaga_turma_cadastro_aluno();">

                      </select>
                    </div>
                  </div>

                  <span id="etapa">
                    <input type="hidden" name="etapa" value="">
                  </span>


                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

                      <input type="text" name="quantidade_vagas_restante" id="quantidade_vagas_restante" value="0" readonly class="form-control">

                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class='text-danger'>Data Matrícula <b class="text-danger">*</b></label>

                      <input type="date" class="form-control" id="data_matricula" name="data_matricula" required <?php echo $disabled; ?> value="<?php echo date('Y-m-d'); ?>">

                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="button" class="btn btn-block btn-success " id="btnSend" name="btnSend" onclick="cadastro_aluno();">Cadastrar Aluno</button>
                    </div>
                  </div>

                </div>

              </div>
              <!-- /.card -->

            </div>

          </div>

  </form>

  <!-- ######################################################################## -->
</div>

<?php include_once "rodape.php"; ?>