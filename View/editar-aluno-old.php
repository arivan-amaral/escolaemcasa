<?php 
session_start();
include_once 'cabecalho.php'; 
include_once 'barra_horizontal.php'; 
include_once "menu.php"; 
include_once "alertas.php"; 
include_once "../Model/Conexao.php"; 
include_once "../Model/Aluno.php"; 


$id = 50003;
$res =pesquisar_aluno2($conexao,$id);
$nome = "";
$sexo = "";
$email = "";
$filiacao1 = "";
$filiacao2 ="";
$documento = "";
$whatsapp = "";
$codigo_inep = "";
$numero_nis = "";
$data_nascimento = "";
$tipo_responsavel = "";
$raca_aluno="";
$estado_civil_aluno="";
$tipo_sanguinio_aluno="";
$cpf_filiacao1="";
$cpf_filiacao2="";
$situacao_documentacao = "";
$tipo_certidao="";
$endereco ="";
$complemento = "";
$numero_endereco = "";
$uf_endereco = "";
$municipio_endereco = "";
$bairro_endereco = "";
$zona_endereco = "";
$cep_endereco = "";
$nacionalidade = "";
$pais="";
$naturalidade="";
$localidade = "";
$transposte_escolar = "";
$poder_publico_responsavel = "";
$recebe_escolaridade_outro_espaco = "";
$matricula_certidao="";
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
$tipo_certidao = "";
$numero_termo = "";
$data_expedicao = "";
$cpf = "";


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
    $documento = $value['documento'];
    $whatsapp = $value['whatsapp'];
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
    $pais= $value['pais'];
    $naturalidade= $value['naturalidade'];
    $localidade = $value['localidade'];
    $transposte_escolar = $value['transposte_escolar'];
    $poder_publico_responsavel = $value['poder_publico_responsavel'];
    $recebe_escolaridade_outro_espaco = $value['recebe_escolaridade_outro_espaco'];
    $profissao = $value['profissao'];
    $situacao_documentacao = $value['situacao_documentacao'];
    $matricula_certidao= $value['matricula_certidao'];
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
    $matricula_certidao = $value['matricula_certidao'];
    $tipo_certidao = $value['tipo_certidao'];
    $numero_termo = $value['numero_termo'];
    $data_expedicao = $value['data_expedicao'];
    $cpf = $value['cpf'];
}
?>
  <!-- Main Sidebar Container -->
<div class="content-wrapper">
<!-- ####################### CORPO ################################################# -->

      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-1"></div>
          <div class="col-sm-10 alert alert-<?php echo $tema_aplivacao; ?>">
          <center>  
            <h1 class="m-0">
              <b>
                <?php echo $nome_escola_global ?>
              </b>
            </h1>
          </center>

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->    
      <form method="POST">
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
              <li class="pt-2 px-3"><h3 class="card-title">CADASTRAR ALUNO</h3></li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Dados Pessoais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Endereço</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Documentos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Cursos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-necessidades-tab" data-toggle="pill" href="#custom-tabs-two-necessidades" role="tab" aria-controls="custom-tabs-two-necessidades" aria-selected="false">Necessidades Especiais</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-matricula-tab" data-toggle="pill" href="#custom-tabs-two-matricula" role="tab" aria-controls="custom-tabs-two-matricula" aria-selected="false">Matricula INEP</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
              <div class="tab-pane fade" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                 <div class="card-body">
                    <div class="row">
                      <div class="col-sm-1">
                        <img src="imagens/user.png" class="img-thumbnail" alt="...">
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código INEP</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_inep" value='<?php echo $codigo_inep; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° Nis</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="n_nis" value='<?php echo $numero_nis; ?>' required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome" value='<?php echo $nome; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nascimento</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" name="nascimento" value='<?php echo $data_nascimento; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Idade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="idade" required="" disabled>
                        </div>
                      </div>             
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="email" value='<?php echo $email; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Celular</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="celular" value='<?php echo $whatsapp; ?>' required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Contato</label><br>
                          <select class="form-control">
                            <option selected></option>
                            <option value="Whastapp">Whastapp</option>
                            <option value="Telefone">Telefone</option>
                            <option value="Email">Email</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Filiação</label><br>
                          <select class="form-control">
                            <option selected value='<?php echo $tipo_responsavel; ?>'><?php echo $tipo_responsavel ?></option>
                            <option value="PAI E/OU MÃE">PAI E/OU MÃE</option>
                            <option value="PAI">PAI</option>
                            <option value="MÃE">MÃE</option>

                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Raça</label><br>
                          <select  class="form-control" >
                            <option selected value='<?php echo $raca_aluno ?>'><?php echo $raca_aluno ?></option>
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
                          <label for="exampleInputEmail1">Estado Civil</label><br>
                          <select class="form-control" >
                            <option selected value='<?php echo $estado_civil_aluno; ?>'><?php echo $estado_civil_aluno ?></option>
                            <option value="Solteiro">Solteiro</option>
                            <option value="Casado">Casado</option>
                            <option value="Separado">Separado</option>
                            <option value="Divorciado">Divorciado</option>
                            <option value="Viúvo">Viúvo</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tipo Sanguineo</label><br>
                          <select class="form-control" >
                            <option selected value='<?php echo $tipo_sanguinio_aluno;?>'><?php echo $tipo_sanguinio_aluno;?></option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Sexo</label><br>
                          <select class="form-control">
                            <option selected value='<?php echo $sexo ?>'><?php if ($sexo == 'M'){echo "Masculino";}else{ echo "Feminino";} {
                              // code...
                            }?></option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <label for="exampleInputEmail1"><h5>Filiação 1</h5></label>
                    <div class="row">          
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_filiação1" value='<?php echo $filiacao1; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf_filiação1" value='<?php echo $cpf_filiacao1; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsavel</label>
                        </div>
                      </div>
                    </div>
                    <label for="exampleInputEmail1"><h5>Filiação 2</h5></label>
                    <div class="row">          
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_filiação2" value='<?php echo $filiacao2; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf_filiação2" value='<?php echo $cpf_filiacao2; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsavel</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-primary ">Proximo</button>
                      </div>  
                    </div>
                 </div>
              </div>
              <div class="tab-pane fade active show" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
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
                          <label for="exampleInputEmail1">complemento</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" value='<?php echo $complemento; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">numero</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="numero" value='<?php echo $numero_endereco; ?>' required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Uf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="uf"  value='<?php echo $uf_endereco; ?>'  required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Municipio</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="municipio"  value='<?php echo $municipio_endereco; ?>'  required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bairro</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="bairro"  value='<?php echo  $bairro_endereco; ?>'  required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Zona</label><br>
                          <select  class="form-control">
                            <option selected  value='<?php echo $zona_endereco; ?>' ><?php echo $zona_endereco ?></option>
                            <option value="Urbana">Urbana</option>
                            <option value="Rural">Rural</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cep</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cep" value='<?php echo $cep_endereco; ?>' required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Telefone</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="telefone" value='<?php echo $whatsapp; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Fax</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="fax" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="email" value='<?php echo $email; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Caixa Postal</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="caixa_postal" required="">
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="naturalidade" value='<?php echo $naturalidade; ?>' required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">localidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="localidade" value='<?php echo $localidade; ?>' required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Transporte Escolar Público</label><br>
                          <select class="form-control">
                            <option selected value='<?php echo $transposte_escolar; ?>'><?php echo $transposte_escolar; ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Poder Público Responsável</label><br>
                          <select class="form-control" >
                            <option selected value='<?php echo  $poder_publico_responsavel; ?>'><?php echo  $poder_publico_responsavel ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Recebe Escolarização Em Outro Espaço</label><br>
                          <select class="form-control" >
                            <option selected value='<?php echo  $recebe_escolaridade_outro_espaco; ?>'><?php echo  $recebe_escolaridade_outro_espaco ?></option>
                            <option value="1">Sim</option>
                            <option value="2">Não</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bolsa Familia</label><br>
                          <select class="form-control" >
                            <option selected value='<?php echo $bolsa_familia; ?>'><?php echo $bolsa_familia ?></option>
                            <option value="1">Sim</option>
                            <option value="2">Não</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Profissão</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="profissão" value='<?php echo $profissao; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">local de procedencia </label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">.</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="numero" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-primary ">Proximo</button>
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
                          <select class="form-control">
                            <option selected value='<?php echo $situacao_documentacao; ?>'><?php echo $situacao_documentacao ?></option>
                            <option value="1">Aluno Não Possui Documentação</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código INEP</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_inep" value='<?php echo $codigo_inep ?>' required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Matricula</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="matricula" value='<?php echo $matricula_certidao; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tipo De Certidão</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="tipo_certidao" value='<?php echo $tipo_certidao; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Número Do Termo</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="numero_termo" value='<?php echo $numero_termo; ?>' required="">
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
                          <select class="form-control">
                            <option selected value='<?php echo $uf_cartorio; ?>'><?php echo $uf_cartorio ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Municipio</label><br>
                          <select class="form-control">
                            <option selected value='<?php echo $municipio_cartorio; ?>'><?php echo $municipio_cartorio ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cartorios</label><br>
                          <select class="form-control" >
                            <option selected value='<?php echo $nome_cartorio; ?>'><?php echo $nome_cartorio ?></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° Identidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="n_identidade" value='<?php echo  $numero_indentidade; ?>'  required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Complemento</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" value='<?php echo $numero_indentidade; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Uf Identidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="uf_identidade" value='<?php echo $uf_identidade; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Orgão Emissor</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="orgao_emissor" value='<?php echo $orgao_emissor_indentidade; ?>' required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Data Expedição Identidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="data_expedicao_identidade" value='<?php echo $data_expedicao; ?>' required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="n_cnh" required="" value='<?php echo $numero_cnh; ?>' disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">1° CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="1_cnh" required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Categoria CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="categoria_cnh" value='<?php echo $categoria_cnh; ?>' required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Emissão CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="emissao_cnh" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Vencimento CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="vencimento_cnh" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf" required="" value='<?php echo $cpf; ?>'  disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° Passaporte</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="n_passaporte" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cartão Sus</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cartão_sus" value='<?php echo $cartao_sus; ?>' required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Observações</label>
                          <textarea rows="3" class="form-control" id="exampleInputEmail1" name="observações" value='<?php echo $observacao; ?>' required=""><?php echo $observacao; ?></textarea>
                       </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Contato</label>
                          <textarea rows="3" class="form-control" id="exampleInputEmail1" name="contato" required=""></textarea>
                       </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-primary ">Proximo</button>
                      </div>  
                    </div>
                 </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Escola</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_escola" 
                          required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Escola</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_escola" 
                          required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Calendario</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_calendario" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Calendario</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_calendario" required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Aluno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_aluno" 
                          required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Aluno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_aluno" 
                          required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Etapa</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_etapa" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Etapa</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_etapa" required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Curso</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_curso" 
                          required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Curso</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_curso" 
                          required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Turno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_turno" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Turno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_turno" required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Base Curricular</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_base_curricular" 
                          required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Base Curricular</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_base_curricular" 
                          required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Codigo Situação</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_situacao" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome Situação</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_situacao" required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <button type="button" class="btn btn-primary ">Incluir</button>
                      </div>  
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registros</font></font></h3>

                            <div class="card-tools">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Procurar">

                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nome Da Escola</font></font></th>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nome Do Curso</font></font></th>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nome Da Base</font></font></th>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nome Do Calendario</font></font></th>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Situação</font></font></th>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nome Da Etapa</font></font></th>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nome Do Turno</font></font></th>
                                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Opções</font></font></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">183</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">John Doe</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">07-11-2014</font></font></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                </tr>
                                <tr>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">183</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">John Doe</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">07-11-2014</font></font></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                </tr>
                                <tr>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">183</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">John Doe</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">07-11-2014</font></font></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                </tr>
                                <tr>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">183</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">John Doe</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">07-11-2014</font></font></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                </tr>
                                <tr>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">183</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">John Doe</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">07-11-2014</font></font></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                </tr>
                                <tr>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">183</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">John Doe</font></font></td>
                                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">07-11-2014</font></font></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                  <td><span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aprovado</font></font></span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                 </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-two-necessidades" role="tabpanel" aria-labelledby="custom-tabs-two-necessidades-tab">
                 <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo" required="" >
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código Aluno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_aluno" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Necessidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="necessidade" value='<?php echo $necessidade_especial; ?>' required="" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Apoio Pedagógico</label><br>
                          <select class="form-control">
                            <option selected value='<?php echo $apoio_pedagogico; ?>'><?php echo  $apoio_pedagogico?></option>
                            <option value="1"></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tipo De Diagnóstico</label><br>
                          <select class="form-control">
                            <option selected value='<?php echo $tipo_diagnostico; ?>'><?php echo $tipo_diagnostico ?></option>
                            <option value="1"></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Ultima Alteração</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="ultima_alteracao" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Data</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" name="data" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-primary ">Proximo</button>
                      </div>  
                    </div>
                 </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-two-matricula" role="tabpanel" aria-labelledby="custom-tabs-two-matricula-tab">
                 <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código Aluno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_aluno" required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código INEP Do Aluno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_inep_aluno" value='<?php echo $codigo_inep ?>' required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código INEP Da Turma</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_inep_turma" required="" >
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Matricula INEP</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="matricula_inep" required="" >
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Ano</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="ano" required="" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-primary ">Incluir</button>
                      </div>  
                    </div>
                 </div>
              </div>
          </div>
          <!-- /.card -->
        </div>
      </form>
  

</div>
    





<!-- ######################################################################## -->
</div>
<?php include_once "rodape.php"; ?>



