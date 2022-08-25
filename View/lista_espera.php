<?php 

session_start();
  include "cabecalho.php";
  include "alertas.php";
  include "barra_horizontal.php";
  include 'menu.php';
  include '../Model/Conexao.php';
  include '../Controller/Conversao.php';
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
                <form class="mt-12"  method="GET">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Escola</label>
                         <select class="form-control"  name="escola" id="escola" onchange="lista_turma_cadastrada_escola_por_serie('tabela');" required>
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
                          <label for="exampleInputEmail1">Série</label>
                            <select class="form-control"  name="idserie" id="idserie">
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
                           <input type="text" class="form-control"  required>
                             
                        </div>
                      </div>                     

                       <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Data nasc. do aluno</label>
                           <input type="date" class="form-control"   required>
                             
                        </div>
                      </div>                       

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Cpf do aluno</label>
                           <input type="text" class="form-control"   required>
                             
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Nome do responsável</label>
                           <input type="text" class="form-control"   required="">
                             
                        </div>
                      </div> 
                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Cpf do responsável</label>
                           <input type="text" class="form-control"   required>
                             
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                           <label for="exampleInputEmail1">WhatsApp do responsável</label>
                           <input type="tel" class="form-control"     required="">
                             
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Endereço</label>
                           <input type="text" class="form-control"     required="">
                             
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                        <br>
                            <button   class="btn btn-block btn-success " >Cadastrar na lista</button>

                             
                        </div>
                      </div>
                             


                    </div> 


               
                    </form> 
                    <br>
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">DADOS ALUNO</th>
                              <th scope="col">DADOS RESPONSÁVEL</th>
                              <th scope="col">ESCOLA</th>
                              <th scope="col">SERIE</th>
                              <th scope="col">OPÇÃO</th> 
                              
                            </tr>
                          </thead>
                          <tbody id="tabela">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>               
                  </div>
                </div> 
              </div>
    </div>

  </section>

</div>

<aside class="control-sidebar control-sidebar-dark">

  <!-- Control sidebar content goes here -->

</aside>

  <!-- /.control-sidebar -->


 <?php 

    include 'rodape.php';

 ?>