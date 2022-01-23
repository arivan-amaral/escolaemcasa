<?php 
session_start();
include_once 'cabecalho.php'; 
include_once 'barra_horizontal.php'; 
include_once "menu.php"; 
include_once "alertas.php"; 
include_once "../Model/Conexao.php"; 
include_once "../Model/Serie.php"; 
include_once "../Model/Escola.php"; 
include_once "../Model/Estado.php"; 
include_once "../Model/Coordenador.php"; 
$idcoordenador=$_SESSION['idfuncionario'];


 
?>


<script src="ajax.js?<?php echo rand(); ?>"></script>
  <!-- Main Sidebar Container -->
<div class="content-wrapper">
<!-- ####################### CORPO ################################################# -->
   <!-- <H1> <font color='red'>PÁGINA EM MANUTENÇÃO</font> </H1><BR> -->

 
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
                          <input type="text" class="form-control" id="numero_nis" name="numero_nis" required="">
                        </div>
                      </div>

                       <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bolsa Familia</label><br>
                          <select  class="form-control" name="bolsa_familia" id="bolsa_familia" required>
                            <option selected></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
            
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Local de procedência </label>
                            <select name="local_procedencia" id="local_procedencia"  class="form-control" > 
                              <option value="Escola da rede">Escola da REDE</option>
                              <option value="Escola da fora">Escola de FORA</option>

                            </select> 
                        </div>
                      </div>

                    </div>



                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome</label>
                          <input type="text" class="form-control" id="nome" name="nome" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nascimento</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" name="data_nascimento" required="">
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
                      <div class="col-sm-4">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="email"  >
                        </div>
                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Whatsapp aluno</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="whatsapp"  >
                        </div>
                      </div>                      
                      <div class="col-sm-4">
                         <div class="form-group">
                          <label for="exampleInputEmail1">Whatsapp responsável</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="whatsapp_responsavel"  >
                        </div>
                      </div>
                    </div>
                   


                   <div class="row">
                 

                     <div class="col-sm-4">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Necessidade especial</label><br>
                         <select  class="form-control" name="necessidade_especial">
                           <option value='N'>NÃO</option>
                           <option value='S'>SIM</option>
                         </select>
                       </div>
                     </div>
         
                     <div class="col-sm-3">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Apoio Pedagógico</label><br>
                         <select  class="form-control" name="apoio_pedagogico">
                             <option></option>
                             <option value='SEM APOIO PEDAGÓGICO'>SEM APOIO PEDAGÓGICO</option>
                              <option value="COM APOIO PEDAGÓGICO">COM APOIO PEDAGÓGICO</option>
                              <option value="COM APOIO PEDAGÓGICO (OUTRO ESTABELECIMENTO)">COM APOIO PEDAGÓGICO (OUTRO ESTABELECIMENTO)</option>
                         </select>
                       </div>
                     </div>

                     <div class="col-sm-3">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Tipo De Diagnóstico</label><br>
                         <select  class="form-control" name="tipo_diagnostico">
                             <option></option>
                          
                           <option value='SEM DIAGNÓSTICO'>SEM DIAGNÓSTICO</option>
                           <option value='FICHA DE AVALIAÇÃO'>FICHA DE AVALIAÇÃO</option>
                           <option value='LAUDO TÉCNICO'>LAUDO TÉCNICO</option>
                         </select>
                       </div>
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
                          <select  class="form-control" required name="tipo_responsavel">
                            <option value="MÃE">MÃE</option>
                            <option value="PAI">PAI</option>
                            <option value="OUTRO">OUTRO</option>
                             
                          </select>
                        </div>
                      </div>


                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Raça do aluno</label><br>
                          <select   class="form-control" name="raca_aluno" required>
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
                          <select  class="form-control" name="estado_civil_aluno" required>
                    
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
                          <select  class="form-control" required name="tipo_sanguinio_aluno">
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
                          <select  class="form-control" required id='sexo' name="sexo">
                          
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="nome_responsavel" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf do responsável</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf_responsavel" required="">
                        </div>
                      </div>
                      <!-- <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsável</label>
                        </div>
                      </div> -->
                    </div> 
     
      
      
 

                    <label for="exampleInputEmail1"><h5>Filiação 1</h5></label>
                    <div class="row">          
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome filiação 1</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="filiacao1" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf filiação 1</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf_filiacao1" required="">
                        </div>
                      </div>
                      <!-- <div class="col-sm-4"><br><br>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Responsável</label>
                        </div>
                      </div> -->
                    </div>
                    <label for="exampleInputEmail1"><h5>Filiação 2</h5></label>
                    <div class="row">          
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nome filiação 2</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="filiacao2" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf filiação 2</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf_filiacao2" required="">
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="endereco" required="">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Complemento</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="complemento" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Número</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="numero_endereco" required="">
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
                              $resultado_estado= listar_estado($conexao);
                              foreach ($resultado_estado as $key => $value) {
                                $idestado=$value['id'];
                                $nome_estado=$value['nome'];
                                echo "<option value='$idestado'>$nome_estado</option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3"id="municipio_endereco">
                        <!-- municipio aqui -->
                        <div class='form-group'>
                          <label for='exampleInputEmail1'>Município</label>
                          <select type='text' class='form-control'  name='municipio_endereco' >
                            <option value="515">Luís Eduardo Magalhães</option>
                            <?php 
                        $pesquisa_cidadade=listar_cidade_por_idestado($conexao,5);
                        foreach ($pesquisa_cidadade as $key => $value) {
                          $id=$value['id'];
                          $nome_cidade=$value['nome'];
                          echo"<option value='$id'>$nome_cidade</option>"; 
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
                          <select   class="form-control" name="zona_endereco">
                            <option selected></option>
                            <option value="Urbana">Urbana</option>
                            <option value="Rural">Rural</option>
                           

                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cep</label>
                          <input type="number" class="form-control" id="exampleInputEmail1" name="cep_endereco" required="">
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
                          <label for="exampleInputEmail1">localidade</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="localidade" >
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
                          <select   class="form-control" name="poder_publico_responsavel">
                            <option  value="Municipal">Municipal</option>

   
        
                           
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Recebe Escolarização Em Outro Espaço</label><br>
                          <select  class="form-control" required name="recebe_escolaridade_outro_espaco">
      
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
                          <select  class="form-control" required name="situacao_documentacao">
                             
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
                          <input type="text" class="form-control" id="exampleInputEmail1" name="matricula_certidao" required="">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tipo De Certidão</label>
                          <select type="text" class="form-control"  name="tipo_certidao">
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
                          <select  class="form-control" required name="uf_cartorio"  onchange="pesquisar_municipio(this.value,'uf_municipio_cartorio');">
                            <option></option>
                            <?php 
                              $resultado_estado= listar_estado($conexao);
                              foreach ($resultado_estado as $key => $value) {
                                $idestado=$value['id'];
                                $nome_estado=$value['nome'];
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
                          <label for="exampleInputEmail1">Cartórios</label><br>
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
                          <select class="form-control"  name="uf_identidade" >
                            <option></option>

                          <?php 
                              $resultado_estado= listar_estado($conexao);
                              foreach ($resultado_estado as $key => $value) {
                                $idestado=$value['id'];
                                $nome_estado=$value['nome'];
                                echo "<option value='$idestado'> $nome_estado</option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Orgão Emissor</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="orgao_emissor_indentidade" >
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Data Expedição Identidade</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" name="data_expedicao" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">N° CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="numero_cnh"   >
                        </div>
                      </div>
                       
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Categoria CNH</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="categoria_cnh"  >
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cpf</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cpf"    >
                        </div>
                      </div>
              
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cartão Sus</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="cartao_sus" required="" >
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
 document.getElementById("idserie").onchange = function(){
    var value = document.getElementById("idserie").value;
 };
</script>


        
          <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Escola</label>
                         <select class="form-control"  name="escola" id="escola" onchange="lista_turma_escola_por_serie_cadatro_aluno();">
                          <option></option>
                       <?php 
                         // $res_escola=lista_escola($conexao);

                        $res_escola= escola_associada($conexao,$idcoordenador);
                         foreach ($res_escola as $key => $value) {
                             $idescola=$value['idescola'];
                             $nome_escola=$value['nome_escola'];
                             echo "<option value='$idescola'>$nome_escola </option>";
                         }
                         ?>
                         </select>
                        </div>
                      </div>                      

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Turno</label>
    
                         <select class="form-control"  name="turno" id="turno" onchange="lista_turma_escola_por_serie_cadatro_aluno();" >
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
                            <select class="form-control"  name="serie" id="idserie" onchange="lista_turma_escola_por_serie_cadatro_aluno();">
                              <!--    <select class="form-control"  name="serie" id="idserie" onchange="listar_turmas_por_serie(this.value);"> -->
                            <option></option>

                          <?php 
                            $res_serie=lista_todas_series($conexao);
                            foreach ($res_serie as $key => $value) {
                                $id=$value['id'];
                                $nome_serie=$value['nome'];
                                echo "<option value='$id'>$nome_serie </option>";
                            }
                            ?>
                            </select>
                        </div>
                      </div>
                      

                                
                        <div class="col-sm-4">
                        <div class="form-group">
                        <label for='exampleInputEmail1' class='text-danger'>Turma pretendida</label>
                          <select class='form-control'  name='idturma' id='idturma' onchange="quantidade_vaga_turma_cadastro_aluno();"> 
                          
                        </select>
                         </div>
                       </div>

                       <span id="etapa">
                        <input type="hidden" name="etapa" value="">
                    
                      </span>
            <div class="col-sm-6">
              <div class="form-group" >
                <label for='exampleInputEmail1' class='text-danger'>Vagas restantes na turma</label>

                <input type="text"  name="quantidade_vagas_restante" id="quantidade_vagas_restante" value="0" readonly class="alert alert-secondary">
                 
              </div>
            </div>
                    </div>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
             <button   class="btn btn-block btn-success " id="btn_cadastro_aluno" onclick="cadastro_aluno();">Cadastrar Aluno</button>

         </div>
        </div>
        
      </div>
                  


          
          </div>
          <!-- /.card -->



           
        </div>
  
  

</div>
    





<!-- ######################################################################## -->
</div>
<?php include_once "rodape.php"; ?>



