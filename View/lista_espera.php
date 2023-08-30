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
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Escola</label>
                         <select class="form-control"  name="escola_id" id="escola" onchange="lista_turma_cadastrada_escola_por_serie('tabela');" required>
                          <!-- <option></option> -->
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

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Nome do aluno</label>
                           <input type="text" class="form-control" name="nome_aluno" required>
                             
                        </div>
                      </div>                     
          
                       <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Data nasc. do aluno</label>
                           <input type="date" class="form-control"  name="data_nascimento" required>
                             
                        </div>
                      </div>                       

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Cpf do aluno</label>

                           <input type="text" name="cpf_aluno"  id="cpf_aluno" class="form-control" placeholder="Digite seu CPF do aluno" required=""  onkeyup="fMasc( this, mCPF ); ValidaCPF('cpf_aluno');" maxlength="14">
                             
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Nome do responsável</label>
                           <input type="text" class="form-control"  name="nome_responsavel" required="">
                             
                        </div>
                      </div> 
                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Cpf do responsável</label>
                           <div id="status_cpf"></div>
                  
                           <input type="text" name="cpf_responsavel"  id="cpf" class="form-control" placeholder="Digite seu CPF do responsável" required=""  onkeyup="fMasc( this, mCPF ); ValidaCPF('cpf');" maxlength="14">


                             
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">WhatsApp do responsável</label>
                           <input type="tel" class="form-control" name="telefone"    required="">
                             
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Endereço</label>
                           <input type="text" class="form-control" name="endereco"    required="">
                             
                        </div>
                      </div> 
                      <div class="col-sm-5">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Observação</label>
                           <textarea class="form-control" name="observacao" rows="5"></textarea>
                             
                        </div>
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

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                             <label for="exampleInputEmail1">Filtrar por Escola</label>
                             <select class="form-control" id="escola_associada" onchange="lista_espera();" >
                              <option value='Todas'>Todas </option>
                                <?php 
                                 $res_escola= $conexao->query("SELECT * from escola ORDER BY nome_escola asc");
                                  $lista_escola_associada=""; 
                                
                                foreach ($res_escola as $key => $value) {
                                    $id=$value['idescola'];
                                   $nome_escola=($value['nome_escola']);
                                 
                                    $lista_escola_associada.= "
                                         <option value='$id'>$nome_escola </option>

                                     ";
                                }
                                echo "$lista_escola_associada";
                                ?>
                             </select>
                               
                          </div>
                        </div>
                        <!-- <div class="col-sm-5">
                          <div class="form-group">
                             <label for="exampleInputEmail1">Endereço</label>
                             <input type="text" class="form-control" name="endereco"    required="">
                               
                          </div>
                        </div> -->
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


 <?php 

    include_once 'rodape.php';

 ?>