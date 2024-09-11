<?php

use GuzzleHttp\Psr7\Query;

session_start();
  include_once "cabecalho.php";
  include_once "alertas.php";
  include_once "barra_horizontal.php";
  include_once 'menu.php';
  if (!isset($_SESSION['usuariobd'])) {
    // Se não estiver definida, atribui o valor padrão 'educ_lem'
    $_SESSION['usuariobd'] = 'educ_lem';
}
$usuariobd=$_SESSION['usuariobd'];
include_once "../Model/Conexao_".$usuariobd.".php";
  include_once '../Controller/Conversao.php';
  include_once "../Model/Serie.php"; 
  include_once "../Model/Escola.php"; 
  include_once "../Model/Estado.php"; 
  include_once "../Model/Coordenador.php"; 
  $idcoordenador=$_SESSION['idfuncionario'];

?> 

  
<script>
     document.addEventListener('DOMContentLoaded', (event) => {
         document.querySelectorAll('input').forEach(input => {
             input.addEventListener('keydown', function(event) {
                 if (event.key === 'Enter') {
                     event.preventDefault();
                     if (input.id === 'pesquisa_nome_aluno') {
                         lista_espera();
                     }
                 }
             });
         });
     });

 
 </script>
<script src="ajax.js?<?php echo rand(); ?>"></script>


 
<div class="content-wrapper" style="min-height: 529px;">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
 
          

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->



            </section>



            <!-- Main content -->

            <section class="content">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">LISTA DE ESPERA DE VAGAS </h3>
              </div> 
              <div class="container-fluid">
           

                <div class="row">
                  <div class="col-md-12">
                    <br>
                <form class="mt-12"  method="POST" id="form_lista_espera">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Escola</label>
                         <select class="form-control"  name="escola_associada" id="escola_associada">
                          <!-- <option></option> -->
                       <?php 
                         // $res_escola=lista_escola($conexao);

                        $res_escola= escola_associada($conexao,$idcoordenador);
                         foreach ($res_escola as $key => $value) {
                             $idescola=$value['idescola'];
                             $nome_escola=$value['nome_escola'];
                             echo "<option value='$idescola'>$nome_escola t</option>";
                         }
                         ?>
                         </select>
                        </div>
                      </div>                      
         
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Série</label>
                            <select class="form-control"  name="serie_id" id="serie_id">
                            <!-- <option></option> -->

                            <?php 
                              $res_serie=pesquisar_ordem_proxima_serie($conexao,'id=1');
                              foreach ($res_serie as $key => $value) {
                                  $id=$value['id'];
                                  $nome_serie=$value['nome'];
                                  echo "<option value='$id'>$nome_serie </option>";
                              }
                            ?>

                            </select>
                        </div>
                      </div> 

                      <div class="col-sm-6">
                        <div class="form-group">
                           <label class="text-danger" for="exampleInputEmail1">Nome do aluno *</label>
                           <input type="text" class="form-control" name="nome_aluno" required="">
                             
                        </div>
                      </div>                     
          
                       <div class="col-sm-3">
                        <div class="form-group">
                           <label class="text-danger" for="exampleInputEmail1">Data nasc. aluno *</label>
                           <input type="date" class="form-control"  name="data_nascimento" required="">
                             
                        </div>
                      </div>                       

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label class="text-danger" for="exampleInputEmail1">Cpf do aluno *</label>

                           <input type="text" name="cpf_aluno"  id="cpf_aluno" class="form-control" placeholder="Digite seu CPF do aluno" required=""  onkeyup="fMasc( this, mCPF ); ValidaCPF('cpf_aluno');" maxlength="14">
                             
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="text-danger">Nome do responsável *</label>
                           <input type="text" class="form-control"  name="nome_responsavel" required="">
                             
                        </div>
                      </div> 

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label class="text-danger" for="exampleInputEmail1">WhatsApp do responsável *</label>
                           <input type="tel" class="form-control" name="telefone"    required="">
                             
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Cpf do responsável</label>
                           <div id="status_cpf"></div>
                  
                           <input type="text" name="cpf_responsavel"  id="cpf" class="form-control" placeholder="Digite seu CPF do responsável" required  onkeyup="fMasc( this, mCPF ); ValidaCPF('cpf');" maxlength="14">


                             
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Endereço</label>
                           <input type="text" class="form-control" name="endereco"    required>
                             
                        </div>
                        </div> 
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label class="text-danger" for="exampleInputEmail1">Nec especial *</label><br>
                            <select class="form-control" required="" name="nec_especial" id="nec_especial">
                              <option value='S'>Sim</option>
                              <option value='N' selected>Não</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label class="text-danger" for="exampleInputEmail1">Tipo deficiência *</label><br>
                            <select class="form-control" id="tipo_nec" required="" name="tipo_nec" onchange="mostrarCampoOutros()">
                              <option value="tea">Transtorno do Espectro autista (TEA)</option>
                              <option value="Nenhuma" selected>Nenhuma</option>
                              <option value="Outros">Outros</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6" id="outros_campo" style="display: none;">
                          <div class="form-group">
                            <label for="outrosDeficiencia">Outros tipos de deficiência</label><br>
                            <input type="text" class="form-control" name="outrosDeficiencia" id="outrosDeficiencia">
                          </div>
                          <script>
                            function mostrarCampoOutros() {
                              var select = document.getElementById("tipo_nec");
                              var outrosCampo = document.getElementById("outros_campo");

                              if (select.value === "Outros") {
                                outrosCampo.style.display = "block";
                              } else {
                                outrosCampo.style.display = "none";
                              }
                            }
                          </script>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                             <label for="exampleInputEmail1">Observação</label>
                             <textarea class="form-control" name="observacao" rows="1"></textarea>
                               
                          </div>
                        </div>
                        <div class="row">

                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                        <br>
                            <button onclick="submit_post_generico('../Controller/Cadastrar_lista_espera.php,form_lista_espera,btn_lista_espera'); lista_espera();"  class="btn btn-block btn-success" id="btn_lista_espera" >Cadastrar na lista</button>

                             
                        </div>
                      </div>
                             


                    </div> 


               
                    </form> 
                    <br>

                    <div class="container-fluid">

                  <div class="row">
                    <div class="col-sm-4">
                      <label for="exampleInputEmail1">Filtrar por escola</label>
                        <select id="escola" class="form-control form-control">

                            <option value="Todas" style='color: black; background-color:#A9A9A9;'>TODAS AS ESCOLAS</option>
                            <?php 

                            $res_turma=escola_associada($conexao,$idcoordenador); 
                            $array_escolas_coordenador=array();
                            $conta_escolas=0;
                            foreach ($res_turma as $key => $value) {
                              $array_escolas_coordenador[$conta_escolas]=$value['idescola'];
                              $conta_escolas++;
                            }
                          $res_escola=lista_escola($conexao); 
                          foreach ($res_escola as $key => $value) {
                              $idescola=$value['idescola'];
                              $nome_escola=$value['nome_escola'];
                              if (in_array($idescola, $array_escolas_coordenador) ) { 
                                echo"<option value='$idescola' style='color: black; background-color:#A9A9A9;'>$nome_escola </option>";
                              }else{
                                echo"<option value='$idescola'>$nome_escola </option>";

                              }
                          }
                            ?>
                        </select>
                    </div>  
                    <div class="col-sm-6"> 
                        <label for="exampleInputEmail1">Pesquisar aluno</label>
                          <input type="search" id="pesquisa_nome_aluno" class="form-control form-control" 
                          placeholder="Pesquisar aluno">
                        
                    </div>
                        <div class="col-sm-2"> 
                          <label><br></label><br>
                        <a class="btn btn-primary" onclick="lista_espera();">Buscar</a>
                        </div>
                  </div> 

                  <div id='tabela_pesquisa'>
                  </div>
                  <div id="paginacao">
                  </div>
                  <input type="hidden" value="30" id="valor_paginacao">
                  </div> 

                    <br>
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">DADOS ALUNO</th>
                              <th scope="col">DADOS RESPONSÁVEL</th>
                              <th scope="col">ESCOLA</th>
                              <th scope="col">SERIE</th>
                              <th scope="col">OBSERVAÇÃO</th>
                              <th scope="col">OPÇÃO</th> 

                            </tr>
                          </thead>
                          <tbody id="tabela_lista_espera">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>               
                  </div>
                </div> 
              </div>
    </div>

  </section>

  <script type="text/javascript">
    setTimeout("lista_espera();",1000);
  </script>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->
  <div class="modal fade" id="modal-lista-espera">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar dados lista de espera!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">
       
        <!-- corpo -->




        <form class="mt-12"  method="POST" id="form_lista_espera_editar">
               

                
        </form>



        <!-- /corpo -->          
      </div>
      

      <button type="button" class="btn " data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Fechar</font></font></button>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">
  const inputEle = document.getElementById('pesquisa_nome_aluno');
  inputEle.addEventListener('keyup', function(e){
    var key = e.which || e.keyCode;
    if (key == 13) { // codigo da tecla enter
      lista_espera();
     
    }
  });
  </script>
 <?php 

    include_once 'rodape.php';

 ?>