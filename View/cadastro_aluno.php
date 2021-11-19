<?php 
session_start();
include_once 'cabecalho.php'; 
include_once 'barra_horizontal.php'; 
include_once "menu.php"; 
include_once "alertas.php"; 
include_once "../Model/Conexao.php"; 


?>
  <!-- Main Sidebar Container -->
<div class="content-wrapper">
<!-- ####################### CORPO ################################################# -->

    
      <form method="POST">
        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
              <li class="pt-2 px-3"><h3 class="card-title">CADASTRAR ALUNO</h3></li>
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
              <div class="tab-pane fade  active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                 <div class="card-body">


                    <div class="row">
                      <div class="col-sm-1">
                        <img src="imagens/user.png" class="img-thumbnail" alt="...">
                      </div>
 
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Código INEP</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_inep" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° Nis</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="n_nis" required="">
                        </div>
                      </div>

                       <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bolsa Familia</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
            
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nascimento</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" name="nascimento" required="">
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="email" required="">
                        </div>
                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Celular</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="celular" required="">
                        </div>
                      </div>
                    </div>
                   

                    <div class="row">
                      
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tipo responsável</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="PAI E/OU MÃE">PAI E/OU MÃE</option>
                            <option value="PAI">PAI</option>
                            <option value="MÃE">MÃE</option>
                            <option>----------------------------</option>
                          </select>
                        </div>
                      </div>


                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Raça do aluno</label><br>
                          <select style="height:38px;" class="form-select" aria-label=".form-select-lg example">
                            <option selected value="Não Declarada">Não Declarada</option>
                            <option value="Branco">Branco</option>
                            <option value="Negro">Negro</option>
                            <option value="Pardo">Pardo</option>
                            <option value="Amarelo">Amarelo</option>
                            <option value="Indigena">Indigena</option>
                            <option>----------------------------</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Estado Civil do aluno</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
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
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value=""></option>
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
                          <label for="exampleInputEmail1">Sexo do aluno</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_filiação1" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf_filiação1" required="">
                        </div>
                      </div>
                      <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsável</label>
                        </div>
                      </div>
                    </div>
                    <label for="exampleInputEmail1"><h5>Filiação 2</h5></label>
                    <div class="row">          
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_filiação2" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf_filiação2" required="">
                        </div>
                      </div>
                      <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsável</label>
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="endereco" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Complemento</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Número</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="numero" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Uf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="uf" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Município</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="municipio" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bairro</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="bairro" required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Zona</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="1">Urbana</option>
                            <option value="2">Rural</option>
                            <option>---------------------------</option>

                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cep</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cep" required="">
                        </div>
                      </div>
                    </div>
                    

                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nacionalidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nacionalidade" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">País</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="pais" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Naturalidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="naturalidade" required="" disabled>
                        </div>
                      </div>
                       <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">localidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="localidade" required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Transporte Escolar Público</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected>Não Utilizado</option>
                            <option>--------------------------------------------</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Poder Público Responsável</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option>--------------------------------------------</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Recebe Escolarização Em Outro Espaço</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                           
                          </select>
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Profissão</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="profissão" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Local de procedência </label>
                            <select name="" id=" "> 
                              <option value="Escola da rede">Escola da REDE</option>
                              <option value="Escola da fora">Escola da FORA</option>

                            </select> 
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">.</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="numero" required="">
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
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected>Aluno Possui Documentação</option>
                            <option value="1">Aluno Não Possui Documentação</option>
                            <option>-------------------------------------------------------------</option>
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_inep" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Matricula</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="matricula" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tipo De Certidão</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="tipo_certidao" required="">
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
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="1">-------------------------------------------------------------</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Municipio</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="1">-------------------------------------------------------------</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cartórios</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="1">-------------------------------------------------------------</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° Identidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="n_identidade" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Complemento</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Uf Identidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="uf_identidade" required="">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Orgão Emissor</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="orgao_emissor" required="" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Data Expedição Identidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="data_expedicao_identidade" required="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="n_cnh" required="" disabled>
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="categoria_cnh" required="">
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf" required="" disabled>
                        </div>
                      </div>
          
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cartão Sus</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cartão_sus" required="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Observações</label>
                          <textarea rows="3" class="form-control" id="exampleInputEmail1" name="observações" required=""></textarea>
                       </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Contato</label>
                          <textarea rows="3" class="form-control" id="exampleInputEmail1" name="contato" required=""></textarea>
                       </div>
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="necessidade" required="" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Apoio Pedagógico</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="1"></option>
                            <option>----------------------------------------------------------------------------------------------------------------------------------</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tipo De Diagnóstico</label><br>
                          <select style="height:38px;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected></option>
                            <option value="1"></option>
                            <option>-------------------------------------------------------------</option>
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


              <div class="tab-pane fade " id="custom-tabs-two-matricula" role="tabpanel" aria-labelledby="custom-tabs-two-matricula-tab">
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="codigo_inep_aluno" required="" disabled>
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



